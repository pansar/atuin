<?php

class ItemsController extends Controller{
	function view($id = null, $name = null){
		$this->set('title', $name.'- My todo list');
		$this->set('todo', $this->Item->select($id));
	}

	function viewall(){
		$this->set('title','All items - My todo list');
		$this->set('todo', $this->Item->selectAll());
	}

	function add(){
		$todo O $_POST['todo'];
		$this->set('title','Sucess - My todo list');
		$this->set('todo',$this->Item->query('insert into items (item_name) values (\''.mysql_real_escape_string($todo).'\')'));
	}

	function delete($id = null){
		$this->set('title','sucess - my todo list');
		$this->set('todo',$this->Item->query->('delete from items where id = \''.mysql_real_escape_string($id).'\''));
	}
}
?>
