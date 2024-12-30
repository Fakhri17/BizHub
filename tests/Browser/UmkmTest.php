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
            $cleanedAddress = $this->fakerVar->streetAddress;
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('create'))
                ->typeSlowly('#data\.product_name', $this->fakerVar->sentence(3), 50)
                ->click('#data\.product_category_id')
                ->pause(2000)
                ->select('#data\.product_category_id', rand(1, 4))
                ->attach('.filepond--browser', __DIR__ . '/photos/produk-7.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.product_price', $this->fakerVar->randomNumber(5), 50)
                ->typeSlowly('#data\.product_description', $this->fakerVar->text(20), 50)
                ->typeSlowly('#data\.product_location', $cleanedAddress, 50)
                // ->check('#data\.is_published')
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
            $cleanedAddress = $this->fakerVar->streetAddress;
            $browser->loginAs($this->umkmOwner)
                ->visit(UmkmProductResource::getUrl('edit', ['record' => UmkmProduct::latest()->first()->slug]))
                ->typeSlowly('#data\.product_name', $this->fakerVar->sentence(3), 50)
                ->click('#data\.product_category_id')
                ->pause(2000)
                ->select('#data\.product_category_id', rand(1, 4))
                ->click('button[class="filepond--file-action-button filepond--action-remove-item"]')
                ->pause(2000)
                ->attach('.filepond--browser', __DIR__ . '/photos/produk-12.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.product_price', $this->fakerVar->randomNumber(5), 50)
                ->typeSlowly('#data\.product_description', $this->fakerVar->text(20), 50)
                ->typeSlowly('#data\.product_location', $cleanedAddress, 50)
                // ->check('#data\.is_published')
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
                ->waitFor('button[data-id="group-actions"]', 50)
                ->click('button[data-id="group-actions"]')
                ->pause(2000)
                ->press('Delete')
                ->waitFor('button[class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-danger fi-color-danger fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action"]', 50)
                ->pause(2000)
                ->press('Confirm');
            $browser->visit(UmkmProductResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }
}
