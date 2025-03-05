<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Timesheet;
use Illuminate\Database\Seeder;
use App\Models\User;

class TimesheetSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        foreach ($users as $user) {
            foreach ($projects as $project) {
                Timesheet::create([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'task_name' => 'Development Task',
                    'date' => now()->subDays(random_int(1, 30))->toDateString(),
                    'hours' => random_int(2, 8),
                ]);
            }
        }
    }
}
