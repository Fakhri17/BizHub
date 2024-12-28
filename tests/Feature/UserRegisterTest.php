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

        //
        $roles = [
            'UMKM Owner',
            'Customer',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }


    public function  test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_user_consumen()
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

    public function test_umkm_owner(): void
    {
        $this->withoutExceptionHandling();

        $data = [
            'username_umkm' => 'test_owner',
            'name_umkm' => 'Test Owner',
            'phone_number_umkm' => '1234567890',
            'address_umkm' => '123 Test Street',
            'email_umkm' => 'testuser@example.com',
            'password_umkm' => 'password',
            'password_confirmation' => 'password',
            'npwp' => '12.345.678.9-012.345',
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-umkm'), $data);

        $this->assertDatabaseHas('users', [
            'username' => $data['username_umkm'],
            'email' => $data['email_umkm']
        ]);

        $user = User::where('email', $data['email_umkm'])->first();
        $user->assignRole('UMKM Owner');
        $this->assertTrue($user->hasRole('UMKM Owner'));
        $this->assertDatabaseHas('umkm_owners', [
            'user_id' => $user->id,
            'npwp' => $data['npwp']
        ]);

        $response->assertRedirect(route('auth.login'));
        $response->assertSessionHas('success', 'Registrasi Berhasil.');
    }
}
