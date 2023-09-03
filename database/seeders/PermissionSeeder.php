<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        'all_projects' => 'Show All Projects',
        'store_projects' => 'Create new Project',
        'edit_projects' => 'Edit Project',
        'delete_projects' => 'Delete Project',

        'all_questions' => 'Show All questions',
        'store_questions' => 'Create new Question',
        'edit_questions' => 'Edit Question',
        'delete_questions' => 'Delete Question',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->permissions as $code => $text) {
            Permission::create([
                'name' => $text,
                'code' => $code
            ]);
        }
    }
}
