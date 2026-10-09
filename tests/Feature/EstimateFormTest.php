<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class EstimateFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_with_the_estimate_form(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Spaces refined')
            ->assertSeeLivewire('estimate-form');
    }

    public function test_a_valid_submission_stores_a_lead_and_shows_success(): void
    {
        Livewire::test('estimate-form')
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@company.com')
            ->set('phone', '(416) 555-0100')
            ->set('address', '1 King St W, Toronto')
            ->set('message', 'Weekly office cleaning for 4,000 sq ft.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('sent', true);

        $this->assertDatabaseCount('leads', 1);
        $this->assertDatabaseHas('leads', [
            'name'   => 'Jane Doe',
            'email'  => 'jane@company.com',
            'status' => 'new',
        ]);
    }

    public function test_it_validates_required_fields(): void
    {
        Livewire::test('estimate-form')
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->call('submit')
            ->assertHasErrors(['name' => 'required', 'email' => 'email']);

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_send_another_resets_the_success_state(): void
    {
        Livewire::test('estimate-form')
            ->set('name', 'Sam Lee')
            ->set('email', 'sam@acme.com')
            ->call('submit')
            ->assertSet('sent', true)
            ->call('sendAnother')
            ->assertSet('sent', false)
            ->assertSet('name', '');
    }
}
