<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function clear(Project $project){
        $project->logs()->delete();
        return redirect()->back();
    }
}
