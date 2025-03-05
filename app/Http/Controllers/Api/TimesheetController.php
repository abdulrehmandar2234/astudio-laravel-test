<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Models\Timesheet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TimesheetController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $timesheets = Timesheet::with(['user', 'project'])->get();

        return TimesheetResource::collection($timesheets);
    }

    public function store(StoreTimesheetRequest $request): TimesheetResource
    {
        $timesheet = Timesheet::create($request->validated());

        return new TimesheetResource($timesheet);
    }

    public function update(StoreTimesheetRequest $request, Timesheet $timesheet): TimesheetResource
    {
        $timesheet->update($request->validated());

        return new TimesheetResource($timesheet);
    }

    public function show(Timesheet $timesheet): TimesheetResource
    {
        return new TimesheetResource($timesheet);
    }

    public function destroy(Timesheet $timesheet): JsonResponse
    {
        $timesheet->delete();

        return response()->json(['message' => 'Timesheet deleted successfully']);
    }
}
