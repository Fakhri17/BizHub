<?php

namespace Tests\Feature;

use App\Filament\Resources\UmkmProductResource;
use App\Models\UmkmProduct;
use App\Models\User;
use Database\Factories\UmkmProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;

class UmkmProductsTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseMigrations;

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

    public function test_umkm_list_can_be_rendered(): void
    {
        $response = $this->get('/umkm');
        $response->assertStatus(200);
    }

    public function test_umkm_products_resource_can_be_rendered(): void
    {
        $response = $this->get(UmkmProductResource::getUrl('index'));
        $response->assertSuccessful();
    }

    public function test_create_umkm_products_data(): void
    {
        $this->get(UmkmProductResource::getUrl('create'))->assertSuccessful();
    
        $newProduct = UmkmProduct::factory()->make([
            'product_image' => UploadedFile::fake()->image('product.jpg', 600, 600),
        ]);
    
        Livewire::test(UmkmProductResource\Pages\CreateUmkmProduct::class)
            ->fillForm([
                'umkm_owner_id' => $newProduct->umkm_owner_id,
                'product_name' => $newProduct->product_name,
                'slug' => $newProduct->slug,
                'product_description' => $newProduct->product_description,
                'product_price' => $newProduct->product_price,
                'product_category_id' => $newProduct->product_category_id,
                'product_location' => $newProduct->product_location,
                'is_published' => $newProduct->is_published,
                'product_image' => $newProduct->product_image,
            ])
            ->call('create')
            ->assertHasNoErrors();
    
        $this->assertDatabaseHas('umkm_products', [
            'umkm_owner_id' => $newProduct->umkm_owner_id,
            'product_name' => $newProduct->product_name,
            'slug' => $newProduct->slug,
            'product_description' => $newProduct->product_description,
            'product_price' => $newProduct->product_price,
            'product_category_id' => $newProduct->product_category_id,
            'product_location' => $newProduct->product_location,
            'is_published' => $newProduct->is_published,
        ]);
    }
    
}
