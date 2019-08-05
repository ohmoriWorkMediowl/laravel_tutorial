<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodoController extends Controller
{
	//一覧表示
	public function index(){
		$todos = Todo::all();
		return view('todo.index' , ['todos' => $todos]);
	}
	//新規登録フォーム
	public function create(){
		return view('todo.create');
	}
	//新規登録
	public function store(Request $request){
		$todo = new Todo;
		$todo->title = $request->title;
		$todo->detail = $request->detail;
		$todo->doneflg = 0;
		$todo->uid=9999;//ログインがないので一時的に
		$todo->deadline = '2019/09/30';//期限必要なら対応
		$todo->save();
		return view('todo.store');
	}
	//編集フォーム
	public function edit(Request $request, $id){
		$todo = Todo::find($id);
		return view('todo.edit', ['todo'=>$todo]);
	}
	//編集
	public function update(Request $request){
		$todo = Todo::find($request->id);
		$todo->title = $request->title;
		$todo->detail = $request->detail;
		$todo->save();
		return view('todo.update');
	}
	//削除フォーム
	public function show(Request $request, $id){
		$todo = Todo::find($request->id);
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
		return view('todo.detail', ['todo' => $todo]);
	}
	//タスク完了
	public function complete(Request $request){
		$todo = Todo::find($request->id);
		$todo->doneflg = 1;
		$todo->save();
		$todos = Todo::all();
		return view('todo.index', ['todos' => $todos]);
	}
}
