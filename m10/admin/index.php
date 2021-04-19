<?
$filename = "../data/users.json";
$file = file_get_contents($filename);
$data = json_decode($file);

$empty_user = (object)array(
	"product_name"=>"",
	"product_description"=>"",
	"technical_specs"=>"",
	"price"=>""
)
if(isset($_GET['action'])) {
	if($_GET['action']=="create") {
		$empty_user->product_name = $_POST['product_name'];
		$empty_user->product_description = $_POST['product_description'];
		$empty_user->technical_specs = $_POST['technical_specs'];
		$empty_user->price = $_POST['price'];

		$new_id = count($data->users);
		$data->users[] = $empty_user;

		$jsondata = json_encode($data);
		file_put_contents($filename,$jsondata);

		header('location:index.php');
	}
	else if($_GET['action']=='update') {
		$data->users[$_GET['id']]->product_name = $_POST['product_name'];
		$data->users[$_GET['id']]->product_description = $_POST['product_description'];
		$data->users[$_GET['id']]->technical_specs = $_POST['technical_specs'];
		$data->users[$_GET['id']]->price = $_POST['price'];

		$jsondata = json_encode($data);
		file_put_contents($filename,$jsondata);

		header('location:index.php?msg=success');
	}
	else if($_GET['action']=='delete') {
		array_splice($data->users,$_GET['id'],1);

		$jsondata = json_encode($data);
		file_put_contents($filename,$jsondata);

		header('location:index.php');
	}
}

function printUser($user) {
	$action = $_GET['id'] == "new" ? "create" : "update"; //ternary function

	if($_GET['id']!="new") {
		echo "[<a href='?action=delete&id={$_GET['id']}'>Delete</a>]";
	}

?>

<form action="index.php?action=<?= $action?>&id=<?= $_GET['id']?>>"
	class="user" method="post">
	<div class="user-name">
		<label>Product Name</label>
		<input type="text" name="product_name" value="<?= $product_name ?>">
	</div>
	<div>
		<label>Product Description</label>
		<input type="text" name="product_description" value="<?= $user->product_description?>">
	</div>
	<div>
		<label>Technical Specs</label>
		<input type="text" name="technical_specs" value="<?= $user->technical_specs?>">
	</div>
	<div>
		<label>Price</label>
		<input type="text" name="price" value="<?= $user->price?>">
	</div>
	<label></label>
	<input type="submit" value="submit">
</div>
</form>
<? } ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Productst</title>
	<style>
		.user{
			margin-left: 1em;
			margin-top: 0.2em;
			padding: 0.2em 0.5em;
			border: 1px solid #ccc;
		}
		label{
			display: inline-block;
			width: 8em;
			margin-left: 1em;
			font-weight: bold;
			text-align: right;
		}
		input[type=text] {
			border: solid #000;
			border-width: 0 0 1px;
			display: inline;
			width: calc(100%-10em);
			font-size: inherit;
		}
	</style>
</head>
<body>
	<?
		if(isset($_GET['msg'])) {
			echo "<div>".$_GET['msg']."</div>";
		}

		if(isset($_GET['id'])) {
			$user = $_GET['id']=="new" ?
			$empty_user :
			$data->users[$_GET['id']];
			printUser($user);
			echo "<a href='index.php'>Back</a>";
		} else {
			echo "<a href='?id=new'>Add New Product</a>";
			foreach($data->users as $id=>$value) {
				echo "
					<div class='user'>
						<span>$value->product_name</span>
						<a href='?id=$id'>&gt;</a>
					</div>
				";
			}
		}
		






	?>




</body>
</html>




