<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Mail;
use App\Mail\TodoEmail;

class TodoController extends Controller
{
    public function index(){
        if(\Auth::user()->role_id == 1){
            $todos = Todo::with('user')->latest()->get();
        }else{
            $user_id = \Auth::user()->id;
            $todos = Todo::where('user_id',$user_id)->with('user')->latest()->get();
        }
        
        return view('todo.list', compact('todos'));
    }

    public function create(){
        $users = User::where('role_id','2')->get();
        return view('todo.manage', compact('users'));
    }
    
    public function store(Request $request){

        if($request->todo_id){
            $todo =Todo::find($request->todo_id);
            if(!$todo){
                return back();
            }
            $todo->status = $request->user_id;
        }else{
            $todo = new Todo();
        }

        $user = User::find($request->user_id);
        if(!$user){
            return back();
        }

        $mailData = ['to' => $user->email,'name' => $user->name];
        Mail::send(new TodoEmail($mailData)); 

        $todo->name = $request->name;
        $todo->user_id = $request->user_id;
        $todo->save();

        return redirect()->route('todo');
    }

    public function edit($id){
        $todo = Todo::find($id);
        if(!$todo){
            return back();
        }

        $users = User::where('role_id','2')->get();
        return view('todo.manage', compact('todo','users'));

    }

    public function destroy($id){

        $todo = Todo::find($id);
        if(!$todo){
            return back();
        }

        $todo->delete();
        return back()->with('success', 'Todo have been deleted successfully.');
    }

}   
