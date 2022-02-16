<?php
include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('layout/head.php'); ?>
  <title>AdminLTE 3 | Dashboard</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include('layout/header.php'); ?>

  <!-- Main Sidebar Container -->
  <?php include('layout/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <hr>
    <!-- /.content-header -->

    <!-- Main content -->
   
    <div class="card">
            <div class="card-header">Add Product</div>
            <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
      	<?php 

            $stmt = $conn->prepare("SELECT * FROM categories WHERE status=1");
            $stmt->execute();
            $categories = $stmt->fetchAll();
           
            
          ?>
      <div class="form-group">
          <label for="exampleInputEmail1">select category</label>
          <select class="form-control" name="category" id="category">
          	<option>select category</option>
          	<?php
          	foreach($categories as $category){ ?>
          		<option value="<?php echo $category['id'] ?>"><?php echo $category['category_name'] ?></option>
          	<?php } ?>
          	
          </select>
        </div>
         <div class="form-group">
          <label for="exampleInputEmail1">select sub-category</label>
          <select class="form-control" name="sub_category" id="subcategory">
          	<option>select sub-category</option>       	
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Product name</label>
          <input type="text" name="product_name" class="form-control" placeholder="Enter category">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Product price</label>
          <input type="text" name="price" class="form-control" placeholder="Enter category">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Product Description</label>
          <textarea class="form-control" rows="5" cols="4" name="desc">
          	
          </textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Product image</label>
          <input type="file" name="img" class="form-control" placeholder="Enter category">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Product In-Stoct</label>
          <input type="text" name="stock" class="form-control" placeholder="Enter category">
        </div>
        <span class="text-danger"></span>
      

        <br>
        <input type="submit" class="btn btn-primary" value="add Product" name="submit">
      </form>
            </div>
            
          </div>
  <?php include('layout/footer.php'); ?>
</div>
<?php include('layout/asset.php'); ?>
</body>
</html>
<?php
include('connection.php');
if(isset($_POST['submit'])){
  
  $cat_id=$_POST['category'];
  $subcat_id=$_POST['sub_category'];
  $product_name=$_POST['product_name'];
  $price=$_POST['price'];
  $desc=$_POST['desc'];
  $stock=$_POST['stock'];
  $created_at = date('Y-m-d H:m:s a');
  $updated_at = date('Y-m-d H:m:s a');
  $image= $_FILES['img'];

          if($image['type'] == 'image/jpg' || $image['type'] == 'image/jpeg' || $image['type'] == 'image/png' && $image['size'] < 1024*1024){
            $newimg = 'img_'.time().'.jpg';
            
            move_uploaded_file($image['tmp_name'],'products_image/'.$newimg);
  
  $sql = "INSERT INTO products (cat_id,subcat_id,product_name,description,price,image,in_stocks,created_at,updated_at) VALUES ('$cat_id','$subcat_id','$product_name','$desc','$price','$stock','$newimg','$created_at','$updated_at')";
              if ($conn->exec($sql)) {
                echo '<script>window.location.href="show_product.php"</script>';
                $_SESSION['success']='one product inserted';
              }else{
                echo "<script>alert('Error extreme inside')</script>";
              }
}
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#category').on('change',function(){
			var category = $(this).val()

			$.ajax({
				url: 'get_subcategory.php',
				type: 'POST',
				datatype: 'json',
				data: {'category':category},
				success: function(response){
					$('#subcategory').empty();
					result = "<option>select sub-category</option>"
					$.each(JSON.parse(response), function(k, v) {	
					result +=	"<option value='"+v.id+"'>"+v.subcat_name+"</option>";	
					});	
					$("#subcategory").append(result);													
					},
				error: function(){
					console.log('internal server error')
				}
			})
		});
	});
</script>