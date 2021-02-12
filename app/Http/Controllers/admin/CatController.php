<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use App\Models\Cat;

class CatController extends Controller
{
    //
    


    public function index(){
        
        $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(10);
        return view('admin.cats.index')->with($data);          //combact with data
    }




    
   public function store(Request $request){

        // dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            ]);
            
            
            Cat::create([
                'name' =>json_encode([
                    'en' => $request->name_en,
                     'ar' => $request->name_ar,
            ]),
            ]);
            
            
            $request->session()->flash('msg', "row added successfully");
            // session('msg', 'row added successfully');
            
            return back();
            
        }
        
        
        
        
        



    
    
    public function update(Request $request){
    
        // dd($request->all());
        $request->validate([
            'id' => 'required|exists:cats,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
    
    
        Cat::findOrFail($request->id)->update([
            'name' =>json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
    
        $request->session()->flash('msg', "row updated successfully");
        // session('msg', 'row added successfully');
    
        return back();
    
    }















    public function delete(Cat $cat, Request $request){
            
        //route model binding

        try {

            $cat->delete();
            $msg = "row deleted successfully";
            

        } catch (Exception $e) {

            $msg = "can't delete this row";
            
        }
        
       

        // $msg = $isDeleted ? "row deleted successfully" : "can't delete this row";     //internary operator
        
        $request->session()->flash('msg', $msg);
        
        // session('msg', $msg);

        
        return back();
    }









    public function toggle(Cat $cat){


        $cat->update([
            'active' => ! $cat->active,
        ]);

        return back();

    }
    

}
