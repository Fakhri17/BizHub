<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\ProductCategory;
use App\Models\UmkmProduct;
use App\Models\UmkmOwner;

use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;
use App\Policies\BlogPolicy;
use App\Policies\BlogCategoryPolicy;
use App\Policies\ProductCategoryPolicy;
use App\Policies\UmkmProductPolicy;
use App\Policies\UmkmOwnerPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Blog::class => BlogPolicy::class,
        BlogCategory::class => BlogCategoryPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        ProductCategory::class => ProductCategoryPolicy::class,
        UmkmProduct::class => UmkmProductPolicy::class,
        UmkmOwner::class => UmkmOwnerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
