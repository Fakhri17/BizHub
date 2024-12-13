<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    /**
     * Test login for Super Admin.
     */
    public function test_super_admin_can_login()
    {

        Role::create(['name' => 'Super Admin']);

        $superAdmin = User::create([
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567890',
            'password' => Hash::make('admin123'),
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $superAdmin->assignRole('Super Admin');

        $response = $this->withoutMiddleware()->post('/login-proses', [
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }
    
    public function test_umkm_owner_can_login()
    {
        Role::create(['name' => 'UMKM Owner']);

        $umkmOwner = User::create([
            'username' => 'umkmowner',
            'name' => 'UMKM Owner',
            'email' => 'umkmowner@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567891',
            'password' => Hash::make('umkm123'),
            'address' => 'Jl. Raya No. 2',
            'role_id' => '2'
        ]);
        
        $umkmOwner->assignRole('UMKM Owner');

        $response = $this->withoutMiddleware()->post('/login-proses', [
            'email' => 'umkmowner@gmail.com',
            'password' => 'umkm123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));

    }

    public function test_customer_can_login()
    {
        Role::create(['name' => 'Customer']);

        $customer = User::create([
            'username' => 'customer',
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567892',
            'password' => Hash::make('customer123'),
            'address' => 'Jl. Raya No. 3',
            'role_id' => '3'
        ]);

        $customer->assignRole('Customer');

        $response = $this->withoutMiddleware()->post('/login-proses', [
            'email' => 'customer@gmail.com',
            'password' => 'customer123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

}
