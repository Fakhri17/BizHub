<?php

namespace Tests\Feature\SuperAdmin;

use App\Filament\Resources\BlogResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;

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

    private function loadCreateBlogPage(): void
    {
        $this->get(BlogResource::getUrl('create'))->assertSuccessful();
    }

    private function prepareTestData(): array
    {
        $blog = Blog::factory()->create();

        return [
            'blog' => $blog,
        ];
    }

    private function updateData(Blog $blog, array $data): void
    {
        $blog->update($data);
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

    public function test_create_blog_full_data(): void
    {

        $this->loadCreateBlogPage();

        $newData = Blog::factory()->make([
            'thumbnail' => UploadedFile::fake()->image('blog.jpg', 600, 600),
        ]);

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
    }

    public function test_create_blog_without_data(): void
    {
        $this->loadCreateBlogPage();

        Livewire::test(BlogResource\Pages\CreateBlog::class)
            ->call('create')
            ->assertHasErrors();

        $this->assertDatabaseCount('blogs', 0);
    }

    public function test_can_access_edit(): void
    {
        $this->get(BlogResource::getUrl('edit', [
            'record' => Blog::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_save_new_data(): void
    {
        $this->prepareTestData();
        $blogLast = Blog::latest()->first();
        $newData = Blog::factory()->make([
            'thumbnail' => UploadedFile::fake()->image('blog.jpg', 600, 600),
        ]);

        Livewire::test(BlogResource\Pages\EditBlog::class, [
            'record' => $blogLast->getRouteKey(),
        ])
            ->fillForm([
                'title' => $newData->title,
                'slug' => $newData->slug,
                'content' => $newData->content,
                'blog_category_id' => $newData->blog_category_id,
                'is_published' => $newData->is_published,
            ])
            ->call('save')
            ->assertHasNoErrors();

        $this->updateData($blogLast, $newData->toArray());

        $blogLast->refresh();

        $this->assertequals($blogLast->title, $newData->title);
        $this->assertequals($blogLast->slug, $newData->slug);
        $this->assertequals($blogLast->content, $newData->content);
        $this->assertequals($blogLast->blog_category_id, $newData->blog_category_id);
        $this->assertequals($blogLast->is_published, $newData->is_published);
    }


    public function test_save_new_data_without_data(): void
    {
        $this->prepareTestData();
        $blogLast = Blog::latest()->first();

        Livewire::test(BlogResource\Pages\EditBlog::class, [
            'record' => $blogLast->getRouteKey(),
        ])
        ->fillForm([
            'title' => '',
            'slug' => '',
            'content' => '',
            'blog_category_id' => '',
            'is_published' => '',
        ])
            ->call('save')
            ->assertHasErrors();

        $blogLast->refresh();

      
    }

    public function test_can_delete_data(): void
    {
        $this->loadCreateBlogPage();
        $this->prepareTestData();

        $blogLast = Blog::latest()->first();

        Livewire::test(BlogResource\Pages\EditBlog::class, [
            'record' => $blogLast->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertDatabaseMissing('blogs', [
            'id' => $blogLast->id,
        ]);
    }
}
