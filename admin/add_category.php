<?php
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
            <h1 class="m-0">Add Category</h1>
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
   
    <div class="card">
            <div class="card-header">Add Category</div>
            <div class="card-body">
      <form action="" method="post">
      
        <div class="form-group">
          <label for="exampleInputEmail1">Add Category</label>
          <input type="text" name="category_name" class="form-control" placeholder="Enter category">
        </div>
        
        <span class="text-danger"></span>
      

        <br>
        <input type="submit" class="btn btn-primary" value="add Category" name="submit">
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
  $category=$_POST['category_name'];
  $created_at = date('Y-m-d H:m:s a');
  $updated_at = date('Y-m-d H:m:s a');
  $sql = "INSERT INTO categories (category_name,created_at,updated_at) VALUES ('$category','$created_at','$updated_at')";
              if ($conn->exec($sql)) {
                echo '<script>window.location.href="show_category.php"</script>';
                $_SESSION['success']='one category inserted';
              }else{
                echo "<script>alert('Error extreme inside')</script>";
              }
}

?>