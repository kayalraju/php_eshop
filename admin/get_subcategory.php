<?php 
include('connection.php');
	if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
		$category = $_POST['category'];
		$stmt = $conn->prepare("SELECT id,subcat_name FROM subcategories WHERE cat_id='$category'");
        $stmt->execute();
       	$subcategories = $stmt->fetchAll();
       	print_r(json_encode($subcategories));
	}
?>