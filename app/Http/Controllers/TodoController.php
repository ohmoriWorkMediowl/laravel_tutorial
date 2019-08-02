<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodoController extends Controller
{
	public function index(){
		$todos = Todo::all();
		return view('todo.index',['todos'=> $todos]);
	}

	public function create(){
		return view('todo.create');
	}
 
	public function store(Request $request){
		$todo = new Todo();
		$todo->title =  $request->title;
		$todo->detail = $request->detail;
		$todo->user_id ='1111';// $request->user_id;
		$todo->user_name ="###";// $request->user_name;
		$todo->limit = $request->limit;
		$todo->is_done = 0;
		$todo->save();
		return view('todo.store');	
	}
}
