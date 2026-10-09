#!/usr/bin/env bash
#
# Lumeco one-command deploy → Hostinger shared hosting.
#
#   ./deploy.sh              build, test, upload, migrate, cache, verify
#   ./deploy.sh --deps       also run `composer install` on the server (new PHP packages)
#   ./deploy.sh --skip-tests skip the local test suite
#   ./deploy.sh --skip-build skip `npm run build` (reuse existing public/build)
#
# Credentials: create a gitignored `.deploy.env` next to this file with
#   DEPLOY_PASSWORD='your-ssh-password'
# (or export DEPLOY_PASSWORD / set DEPLOY_SSH_KEY=/path/to/key). If none is
# found you'll be prompted once per run.
#
set -euo pipefail

# ─── Server settings ────────────────────────────────────────────────────────
SSH_HOST="82.29.157.119"
SSH_PORT="65002"
SSH_USER="u764517528"
REMOTE_APP="/home/u764517528/domains/lumeco.co.uk/lumeco_app"
SITE_URL="https://lumeco.co.uk"

# ─── Flags ──────────────────────────────────────────────────────────────────
RUN_DEPS=0; RUN_TESTS=1; RUN_BUILD=1
for arg in "$@"; do
    case "$arg" in
        --deps)        RUN_DEPS=1 ;;
        --skip-tests)  RUN_TESTS=0 ;;
        --skip-build)  RUN_BUILD=0 ;;
        -h|--help)     grep '^#' "$0" | sed 's/^# \{0,1\}//'; exit 0 ;;
        *) echo "Unknown option: $arg" >&2; exit 1 ;;
    esac
done

# ─── Pretty output ──────────────────────────────────────────────────────────
if [ -t 1 ]; then B=$'\e[1m'; G=$'\e[32m'; Y=$'\e[33m'; R=$'\e[31m'; C=$'\e[36m'; X=$'\e[0m'; else B=; G=; Y=; R=; C=; X=; fi
step() { echo; echo "${B}${C}▸ $*${X}"; }
ok()   { echo "  ${G}✓${X} $*"; }
die()  { echo "  ${R}✗ $*${X}" >&2; exit 1; }

cd "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# ─── Preconditions ──────────────────────────────────────────────────────────
command -v tar >/dev/null || die "tar not found"
[ -f artisan ] || die "run this from the Laravel project root"

# ─── Credentials ────────────────────────────────────────────────────────────
[ -f .deploy.env ] && set -a && . ./.deploy.env && set +a
USE_KEY=0
if [ -n "${DEPLOY_SSH_KEY:-}" ] && [ -f "${DEPLOY_SSH_KEY}" ]; then
    USE_KEY=1
else
    command -v sshpass >/dev/null || die "sshpass not found (or set DEPLOY_SSH_KEY to use a key)"
    if [ -z "${DEPLOY_PASSWORD:-}" ]; then
        read -rsp "SSH password for ${SSH_USER}@${SSH_HOST}: " DEPLOY_PASSWORD; echo
        [ -n "$DEPLOY_PASSWORD" ] || die "no password provided"
    fi
fi

SSH_OPTS=(-p "$SSH_PORT" -o StrictHostKeyChecking=accept-new -o ConnectTimeout=40)
SCP_OPTS=(-P "$SSH_PORT" -o StrictHostKeyChecking=accept-new -o ConnectTimeout=40)
ssh_run() {
    if [ "$USE_KEY" = 1 ]; then ssh -i "$DEPLOY_SSH_KEY" "${SSH_OPTS[@]}" "$SSH_USER@$SSH_HOST" "$@"
    else SSHPASS="$DEPLOY_PASSWORD" sshpass -e ssh "${SSH_OPTS[@]}" "$SSH_USER@$SSH_HOST" "$@"; fi
}
scp_up() {
    if [ "$USE_KEY" = 1 ]; then scp -i "$DEPLOY_SSH_KEY" "${SCP_OPTS[@]}" "$1" "$SSH_USER@$SSH_HOST:$2"
    else SSHPASS="$DEPLOY_PASSWORD" sshpass -e scp "${SCP_OPTS[@]}" "$1" "$SSH_USER@$SSH_HOST:$2"; fi
}

# ─── 1. Tests ───────────────────────────────────────────────────────────────
if [ "$RUN_TESTS" = 1 ]; then
    step "Running tests"
    php artisan test >/dev/null 2>&1 || die "tests failed — deploy aborted (use --skip-tests to override)"
    ok "tests passed"
else
    step "Skipping tests"
fi

# ─── 2. Build assets ────────────────────────────────────────────────────────
if [ "$RUN_BUILD" = 1 ]; then
    step "Building front-end assets"
    npm run build >/dev/null 2>&1 || die "npm run build failed"
    ok "assets built into public/build"
else
    step "Skipping build (reusing public/build)"
fi
[ -d public/build ] || die "public/build missing — run without --skip-build"

# ─── 3. Package ─────────────────────────────────────────────────────────────
step "Packaging release"
BUNDLE="$(mktemp -t lumeco-deploy-XXXX.tar.gz)"
trap 'rm -f "$BUNDLE"' EXIT
tar czf "$BUNDLE" \
    --exclude='./node_modules' --exclude='./.git' --exclude='./vendor' \
    --exclude='./.env' --exclude='./.env.example' --exclude='./.deploy.env' \
    --exclude='./.agents' --exclude='./logo' --exclude='./skills-lock.json' \
    --exclude='./tests' --exclude='./PRODUCT.md' --exclude='./DESIGN.md' \
    --exclude='./deploy.sh' \
    --exclude='./database/database.sqlite' \
    --exclude='./storage/logs/*.log' \
    --exclude='./storage/framework/cache/data/*' \
    --exclude='./storage/framework/sessions/*' \
    --exclude='./storage/framework/views/*' \
    --exclude='./bootstrap/cache/*.php' \
    -C . .
ok "bundle $(du -h "$BUNDLE" | cut -f1)"

# ─── 4. Upload ──────────────────────────────────────────────────────────────
step "Uploading to server"
scp_up "$BUNDLE" "~/deploy_release.tar.gz" || die "upload failed"
ok "uploaded"

# ─── 5. Remote deploy ───────────────────────────────────────────────────────
step "Deploying on server"
ssh_run "
set -e
cd '$REMOTE_APP'
tar xzf ~/deploy_release.tar.gz -C '$REMOTE_APP'
rm -f ~/deploy_release.tar.gz resources/views/welcome.blade.php
$( [ "$RUN_DEPS" = 1 ] && echo 'composer install --no-dev --optimize-autoloader --no-interaction' )
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R ug+rwX storage bootstrap/cache
echo REMOTE_OK
" | sed 's/^/  /'
ok "server updated"

# ─── 6. Verify ──────────────────────────────────────────────────────────────
step "Verifying live site"
CODE="$(curl -s -o /dev/null -w '%{http_code}' --max-time 30 "$SITE_URL/" || echo 000)"
[ "$CODE" = "200" ] || die "site returned HTTP $CODE"
ok "home page HTTP 200"
ACODE="$(curl -s -o /dev/null -w '%{http_code}' --max-time 30 "$SITE_URL/admin/login" || echo 000)"
[ "$ACODE" = "200" ] && ok "admin login HTTP 200" || echo "  ${Y}! admin login HTTP $ACODE${X}"

echo
echo "${B}${G}Deployed successfully → $SITE_URL${X}"
