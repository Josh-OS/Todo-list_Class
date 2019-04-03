<?php
include_once 'classes.php';

$del = new delcv();
$fileo = new fileopc();

//Add btn is clicked.
if ($_GET) {

	if ($_GET['addbox']) {

		$fileo->savetodo();
		header('location: index.php');
 	 }
	
}



//Check a box is clicked


	if($_GET) {

		if($_GET['checkdone']) {

			//Code
			
			
			$container = file_get_contents('file_todo.csv');
			$lister =[];

			foreach(explode("\n", $container) as $contains) { //string to organized array
				if ($contains) { //To prevent warning: will prevent execution if the $contains is empty.
					[$task_list, $id] = explode(',', $contains);

					if ($id == $_GET['checkdone']) {

						$lister[] = [
							'task_list' => $task_list,
							'id' => $id
					];
					}
				}


			}


			$fileo->savedone($lister);

			$del->importFile();
			$del->deleteById($_GET['checkdone']);
	


			$contains = NULL;			
			$lister = NULL;
			header('location: index.php');			
			//Code
		}
	}

?>


<html>
 <head>
  <title>Task To Do</title>
  <link rel="stylesheet" type="text/css" href="todocss.css">
 </head>
</html>

<body>
 
 <!--Main Pad-->
 <div class="pad">
 <h3 class="title">To Do</h3>



 
<?php
$doneactive = $_GET['active'];
if ($doneactive == 'true') { //When 'Done' view is active.

	//DONE.csv TO SCREEN
	echo '<div class="todo-list">';
	if (file_exists('DONE.csv')) { //To prevent error: check first if file exists.

		$container = file_get_contents('DONE.csv');
		$lister =[];

		echo '<table class=tlist>'; //create table

		foreach(explode("\n", $container) as $contains) { //string to organized array
			if ($contains) { //To prevent warning: will prevent execution if the $contains is empty.
				[$task_list, $id] = explode(',', $contains);
	
	
				//print on screen
				
				echo '<tr>';
				echo '<td>' . '<span class="strike">' . $task_list . '</span>' . '</td>';
				echo '</tr>';
	

			}
				

		}

		echo '</table>'; //end table

	}
	echo '</div>';	
	//STYLE
	echo '<style> .dones{ border-style:solid; border-width: 0px 0px 2px 0px;}</style>';
	echo '<style> .adder{ display:none;}</style>'; //Hide add text box and button
	
}

else { //Default action.
//<!--To do list (table)-->
	//CSV TO SCREEN
	echo '<div class="todo-list">';
	if (file_exists('file_todo.csv')) { //To prevent error: check first if file exists.

		$container = file_get_contents('file_todo.csv');
		$lister =[];

		echo '<table class=tlist>'; //create table

		foreach(explode("\n", $container) as $contains) { //string to organized array
			if ($contains) { //To prevent warning: will prevent execution if the $contains is empty.
				[$task_list, $id] = explode(',', $contains);
	
				$lister[] = [
					'task_list' => $task_list,
					'id' => $id
				];
	
				//print on screen
				
				echo '<tr>';
				echo '<td class=checkbox>' . '<a href="?checkdone=' . $id . '">' . '<div class=divbox></div>' . '</a>'  . '</td>';
				echo '<td>' . $task_list . '</td>';
				echo '</tr>';
	

			}
				

		}
		echo '</table>'; //end table

	}
	echo '</div>';	
	//STYLE
	echo '<style> .todos{ border-style:solid; border-width: 0px 0px 2px 0px;}</style>';
	
}
	
?>

  <div class="adder">
   <form action="" method="get">
    <input type="text" name="addbox">
    <span class="sub"><input type="submit" class="sub" value="ADD"></span>
   </form>
  </div>
<div class="tab">
<a href="?active=false" class="talbink"><div class="Label"><div class="todos">Todo<span class="counter"><?php echo "$todotask"; ?></span></div></div></a>
<a href="?active=true" class="tablink"><div class="Label"><div class="dones">Done<span class="counter"><?php echo "$donetask"; ?></span></div></div></a>
</div>
 </div>



</body>
</html>


	
