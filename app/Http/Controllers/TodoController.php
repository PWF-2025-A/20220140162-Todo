<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index(){
        // $todos = Todo::all();
        $todos = Todo::where('user_id', Auth::id())->get();
        dd($todos);
        return view("todo.index");
    }

    public function create(){
        return view('todo.create');
    }

    public function edit(){
        return view('todo.edit');
    }
}
