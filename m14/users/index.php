<?
include_once "../lib/php/functions.php";


$filename = "../data/users.json";
$users = getFileData($filename);






$empty_user = (object)[
	"name"=>"",
	"type"=>"",
	"email"=>"",
	"classes"=>[]
];



if(isset($_GET['action'])) {
	if($_GET['action'] == 'update') {
		$users[$_GET['id']]->name = $_POST['edit-name'];
		$users[$_GET['id']]->type = $_POST['edit-type'];
		$users[$_GET['id']]->email = $_POST['edit-email'];
		$users[$_GET['id']]->classes = explode(", ",$_POST['edit-classes']);

		file_put_contents($filename, json_encode($users));

		header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
	}
	if($_GET['action'] == 'create') {
		$empty_user->name = $_POST['edit-name'];
		$empty_user->type = $_POST['edit-type'];
		$empty_user->email = $_POST['edit-email'];
		$empty_user->classes = explode(", ",$_POST['edit-classes']);

		$id = count($users);

		$users[] = $empty_user;
		// array_push($users,$empty_user);

		file_put_contents($filename, json_encode($users));

		header("location:{$_SERVER['PHP_SELF']}?id=$id");
	}
	if($_GET['action'] == 'delete') {

		array_splice($users,$_GET['id'],1);

		file_put_contents($filename, json_encode($users));

		header("location:{$_SERVER['PHP_SELF']}");
	}
}





function showUserPage($user) {

$id = $_GET['id'];
$classes = implode(", ",$user->classes);
$addoredit = $id=='new' ? 'Add' : 'Edit';
$createorupdate = $id=='new' ? 'create' : 'update';
$deletebutton = $id!='new'?"<div class='flex-none'>
	[<a href='{$_SERVER['PHP_SELF']}?id=$id&action=delete'>Delete</a>]
</div>":'';








echo <<<HTML

<div class="display-flex">
	<div class="flex-stretch">
		<a href="{$_SERVER['PHP_SELF']}">Back</a>
	</div>
	$deletebutton
</div>
<form method="post" action="?id=$id&action=$createorupdate">
	<h2>$addoredit User</h2>
	<div class="form-control">
		<label class="form-label">Name</label>
		<input class="form-input" name="edit-name" type="text" value="$user->name">
	</div>
	<div class="form-control">
		<label class="form-label">Type</label>
		<input class="form-input" name="edit-type" type="text" value="$user->type">
	</div>
	<div class="form-control">
		<label class="form-label">Email</label>
		<input class="form-input" name="edit-email" type="text" value="$user->email">
	</div>
	<div class="form-control">
		<label class="form-label">Classes</label>
		<input class="form-input" name="edit-classes" type="text" value="$classes">
	</div>
	<div class="form-control">
		<input class="form-button" type="submit" value="Confirm">
	</div>
</form>
HTML;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Admin</title>
	<link rel="stylesheet" href="../lib/css/styleguide.css">
	<link rel="stylesheet" href="../lib/css/gridsystem.css">
	<link rel="stylesheet" href="../css/storetheme.css">
</head>
<body>
	
	<header class="navbar">
		<div class="container display-flex">
			<div class="flex-stretch">
				<h1>User Admin</h1>
			</div>
			<nav class="nav-flex">
				<ul>
					<li><a href="<?= $_SERVER['PHP_SELF'] ?>">List</a></li>
					<li><a href="<?= $_SERVER['PHP_SELF'] ?>?id=new">Add New User</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<div class="container">
		<div class="card-basic">
			<?php

			if(isset($_GET['id'])) {

				// ternary conditional
				showUserPage(
					$_GET['id']=='new' ?
						$empty_user :
						$users[$_GET['id']]
				);
			} else {

			?>

			<h2>User List</h2>
			
			<div class="userlist">
			<?php

			foreach($users as $i=>$user) {
				echo "
				<div class='card card-soft display-flex'>
					<div class='flex-stretch'>
						<div class='userlist-name'>$user->name</div>
						<div class='userlist-type'>$user->type</div>
					</div>
					<div class='flex-none'>
						[<a href='?id=$i'>edit</a>]
					</div>
				</div>
				";
			}

			?>
			</div>

			<?php

			}
			
			?>
		</div>
	</div>
	
</body>
</html>