<?php

namespace Tests\Unit\SuperAdmin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    private function createSuperAdmin(): User
    {
        Role::create(['name' => 'Super Admin']);

      
        $user = User::create([
           'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'password' => Hash::make('admin123'),
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $user->assignRole('Super Admin');

        return $user;
    }

    private function loginUser(string $email, string $password)
    {
        return $this->withoutMiddleware()->post('/login-proses', [
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function test_super_admin_login_wihout_data(): void
    {
        $response = $this->loginUser('', '');
        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_super_admin_login_with_no_email(): void
    {
        $this->createSuperAdmin();
        $response = $this->loginUser('', 'admin123');
        $response->assertSessionHasErrors(['email']);
    }

    public function test_super_admin_login_with_no_password(): void
    {
        $this->createSuperAdmin();
        $response = $this->loginUser('admin@gmail.com', '');
        $response->assertSessionHasErrors(['password']);
    }

    public function test_super_admin_login_with_wrong_email(): void
    {
        $this->createSuperAdmin();
        $response = $this->loginUser('admin123@gmail.com', 'admin123');
        $response->assertSessionHasErrors(['email']);
    }

    public function test_super_admin_login_with_wrong_password(): void
    {
        $this->createSuperAdmin();
        $response = $this->loginUser('admin@gmail.com', 'admin1234');
        $response->assertSessionHasErrors(['password']);
    }

    public function test_super_admin_can_login(): void
    {
        $this->createSuperAdmin();
        $response = $this->loginUser('admin@gmail.com', 'admin123');
        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

}
