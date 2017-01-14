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
            ],
            ["id" => 13,	"name" => "Create Task",	"slug" => "create.task"],
            ["id" => 14,	"name" => "Update Task",	"slug" => "update.task"],
            ["id" => 15,	"name" => "View Task",	"slug" => "view.task"],
            ["id" => 16,	"name" => "View Comment",	"slug" => "view.comment"],
            ["id" => 17,	"name" => "Update Comment",	"slug" => "update.comment"],
            ["id" => 18,	"name" => "Create Comment",	"slug" => "create.comment"],
            ["id" => 19,	"name" => "Delete Comment",	"slug" => "delete.comment"],
            ["id" => 20,	"name" => "Create Invoice",	"slug" => "create.invoice"],
            ["id" => 21,	"name" => "View Invoice",	"slug" => "view.invoice"],
            ["id" => 22,	"name" => "Update Invoice",	"slug" => "update.invoice"],
            ["id" => 23,	"name" => "Delete Invoice",	"slug" => "delete.invoice"],
            ["id" => 24,	"name" => "View Task Price", "slug" => "view.task.price"],
            ["id" => 25,	"name" => "View Client Name", "slug" => "view.client.name"],
            ["id" => 26,	"name" => "View Trail",	"slug" => "view.trail"],
            ["id" => 27,	"name" => "View Quotation",	"slug" => "view.quotation"],
            ["id" => 28,	"name" => "Delete Task",	"slug" => "delete.task"],
            ["id" => 29,	"name" => "View FTP",	"slug" => "view.ftp"],
            ["id" => 30,	"name" => "Create Ftp",	"slug" => "create.ftp"],
            ["id" => 31,	"name" => "Update Ftp",	"slug" => "update.ftp"],
            ["id" => 32,	"name" => "Delete Ftp",	"slug" => "delete.ftp"],


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
            ],
            [
                'role_id' => 1,
                'permission_id' => 13
            ],
            [
                'role_id' => 1,
                'permission_id' => 14
            ],
            [
                'role_id' => 1,
                'permission_id' => 15
            ],
            [
                'role_id' => 1,
                'permission_id' => 16
            ],
            [
                'role_id' => 1,
                'permission_id' => 17
            ],
            [
                'role_id' => 1,
                'permission_id' => 18
            ],
            [
                'role_id' => 1,
                'permission_id' => 19
            ],
            [
                'role_id' => 1,
                'permission_id' => 20
            ],
            [
                'role_id' => 1,
                'permission_id' => 21
            ],
            [
                'role_id' => 1,
                'permission_id' => 22
            ],
            [
                'role_id' => 1,
                'permission_id' => 23
            ],
            [
                'role_id' => 1,
                'permission_id' => 24
            ],
            [
                'role_id' => 1,
                'permission_id' => 25
            ],
            [
                'role_id' => 1,
                'permission_id' => 26
            ],
            [
                'role_id' => 1,
                'permission_id' => 27
            ],
            [
                'role_id' => 1,
                'permission_id' => 28
            ],
            [
                'role_id' => 1,
                'permission_id' => 29
            ],
            [
                'role_id' => 1,
                'permission_id' => 30
            ],
            [
                'role_id' => 1,
                'permission_id' => 31
            ],
            [
                'role_id' => 1,
                'permission_id' => 32
            ],
            [
                'role_id' => 2,
                'permission_id' => 13
            ],
            [
                'role_id' => 2,
                'permission_id' => 14
            ],
            [
                'role_id' => 2,
                'permission_id' => 15
            ],
            [
                'role_id' => 2,
                'permission_id' => 16
            ],
            [
                'role_id' => 2,
                'permission_id' => 17
            ],
            [
                'role_id' => 2,
                'permission_id' => 18
            ],
            [
                'role_id' => 2,
                'permission_id' => 20
            ],
            [
                'role_id' => 2,
                'permission_id' => 21
            ],
            [
                'role_id' => 2,
                'permission_id' => 24
            ],
            [
                'role_id' => 2,
                'permission_id' => 25
            ],
            [
                'role_id' => 2,
                'permission_id' => 26
            ],
            [
                'role_id' => 2,
                'permission_id' => 27
            ],
            [
                'role_id' => 2,
                'permission_id' => 28
            ],
            [
                'role_id' => 2,
                'permission_id' => 29
            ],
            [
                'role_id' => 2,
                'permission_id' => 30
            ],
            [
                'role_id' => 2,
                'permission_id' => 31
            ],
            [
                'role_id' => 2,
                'permission_id' => 32
            ],
            [
                'role_id' => 3,
                'permission_id' => 13
            ],
            [
                'role_id' => 3,
                'permission_id' => 14
            ],
            [
                'role_id' => 3,
                'permission_id' => 15
            ],
            [
                'role_id' => 3,
                'permission_id' => 16
            ],
            [
                'role_id' => 3,
                'permission_id' => 17
            ],
            [
                'role_id' => 3,
                'permission_id' => 18
            ],
            [
                'role_id' => 3,
                'permission_id' => 20
            ],
            [
                'role_id' => 3,
                'permission_id' => 21
            ],
            [
                'role_id' => 3,
                'permission_id' => 24
            ],
            [
                'role_id' => 3,
                'permission_id' => 25
            ],
            [
                'role_id' => 3,
                'permission_id' => 26
            ],
            [
                'role_id' => 3,
                'permission_id' => 27
            ],
            [
                'role_id' => 3,
                'permission_id' => 29
            ]
        ]);
    }
}