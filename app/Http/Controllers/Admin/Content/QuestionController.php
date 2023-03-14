<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;



class QuestionController extends Controller
{
    public function index()
    {
       $questions = Question::select('id', 'name', 'email', 'new', 'created_at')->get();
       return view('admin.content.question.index', compact('questions'));
    }

   public function show($id)
    {
        $question = Question::find($id);
        if($question->new){
            $question->new = 0;
            $question->update();
        }
        return view('admin.content.question.item', compact('question'));
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->route('questions.list')->with('success', 'Вопрос удален');
    }

    public function make(Request $request)
    {
        try{
            $messages = [
                'name' => 'Поле - Имя обязательно для заполнения',
                'email.required' => 'Поле - Email  обязательно для заполнения',
                'email.email' => 'Поле - Email  должно соответсвовать email адресу',
            ];
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
            ], $messages);
            Question::create($request->all());
            return 200;
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
