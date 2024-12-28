<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Filament\Pages\EditProfile;
use Illuminate\Support\Sleep;

class EditProfileTest extends DuskTestCase
{
    protected $umkmOwner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->umkmOwner = User::role('UMKM Owner')->first();
    }

    public function testEditProfile(): void
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();

            // Data acak untuk uji coba
            $newName = $faker->name;
            $newEmail = $faker->unique()->safeEmail;
            $newPhoneNumber = $faker->phoneNumber;
            $newAddress = $faker->address;

            $browser->loginAs($this->umkmOwner)
                ->visit('/dashboard/edit-profile')
                ->typeSlowly('#user\.name', $newName, 50)
                ->typeSlowly('#user\.email', $newEmail, 50)
                ->typeSlowly('#user\.phone_number', $newPhoneNumber, 50)
                ->typeSlowly('#user\.address', $newAddress, 50)
                ->pause(4000)
                ->press('Save changes');
        });
    }


    public function tearDown(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->driver->manage()->deleteAllCookies();
        });
    }
}
