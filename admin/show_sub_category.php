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
     <a href="add_sub_category.php" class="btn btn-success">Add-Category</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Category name</th>
        <th>Sub-Category name</th>
        <th>Status</th>

        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
       <?php 

            $stmt = $conn->prepare("SELECT subcategories.id as subcat_id,categories.category_name as category,subcategories.subcat_name as subcategory,subcategories.status as status FROM subcategories LEFT JOIN categories ON subcategories.cat_id=categories.id");
            $stmt->execute();
            $sub_categories = $stmt->fetchAll();
           
            foreach($sub_categories as $subcategory){
          ?>
      <tr>
        <td><?php echo $subcategory['subcat_id'];?></td>
        <td><?php echo $subcategory['category'];?></td>
        <td><?php echo $subcategory['subcategory'];?></td>
         <td><input type="checkbox" <?php echo $subcategory['status'] == 1 ? 'checked' : '' ?>></td>
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