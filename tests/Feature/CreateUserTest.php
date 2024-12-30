<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Filament\Actions\DeleteAction;

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

    private function loadCreateUserPage(): void
    {
        $this->get(UserResource::getUrl('create'))->assertSuccessful();
    }

    private function prepareTestData(): array
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'UMKM Owner']);

        return [
            'user' => $user,
            'role' => $role,
        ];
    }

    private function updateData(User $user, array $data): void
    {
        $user->update($data);
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


    public function test_create_user_full_data(): void
    {
        $this->loadCreateUserPage();
        $data = $this->prepareTestData();

        Livewire::test(UserResource\Pages\CreateUser::class)
            ->fillForm([
                'username' => $data['user']->username,
                'name' => $data['user']->name,
                'email' => $data['user']->email,
                'phone_number' => $data['user']->phone_number,
                'address' => $data['user']->address,
                'roles' => $data['role']->id,
            ])
            ->assertFormFieldIsVisible('password')
            ->call('create')
            ->assertHasErrors();

        $this->assertDatabaseHas(User::class, [
            'username' => $data['user']->username,
            'name' => $data['user']->name,
            'email' => $data['user']->email,
            'phone_number' => $data['user']->phone_number,
            'address' => $data['user']->address,
        ]);
    }

    public function test_create_user_without_data(): void
    {
        $this->loadCreateUserPage();

        Livewire::test(UserResource\Pages\CreateUser::class)
            ->call('create')
            ->assertHasErrors();

        $this->assertDatabaseCount('users', 1);
    }

    public function test_can_access_edit(): void
    {
        $this->get(UserResource::getUrl('edit', [
            'record' => User::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_save_new_data(): void
    {
        $userLast = User::latest()->first();
        $newData = User::factory()->make();

        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $userLast->getRouteKey(),
        ])
            ->fillForm([
                'username' => $newData->username,
                'name' => $newData->name,
                'email' => $newData->email,
                'address' => $newData->address,
            ])
            ->assertFormFieldIsVisible('password')
            ->call('save')
            ->assertHasNoErrors();

        $this->updateData($userLast, $newData->toArray());

        $userLast->refresh();

        $this->assertEquals($newData->username, $userLast->username);
        $this->assertEquals($newData->name, $userLast->name);
        $this->assertEquals($newData->email, $userLast->email);
        $this->assertEquals($newData->address, $userLast->address);
    }


    public function test_edit_user_without_data(): void
    {
        $this->loadCreateUserPage();
        $this->prepareTestData();

        $userLast = User::latest()->first();

        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $userLast->getRouteKey()
        ])
            ->fillForm([
                'username' => '',
                'name' => '',
                'email' => '',
                'address' => '',
            ])
            ->call('save')
            ->assertHasErrors();

        $userLast->refresh();
    }

    public function test_delete_user(): void
    {
        $this->loadCreateUserPage();
        $this->prepareTestData();

        $userLast = User::latest()->first();


        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $userLast->getRouteKey()
        ])
            ->callAction(DeleteAction::class);

       $this->assertDatabaseMissing('users', [
            'id' => $userLast->id,
        ]);
    }
}
