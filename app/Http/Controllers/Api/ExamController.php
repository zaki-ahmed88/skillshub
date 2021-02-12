<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Resources\ExamResource;

use App\Models\Exam;


use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ExamController extends Controller
{


    public function show($id){


        $exam = Exam::findOrFail($id);     
        return new ExamResource($exam);                  

    }



    public function showQuestions($id){


        $exam = Exam::with('questions')->findOrFail($id);     
        return new ExamResource($exam);                  

    }











 
    public function start($examId, Request $request){

        /* dd($request->user());*/

        $request->user()->exams()->attach($examId);

        return response()->json([
            'message' => 'you started exam'
        ]);
    } 
















    public function submit($examId, Request $request){


        

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);



        if($validator->fails()){
            return response()->json($validator->errors());
        }
        

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
   
    

     $user = $request->user();
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

    /* $request->session()->flash('success', "You finished exam successfully wth score $score %");
    return redirect(url("exams/show/$examId"));
 */


     return response()->json([
         'message' => "you submitted exam successfully, your score is $score"
     ]);   

    }

}
