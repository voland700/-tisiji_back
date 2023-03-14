<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class MainController extends Controller
{
    public function index()
    {
       $questions = Question::select('id', 'name', 'email', 'new', 'created_at')->get();
       $new = $questions->where('new', 1)->count();
       return view('admin.main', compact('questions', 'new'));
    }


    public function cacheClear()
    {
        try{
            \Artisan::call('cache:clear');
            \Artisan::call('config:cache');
            \Artisan::call('view:clear');
            \Artisan::call('route:clear');
            return 200;
        }catch (\Exception $e) {
            return 500;
        }
    }

}
