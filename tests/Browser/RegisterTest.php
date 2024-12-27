<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
// Sleep

class RegisterTest extends DuskTestCase
{

    use DatabaseTruncation;

    private function generateRandomNPWP() {
        $randomDigits = function($length) {
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

    public function testKonsumenTabLoadsCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $username = 'konsumenuser' . uniqid();
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
        });
        Sleep::for(2)->seconds();
    }

    public function testUmkmTabLoadsCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $username = 'umkmuser' . uniqid();
            $email = 'umkm' . uniqid() . '@example.com';
            $browser->visit('/register')
                ->pause(500)
                ->waitFor('@tab-umkm', 5)
                ->click('@tab-umkm')
                ->pause(500)
                ->screenshot('tab-umkm')
                ->typeSlowly('username_umkm', $username, 50)
                ->typeSlowly('name_umkm', 'umkm Name', 50)
                ->typeSlowly('email_umkm', $email, 50)
                ->typeSlowly('password_umkm', 'password', 50)
                ->typeSlowly('phone_number_umkm', '08970632441', 50)
                ->typeSlowly('address_umkm', 'umkm Address', 50)
                ->typeSlowly('npwp', $this->generateRandomNPWP(), 50)
                ->press('Daftar');
        });
        Sleep::for(2)->seconds();
    }
}
