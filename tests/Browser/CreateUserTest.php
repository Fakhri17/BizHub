<?php

namespace Tests\Browser;

use App\Filament\Resources\UserResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Sleep;


class CreateUserTest extends DuskTestCase
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@gmail.com')->first();
    }

    public function testListBlogDashboard(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->adminUser)
                ->visit(UserResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testCreateUser(): void
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $username = $faker->userName;
            $name = $faker->name;
            $email =  $username . '@example.com';
            $phoneNumber = $faker->numerify('############') . rand(10, 99);
            $address = $faker->streetAddress;
            $rolesId = rand(1, 3);
            $browser->loginAs($this->adminUser)
                ->visit(UserResource::getUrl('create'))
                ->typeSlowly('#data\.username', $username, 50)
                ->typeSlowly('#data\.name', $name, 50)
                ->typeSlowly('#data\.email', $email, 50)
                ->typeSlowly('#data\.phone_number', $phoneNumber, 50)
                ->typeSlowly('#data\.address', $address, 50)
                ->select('#data\.roles', $rolesId)
                ->pause(2000)
                ->press('Create')
                ->pause(2000)
                ->visit(UserResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testEditUser(): void
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $username = $faker->userName;
            $name = $faker->name;
            $email =  $username . '@example.com';
            $phoneNumber = $faker->numerify('############') . rand(10, 99);
            $address = $faker->streetAddress;
            $rolesId = rand(1, 3);
            $browser->loginAs($this->adminUser)
                ->visit(UserResource::getUrl('edit', ['record' => User::latest()->first()->id]))
                ->typeSlowly('#data\.username', $username, 50)
                ->typeSlowly('#data\.name', $name, 50)
                ->typeSlowly('#data\.email', $email, 50)
                ->typeSlowly('#data\.phone_number', $phoneNumber, 50)
                ->typeSlowly('#data\.address', $address, 50)
                ->select('#data\.roles', $rolesId)
                ->pause(2000)
                ->press('Save changes')
                ->pause(2000)
                ->visit(UserResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testDeleteUser(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->adminUser)
                ->visit(UserResource::getUrl('index'))
                ->waitFor('button[data-id="group-actions"]', 50)
                ->click('button[data-id="group-actions"]')
                ->pause(2000)
                ->press('Delete')
                ->waitFor('button[class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-danger fi-color-danger fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action"]', 50)
                ->press('Confirm');
            $browser->visit(UserResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }
}
