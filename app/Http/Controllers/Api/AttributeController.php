<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AttributeResource::collection(Attribute::all());
    }

    public function show(Attribute $attribute): AttributeResource
    {
        return new AttributeResource($attribute);
    }

    public function store(StoreAttributeRequest $request): AttributeResource
    {
        $attribute = Attribute::create($request->validated());
        return new AttributeResource($attribute);
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute): AttributeResource
    {
        $attribute->update($request->validated());

        return new AttributeResource($attribute);
    }

    public function destroy(Attribute $attribute): JsonResponse
    {
        $attribute->delete();
        return response()->json(['message' => 'Attribute deleted']);
    }
}
