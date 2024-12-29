<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Log;
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
}
