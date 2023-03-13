<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;



class QuestionController extends Controller
{
    public function index()
    {


    }



    public function make(Request $Request)
    {

        //dd($Request->all());

        return $Request->text;



    }
}
