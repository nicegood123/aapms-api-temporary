<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Department::factory()
            ->create([
                'name' => 'PS',
                'description' => 'Professional Schools',
            ]);

        Department::factory()
            ->create([
                'name' => 'CLE',
                'description' => 'College of Legal Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CAE',
                'description' => 'College of Accounting Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CAFAE',
                'description' => 'College of Architecture and Fine Arts Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CASE',
                'description' => 'College of Arts and Sciences Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CBAE',
                'description' => 'College of Business Administration Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CCE',
                'description' => 'College of Computing Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CCJE',
                'description' => 'College of Criminal Justice Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CEE',
                'description' => 'College of Engineering Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CHE',
                'description' => 'College of Hospitality Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CHSE',
                'description' => 'College of Health Sciences Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'CTE',
                'description' => 'College of Teacher Education',
            ]);

        Department::factory()
            ->create([
                'name' => 'TS',
                'description' => 'Technical School',
            ]);

        Department::factory()
            ->create([
                'name' => 'BE',
                'description' => 'Basic Education',
            ]);

        
    }
}
