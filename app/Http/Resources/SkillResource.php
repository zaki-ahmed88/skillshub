<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


use App\Http\Resources\ExamResource;

class SkillResource extends JsonResource
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
            'img' => asset("uploads/$this->img"),
            'exams' => ExamResource::collection($this->whenLoaded('exams')),
        ];
    }
}
