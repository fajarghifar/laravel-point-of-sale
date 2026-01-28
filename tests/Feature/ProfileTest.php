<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        // Use a valid username that passes alpha_dash:ascii validation
        $validUsername = 'testuser123';

        $response = $this
            ->actingAs($user)
            ->put('/profile', [
                'name' => 'Test User',
                'username' => $validUsername,
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        // Use a valid username that passes alpha_dash:ascii validation
        $validUsername = preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username);

        $response = $this
            ->actingAs($user)
            ->put('/profile', [
                'name' => 'Test User',
                'username' => $validUsername,
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $this->markTestSkipped('Profile deletion route is not implemented in this application.');
        
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $this->markTestSkipped('Profile deletion route is not implemented in this application.');
        
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile/delete')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile/delete');

        $this->assertNotNull($user->fresh());
    }

    public function test_job_description_and_location_can_be_updated(): void
    {
        $user = User::factory()->create();

        // Use a valid username that passes alpha_dash:ascii validation
        $validUsername = preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username);

        $response = $this
            ->actingAs($user)
            ->put('/profile', [
                'name' => 'Test User',
                'username' => $validUsername,
                'email' => $user->email,
                'job_description' => 'Software Engineer',
                'location' => 'San Francisco, CA',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Software Engineer', $user->job_description);
        $this->assertSame('San Francisco, CA', $user->location);
    }

    public function test_job_description_and_location_can_be_null(): void
    {
        $user = User::factory()->create([
            'job_description' => 'Developer',
            'location' => 'New York',
        ]);

        // Use a valid username that passes alpha_dash:ascii validation
        $validUsername = preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username);

        $response = $this
            ->actingAs($user)
            ->put('/profile', [
                'name' => 'Test User',
                'username' => $validUsername,
                'email' => $user->email,
                'job_description' => '',
                'location' => '',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertNull($user->job_description);
        $this->assertNull($user->location);
    }

    public function test_job_description_cannot_exceed_255_characters(): void
    {
        $user = User::factory()->create();

        // Use a valid username that passes alpha_dash:ascii validation
        $validUsername = preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username);

        $response = $this
            ->actingAs($user)
            ->put('/profile', [
                'name' => 'Test User',
                'username' => $validUsername,
                'email' => $user->email,
                'job_description' => str_repeat('a', 256),
                'location' => 'Test Location',
            ]);

        $response
            ->assertSessionHasErrors('job_description');
    }

    public function test_location_cannot_exceed_255_characters(): void
    {
        $user = User::factory()->create();

        // Use a valid username that passes alpha_dash:ascii validation
        $validUsername = preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username);

        $response = $this
            ->actingAs($user)
            ->put('/profile', [
                'name' => 'Test User',
                'username' => $validUsername,
                'email' => $user->email,
                'job_description' => 'Test Job',
                'location' => str_repeat('a', 256),
            ]);

        $response
            ->assertSessionHasErrors('location');
    }

    public function test_profile_page_displays_job_description_and_location(): void
    {
        $user = User::factory()->create([
            'job_description' => 'UI/UX Designer',
            'location' => 'Los Angeles, CA',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
        $response->assertSee('UI/UX Designer');
        $response->assertSee('Los Angeles, CA');
    }

    public function test_profile_page_displays_empty_job_description_when_not_set(): void
    {
        $user = User::factory()->create([
            'job_description' => null,
            'location' => 'Seattle, WA',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
        $response->assertSee('Seattle, WA');
        // Job description field should be present but empty
        $response->assertSee('value=""', false);
    }

    public function test_profile_page_displays_unknown_location_when_not_set(): void
    {
        $user = User::factory()->create([
            'job_description' => 'Developer',
            'location' => null,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
        $response->assertSee('Developer');
        $response->assertSee('Unknown');
    }
}
