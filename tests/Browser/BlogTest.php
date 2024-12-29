<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Log;
use App\Models\Blog;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Filament\Resources\BlogResource;

class BlogTest extends DuskTestCase
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
                ->visit(BlogResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testCreateBlog(): void
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $blogTitle = $faker->sentence(3);
            $blogCategoryId = rand(1, 2);
            $blogDescription = $faker->text(20);
            $browser->loginAs($this->adminUser)
                ->visit(BlogResource::getUrl('create'))
                ->typeSlowly('#data\.title', $blogTitle, 50)
                ->click('#data\.blog_category_id')
                ->pause(2000)
                ->select('#data\.blog_category_id', $blogCategoryId)
                ->attach('.filepond--browser', __DIR__ . '/photos/test-foto.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.content', $blogDescription, 50)
                ->check('#data\.is_published')
                ->pause(2000)
                ->press('Create')
                ->pause(2000)
                ->visit(BlogResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testEditBlog(): void
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $blogTitle = $faker->sentence(3);
            $blogCategoryId = rand(1, 2);
            $blogDescription = $faker->text(20);
            $browser->loginAs($this->adminUser)
                ->visit(BlogResource::getUrl('edit', ['record' => Blog::first()->id]))
                ->typeSlowly('#data\.title', $blogTitle, 50)
                ->click('#data\.blog_category_id')
                ->pause(2000)
                ->select('#data\.blog_category_id', $blogCategoryId)
                ->click('button[class="filepond--file-action-button filepond--action-remove-item"]')
                ->pause(2000)
                ->attach('.filepond--browser', __DIR__ . '/photos/test-foto.jpg')
                ->pause(4000)
                ->typeSlowly('#data\.content', $blogDescription, 50)
                ->check('#data\.is_published')
                ->pause(2000)
                ->press('Save changes')
                ->pause(2000)
                ->visit(BlogResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }

    public function testDeleteBlog(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->adminUser)
                ->visit(BlogResource::getUrl('index'))
                ->waitFor('button[data-id="group-actions"]', 50)
                ->click('button[data-id="group-actions"]')
                ->press('Delete')
                ->waitFor('button[class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-danger fi-color-danger fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action"]', 50)
                ->press('Confirm')
                // ->pause(2000)
            ;
            $browser->visit(BlogResource::getUrl('index'));
            Sleep::for(2)->seconds();
        });
    }
}
