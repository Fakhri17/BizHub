<?php

namespace Tests\Feature;

use App\Filament\Resources\UmkmProductResource;
use App\Models\UmkmProduct;
use App\Models\User;
use Database\Factories\UmkmProductFactory;
use Filament\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            'password' => Hash::make('admin123'),
            'avatar_path' => '',
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $user->assignRole('Super Admin');

        return $user;
    }

    public function loadCreateUmkmProductPage(): void
    {
        $this->get(UmkmProductResource::getUrl('create'))->assertSuccessful();
    }

    public function prepareTestData(): array
    {
        $umkmProduct = UmkmProduct::factory()->create();

        return [
            'umkmProduct' => $umkmProduct,
        ];
    }

    public function updateData(UmkmProduct $umkmProduct, array $data): void
    {
        $umkmProduct->update($data);
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
        $url = UmkmProductResource::getUrl('index');
        $response = $this->get($url);

        if ($response->getStatusCode() !== 200) {
            Log::error("Failed to render UMKM products resource. Status code: " . $response->getStatusCode());
            Log::error("Response content: " . $response->getContent());
        }

        $response->assertSuccessful();
    }

    public function test_create_umkm_products_data(): void
    {
        $this->loadCreateUmkmProductPage();

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

    public function test_create_umkm_products_without_data(): void
    {
        $this->loadCreateUmkmProductPage();

        Livewire::test(UmkmProductResource\Pages\CreateUmkmProduct::class)
            ->call('create')
            ->assertHasErrors();

        $this->assertDatabaseCount('umkm_products', 0);
    }

    public function test_can_access_edit(): void
    {
        $this->get(UmkmProductResource::getUrl('edit', [
            'record' => UmkmProduct::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_save_new_data(): void
    {
        $this->prepareTestData();
        $umkmProductLast = UmkmProduct::latest()->first();
        $newData = UmkmProduct::factory()->make([
            'product_image' => UploadedFile::fake()->image('product.jpg', 600, 600),
        ]);

        Livewire::test(UmkmProductResource\Pages\EditUmkmProduct::class, [
            'record' => $umkmProductLast->getRouteKey(),
        ])
            ->fillForm([
                'umkm_owner_id' => $newData->umkm_owner_id,
                'product_name' => $newData->product_name,
                'slug' => $newData->slug,
                'product_description' => $newData->product_description,
                'product_price' => $newData->product_price,
                'product_category_id' => $newData->product_category_id,
                'product_location' => $newData->product_location,
                'is_published' => $newData->is_published,
                'product_image' => $newData->product_image,
            ])
            ->call('save')
            ->assertHasNoErrors();

        $this->updateData($umkmProductLast, $newData->toArray());

        $umkmProductLast->refresh();

        $this->assertEquals($umkmProductLast->umkm_owner_id, $newData->umkm_owner_id);
        $this->assertEquals($umkmProductLast->product_name, $newData->product_name);
        $this->assertEquals($umkmProductLast->slug, $newData->slug);
        $this->assertEquals($umkmProductLast->product_description, $newData->product_description);
        $this->assertEquals($umkmProductLast->product_price, $newData->product_price);
        $this->assertEquals($umkmProductLast->product_category_id, $newData->product_category_id);
        $this->assertEquals($umkmProductLast->product_location, $newData->product_location);
        $this->assertEquals($umkmProductLast->is_published, $newData->is_published);
    }

    public function test_save_new_data_without_data(): void
    {
        $this->prepareTestData();
        $umkmProductLast = UmkmProduct::latest()->first();

        Livewire::test(UmkmProductResource\Pages\EditUmkmProduct::class, [
            'record' => $umkmProductLast->getRouteKey(),
        ])
            ->fillForm([
                'umkm_owner_id' => '',
                'product_name' => '',
                'slug' => '',
                'product_description' => '',
                'product_price' => '',
                'product_category_id' => '',
                'product_location' => '',
                'is_published' => '',
                'product_image' => '',
            ])
            ->call('save')
            ->assertHasErrors();

        $umkmProductLast->refresh();
    }

    public function test_can_delete_data(): void
    {
        $this->loadCreateUmkmProductPage();
        $this->prepareTestData();

        $umkmProductLast = UmkmProduct::latest()->first();

        Livewire::test(UmkmProductResource\Pages\EditUmkmProduct::class, [
            'record' => $umkmProductLast->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertDatabaseMissing('umkm_products', [
            'id' => $umkmProductLast->id,
        ]);
    }
}
