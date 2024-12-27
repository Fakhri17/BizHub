<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;


class CreateUserTest extends TestCase
{
    use refreshDatabase;

    private function setupSuperAdmin(): User
    {
        Role::create(['name' => 'Super Admin']);

        $user =  User::create([
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'password' => 'admin123',
            'avatar_path' => '',
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $user->assignRole('Super Admin');

        return $user;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->setupSuperAdmin();
        $this->actingAs(User::first());
    }

    public function test_user_resource_can_be_rendered(): void
    {
        $response = $this->get(UserResource::getUrl('index'));
        $response->assertSuccessful();
    }

    public function test_create_user_data(): void
    {
        $this->get(UserResource::getUrl('create'))->assertSuccessful();
        $userList = User::factory()->create();

        Livewire::test(UserResource\Pages\CreateUser::class)
        ->fillForm([
            'username' => $userList->username,
            'name' => $userList->name,
            'email' => $userList->email,
            'phone_number' => $userList->phone_number,
            'address' => $userList->address,
        ])
        ->assertFormFieldIsVisible('password')
        ->call('create');
        // ->assertHasErrors();

        $this->assertDatabaseHas(User::class, [
            'username' => $userList->username,
            'name' => $userList->name,
            'email' => $userList->email,
            'phone_number' => $userList->phone_number,
            'address' => $userList->address,
        ]);
    }

}
