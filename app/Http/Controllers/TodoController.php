<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Todo;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    //Todo list
    public function index()
    {
        //$todos = Todo::all();
        $todos = DB::table('todos')->orderBy('created_at', 'desc')->paginate(5);
        return view('todos.index', compact('todos')); //this is same as - return view('todos.index')->with(['todos' => $todos]);
    }

    //Create new Todo
    public function create()
    {
        return view('todos.create');
    }

    //Store new Todo using custom validation and customized messages
    public function store(Request $request)
    {
        //using default validation messages
        // $request->validate([
        //     'title' => 'required|max:255'
        // ]);

        //customizing default validtion messages
        $rules = [
            'title' => 'required|max:255'
        ];

        $messages = [
            'title.required' => 'Title is required to create New ToDo.',
            'title.max' => 'ToDo Title cannot be greater than 255 charecters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        
        Todo::create($request->all());
        //return redirect()->back()->with('message', 'ToDo created successfully!'); //using alert method
        return redirect(route('todo.index'))->with('toast_success', 'ToDo created successfully!'); //using swal
    }

    //Store new Todo using TodoCreateRequest - validation component
    // public function store(TodoCreateRequest $request)
    // {
    //     Todo::create($request->all());
    //     return redirect(route('todo.index'))->with('toast_success', 'ToDo created successfully!'); //using swal
    // }

    //edit Todo
    public function edit(Todo $todo)
    {
        //$todo = Todo::find($id);
        return view('todos.edit', compact('todo'));
    }

    //update the value into DB
    public function update(TodoCreateRequest $request, Todo $todo)
    {
        $todo->update(['title' => $request->title]);
        return redirect(route('todo.index'))->with('toast_success', 'Title Updated Successfully!');
    }

    //update the completed status into DB
    public function markComplete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return response()->json(['succes' => true, 'todo' => $todo, 'msg' => 'Todo Marked as Completed!']);
        //return redirect(route('todo.index'))->with('toast_success', 'Todo Marked as completed!');
    }

    //update the incompleted status into DB
    public function markIncomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        return response()->json(['succes' => true, 'todo' => $todo, 'msg' => 'Todo Marked as Incompleted!']);
        //return redirect(route('todo.index'))->with('toast_success', 'Todo Marked as incompleted!');
    }

}
