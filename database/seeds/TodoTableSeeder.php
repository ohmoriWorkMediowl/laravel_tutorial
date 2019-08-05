<?php

use Illuminate\Database\Seeder;
use App\Todo;
class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    for($i = 0;$i < 10; $i++){
		    $todo = new Todo;
		    $todo->title = 'タイトル' . $i;
		    $todo->uid = 1;
		    $todo->detail = '内容'.$i;
		    $todo->doneflg=0;
		    $todo->deadline='2019/08/31';
		    $todo->save();
	    }
    }
}
