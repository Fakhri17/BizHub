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
            $address = $faker->address;
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
}
