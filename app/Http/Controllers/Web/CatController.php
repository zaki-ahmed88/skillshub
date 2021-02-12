<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;


class CatController extends Controller
{
    public function show($id){


        $data['cat'] = Cat::findOrFail($id);
        $data['allCats'] = Cat::select('id', 'name')->active()->get();


        $data['skills'] = $data['cat']->skills()->active()->paginate(6);
        /* dd($data['skills']); */

        return view('web.cats.show')->with($data);

    }

   
    
}
