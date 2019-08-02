<?php

use Illuminate\Database\Seeder;
use App\Todo;
class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    for($i = 0;$i < 10;$i++){
		    $todo = new Todo();
		    $todo->title = 'タイトル'.$i;
		    $todo->detail = '詳細'.$i;
		    $todo->user_id = '9999';
		    $todo->user_name = 'testuser';
		    $todo->limit = '2019/08/31';
		    $todo->is_done = false;
		    $todo->save();  
	    }
    }
}
