<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Models\UmkmOwner;
use App\Models\User;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create roles
        Role::create(['name' => 'Customer']);
    }


    public function  test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_user()
    {
        $data = [
            'username' => 'test_user',
            'name' => 'Test User',
            'phone_number' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-konsumen'), $data);

        $response->assertRedirect(route('auth.login'));
        $response->assertSessionHas('success', 'Registration successful.');

        $this->assertDatabaseHas('users', [
            'username' => $data['username'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'email' => $data['email'],
        ]);

        $user = User::where('email', $data['email'])->first();
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertTrue($user->hasRole('Customer'));
    }
}
