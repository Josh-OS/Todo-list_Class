<?php
class delcv {

	public function importFile()
	{
		$contents = file_get_contents('file_todo.csv');

		$rows = explode("\n", $contents);
		$tasks = [];

		foreach($rows as $field) {
			[$task_list, $id] = explode(",", $field);

			$tasks[] = [
				'task_list' => $task_list,
				'id' => $id,
			];
		}

		return $tasks;
	}

	public function exportFile($contents)
	{
		$rows = null;

		foreach($contents as $content) {
			if ($content['id']) {
				$field .= implode(',', $content) . "\n";
			}
		}

		file_put_contents('file_todo.csv', $field);
	}

	public function deleteById($id)
	{
		$contents = $this->importFile();

		foreach($contents as $index => $content) {
			if ($content['id'] === $id) {
			unset($contents[$index]);

			$this->exportFile($contents);
			}
		}
	}

}

//New functions

	$doneactive;
	$donetask = -1;
	$todotask = -1;

	//Done Counter
	$doneTASKS = file_get_contents('DONE.csv');
	foreach(explode("\n", $doneTASKS) as $num) {
		++$donetask;
	}
	//To do Counter
	$todoTASKS = file_get_contents('file_todo.csv');
	foreach(explode("\n", $todoTASKS) as $num) {
		++$todotask;
	}



class fileopc {


	public function csvwrite($val, $to) {

		if ($to == 'todo') {
			file_put_contents('file_todo.csv', (implode(',', $val) . "\n"), FILE_APPEND);
		}
		elseif ($to =='done') {
			file_put_contents('DONE.csv', (implode(',', $val[0]) . "\n"), FILE_APPEND);
		}
		else {
			echo "Error in csvwrite()";
		}
	}

	public function savetodo() {

		$input = NLL;
        	$input = $_GET; //GET to array
        	$input['id'] = uniqid(); //append generated id

		$this->csvwrite($input, 'todo');
	}

	public function savedone($var) {

		$this->csvwrite($var, 'done');

	}


}
