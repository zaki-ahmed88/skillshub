<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */


     //https://github.com/fzaninotto/Faker

    public function definition()
    {
        static $i;
        $i++;
        return [
            'name' => json_encode([
                'en' => $this->faker->word(),
                'ar' => $this->faker->word(),
            ]),
            'desc' => json_encode([
                'en' => $this->faker->text(5000),
                'ar' => $this->faker->text(5000),
            ]),
            'img' => "exams/$i.png",
            'question_no' => 15,
            'difficulty' => $this->faker->numberbetween(1, 5),
            'duration_mins' => $this->faker->numberbetween(1, 3) * 30,         //time will be 30 or 60 or 90 mins
        ];
    }
}
