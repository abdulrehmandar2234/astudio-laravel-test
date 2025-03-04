<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Project::query();

        $filters = $request->get('filters', []);

        foreach ($filters as $key => $filter) {
            // Handle attribute operators (e.g., department|LIKE, start_date|>=)
            [$field, $operator] = explode('|', $key . '|='); // Default to '=' if no operator provided

            if (in_array($field, ['name', 'status'])) {
                // Filter by regular project fields
                $query->where($field, $this->resolveOperator($operator), $filter);
            } else {
                // Filter by EAV attributes
                $query->whereHas('attributes', function ($q) use ($field, $filter, $operator) {
                    $q->whereHas('attribute', function ($subQuery) use ($field) {
                        $subQuery->where('name', $field);
                    })->where('value', $this->resolveOperator($operator), $filter);
                });
            }
        }
        return ProjectResource::collection($query->with('attributes.attribute')->get());
    }

    public function store(StoreProjectRequest $request): ProjectResource
    {
        $project = Project::create($request->validated());

        if ($request->has('attributes')) {
            $this->setAttributes($project, $request->get('attributes'));
        }

        return new ProjectResource($project->load('attributes'));
    }

    public function update(UpdateProjectRequest $request, Project $project): ProjectResource
    {
        $project->update($request->validated());

        if ($request->has('attributes')) {
            $this->setAttributes($project, $request->get('attributes'));
        }

        return new ProjectResource($project->load('attributes'));
    }

    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project->load('attributes'));
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }

    private function setAttributes(Project $project, array $attributes): void
    {
        foreach ($attributes as $attributeId => $value) {
            AttributeValue::updateOrCreate(
                ['attribute_id' => $attributeId, 'entity_id' => $project->id],
                ['value' => $value]
            );
        }
    }

    private function resolveOperator($operator): string
    {
        $operators = [
            'eq' => '=',  '=' => '=',
            'lt' => '<',  '<' => '<',
            'gt' => '>',  '>' => '>',
            'like' => 'LIKE',
        ];

        return $operators[$operator] ?? '=';
    }
}
