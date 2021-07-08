<?php
require 'model.php';
$obj=new model();          // object created
		
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Table</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- sucess message -->
		<?php 
		if (isset($_GET['msg']) AND $_GET['msg']=='ins') {
			echo '<div class="alert alert-secondary" role="alert">
  Record inserted sucessfully....!
</div>';
		}

		if (isset($_GET['msg']) AND $_GET['msg']=='ups') {
			echo '<div class="alert alert-secondary" role="alert">
  Record updated sucessfully...
</div>';
		}

		if (isset($_GET['msg']) AND $_GET['msg']=='del') {
			echo '<div class="alert alert-secondary" role="alert">
  Record deleted sucessfully...
</div>';
		}

		?>
	<?php
	if (isset($_POST['submit'])) {
		$obj->setdata($_POST); 			// called setdata function
	}

	if (isset($_POST['update'])) {
		$obj->updatedata($_POST); 			// called update function
	}

		if (isset($_GET['deleteid'])) {
			$delid = $_GET['deleteid'];
		$obj->deletedata($delid); 			// called deletedata function
	}


	if (isset($_GET['editid'])){
		$editid= $_GET['editid'];
		$myrecord = $obj->updatedatabyid($editid);
		?>


		
<h2>MY Crud Operation</h2>
		<form action="index.php" method="post">
	<div class="form-group">
	<label for="username">UserName</label>
	<input type="text" class="form-control" name="username" value="<?Php echo $myrecord['username'];?>" placeholder="Enter Your UserName Here"><br>
	<label for="Email">Email</label>
	<input type="Email" class="form-control" name="email" value="<?Php echo $myrecord['email'];?>" placeholder="Enter your Email Here"><br>
	<input type="hidden" name="hid" value="<?php echo $myrecord['id'];?>">
	<input type="submit" name="update" value="update">
</div>
</form>

	<?php
	} // end of if statment

	else { ?>
<form action="index.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label for="username">UserName</label>
	<input type="text" class="form-control" name="username" placeholder="Enter Your UserName Here"><br>
	<label for="Email">Email</label>
	<input type="Email" class="form-control" name="email" placeholder="Enter your Email Here"><br>
	<input type="file" class="form-control" name="uploadimage"> <br>
	<input type="submit" class="btn btn-info" name="submit" value="Insert Record">

</div>
</form>
<?php }// end of else statment
 ?> 


	<!-- Table for Showing data-->

<table  class="table table-bordered">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Picture</th>
		<th>Action</th>
	</tr>
	<?php $result=$obj->getdata();	
	foreach ($result as $value) {	
	?>
	<tr>
		<img src="" alt="">
		 <td><?php echo $value['id'];?></td>
		 <td><?php echo $value['username'];?></td>
		 <td><?php echo $value['email'];?></td>
		 <td><img src="<?php echo $value['image'];?>" alt="picture"   width="100px" height="100px"></td>
		 <td>
		 	<a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
		 	<a href="index.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
		 </td>
	</tr>
<?php }?>
</table> 

</body>
</html>