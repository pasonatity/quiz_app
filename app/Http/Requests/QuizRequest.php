<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quizTitle'                    => 'required|max:60',
            'quizSubTitle'                 => 'max:60',
            'questions.*.content'          => 'required|max:60',
            'questions.*.correct'          => 'required|max:30',
            'questions.*.incorrect.*.item' => 'required|max:30',
            'publicType'                   => 'required',
            'questionNumber'               => 'required',
        ];
    }
}
