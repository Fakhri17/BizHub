<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
// Sleep

class RegisterConsumenTest extends DuskTestCase
{

    use DatabaseTruncation;

    public function testKonsumenTabLoadsCorrectly()
    {
       Sleep::for(2)->seconds();
        $this->browse(function (Browser $browser) {
            $username = 'konsumenuser'.uniqid();
            $email = 'konsumen' . uniqid() . '@example.com';
            $browser->visit('/register')
                ->click('@konsumen')
                ->typeSlowly('username', $username, 50)
                ->typeSlowly('name', 'Konsumen Name', 50)
                ->typeSlowly('email', $email, 50)
                ->typeSlowly('password', 'password', 50)
                ->typeSlowly('phone_number', '08970632441', 50)
                ->typeSlowly('address', 'Konsumen Address', 50)
                ->press('Daftar');
            Sleep::for(2)->seconds();
        });
        Sleep::for(2)->seconds();
    }

     public function testUmkmTabLoadsCorrectly()
    {
        Sleep::for(2)->seconds();
        $this->browse(function (Browser $browser) {
            $username = 'umkmuser'.uniqid();
            $email = 'umkm' . uniqid() . '@example.com';
            $browser->visit('/register')
                ->click('@tab-umkm')
                ->typeSlowly('username', $username, 50)
                ->typeSlowly('name', 'umkm Name', 50)
                ->typeSlowly('email', $email, 50)
                ->typeSlowly('password', 'password', 50)
                ->typeSlowly('phone_number', '08970632441', 50)
                ->typeSlowly('address', 'umkm Address', 50)
                ->typeSlowly('npwp', '12.312.312.3-213.123', 50)
                ->press('Daftar');
            Sleep::for(2)->seconds();
        });
        Sleep::for(2)->seconds();
    }


}
