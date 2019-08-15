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
		$todos = Todo::where('user_id', '=', Auth::id());

		//未完了todo
		$todos_notdone = (clone $todos)->where('doneflg' , '=', 0)->latest();

		//完了済みtodo
		$todos_done = (clone $todos)->where('doneflg', '!=', 0)->latest();

		if(!empty($keyword)){//検索フォームに値が入ってた場合
			$todos_notdone = $todos_notdone->where('detail', 'like', '%'.$keyword.'%');
			$todos_done = $todos_done->where('detail', 'like', '%'.$keyword.'%');
		}
		

		$todos_notdone = $todos_notdone
			->paginate(5,["*"], 'doneflg_true')
			->appends(["doneflg_false"=>Input::get('doneflg_false')]);

		$todos_done = $todos_done
			->paginate(5,["*"], 'doneflg_false')
			->appends(["doneflg_true"=>Input::get('doneflg_true')]);



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
		$todo->user_id= $request->user()->id;
		$todo->deadline = '2019/09/30';//仮
		$todo->save();
		return redirect()->action('TodoController@index');
	}
	//編集フォーム
	public function edit($id){
		$todo = Todo::find($id);
		if(!$todo ||  $todo->user_id != Auth::id()){
			return redirect()->action('TodoController@index');
		}else{
			return view('todos.edit', ['todo'=>$todo]);
		}
	}
	//編集
	public function update(StoreTodo $request){
		$todo = Todo::find($request->id);
		if(!$todo || $todo->user_id != Auth::id()){//Todo作成者IDチェック
			return redirect()->action('TodoController@index');
		}
		$todo->title = $request->title;
		$todo->detail = $request->detail;
		$todo->save();
		return redirect()->action('TodoController@index');
	}
	//削除フォーム
	public function show($id){
		$todo = Todo::find($id);
		if(!$todo || $todo->user_id != Auth::id()){
			return redirect()->action('TodoController@index');
		}else{
			return view('todos.show', ['todo' => $todo]);
		}
	}
	//削除
	public function destroy(Request $request){
		$todo = Todo::find($request->id);
		if(!$todo || $todo->user_id != Auth::id()){
			return redirect()->action('TodoController@index');
		}
		Todo::destroy($request->id);
		return redirect()->action('TodoController@index');
	}
	//タスク完了
	public function complete(Request $request){
		$todo = Todo::find($request->id);
		$todo->doneflg = 1;
		$todo->save();
		return redirect()->action('TodoController@index');
	}
}
