<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    //

    public function index()
    {
        $todos = Todo::all();
        // return $todos;
        return view('welcome', compact('todos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required"
        ]);
        $data = [
            "title" => $request->title
        ];
        if (Todo::create($data)) {
            return redirect()->to("/")->with(['status' => 'todo created.']);
        }
    }

    public function update(Request $request)
    {
        $data = [
            "done" => $request->has("done")
        ];
        Todo::where('id', $request->id)->update($data);
        return redirect()->to("/")->with(['status' => 'todo updated.']);
    }
}
