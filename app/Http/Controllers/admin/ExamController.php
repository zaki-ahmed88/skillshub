<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;

use Exception;

use App\Models\Skill;
use App\Models\Exam;
use App\Models\Question;



use App\Events\ExamAddedEvent;


class ExamController extends Controller
{



    public function index(){

        $data['exams'] = Exam::select('id', 'name', 'skill_id', 'img', 'questions_no', 'active')->orderBy('id', 'DESC')->paginate(10);

        return view('admin.exams.index')->with($data);

    }







    public function show(Exam $exam){

        $data['exam'] = $exam;

        return view('admin.exams.show')->with($data);

    }







    public function showQuestions(Exam $exam){

        $data['exam'] = $exam;

        return view('admin.exams.show-questions')->with($data);

    }



    public function create(){

        $data['skills'] = Skill::select('id', 'name')->get();

        return view('admin.exams.create')->with($data);

    }




    public function store(Request $request){

        //  dd($request->all());


        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'desc_en' => 'required|string|max:5000',
            'desc_ar' => 'required|string|max:5000',
            'img' => 'required|image|max:2048',
            'skill_id' => 'required|exists:exams,id',
            'questions_no' => 'required|integer|min:1',        //negative s not allowed here
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
            ]);

            //putFile method rename file with a random name and return it

            $path = Storage::putFile("exams", $request->file('img'));



            $exam = Exam::create([
                'name' =>json_encode([
                    'en' => $request->name_en,
                     'ar' => $request->name_ar,

                    ]),

                'desc' =>json_encode([
                    'en' => $request->desc_en,
                     'ar' => $request->desc_ar,

                    ]),
                    'img' => $path,
                    'skill_id' => $request->skill_id,
                    'questions_no' => $request->questions_no,
                    'difficulty' => $request->difficulty,
                    'duration_mins' => $request->duration_mins,
                    'active' => 0,
            ]);


            $request->session()->flash('prev', "exam/$exam->id");

            //dd($request->all());

            return redirect(url("dashboard/exams/create-questions/{$exam->id}"));

        }



        public function createQuestions(Exam $exam){


            if(session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id"){

                return redirect(url("dashboard/exams"));
            }


            $data['exam_id'] = $exam->id;
            $data['questions_no'] = $exam->questions_no;



            return view('admin.exams.create-questions')->with($data);


        }






        public function storeQuestions(Exam $exam, Request $request){

            /* dd($request->all()); */


            $request->session()->flash('current', "exam/$exam->id");

            $request->validate([

                'titles' => 'required|array',
                'titles.*' => 'required|string|max:500',
                'right_anss' => 'required|array',
                'right_anss.*' => 'required|in:1,2,3,4',
                'option_1s' => 'required|array',
                'option_1s.*' => 'required|string|max:255',
                'option_2s' => 'required|array',
                'option_2s.*' => 'required|string|max:255',
                'option_3s' => 'required|array',
                'option_3s.*' => 'required|string|max:255',
                'option_4s' => 'required|array',
                'option_4s.*' => 'required|string|max:255',

            ]);

            for ($i=0; $i < $exam->questions_no ; $i++) {

                Question::create([
                    'exam_id' => $exam->id,
                    'title' => $request->titles[$i],
                    'option_1' => $request->option_1s[$i],
                    'option_2' => $request->option_2s[$i],
                    'option_3' => $request->option_3s[$i],
                    'option_4' => $request->option_4s[$i],
                    'right_ans' => $request->right_anss[$i],
                ]);
            }

            $exam->update([                                   //make exam active
                'active' => 1,
            ]);



            event(new ExamAddedEvent);

            return redirect("dashboard/exams");

        }














        public function edit(Exam $exam){

            $data['exam'] = $exam;

            $data['skills'] = Skill::select('id', 'name')->get();

            return view('admin.exams.edit')->with($data);

        }





        public function update(Exam $exam, Request $request){


            $request->validate([
                'name_en' => 'required|string|max:50',
                'name_ar' => 'required|string|max:50',
                'desc_en' => 'required|string|max:5000',
                'desc_ar' => 'required|string|max:5000',
                'img' => 'nullable|image|max:2048',
                'skill_id' => 'required|exists:exams,id',
                'questions_no' => 'required|integer|min:1',        //negative s not allowed here
                'difficulty' => 'required|integer|min:1|max:5',
                'duration_mins' => 'required|integer|min:1',
                ]);



                $path = $exam->img;

                if($request->hasfile('img')){
                    Storage::delete($path);
                    $path = Storage::put('exams', $request->file('img'));
                }


                $exam->update([

                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                    'desc' => json_encode([
                        'en' => $request->desc_en,
                        'ar' => $request->desc_ar,
                    ]),
                    'img' => $path,
                    'skill_id' => $request->skill_id,
                    'difficulty' => $request->difficulty,
                    'duration_mins' => $request->duration_mins,

                ]);



                $request->session()->flash('msg', 'row updated successfully');
                return redirect(url("dashboard/exams/show/$exam->id"));
        }




        public function toggle(Exam $exam){

            if($exam->questions_no == $exam->questions()->count()){

                $exam->update([
                    'active' => !$exam->active,
                ]);
            }

            return back();
        }





        public function delete(Exam $exam, Request $request){

            try {
                $path = $exam->img;
                $exam->questions->delete();
                $exam->delete();

                Storage::delete($path);

                $msg = 'row deleted successfully';


            } catch ( Exception $e) {
                $msg = "can't delete this row";
            }

            

            $request->session()->flash('msg', $msg);
            return back();
        }









        public function editQuestion(Exam $exam, Question $question){

            $data['exam'] = $exam;

            $data['ques'] = $question;

            return view('admin.exams.edit-question')->with($data);

        }











        public function updateQuestion(Exam $exam, Question $question, Request $request){


            $data = $request->validate([

                    'title' => 'required|string|max:500',

                    'right_ans' => 'required|in:1,2,3,4',

                    'option_1' => 'required|string|max:255',

                    'option_2' => 'required|string|max:255',

                    'option_3' => 'required|string|max:255',

                    'option_4' => 'required|string|max:255',
                    ]);


                $question->update($data);

                return redirect(url("dashboard/exams/show-questions/{$exam->id}"));
        }







}
