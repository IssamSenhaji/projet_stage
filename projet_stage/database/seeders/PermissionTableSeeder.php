<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'formations-list',
            'formations-create',
            'formations-edit',
            'formations-delete',

            'matieres-list',
            'matieres-create',
            'matieres-edit',
            'matieres-delete',

            'groupes-list',
            'groupes-create',
            'groupes-edit',
            'groupes-delete',

            'etudiants-list',
            'etudiants-create',
            'etudiants-edit',
            'etudiants-delete',

            'inscriptions-list',
            'inscriptions-create',
            'inscriptions-edit',
            'inscriptions-delete',

            'formateurs-list',
            'formateurs-create',
            'formateurs-edit',
            'formateurs-delete',

            'tdtp-list',
            'tdtp-create',
            'tdtp-edit',
            'tdtp-delete',

            'videos-list',
            'videos-create',
            'videos-edit',
            'videos-delete'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission , 'name_show' => $permission]);
        }
    }
}
