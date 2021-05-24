<?
include_once "../lib/php/functions.php";

$output = [];
$limit = 12;



if(!isset($_GET['type'])) {
	$output['error'] = "No Type";
} else switch($_GET['type']) {

	case "products-all":
	$output['result'] = getData(
		"SELECT *
		FROM `products`
		ORDER BY date_create DESC
		limit $limit"
	);
	break;

	case "products-one";
	if(!isset($_POST['id']))
		$output['error'] = "No ID";
	$output['result'] = getData(
		"SELECT *
		FROM `products`
		WHERE `id` = '{$_POST['id']}'"
	);
	break;

	case "products-search";
	is(!isset($_POST['search']))
		$output['error'] = "No Search Term";
	$output['result'] = getData(
		"SELECT *
		FROM `products`
		WHERE
			`title` LIKE '%{$_POST['search']}%' OR
			`description` LIKE '%{$_POST['search']}%' OR
			`category` LIKE '%{$_POST['search']}%'

			ORDER BY date_create DESC
			limit $limit"
	);
	break;

	case "products-filter";
		if(!isset($_POST['type']) || !isset($_POST['value']))
			$output['error'] = "Incorrrect Data";
		$output['result'] = getData(
			"SELECT *
			FROM `products`
			WHERE `{$_POST['type']}` = '{$_POST['value']}'
			ORDER BY `date_create` DESC
			LIMIT $limit"
		);
		break;

		case "products-sort":
        if(!isset($_POST['type']) || !isset($_POST['dir']))
            $output['error'] = "Incorrect Data";
        $output['result'] = getData(
            "SELECT *
            FROM `products`
            ORDER BY `{$_POST['type']}` {$_POST['dir']}
            limit $limit"
        );
        break;
}

die(json_encode(
	$output,
	JSON_UNESCAPED_UNICODE,
	JSON_NUMERIC_CHECK
	));



?>