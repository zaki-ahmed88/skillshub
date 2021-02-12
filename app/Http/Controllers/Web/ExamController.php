<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\questions;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id){

        $data['exam'] = Exam::findOrFail($id);

        $user = Auth::user();
        
        $data['canViewStartBtn'] = true;
        
        if($user !== null){

            $pivotRow = $user->exams()->where('exam_id', $id)->first();

            if($pivotRow !== null and $pivotRow->pivot->status == 'closed'){        //if the status open the user can enter the exam eventhough pivotRow is exist
            $data['canViewStartBtn'] = false;
            }

        }

        return view('web.exams.show')->with($data);
    }


    public function questions($examId, Request $request){

        if(session('prev') !== "start/$examId"){
            return redirect (url("exams/show/$examId"));
        }

        $data['exam'] = Exam::findOrFail($examId);

        $request->session()->flash('prev', "questions/$examId");

        return view('web.exams.questions')->with($data);
    }




    public function start($examId, Request $request){


    //    $userId = Auth::user()->id;
        $userId = Auth::id();           //id of logined user now

        $user = Auth::user();           //logined user now
        /* $user->exams()->attach($examId); */       //match the logined user with the exam and combined them wth each others


        if(! $user->exams->contains($examId)){

            $user->exams()->attach($examId);

        }else {

            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
            
        }

        $request->session()->flash('prev', "start/$examId");

        return redirect(url("exams/questions/$examId"));
    }



    public function submit($examId, Request $request){


        if(session('prev') !== "questions/$examId"){
            return redirect (url("exams/show/$examId"));
        }

        // dd($request->all());
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);

        // dd($request->answers);
              /* array:5 [▼
              1729 => "2"
              1730 => "3"
              1731 => "4"
              1732 => "3"
              1733 => "1"
              ]       */    

        // dd($request->answers[1729]);      //2

        // dd(isset($request->answers[1729]));    //true


        //calculate score
        $exam = Exam::findOrFail($examId);
        
        $point = 0;
        $totalQuesNum = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if(isset($request->answers[$question->id])){

                $userAns = $request->answers[$question->id];
                // dd($request->answers[$question->id]);

                $rightAns = $question->right_ans;

                if($userAns == $rightAns){
                    $point += 1;
                }
            }
            
        }

        $score = ($point / $totalQuesNum) * 100;
     // dd($score);


     //Calculate time mins
     //Carbon class is responsible for time


     //submit time - start tme(examId wiz userId in exam_user table)

    

     $user = Auth::user();
     $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        
    //  dd($pivotRow);

    $startTime = $pivotRow->pivot->created_at;

    // dd($startTime);

    $submitTime = Carbon::now();
    //  dd($submitTime);

    $timeMins = $submitTime->diffInMinutes($startTime);        //diffInMinutes ===> from Carbon documentation
    // dd($timeMins);


    if($timeMins > $pivotRow->duration_mins){
        $score = 0;
    }

    $user->exams()->updateExistingPivot($examId,[
        'score' => $score,
        'time_mins' => $timeMins,
    ]);

    $request->session()->flash('success', "You finished exam successfully wth score $score %");
    return redirect(url("exams/show/$examId"));


    }

    

}
