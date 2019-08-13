<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Todo;
use Auth;
use App\Http\Requests\StoreTodo;
class TodoController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	//一覧表示
	public function index(Request $request){
		$keyword = $request->input('keyword');
		$todos = Todo::where('uid', '=', Auth::id());
		var_dump($todos->count());//結果：6

		$todos_notdone = $todos->where('doneflg' , '=', 0)->latest()
			->paginate(5,["*"], 'doneflg_false')
			->appends(["doneflg_true"=>Input::get('doneflg_true')]);

		var_dump($todos->count());//結果：2

		$todos_done = $todos->where('doneflg', '!=', 0)->latest()
			->paginate(5,["*"], 'doneflg_true')
			->appends(["doneflg_false"=>Input::get('doneflg_false')]);

		if(!empty($keyword)){
			$todos_notdone = $todos_notdone->where('detail', 'like', '%'.$keyword.'%');
			$todos_done = $todos_done->where('detail', 'like', '%'.$keyword.'%');
		}
		var_dump($todos->count());
		var_dump($todos_done->count());
		var_dump($todos_notdone->count());
		return view('todos.index' , ['todos_notdone' => $todos_notdone], ['todos_done' => $todos_done])->with('keyword',$keyword);
	}

	//新規登録フォーム
	public function create(){
		return view('todos.create');
	}
	//新規登録
	public function store(StoreTodo $request){
		$todo = new Todo;
		$todo->title = $request->title;
		$todo->detail = $request->detail;
		$todo->doneflg = 0;
		$todo->uid= $request->user()->id;
		$todo->deadline = '2019/09/30';//仮
		$todo->save();
		return redirect()->action('TodoController@index');
	}
	//編集フォーム
	public function edit(Request $request, $id){
		$todo = Todo::find($request->id);
		if(!$todo || $todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}else{
			return view('todo.edit', ['todo'=>$todo]);
		}
	}
	//編集
	public function update(StoreTodo $request){
		$todo = Todo::find($request->id);
		if(!$todo || $todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}
		$todo->title = $request->title;
		$todo->detail = $request->detail;
		$todo->save();
		return redirect('/update');
	}
	//削除フォーム
	public function show(Request $request, $id){
		$todo = Todo::find($request->id);
		if(!$todo || $todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}else{
			return view('todo.show', ['todo' => $todo]);
		}
	}
	//削除
	public function delete(Request $request){
		Todo::destroy($request->id);
		return redirect('/delete');
	}
	//詳細
	public function detail(Request $request, $id){
		$todo = Todo::find($request->id);
		if(!$todo || $todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}else{
			return view('todo.detail', ['todo' => $todo]);
		}
	}
	//タスク完了
	public function complete(Request $request){
		$todo = Todo::find($request->id);
		$todo->doneflg = 1;
		$todo->save();
		return redirect()->action('TodoController@index');
	}
	public function top(){
		$todo = Todo::where('uid', '=', Auth::id())->where('doneflg', '=', 0)->latest()->first();
		return view('todos.top', ['todo' => $todo]);
	}
}
