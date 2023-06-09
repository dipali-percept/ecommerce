<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'sub-category-list',
            'sub-category-create',
            'sub-category-edit',
            'sub-category-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'banner-list',
            'banner-create',
            'banner-edit',
            'banner-delete',
            'country-list',
            'country-create',
            'country-edit',
            'country-delete',
            'currency-list',
            'currency-create',
            'currency-edit',
            'currency-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'order-detail-list',
            'order-detail-create',
            'order-detail-edit',
            'order-detail-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
