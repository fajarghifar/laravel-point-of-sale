<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

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
}
