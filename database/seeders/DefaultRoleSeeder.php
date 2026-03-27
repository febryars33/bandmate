<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Customer
            // 'browse_products',
            // 'view_product',
            // 'place_order',
            // 'view_own_orders',
            // 'cancel_own_order',
            // 'update_own_profile',
            // 'manage_own_addresses',

            // Admin / Staff
            'manage_users',
            'manage_roles',
            'manage_products',
            'manage_orders',
            'manage_inventory',
            'manage_finance',
            'view_reports',

            // Warehouse
            // 'view_inventory',
            // 'adjust_inventory',
            // 'update_order_status',
            // 'print_shipping_label',
            // 'view_orders',

            // Finance
            // 'view_payments',
            // 'confirm_payment',
            // 'refund_payment',
            // 'view_financial_reports',
            // 'export_financial_data',

            // Support
            // 'update_order_notes',
            // 'respond_customer_ticket',
            // 'view_customer_profile',
            // 'view_orders',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role::firstOrCreate(['name' => 'customer'])
        //     ->givePermissionTo([
        //         'browse_products',
        //         'view_product',
        //         'place_order',
        //         'view_own_orders',
        //         'cancel_own_order',
        //         'update_own_profile',
        //         'manage_own_addresses',
        //     ]);

        Role::firstOrCreate(['name' => 'administrator'])
            ->givePermissionTo(Permission::all());

        // Role::firstOrCreate(['name' => 'warehouse'])
        //     ->givePermissionTo([
        //         'view_inventory',
        //         'adjust_inventory',
        //         'update_order_status',
        //         'print_shipping_label',
        //     ]);

        // Role::firstOrCreate(['name' => 'finance'])
        //     ->givePermissionTo([
        //         'view_payments',
        //         'confirm_payment',
        //         'refund_payment',
        //         'view_financial_reports',
        //         'export_financial_data',
        //     ]);

        // Role::firstOrCreate(['name' => 'support'])
        //     ->givePermissionTo([
        //         'update_order_notes',
        //         'respond_customer_ticket',
        //         'view_customer_profile',
        //     ]);
    }
}
