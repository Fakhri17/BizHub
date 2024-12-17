<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    private function createUserWithRole(string $roleName, array $userData): User
    {
        Role::create(['name' => $roleName]);

        $user = User::create(array_merge($userData, [
            'password' => Hash::make($userData['password']),
            'avatar_path' => '',
        ]));

        $user->assignRole($roleName);

        return $user;
    }

    private function loginUser(string $email, string $password)
    {
        return $this->withoutMiddleware()->post('/login-proses', [
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function test_super_admin_can_login(): void
    {
        $this->createUserWithRole('Super Admin', [
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'password' => 'admin123',
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $response = $this->loginUser('admin@gmail.com', 'admin123');
        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_umkm_owner_can_login(): void
    {
        $this->createUserWithRole('UMKM Owner', [
            'username' => 'umkmowner',
            'name' => 'UMKM Owner',
            'email' => 'umkmowner@gmail.com',
            'phone_number' => '081234567891',
            'password' => 'umkm123',
            'address' => 'Jl. Raya No. 2',
            'role_id' => '2'
        ]);

        $response = $this->loginUser('umkmowner@gmail.com', 'umkm123');
        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_customer_can_login(): void
    {
        $this->createUserWithRole('Customer', [
            'username' => 'customer',
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone_number' => '081234567892',
            'password' => 'customer123',
            'address' => 'Jl. Raya No. 3',
            'role_id' => '3'
        ]);

        $response = $this->loginUser('customer@gmail.com', 'customer123');
        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_user_login_with_invalid_password(): void
    {
        $customer = $this->createUserWithRole('Customer', [
            'username' => 'customer',
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone_number' => '081234567892',
            'password' => 'customer123',
            'address' => 'Jl. Raya No. 3',
            'role_id' => '3'
        ]);

        $this->loginUser($customer->email, 'wrong-password');
        $this->assertGuest();
    }

    public function test_user_can_logout(): void
    {
        $this->withoutExceptionHandling();

        $umkmOwner = $this->createUserWithRole('UMKM Owner', [
            'username' => 'umkmowner',
            'name' => 'UMKM Owner',
            'email' => 'umkmowner@gmail.com',
            'phone_number' => '081234567891',
            'password' => 'umkm123',
            'address' => 'Jl. Raya No. 2',
            'role_id' => '2'
        ]);

        $this->actingAs($umkmOwner);

        $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
        $response = $this->post(route('auth.logout'));

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
