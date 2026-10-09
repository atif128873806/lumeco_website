<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

#[Signature('lumeco:admin {email : Admin email address} {--name=Lumeco Admin : Display name} {--password= : Password (generated if omitted)}')]
#[Description('Create or update the Lumeco admin login')]
final class CreateAdminUser extends Command
{
    public function handle(): int
    {
        $email = mb_strtolower(trim((string) $this->argument('email')));
        $password = (string) ($this->option('password') ?: Str::password(16));
        $generated = ! $this->option('password');

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => (string) $this->option('name'),
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        $this->info($user->wasRecentlyCreated ? "Admin created: {$email}" : "Admin updated: {$email}");

        if ($generated) {
            $this->newLine();
            $this->warn('Generated password (store it now, it will not be shown again):');
            $this->line("  {$password}");
        }

        return self::SUCCESS;
    }
}
