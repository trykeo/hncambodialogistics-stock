<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_create',
            ],
            [
                'id'    => 18,
                'title' => 'product_edit',
            ],
            [
                'id'    => 19,
                'title' => 'product_show',
            ],
            [
                'id'    => 20,
                'title' => 'product_delete',
            ],
            [
                'id'    => 21,
                'title' => 'product_access',
            ],
            [
                'id'    => 22,
                'title' => 'location_create',
            ],
            [
                'id'    => 23,
                'title' => 'location_edit',
            ],
            [
                'id'    => 24,
                'title' => 'location_show',
            ],
            [
                'id'    => 25,
                'title' => 'location_delete',
            ],
            [
                'id'    => 26,
                'title' => 'location_access',
            ],
            [
                'id'    => 27,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 28,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 29,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 30,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 31,
                'title' => 'product_movement_create',
            ],
            [
                'id'    => 32,
                'title' => 'product_movement_edit',
            ],
            [
                'id'    => 33,
                'title' => 'product_movement_show',
            ],
            [
                'id'    => 34,
                'title' => 'product_movement_delete',
            ],
            [
                'id'    => 35,
                'title' => 'product_movement_access',
            ],
            [
                'id'    => 36,
                'title' => 'stock_in_create',
            ],
            [
                'id'    => 37,
                'title' => 'stock_in_edit',
            ],
            [
                'id'    => 38,
                'title' => 'stock_in_show',
            ],
            [
                'id'    => 39,
                'title' => 'stock_in_delete',
            ],
            [
                'id'    => 40,
                // 'title' => 'stock_in_access',
                'title' => 'bkk_stock_in_access',
            ],
            [
                'id'    => 41,
                'title' => 'stock_out_create',
            ],
            [
                'id'    => 42,
                'title' => 'stock_out_edit',
            ],
            [
                'id'    => 43,
                'title' => 'stock_out_show',
            ],
            [
                'id'    => 44,
                'title' => 'stock_out_delete',
            ],
            [
                'id'    => 45,
                'title' => 'stock_out_access',
            ],
            [
                'id'    => 46,
                'title' => 'stock_complete_create',
            ],
            [
                'id'    => 47,
                'title' => 'stock_complete_edit',
            ],
            [
                'id'    => 48,
                'title' => 'stock_complete_show',
            ],
            [
                'id'    => 49,
                'title' => 'stock_complete_delete',
            ],
            [
                'id'    => 50,
                'title' => 'stock_complete_access',
            ],
            [
                'id'    => 51,
                'title' => 'order_report_create',
            ],
            [
                'id'    => 52,
                'title' => 'order_report_edit',
            ],
            [
                'id'    => 53,
                'title' => 'order_report_show',
            ],
            [
                'id'    => 54,
                'title' => 'order_report_delete',
            ],
            [
                'id'    => 55,
                'title' => 'order_report_access',
            ],
            [
                'id'    => 56,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 57,
                'title' => 'kh_stock_in_access'
            ]
        ];

        Permission::insert($permissions);
    }
}