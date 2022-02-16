<?php 
session_start(); 
if(!empty($_SESSION['id'])){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
   <?php 
   	include('layout/head.php');
	include('layout/connection.php');
   ?>
</head><!--/head-->

<body>
	<?php include('layout/header.php');?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php if(isset($_SESSION['success'])){ ?>
							<div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']) ?></div>
						<?php } ?>
						<?php if(isset($_SESSION['error'])){ ?>
							<div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>
						<?php } ?>
						<form method="POST">
							<input type="email" placeholder="Email Address" name="email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>"/>
							<input type="password" placeholder="password" name="password" value="<?= isset($_COOKIE['password']) ? $_COOKIE['password'] : '' ?>" />
							<span>
								<input type="checkbox" class="checkbox" name="remember_me" <?= isset($_COOKIE['email']) && isset($_COOKIE['password']) ? 'checked' : '' ?>> Remember me
							</span>
							<button type="submit" class="btn btn-default" name="login">Login</button>
						</form>
					</div><!--/login form-->
					<?php
					if (isset($_POST['login'])) {
						$email=$_POST['email'];
						$password=base64_encode($_POST['password']);
						$sql="SELECT * FROM users WHERE email='$email' AND password='$password' AND type='user'";
						$query = $conn->prepare($sql);
					    $query->execute();
					    $result = $query->fetch();
					    if($query->rowCount() == 1){
							if(isset($_POST['remember_me']) && !empty($_POST['remember_me'])){
								setcookie('email',$email,time()+3600*24);
								setcookie('password',base64_decode($password),time()+3600*24);
							}else{
								setcookie('email','');
								setcookie('password','');
							}
							$_SESSION['id'] = $result['id'];
							$_SESSION['name'] = $result['name'];
							//header('location:index.php');
					    }else{
					      $_SESSION['error'] = 'Email or Password Wrong!';
						  //header('location:login.php');
					    }
					}
					?>

				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="" method="POST">
							<input type="text" placeholder="Name" name="name"/>
							<input type="email" placeholder="Email Address" name="email" required/>
							<input type="text" placeholder="Phone Number" name="phone" required/>
							<input type="password" placeholder="Password" name="password" required/>
							<button type="submit" class="btn btn-default" name="submit">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	<?php
	include('layout/connection.php');
	if (isset($_POST['submit'])) {
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=base64_encode($_POST['password']);
		$sql="INSERT INTO users (name,email,phone,password) VALUES('$name','$email','$phone','$password')";
      if ($conn->exec($sql)) {
        $_SESSION['success'] = 'User Registration Successfully, You can Login Now!';
		//header('location:login.php');
      }
      else{
        $_SESSION['reg_error'] = 'Registration Failed, Try Again!';
		//header('location:login.php');
      }    
   }
?>

	<?php include('layout/footer.php');?>
</body>
</html>