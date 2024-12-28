<?php

namespace Tests\Browser;

use App\Filament\Resources\UmkmProductResource;
use App\Models\UmkmProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UmkmTest extends DuskTestCase
{
    protected $umkmOwner;
    protected $fakerVar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->umkmOwner = User::role('UMKM Owner')->first();
        $this->fakerVar = \Faker\Factory::create();
    }

    public function testListUmkmProductDashboard(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testCreateUmkmProduct(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('create'))
                ->typeSlowly('#data\.product_name', $this->fakerVar->sentence(3), 50)
                ->click('#data\.product_category_id')
                ->pause(2000)
                ->select('#data\.product_category_id', rand(1, 4))
                ->attach('.filepond--browser', __DIR__.'\photos\produk-7.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.product_price', $this->fakerVar->randomNumber(5, true), 50)
                ->typeSlowly('#data\.product_description', $this->fakerVar->text(20), 50)
                ->typeSlowly('#data\.product_location', $this->fakerVar->address, 50)
                ->check('#data\.is_published')
                ->pause(2000)
                ->press('Create')
                ->pause(2000);
            $browser->visit(UmkmProductResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }   
}
