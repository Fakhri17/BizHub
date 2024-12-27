<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
// Sleep

class RegisterUmkmTest extends DuskTestCase
{

    use DatabaseTruncation;

    // public function testUmkmTabLoadsCorrectly()
    // {
    //     Sleep::for(2)->seconds();
    //     $this->browse(function (Browser $browser) {
    //         $username = 'umkmuser'.uniqid();
    //         $email = 'umkm' . uniqid() . '@example.com';
    //         $browser->visit('/register')
    //             ->click('@tab-umkm')
    //             ->typeSlowly('username', $username, 50)
    //             ->typeSlowly('name', 'umkm Name', 50)
    //             ->typeSlowly('email', $email, 50)
    //             ->typeSlowly('password', 'password', 50)
    //             ->typeSlowly('phone_number', '08970632441', 50)
    //             ->typeSlowly('address', 'umkm Address', 50)
    //             ->typeSlowly('npwp', '12.312.312.3-213.123', 50)
    //             ->press('Daftar');
    //         Sleep::for(2)->seconds();
    //     });
    //     Sleep::for(2)->seconds();
    // }
}
