<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

final class AdminTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'email' => 'admin@lumeco.co.uk',
            'password' => Hash::make('secret123'),
        ]);
    }

    public function test_guests_are_redirected_from_admin_to_login(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_log_in_and_see_requests(): void
    {
        $admin = $this->admin();
        Lead::create(['name' => 'Sarah Whitfield', 'email' => 'sarah@meridian.com', 'message' => 'Weekly office cleaning.']);

        $this->post(route('admin.login.attempt'), [
            'email' => 'admin@lumeco.co.uk',
            'password' => 'secret123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Estimate requests')
            ->assertSee('Sarah Whitfield');
    }

    public function test_bad_credentials_are_rejected(): void
    {
        $this->admin();
        $this->post(route('admin.login.attempt'), [
            'email' => 'admin@lumeco.co.uk',
            'password' => 'wrong',
        ])->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_opening_a_lead_marks_it_read_and_actions_work(): void
    {
        $this->actingAs($this->admin());
        $lead = Lead::create(['name' => 'David Chen', 'email' => 'david@northline.com', 'message' => 'Switch vendors.', 'status' => 'new']);

        $component = Livewire::test('admin.leads-table')
            ->call('toggle', $lead->id)
            ->assertSet('expanded', $lead->id);
        $this->assertSame('read', $lead->fresh()->status);

        $component->call('markUnread', $lead->id);
        $this->assertSame('new', $lead->fresh()->status);

        $component->call('markRead', $lead->id);
        $this->assertSame('read', $lead->fresh()->status);

        $component->call('delete', $lead->id);
        $this->assertDatabaseCount('leads', 0);
    }

    public function test_search_and_filter(): void
    {
        $this->actingAs($this->admin());
        Lead::create(['name' => 'Sarah Whitfield', 'email' => 'sarah@meridian.com', 'message' => 'office', 'status' => 'new']);
        Lead::create(['name' => 'David Chen', 'email' => 'david@northline.com', 'message' => 'retail', 'status' => 'read']);

        Livewire::test('admin.leads-table')
            ->set('search', 'meridian')
            ->assertSee('Sarah Whitfield')
            ->assertDontSee('David Chen')
            ->set('search', '')
            ->set('filter', 'read')
            ->assertSee('David Chen')
            ->assertDontSee('Sarah Whitfield');
    }

    public function test_admin_can_change_password(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        Livewire::test('admin.account-settings')
            ->set('current_password', 'secret123')
            ->set('password', 'newsecret456')
            ->set('password_confirmation', 'newsecret456')
            ->call('updatePassword')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $this->assertTrue(Hash::check('newsecret456', $admin->fresh()->password));
    }
}
