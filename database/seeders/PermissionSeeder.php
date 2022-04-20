<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'category' => 'Users',
                'permissions' => [
                    [
                        'name' => 'users.view',
                        'display_name' => 'View',
                    ],
                    [
                        'name' => 'users.add',
                        'display_name' => 'Add',
                    ],
                    [
                        'name' => 'users.edit',
                        'display_name' => 'Edit',
                    ],
                    [
                        'name' => 'users.delete',
                        'display_name' => 'Delete',
                    ],
                ],
            ],
            [
                'category' => 'Orders',
                'permissions' => [
                    [
                        "name" => "orders.approve_payment",
                        "display_name" => "Payment Approval",
                    ],
                    [
                        'name' => 'orders.view',
                        'display_name' => 'View',
                    ],
                    [
                        'name' => 'orders.confirm',
                        'display_name' => 'Confirm',
                    ],
                    [
                        'name' => 'orders.deliver',
                        'display_name' => 'Finished',
                    ],
                    [
                        'name' => 'orders.delivered',
                        'display_name' => 'Delivered',
                    ],
                ],
            ],
            [
                'category' => 'Products',
                'permissions' => [
                    [
                        'name' => 'products.view',
                        'display_name' => 'View',
                    ],
                    [
                        'name' => 'products.add',
                        'display_name' => 'Add',
                    ],
                    [
                        'name' => 'products.edit',
                        'display_name' => 'Edit',
                    ],
                    [
                        'name' => 'products.delete',
                        'display_name' => 'Delete',
                    ],
                ],
            ],
            [
                'category' => 'Vendors',
                'permissions' => [
                    [
                        'name' => 'vendors.view',
                        'display_name' => 'View',
                    ],
                    [
                        'name' => 'vendors.add',
                        'display_name' => 'Add',
                    ],
                    [
                        'name' => 'vendors.edit',
                        'display_name' => 'Edit',
                    ],
                    [
                        'name' => 'vendors.delete',
                        'display_name' => 'Delete',
                    ],
                ],
            ],
            [
                'category' => 'Customers',
                'permissions' => [
                    [
                        'name' => 'customers.view',
                        'display_name' => 'View',
                    ],
                    [
                        'name' => 'customers.add',
                        'display_name' => 'Add',
                    ],
                    [
                        'name' => 'customers.edit',
                        'display_name' => 'Edit',
                    ],
                    [
                        'name' => 'customers.delete',
                        'display_name' => 'Delete',
                    ],
                ],
            ],
            [
                'category' => 'Other permissions',
                'permissions' => [
                    [
                        'name' => 'other.change_settings',
                        'display_name' => 'Change Settings',
                    ]
                ],
            ],
        ])->each(function ($permissions) {
            foreach ($permissions['permissions'] as $permission) {
                Permission::firstOrCreate(
                    [
                        'name' => $permission['name'],
                    ],
                    [
                        'category' => $permissions['category'],
                        'display_name' => $permission['display_name'],
                    ]
                );
            }
        });

        collect(['Administrator','Seller'])->each(function ($role) {
            Role::firstOrCreate([
                'name' => $role,
            ]);
        });
    }
}
