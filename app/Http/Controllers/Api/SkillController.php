<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\SkillResource;

use App\Models\Skill;

class SkillController extends Controller
{
    
    
    public function show($id){


        $skill = Skill::with('exams')->findOrFail($id);     
        return new SkillResource($skill);                  

    }
}
