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
            <h1 class="m-0">Add sub-Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Show sub-Category</li>
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
      	<?php 

            $stmt = $conn->prepare("SELECT * FROM categories WHERE status=1");
            $stmt->execute();
            $categories = $stmt->fetchAll();
           
            
          ?>
      <div class="form-group">
          <label for="exampleInputEmail1">select category</label>
          <select class="form-control" name="category">
          	<option>select category</option>
          	<?php
          	foreach($categories as $category){ ?>
          		<option value="<?php echo $category['id'] ?>"><?php echo $category['category_name'] ?></option>
          	<?php } ?>
          	
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Add sub-Category</label>
          <input type="text" name="subcat_name" class="form-control" placeholder="Enter category">
        </div>
        
        <span class="text-danger"></span>
      

        <br>
        <input type="submit" class="btn btn-primary" value="add sub-Category" name="submit">
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
  $sub_category=$_POST['subcat_name'];
  $cat_id=$_POST['category'];

  $created_at = date('Y-m-d H:m:s a');
  $updated_at = date('Y-m-d H:m:s a');
  //$stmt = $conn->prepare("SELECT * FROM subcategories where ");
  $sql = "INSERT INTO subcategories (cat_id,subcat_name,created_at,updated_at) VALUES ('$cat_id','$sub_category','$created_at','$updated_at')";
              if ($conn->exec($sql)) {
                echo '<script>window.location.href="show_sub_category.php"</script>';
                $_SESSION['success']='one sub-category inserted';
              }else{
                echo "<script>alert('Error extreme inside')</script>";
              }
}

?>