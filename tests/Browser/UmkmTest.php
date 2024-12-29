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
            $cleanedAddress = str_replace("\n", ' ', $this->fakerVar->address);
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('create'))
                ->typeSlowly('#data\.product_name', $this->fakerVar->sentence(3), 50)
                ->click('#data\.product_category_id')
                ->pause(2000)
                ->select('#data\.product_category_id', rand(1, 4))
                ->check('#data\.is_published')
                ->attach('.filepond--browser', __DIR__ . '/photos/produk-7.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.product_price', $this->fakerVar->randomNumber(5, true), 50)
                ->waitFor('#data\.product_description', 50)
                ->typeSlowly('#data\.product_description', $this->fakerVar->text(20), 50)
                ->typeSlowly('#data\.product_location', $cleanedAddress, 50)
                ->pause(2000)
                ->press('Create')
                ->pause(2000);
            $browser->visit(UmkmProductResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testEditUmkmProduct(): void
    {
        $this->browse(function (Browser $browser) {
            $cleanedAddress = str_replace("\n", ' ', $this->fakerVar->address);
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('edit', ['record' => UmkmProduct::first()->slug]))
                ->typeSlowly('#data\.product_name', $this->fakerVar->sentence(3), 50)
                ->click('#data\.product_category_id')
                ->pause(2000)
                ->select('#data\.product_category_id', rand(1, 4))
                ->check('#data\.is_published')
                ->click('button[class="filepond--file-action-button filepond--action-remove-item"]')
                ->pause(2000)
                ->attach('.filepond--browser', __DIR__ . '/photos/produk-7.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.product_price', $this->fakerVar->randomNumber(5, true), 50)
                ->waitFor('#data\.product_description', 50)
                ->typeSlowly('#data\.product_description', $this->fakerVar->text(20), 50)
                ->typeSlowly('#data\.product_location', $cleanedAddress, 50)
                ->pause(2000)
                ->press('Save changes')
                ->pause(2000);
            $browser->visit(UmkmProductResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testDeleteUmkmProduct(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('index'))
                ->waitFor('button[class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 fi-color-custom text-custom-500 hover:text-custom-600 focus-visible:ring-custom-600 dark:text-custom-400 dark:hover:text-custom-300 dark:focus-visible:ring-custom-500 fi-color-primary fi-ac-icon-btn-group"]', 50)
                ->click('button[class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 fi-color-custom text-custom-500 hover:text-custom-600 focus-visible:ring-custom-600 dark:text-custom-400 dark:hover:text-custom-300 dark:focus-visible:ring-custom-500 fi-color-primary fi-ac-icon-btn-group"]')
                ->press('Delete')
                ->waitFor('button[class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-danger fi-color-danger fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action"]', 50)
                ->press('Confirm')
                // ->pause(2000)
            ;
            $browser->visit(UmkmProductResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }
}
