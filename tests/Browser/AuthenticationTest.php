<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticationTest extends DuskTestCase
{
    // this get data from base seeder

    public function testWithoutInputEmailAndPassword(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->typeSlowly('email', '', 50)
                ->typeSlowly('password', '', 50)
                ->pause(1000)
                ->press('Masuk');
        });
    }

    public function testWithoutInputEmail(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->typeSlowly('email', '', 50)
                ->typeSlowly('password', 'admin123', 50)
                ->press('Masuk');
        });
    }

    public function testWithoutInputPassword(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->typeSlowly('email', 'admin@gmail.com', 50)
                ->typeSlowly('password', '', 50)
                ->press('Masuk');
        });
    }


    public function testWithWrongPassword(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->typeSlowly('email', 'admin@gmail.com', 50)
                ->typeSlowly('password', 'admin1234', 50)
                ->press('Masuk');
            Sleep::for(2)->seconds();
        });
    }


    public function testUserCorrectLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->typeSlowly('email', 'admin@gmail.com', 50)
                ->typeSlowly('password', 'admin123', 50)
                ->press('Masuk');
        });
        Sleep::for(2)->seconds();
    }
}
