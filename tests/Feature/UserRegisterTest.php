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


    private function generateRandomNPWP()
    {
        $randomDigits = function ($length) {
            return implode('', array_map(fn() => rand(0, 9), range(1, $length)));
        };

        return sprintf(
            '%s.%s.%s.%s-%s.%s',
            $randomDigits(2),
            $randomDigits(3),
            $randomDigits(3),
            $randomDigits(1),
            $randomDigits(3),
            $randomDigits(3)
        );
    }


    public function  test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_user_consumen()
    {
        $data = [
            'username' => 'testuser', // Username valid: huruf kecil, tanpa spasi, minimal 5 karakter
            'name' => 'Test User', // Nama valid
            'phone_number' => '12345678901', // Nomor telepon valid: 11-15 digit
            'address' => '123 Test Street', // Alamat valid
            'email' => 'testuser@example.com', // Email valid
            'password' => 'password123', // Password valid: minimal 6 karakter
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
        $this->assertTrue($user->hasRole('Customer'));
    }

    public function test_register_user_consumen_without_data()
    {
        $data = [
            'username' => '',
            'name' => '',
            'phone_number' => '',
            'address' => '',
            'email' => '',
            'password' => '',
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-konsumen'), $data);

        $response->assertSessionHasErrors([
            'username',
            'name',
            'phone_number',
            'address',
            'email',
            'password',
        ]);
    }

    public function test_register_consumen_without_email()
    {
        $data = [
            'username' => 'testuser', // Username valid: huruf kecil, tanpa spasi, minimal 5 karakter
            'name' => 'Test User', // Nama valid
            'phone_number' => '12345678901', // Nomor telepon valid: 11-15 digit
            'address' => '123 Test Street', // Alamat valid
            'email' => '', // Email valid
            'password' => 'password123', // Password valid: minimal 6 karakter
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-konsumen'), $data);

        $response->assertSessionHasErrors([
            'email',
        ]);
    }

    public function test_register_consumen_without_password()
    {
        $data = [
            'username' => 'testuser', // Username valid: huruf kecil, tanpa spasi, minimal 5 karakter
            'name' => 'Test User', // Nama valid
            'phone_number' => '12345678901', // Nomor telepon valid: 11-15 digit
            'address' => '123 Test Street', // Alamat valid
            'email' => 'testuser@example.com', // Email valid
            'password' => '', // Password valid: minimal 6 karakter
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-konsumen'), $data);

        $response->assertSessionHasErrors([
            'password',
        ]);
    }

    public function test_umkm_owner(): void
    {
        $this->withoutExceptionHandling();

        $data = [
            'username_umkm' => 'umkmowner', // Username valid
            'name_umkm' => 'UMKM Owner', // Nama valid
            'email_umkm' => 'umkmowner@example.com', // Email valid
            'password_umkm' => 'securepassword123', // Password valid
            'phone_number_umkm' => '0812345678901', // Nomor telepon valid
            'address_umkm' => 'Jl. UMKM Nomor 123', // Alamat valid
            'npwp' => $this->generateRandomNPWP(), // NPWP valid (15 digit angka)
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

    public function test_umkm_owner_without_data(): void
    {
        $data = [
            'username_umkm' => '',
            'name_umkm' => '',
            'phone_number_umkm' => '',
            'address_umkm' => '',
            'email_umkm' => '',
            'password_umkm' => '',
            'npwp' => '',
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-umkm'), $data);

        $response->assertSessionHasErrors([
            'username_umkm',
            'name_umkm',
            'phone_number_umkm',
            'address_umkm',
            'email_umkm',
            'password_umkm',
            'npwp',
        ]);
    }

    public function test_umkm_owner_without_email(): void
    {
        $data = [
            'username_umkm' => 'umkmowner',
            'name_umkm' => 'UMKM Owner',
            'phone_number_umkm' => '0812345678901',
            'address_umkm' => 'Jl. UMKM Nomor 123',
            'email_umkm' => '',
            'password_umkm' => 'securepassword123',
            'npwp' => $this->generateRandomNPWP(),
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-umkm'), $data);

        $response->assertSessionHasErrors([
            'email_umkm',
        ]);
    }

    public function test_umkm_owner_without_password(): void
    {
        $data = [
            'username_umkm' => 'umkmowner', // Username valid
            'name_umkm' => 'UMKM Owner', // Nama valid
            'email_umkm' => 'umkmowner@example.com', // Email valid
            'password_umkm' => '', // Password valid
            'phone_number_umkm' => '0812345678901', // Nomor telepon valid
            'address_umkm' => 'Jl. UMKM Nomor 123', // Alamat valid
            'npwp' => $this->generateRandomNPWP(), // NPWP valid (15 digit angka)
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-umkm'), $data);

        $response->assertSessionHasErrors([
            'password_umkm',
        ]);
    }

    public function test_umkm_owner_without_npwp(): void
    {
        $data = [
            'username_umkm' => 'umkmowner', // Username valid
            'name_umkm' => 'UMKM Owner', // Nama valid
            'email_umkm' => 'umkmowner@example.com', // Email valid
            'password_umkm' => '', // Password valid
            'phone_number_umkm' => '0812345678901', // Nomor telepon valid
            'address_umkm' => 'Jl. UMKM Nomor 123', // Alamat valid
            'npwp' => '', // NPWP valid (15 digit angka)
        ];

        $response = $this->withoutMiddleware()->post(route('auth.register-umkm'), $data);

        $response->assertSessionHasErrors([
            'npwp',
        ]);

    }
}
