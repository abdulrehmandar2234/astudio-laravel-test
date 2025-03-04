<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Attribute;
use App\Models\AttributeValue;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Attributes (Department, Start Date, Budget)
        $attributes = [
            ['name' => 'department', 'type' => 'text'],
            ['name' => 'start_date', 'type' => 'date'],
            ['name' => 'budget', 'type' => 'number'],
        ];

        foreach ($attributes as $attr) {
            Attribute::updateOrCreate(['name' => $attr['name']], $attr);
        }

        // Fetch Attributes for later use
        $departmentAttr = Attribute::where('name', 'department')->first();
        $startDateAttr  = Attribute::where('name', 'start_date')->first();
        $budgetAttr     = Attribute::where('name', 'budget')->first();

        // Seed Projects
        $projects = [
            ['name' => 'Project A', 'status' => 'Active'],
            ['name' => 'Project B', 'status' => 'Inactive'],
        ];

        foreach ($projects as $projectData) {
            $project = Project::create($projectData);

            // Assign attribute values
            AttributeValue::create([
                'attribute_id' => $departmentAttr->id,
                'entity_id'    => $project->id,
                'value'        => $project->name === 'Project A' ? 'IT' : 'HR',
            ]);

            AttributeValue::create([
                'attribute_id' => $startDateAttr->id,
                'entity_id'    => $project->id,
                'value'        => $project->name === 'Project A' ? '2025-03-01' : '2025-04-15',
            ]);

            AttributeValue::create([
                'attribute_id' => $budgetAttr->id,
                'entity_id'    => $project->id,
                'value'        => $project->name === 'Project A' ? '50000' : '70000',
            ]);
        }
    }
}
