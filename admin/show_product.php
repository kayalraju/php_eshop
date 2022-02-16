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
            <h1 class="m-0">Show Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Show Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <hr>
    <!-- /.content-header -->

    <!-- Main content -->
   <div class="container">
  <p>
    <?php
    if (isset($_SESSION['success'])) { ?>   
    <div class="alert alert-success">
  <strong>Info!</strong> <?php echo $_SESSION['success'];?>
</div>
<?php 
}
unset($_SESSION['success']);
    ?>
</p>
    <div class="container">
     <a href="add_product.php" class="btn btn-success">Add-Product</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Category name</th>
        <th>Sub-Category name</th>
        <th>Product name</th>
        <th>Product Description</th>
        <th>price</th>
        <th>in-stocks</th>
        <th>image</th>
        <th>status</th>

        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
             <?php 

            $stmt = $conn->prepare("SELECT products.id as product_id,categories.category_name as category,subcategories.subcat_name as subcategory,products.product_name as product_name,price,in_stocks,image,description,products.status as status FROM products inner JOIN categories ON products.cat_id = categories.id inner JOIN subcategories ON products.subcat_id = subcategories.id");
            $stmt->execute();
            $products = $stmt->fetchAll();
           
            foreach($products as $product){
          ?>

            
      <tr>
          <td><?php echo $product['product_id']?></td>
          <td><?php echo $product['category']?></td>
          <td><?php echo $product['subcategory']?></td>
          <td><?php echo $product['product_name']?></td>
          <td><?php echo $product['description']?></td>
          <td><?php echo $product['price']?></td>
          <td><?php echo $product['in_stocks']?></td>
        <td><img src="products_image/<?php echo $product['image']?>" width="100px" height="100px"></td>
         <td><input type="checkbox" <?php echo $product['status'] == 1 ? 'checked' : '' ?>></td>
        <td><a href="" class="btn btn-info">Update</a></td>
         <td><a href="" class="btn btn-danger">Delete</a></td>
      </tr>
   <?php } ?>
    </tbody>
  </table>
    <!-- end main content -->
  
  <?php include('layout/footer.php'); ?>
</div>
<?php include('layout/asset.php'); ?>
</body>
</html>