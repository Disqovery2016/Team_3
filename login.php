<?php  

$c = $_REQUEST["c"]; 

if($c == 1){
	login();
}
if($c == 2){
	signup();
}

function login(){
	include 'db.php';
	if(isset($_REQUEST["email"],$_REQUEST["password"])){

$host = 'localhost';  
$user = "root";  
$pass = '';  
$database= "pulseit";
$conn = mysqli_connect($host, $user, $pass, $database);  
if ($conn) {
$emailid=mysqli_real_escape_string($conn, $_REQUEST["email"]);
$password=mysqli_real_escape_string($conn, $_REQUEST["password"]);
$sql = 'SELECT * FROM users';  
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){
  $i=0; 
    while($row = mysqli_fetch_assoc($retval)){ 
	    if($row['email']==$emailid && $row['password']==$password){
	        $i=1; $id=$row['uid']; $name=$row['name'];
			break;
		}	
	}
if($i==1){
	session_start();
	$_SESSION["uname"]=$name; $_SESSION["uid"]=$id; $_SESSION["uemail"]=$emailid; $_SESSION["upass"]=$password; 
	echo "2";
	} 
	else{echo "Either emailid or password is incorrect !" ; }
}
else{  
echo "No Such User !";  
}
     mysqli_close($conn); 
}
else {
print "Connection NOT established or Database NOT Found ";  
} 
}else{echo "All Details Not Entered";  }

}



function signup(){
	include 'db.php';
	$conn = mysqli_connect($host, $user, $pass, $database);
if(isset($_REQUEST["name"],$_REQUEST["email"],$_REQUEST["password"])){
	if($conn){
		$name=mysqli_real_escape_string($conn, $_REQUEST["name"]);
		$password=mysqli_real_escape_string($conn, $_REQUEST["password"]);
		$emailid=mysqli_real_escape_string($conn, $_REQUEST["email"]);
}

if (!$conn) {
	print "Server down !";
}
else {

	$sql2 = 'SELECT * FROM users';  
	$retval=mysqli_query($conn, $sql2);  $i=0;
  
	if(mysqli_num_rows($retval) > 0){
    	while($row = mysqli_fetch_assoc($retval)){ 
	    	if($row['email']==$emailid){
				$i=2; mysqli_close($conn); echo "Email already registered!";			
				break;
			}	
		}
	} 
	 
if($i==0){
	mysqli_autocommit($conn, FALSE);
	$sql = 'INSERT INTO users(name,email,password) VALUES("'.$name.'","'.$emailid.'","'.$password.'")';  
	mysqli_query($conn, $sql);
	mysqli_commit($conn);
	if( mysqli_commit($conn)){  
		echo "User Created Successfully !";   

	}else{  
		echo "Could not insert record : Server error";  
	}  
  
mysqli_close($conn); 
        }
}

}else{ echo "All details not entered !"; }

}

?>  