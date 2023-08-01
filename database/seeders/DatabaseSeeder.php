<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        /*
        $owner = User::factory()->create([
            'name' => 'Nagy Sebestyén',
            'email' => 'nagy.sebestyen1991@gmail.com',
            'password' => bcrypt('BalatonUdvari2023@'), //hash $2a$12$V1Tl3AiDHV6tFsjk99jb7.w6jWkZrOKbnMt3qgF1BFvzE4s2/tFIC
            'token' => 'gczAFeEF4maMFg7SfDHEE9BeYRuPn0EryuyNcNWzzAvSBdLdAhkhTgHwMgPk',

            INSERT INTO `users` (`id`, `roles_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, '1', 'Nagy Sebestyén', 'nagy.sebestyen1991@gmail.com', NULL, '$2a$12$V1Tl3AiDHV6tFsjk99jb7.w6jWkZrOKbnMt3qgF1BFvzE4s2/tFIC', NULL, current_timestamp(), NULL);

        ]);
        */

        $ownerRole = Role::create(['name' => 'Tulajdonos']);
        //$ownerRole->hasAllPermissions();
        //$ownerUser = assignRole($ownerRole);

        Role::create(['name' => 'Supporter']);
        Role::create(['name' => 'Elnök']);
        Role::create(['name' => 'Felhasználó']);

        Permission::create([
            'name' => 'use-chat',
            'category' => 'chat',
            'description' => 'Chat hazsnálati endedély',
        ]);

        Permission::create([
            'name' => 'create-error',
            'category' => 'bug',
            'description' => 'Új hibabejelentés',
        ]);

        Permission::create([
            'name' => 'delete-error',
            'category' => 'bug',
            'description' => 'Hibabejelentés törlése',
        ]);

        Permission::create([
            'name' => 'edit-error',
            'category' => 'bug',
            'description' => 'Hibabejelentés szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-error',
            'category' => 'bug',
            'description' => 'Hibabejelentés megnézése',
        ]);

        Permission::create([
            'name' => 'list-error',
            'category' => 'bug',
            'description' => 'Összes hibabejelentés listázása',
        ]);

        Permission::create([
            'name' => 'create-user',
            'category' => 'user',
            'description' => 'Új felhasználó létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-user',
            'category' => 'user',
            'description' => 'Felhasználó törlése',
        ]);

        Permission::create([
            'name' => 'edit-user',
            'category' => 'user',
            'description' => 'Felhasználó szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-user',
            'category' => 'user',
            'description' => 'Felhasználó megnézése',
        ]);

        Permission::create([
            'name' => 'list-user',
            'category' => 'user',
            'description' => 'Összes felhasználó listázása',
        ]);

        Permission::create([
            'name' => 'import-user',
            'category' => 'user',
            'description' => 'Felhasználók importálása',
        ]);

        Permission::create([
            'name' => 'export-user',
            'category' => 'user',
            'description' => 'Felhasználók exportálása',
        ]);

        Permission::create([
            'name' => 'create-role',
            'category' => 'role',
            'description' => 'Új Szerepkör létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-role',
            'category' => 'role',
            'description' => 'Szerepkör törlése',
        ]);

        Permission::create([
            'name' => 'edit-role',
            'category' => 'role',
            'description' => 'Szerepkör szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-role',
            'category' => 'role',
            'description' => 'Szerepkör megnézése',
        ]);

        Permission::create([
            'name' => 'list-role',
            'category' => 'role',
            'description' => 'Összes szerepkör listázása',
        ]);

        Permission::create([
            'name' => 'create-blog',
            'category' => 'blog',
            'description' => 'Új bejegyzés létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-blog',
            'category' => 'blog',
            'description' => 'Bejegyzés törlése',
        ]);

        Permission::create([
            'name' => 'edit-blog',
            'category' => 'blog',
            'description' => 'Bejegyzés szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-blog',
            'category' => 'blog',
            'description' => 'Bejegyzés megnézése',
        ]);

        Permission::create([
            'name' => 'list-blog',
            'category' => 'blog',
            'description' => 'Összes bejegyzés listázása',
        ]);

        Permission::create([
            'name' => 'create-blog',
            'category' => 'blog',
            'description' => 'Új címke létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-blog',
            'category' => 'blog',
            'description' => 'Címke törlése',
        ]);

        Permission::create([
            'name' => 'edit-blog',
            'category' => 'blog',
            'description' => 'Címke szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-blog',
            'category' => 'blog',
            'description' => 'Címke megnézése',
        ]);

        Permission::create([
            'name' => 'list-blog',
            'category' => 'blog',
            'description' => 'Összes címke listázása',
        ]);

        Permission::create([
            'name' => 'create-categories-blog',
            'category' => 'blog',
            'description' => 'Új kategória létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-categories-blog',
            'category' => 'blog',
            'description' => 'Kategória törlése',
        ]);

        Permission::create([
            'name' => 'edit-categories-blog',
            'category' => 'blog',
            'description' => 'Kategória szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-categories-blog',
            'category' => 'blog',
            'description' => 'Kategória megnézése',
        ]);

        Permission::create([
            'name' => 'list-categories-blog',
            'category' => 'blog',
            'description' => 'Összes kategória listázása',
        ]);
        
        Permission::create([
            'name' => 'create-comment-blog',
            'category' => 'blog',
            'description' => 'Új hozzászólás létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-comment-blog',
            'category' => 'blog',
            'description' => 'Hozzászólás törlése',
        ]);

        Permission::create([
            'name' => 'edit-comment-blog',
            'category' => 'blog',
            'description' => 'Hozzászólás szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-comment-blog',
            'category' => 'blog',
            'description' => 'Hozzászólás megnézése',
        ]);

        Permission::create([
            'name' => 'list-comment-blog',
            'category' => 'blog',
            'description' => 'Összes hozzászólás listázása',
        ]);

        Permission::create([
            'name' => 'create-forum',
            'category' => 'forum',
            'description' => 'Új téma létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-forum',
            'category' => 'forum',
            'description' => 'Téma törlése',
        ]);

        Permission::create([
            'name' => 'edit-forum',
            'category' => 'forum',
            'description' => 'Téma szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-forum',
            'category' => 'forum',
            'description' => 'Téma megnézése',
        ]);

        Permission::create([
            'name' => 'list-forum',
            'category' => 'forum',
            'description' => 'Összes téma listázása',
        ]);

        Permission::create([
            'name' => 'create-categories-forum',
            'category' => 'forum',
            'description' => 'Új kategória létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-categories-forum',
            'category' => 'forum',
            'description' => 'Kategória törlése',
        ]);

        Permission::create([
            'name' => 'edit-categories-forum',
            'category' => 'forum',
            'description' => 'Kategória szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-categories-forum',
            'category' => 'forum',
            'description' => 'Kategória megnézése',
        ]);

        Permission::create([
            'name' => 'list-categories-forum',
            'category' => 'forum',
            'description' => 'Összes kategória listázása',
        ]);
        
        Permission::create([
            'name' => 'create-comment-forum',
            'category' => 'forum',
            'description' => 'Új hozzászólás létrehozása',
        ]);

        Permission::create([
            'name' => 'delete-comment-forum',
            'category' => 'forum',
            'description' => 'Hozzászólás törlése',
        ]);

        Permission::create([
            'name' => 'edit-comment-forum',
            'category' => 'forum',
            'description' => 'Hozzászólás szerkesztése',
        ]);

        Permission::create([
            'name' => 'view-comment-forum',
            'category' => 'forum',
            'description' => 'Hozzászólás megnézése',
        ]);

        Permission::create([
            'name' => 'list-comment-forum',
            'category' => 'forum',
            'description' => 'Összes hozzászólás listázása',
        ]);

        Permission::create([
            'name' => 'show-email',
            'category' => 'setup',
            'description' => 'E-mail beállítási endedély',
        ]);

        Permission::create([
            'name' => 'show-email-template',
            'category' => 'setup',
            'description' => 'Sablon e-mail beállítási endedély',
        ]);
    }
}
