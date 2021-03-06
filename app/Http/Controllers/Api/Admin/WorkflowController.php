<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Models\Activity;
use App\Models\Category;
use App\Models\CustomWorkflow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

class WorkflowController extends Controller
{
    public function index()
    {
        return response()->success(CustomWorkflow::get());
    }

    public function show($id)
    {
        $workflow=CustomWorkflow::find($id);
        if(!$workflow){
            throw new WorkFlowNotFoundException();
        }
        return response()->success($workflow);
    }

    public function store()
    {
        //FIXME: $workflow
        return response()->success();
    }

}
