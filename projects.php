<?php  

$c = $_REQUEST["c"]; 

if($c == 1){
	display_project_home();
}
if($c == 2){
	input_proj();
}
if($c == 3){
	display_proj();
}
if($c == 4){
	returndet();
}

function returndet(){
	session_start(); 
	if(isset($_SESSION["uid"])){
		$uid = $_SESSION["uid"]; $uname = $_SESSION["uname"]; $uemail = $_SESSION["uemail"]; $upass = $_SESSION["upass"];
		echo $uname;
	}else{}
}

function display_project_home(){
	include 'db.php'; $projdone = array();
	$conn = mysqli_connect($host, $user, $pass, $database); $ok=0; $proj="";
	if ($conn) {

		for($i=0; $i<4; $i++){
			$number = rand(1,10); $ok=0;
		
			while($ok == 0){
				$number = rand(1,10);
				$sql = "SELECT * FROM projects WHERE prim=$number";
				if(mysqli_query($conn,$sql)){
					$retval = mysqli_query($conn, $sql);
					$row = mysqli_fetch_array($retval);
					$img_name = $row["prim"];  $isap = $row["isapproved"];
					if(in_array($img_name, $projdone) || $isap == 0){}
					else{
						$proj_name = $row["proj_name"];
						$reqfund = $row["fund_exp"]; $funddone = $row["fund_raised"];

						$proj = $proj.$img_name."-".$proj_name."-".$reqfund."-".$funddone."%";
						array_push($projdone,$img_name);
						$ok = 1;
					}
				}
			}
		}
		echo $proj;
	}
}

function input_proj(){
	session_start(); $uid = $_SESSION["uid"]; 
	include 'db.php';
	$conn = mysqli_connect($host, $user, $pass, $database);
	if($conn){
		$project_name = $_REQUEST["project_name"]; $fundexp = $_REQUEST["fundexp"]; $deadline = $_REQUEST["deadline"];
		$significance = $_REQUEST["significance"]; $category = $_REQUEST["category"]; $about = $_REQUEST["about"];
		$context = $_REQUEST["context"]; $goal = $_REQUEST["goal"]; $expenditure = $_REQUEST["expenditure"];

		$mem2 = $_REQUEST["mem"]; $mem_email = explode("%", $mem2); //$mem_email = array(); 
		$mem = array(); $ok=1;
		
		for($i=1; $i < sizeof($mem_email); $i++){
			$sql = "SELECT * FROM users WHERE email='".$mem_email[$i]."'";
			if(!mysqli_query($conn,$sql)){ 
				echo "No User with Email : $mem_email[$i] exists ! Insert Valid Members Only"; $ok = 0; break;
			}else{
				$retval = mysqli_query($conn, $sql); $row = mysqli_fetch_array($retval);
				$mem[$i] = $row["uid"];
			}
		}
		array_push($mem,$uid);

		if($ok==1){
			$target_dir = "proj_img/";
			$target_file = $target_dir . basename($_FILES["proj_img"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    			echo "Only JPG, JPEG, PNG files are allowed.";
    			$uploadOk = 0;
			}
			if ($uploadOk == 0) {
    			echo "Sorry, your file was not uploaded.";
			} else{
				$sql = "INSERT INTO projects(proj_name,fund_exp,deadline,significance,category,about,context,goal,expenditure) VALUES('".$project_name."', '".$fundexp."','".$deadline."','".$impact."','".$category."','".$descp."')";
				mysqli_query($conn.$sql); mysqli_commit($conn);

				$last_id = mysqli_insert_id($conn);
				$temp = explode(".", $_FILES["proj_img"]["name"]);
				$newfilename = $last_id . '.' . end($temp);

				if (move_uploaded_file($_FILES["proj_img"]['tmp_name'], "proj_img/".$newfilename)) {
					for($i=0; $i<$no_of_mem; $i++){
						$sql = "INSERT INTO projteam(projid,userid) VALUES($last_id,$mem[$i])";
						mysqli_query($conn,$sql); mysqli_commit($conn);
					}

					/*$to = "admin@fundmyexp.com" ;//change receiver address  
   					$subject = "Email Confirmation";  
   					$message = '<html><body><p>Please click on this link to activate your account</p><br><a href="fundmyexp.com/adminapp/approve_proj.php?projid='.$last_id.'">Approve</a><a href="fundmyexp.com/adminapp/reject.php?projid='.$last_id.'">Approve</a><a href="fundmyexp.com/adminapp/viewproj.php?projid='.$last_id.'">Approve</a><br></body></html>'; 
   					$header = "From:admin@fundmyexp.com\r\n";  
   					$header .= 'MIME-Version: 1.0' . "\r\n";
   					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   					$result = mail ($to,$subject,$message,$header); */

   					if(mysqli_commit($conn)){
   						echo "Project Uploaded Successfully. It Will be Verified by us within 7 days and you will be notified on approval";
   					}else{
   						echo "Error Uploading !";
   					}

				}else{
					echo "Error Uploading Project !";
				}
			}
		}else{
			echo "OK != 1";
		}
	}else{
		echo "Cant connect to database";
	}
	echo mysqli_error($conn);
}

function display_proj(){
	
}

?>