<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function show($id){

        $data['skill'] = Skill::findOrFail($id);

        return view('web.skills.show')->with($data);
    }

 

    
}
