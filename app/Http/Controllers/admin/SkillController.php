<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage; 

use Exception;

use App\Models\Skill;
use App\Models\Cat;

class SkillController extends Controller
{
    
    public function index(){
        
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        $data['cats'] = Cat::select('id', 'name')->get();

        return view('admin.skills.index')->with($data);          //combact with data
    }
    





    public function store(Request $request){

        //  dd($request->all());


        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
            ]);

            //putFile method rename file with a random name and return it 

            $path = Storage::putFile("skills", $request->file('img'));
            
            

            Skill::create([
                'name' =>json_encode([
                    'en' => $request->name_en,
                     'ar' => $request->name_ar,
                    
                    ]),

                    'img' => $path,
                    'cat_id' => $request->cat_id,
            ]);
            
            
            $request->session()->flash('msg', "row added successfully");
            // session('msg', 'row added successfully');
            
            return back();
            
        }











        public function update(Request $request){
    
            // dd($request->all());
            $request->validate([
                'id' => 'required|exists:skills,id',              //hidden input
                'name_en' => 'required|string|max:50',
                'name_ar' => 'required|string|max:50',
                'img' => 'nullable|image|max:2048',
                'cat_id' => 'required|exists:cats,id',
            ]);
        
            $skill  =Skill::findOrFail($request->id);  //skill in db
            $path = $skill->img;         //old path

            if($request->hasfile('img')){    //if we decided to upload a new image
                
                Storage::delete($path);
                $path = Storage::putFile("skills", $request->file('img'));

            }

        
            $skill->update([
                'name' =>json_encode([
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ]),

                'img' => $path,
                'cat_id' => $request->cat_id,
            ]);

        
            $request->session()->flash('msg', "row updated successfully");
            // session('msg', 'row added successfully');
        
            return back();
        
        }

        



        








        public function delete(Skill $skill, Request $request){
            
            //route model binding
    
            try {

                $path = $skill->img;
                $skill->delete();

                Storage::delete($path);

                $msg = "row deleted successfully";
                
    
            } catch (Exception $e) {
    
                $msg = "can't delete this row";
                
            }
            
           
    
            // $msg = $isDeleted ? "row deleted successfully" : "can't delete this row";     //internary operator
            
            $request->session()->flash('msg', $msg);
            
            // session('msg', $msg);
    
            
            return back();
        }








        public function toggle(Skill $skill){


            $skill->update([
                'active' => ! $skill->active,
            ]);
    
            return back();
    
        }
    
    

}
