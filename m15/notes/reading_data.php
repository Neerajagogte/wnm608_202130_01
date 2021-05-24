<?
include "../lib/php/functions.php";

$filename = "notes.json";
$file = file_get_contents($filename);
$notes = json_decode($file);

$filename = "../data/users.json";
$file = file_get_contents($filename);
$users = json_decode($file);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Learning Data</title>
	<link rel="stylesheet" type="text/css" href="../lib/css/styleguide.css">
	<link rel="stylesheet" type="text/css" href="../lib/css/gridsystem.css">
	<link rel="stylesheet" type="text/css" href="../css/storetheme.css">
</head>
<body>
	<header>
		<div class="container">
			<h1>Learning Data</h1>
		</div>
	</header>

	<div class="container">
		<div class="card">
			<h2>Notes</h2>
			<ul>
				<?
					for($i; $i<count($notes); $i++) {
						echo "<li>{$notes[$i]}</li>";
					}


				?>


			</ul>
		</div>
		<div class="card">
			<ol>
				<?
				for($i=0; $i<count($users); $i++){
					echo "
					<li><strong>{$users[$i]->name}	</strong>
					<span>{$users[$i]->type}</span></li>
					"
				}
				?>
			</ol>
		</div>
	</div>
	
</body>
</html>