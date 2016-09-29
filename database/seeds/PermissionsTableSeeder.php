<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'Create User',
                'slug' => 'create.user'
            ],
            [
                'id' => 2,
                'name' => 'View User',
                'slug' => 'view.user'
            ],
            [
                'id' => 3,
                'name' => 'Update User',
                'slug' => 'update.user'
            ],
            [
                'id' => 4,
                'name' => 'Delete User',
                'slug' => 'delete.user'
            ],
            [
                'id' => 5,
                'name' => 'Create Role',
                'slug' => 'create.role'
            ],
            [
                'id' => 6,
                'name' => 'View Role',
                'slug' => 'view.role'
            ],
            [
                'id' => 7,
                'name' => 'Update Role',
                'slug' => 'update.role'
            ],
            [
                'id' => 8,
                'name' => 'Delete Role',
                'slug' => 'delete.role'
            ],
            [
                'id' => 9,
                'name' => 'Create Permission',
                'slug' => 'create.permission'
            ],
            [
                'id' => 10,
                'name' => 'View Permission',
                'slug' => 'view.permission'
            ],
            [
                'id' => 11,
                'name' => 'Update Permission',
                'slug' => 'update.permission'
            ],
            [
                'id' => 12,
                'name' => 'Delete Permission',
                'slug' => 'delete.permission'
            ]
        ]);
        DB::table('permission_role')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1
            ],
            [
                'role_id' => 1,
                'permission_id' => 2
            ],
            [
                'role_id' => 1,
                'permission_id' => 3
            ],
            [
                'role_id' => 1,
                'permission_id' => 4
            ],
            [
                'role_id' => 1,
                'permission_id' => 5
            ],
            [
                'role_id' => 1,
                'permission_id' => 6
            ],
            [
                'role_id' => 1,
                'permission_id' => 7
            ],
            [
                'role_id' => 1,
                'permission_id' => 8
            ],
            [
                'role_id' => 1,
                'permission_id' => 9
            ],
            [
                'role_id' => 1,
                'permission_id' => 10
            ],
            [
                'role_id' => 1,
                'permission_id' => 11
            ],
            [
                'role_id' => 1,
                'permission_id' => 12
            ]
        ]);
        DB::table('permission_user')->insert([
            [
                'user_id' => 1,
                'permission_id' => 1
            ],
            [
                'user_id' => 1,
                'permission_id' => 2
            ],
            [
                'user_id' => 1,
                'permission_id' => 3
            ],
            [
                'user_id' => 1,
                'permission_id' => 4
            ],
            [
                'user_id' => 1,
                'permission_id' => 5
            ],
            [
                'user_id' => 1,
                'permission_id' => 6
            ],
            [
                'user_id' => 1,
                'permission_id' => 7
            ],
            [
                'user_id' => 1,
                'permission_id' => 8
            ],
            [
                'user_id' => 1,
                'permission_id' => 9
            ],
            [
                'user_id' => 1,
                'permission_id' => 10
            ],
            [
                'user_id' => 1,
                'permission_id' => 11
            ],
            [
                'user_id' => 1,
                'permission_id' => 12
            ]
        ]);
    }
}