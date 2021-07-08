<?php

   class database
{
	private $host="localhost";
 	private $username="root";
 	private $password="";
 	private $db="test";
	protected function connect()   // connection function
	{
	
 	$conn=new mysqli($this->host,$this->username,$this->password,$this->db);
 		return $conn;

	}

	} // end of database class

class model extends database{
	
	// function to getdata from database
	public function getdata()	
	{
		$sql="select * from data";
		$result=$this->connect()->query($sql);
		if ($result->num_rows>0){
		while ($row=$result->fetch_assoc()) {
			$data[]=$row;
			
			} // end of while loop
		return $data;
	} //end of if statment 
	} //end of function 

	public function setdata() { // function to insert data into database
		$username=$_POST['username'];
		$email=$_POST['email'];
		$filename= $_FILES["uploadimage"]["name"];
		$tempname= $_FILES["uploadimage"]["tmp_name"];
		$folder="media/".$filename;
		$sql="insert into data(username,email,image) values('$username','$email','$folder')";
		$result=$this->connect()->query($sql);
		$uploaded= move_uploaded_file($tempname, $folder);
		
		if ($result and $uploaded) {
			header('location: index.php?msg=ins');
		} 
		else{
			echo "error ". $sql. "<br>".$this->connect()->error;
		}
	
	} // setdata function closed

	public function updatedatabyid($editid){

		$sql="SELECT * FROM DATA WHERE ID='$editid'";
		$result = $this->connect()->query($sql);
		if ($result->num_rows==1) {
			$row= $result->fetch_assoc();
			return $row;
		} // end of if statment 
	} 	// end of updatedatabyid9

	public function updatedata(){
		$hid= $_POST['hid'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$sql= " UPDATE data set username= '$username', email ='$email' WHERE id='$hid' ";
		$result= $this -> connect()->query($sql);
		if ($result){
			header('location: index.php?msg=ups');
		}
		else{
			echo "errror".$sql."<br>".$this->connect()->error;
		}
	} //end of updatedata

	public function deletedata($delid){
		$sql = "Delete from data where id= '$delid'";
		$result = $this->connect()->query($sql);
		if ($result) {
			header('location: index.php?msg=del');
		}
		else{
			echo "Error ".$sql. "<br>".$this->connect()->error;
		}
	} // end of deletedata function

} // end of class
?>