<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\CatResource;

use App\Models\Cat;

class CatController extends Controller
{
    public function index(){

        $cats = Cat::get();
        return CatResource::collection($cats);

    }



    public function show($id){


        $cat = Cat::with('skills')->findOrFail($id);     //we use with('skills') to return skills only in show case
        return new CatResource($cat);                  //we can make objec from cat resource if we need only one row from the model

    }
}
