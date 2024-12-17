<?php

namespace Tests\Feature;

use App\Filament\Resources\BlogResource;
use App\Filament\Resources\BlogResource\Pages\CreateBlog;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Livewire\Livewire;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    private function setupSuperAdmin(): User
    {
        Role::create(['name' => 'Super Admin']);

        $user =  User::create([
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'password' => 'admin123',
            'avatar_path' => '',
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $user->assignRole('Super Admin');

        return $user;
    }
    public function setUp(): void
    {
        parent::setUp();
        $this->setupSuperAdmin();
        $this->actingAs(User::first());
    }

    public function test_blog_list_can_be_rendered(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_blog_resource_can_be_rendered(): void
    {
        $response = $this->get(BlogResource::getUrl('index'));
        $response->assertSuccessful();
    }


    public function test_create_blog_data(): void
    {

        $this->get(BlogResource::getUrl('create'))->assertSuccessful();
        $newData = Blog::factory()->make();

        // $thumbnail = UploadedFile::fake()->image('thumbnail.jpg');


        Livewire::test(BlogResource\Pages\CreateBlog::class)
            ->fillForm([
                'title' => $newData->title,
                'slug' => $newData->slug,
                'content' => $newData->content,
                'blog_category_id' => $newData->blog_category_id,
                'is_published' => $newData->is_published,
            ])
            ->call('create')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('blogs', [
            'title' => $newData->title,
            'slug' => $newData->slug,
            'content' => $newData->content,
            'blog_category_id' => $newData->blog_category_id,
            'is_published' => $newData->is_published,
        ]);

        // $this->assertTrue(Storage::disk('public')->exists('blog-thumbnails/' . $thumbnail->hashName()));
    }
}
