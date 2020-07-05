<?php

if (!function_exists('deleteActivity')) {
    function deleteActivity()
    {
        $activities = \App\Models\Activity\Activity::where('temp', '1')
            ->where('created_by', \Illuminate\Support\Facades\Auth::id())
            ->get();
        if (count($activities) > 0) {
            foreach ($activities as $activity) {
                deleteIndicators($activity->id);
                deleteBeneficiaries($activity->id);
                deleteLocations($activity->id);
                deleteStaff($activity->id);
            }
            foreach ($activities as $activity) {
                $activity->delete();
            }
        }
    }
}
function deleteIndicators($activity_id)
{
    $indicators = \App\Models\Activity\ActivityIndicators::where('activity_id', $activity_id)->get();
    if (count($indicators) > 0) {
        foreach ($indicators as $indicator) {
            deleteResults($indicator->id);
        }
        foreach ($indicators as $indicator) {
            $indicator->delete();
        }
    }
}
function deleteResults($indicator_id)
{
    $data = \App\Models\Activity\ActivityResult::where('activty_indic_id', $indicator_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
function deleteBeneficiaries($activity_id)
{
    $data = \App\Models\Activity\ActivityBeneficiaries::where('activity_id', $activity_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
function deleteLocations($activity_id)
{
    $data = \App\Models\Activity\Location::where('activity_id', $activity_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
function deleteStaff($activity_id)
{
    $data = \App\Models\Activity\ActivityStaff::where('activity_id', $activity_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}


if (!function_exists('deleteTask')) {
    function deleteTask()
    {
        $tasks = \App\Models\Task\Task::where('temp', '1')
            ->where('created_by', \Illuminate\Support\Facades\Auth::id())
            ->get();
        if (count($tasks) > 0) {
            foreach ($tasks as $task) {
                deleteAssignedTo($task->id);
                deleteTaskComment($task->id);
                deleteTaskLogHour($task->id);
                deleteTaskProgressReport($task->id);
            }
            foreach ($tasks as $task) {
                $task->delete();
            }
        }
    }
}
function deleteAssignedTo($task_id)
{
    $data = App\Models\Task\TaskAssignedTo::where('task_id', $task_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
function deleteTaskComment($task_id)
{
    $data = App\Models\Task\TaskComment::where('task_id', $task_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
function deleteTaskLogHour($task_id)
{
    $data = App\Models\Task\TaskLogHour::where('task_id', $task_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
function deleteTaskProgressReport($task_id)
{
    $data = App\Models\Task\TaskProgressReport::where('task_id', $task_id)->get();
    if (count($data) > 0) {
        foreach ($data as $d) {
            $d->delete();
        }
    }
}
