<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1,100) as  $faker) {
           $employee = new Employee();
           $employee->first_name = Str::random(10);
           $employee->last_name = Str::random(10);
           $employee->designation = Str::random(10);
           $employee->permanent_address = Str::random(10);
           $employee->save();
        }
    }
}
