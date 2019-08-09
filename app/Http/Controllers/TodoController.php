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
		if(!empty($keyword)){
                        $todos = Todo::where('uid', '=', Auth::id())->where('detail', 'like', '%'.$keyword.'%')->where('doneflg' , '=', 0)->latest()->paginate(5,["*"], 'mi')->appends(["sumi"=>Input::get('sumi')]);
			$todos2 = Todo::where('uid', '=', Auth::id())->where('detail', 'like', '%'.$keyword.'%')->where('doneflg', '!=', 0)->latest()->paginate(5,["*"], 'sumi')->appends(["mi"=>Input::get('mi')]);
			return view('todo.index' , ['todos' => $todos], ['todos2' => $todos2])->with('keyword',$keyword);
		}else{
			$todos = Todo::where('uid', '=', Auth::id())->where('doneflg' , '=', 0)->latest()->paginate(5,["*"], 'mi')->appends(["sumi"=>Input::get('sumi')]);
			$todos2= Todo::where('uid', '=', Auth::id())->where('doneflg' , '!=', 0)->latest()->paginate(5,["*"],'sumi')->appends(["mi"=>Input::get('mi')]);
			return view('todo.index' , ['todos' => $todos], ['todos2' => $todos2])->with('keyword', $keyword);
		}
	}
	//新規登録フォーム
	public function create(){
		return view('todo.create');
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
		return view('todo.store');
	}
	//編集フォーム
	public function edit(Request $request, $id){
		$todo = Todo::find($id);
		if(!$todo){
			return redirect()->action('TodoController@index');
		}
		if($todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}
		return view('todo.edit', ['todo'=>$todo]);
	}
	//編集
	public function update(StoreTodo $request){
		$todo = Todo::find($request->id);
		$todo->title = $request->title;
		$todo->detail = $request->detail;
		$todo->save();
		return view('todo.update');
	}
	//削除フォーム
	public function show(Request $request, $id){
		$todo = Todo::find($request->id);
		if(!$todo){
			return redirect()->action('TodoController@index');
		}
		if($todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}
		return view('todo.show', ['todo' => $todo]);
	}
	//削除
	public function delete(Request $request){
		Todo::destroy($request->id);
		return view('todo.delete');
	}
	//詳細
	public function detail(Request $request, $id){
		$todo = Todo::find($request->id);
		if(!$todo){
			return redirect()->action('TodoController@index');
		}

		if($todo->uid != Auth::id()){
			return redirect()->action('TodoController@index');
		}
		return view('todo.detail', ['todo' => $todo]);
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
		return view('todo.top', ['todo' => $todo]);
	}
}
