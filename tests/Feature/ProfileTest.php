<?php

namespace Tests\Feature;

use App\Filament\Pages\EditProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private function setupCustomer(): User
    {
        Role::create(['name' => 'Customer']);

        $customer = User::create([
            'username' => 'customer',
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone_number' => '081234567892',
            'password' => Hash::make('customer123'),
            'avatar_path' => '',
            'address' => 'Jl. Raya No. 3',
            'role_id' => '3'
        ]);

        $customer->assignRole('Customer');

        return $customer;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->setupCustomer();
        $this->actingAs(User::first());
    }

    public function test_profile_can_be_rendered(): void
    {
        $response = $this->get('/dashboard/edit-profile');
        $response->assertStatus(200);
    }

    public function test_profile_can_be_updated(): void
    {
        $user = User::first();

        Livewire::test(EditProfile::class)
            ->fillForm([
                'name' => 'Customer Updated',
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'address' => $user->address,
            ])
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'name' => 'Customer Updated',
        ]);
    }
}
