<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;




class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mame_en' => $this->name('en'),
            'name_ar' => $this->name('ar'),
            'desc_en' => $this->desc('en'),
            'desc_ar' => $this->desc('ar'),
            'questions_no' => $this->questions_no,
            'difficulty' => $this->difficulty,
            'duration_mins' => $this->duration_mins,
            'img' => asset("uploads/$this->img"),
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
