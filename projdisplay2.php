<?php

$c = $_REQUEST["c"];

if($c  == 1){
	projdisplayinit();
}
if($c  == 2){
	getprojdetails2();
}

function projdisplayinit(){
	session_start();
	$uid = $_SESSION["uid"];

	include 'db.php'; $cat = $_REQUEST["cat"];

$conn = mysqli_connect($host, $user, $pass, $database); $members = array();
if($conn){
	if($cat == "init"){
		$sql = "SELECT * FROM projects";
	}elseif($cat == "myprojects"){
		$sql = "SELECT * FROM projects WHERE prim IN (SELECT projid FROM projteam WHERE userid=$uid)";
	}else{
		$sql = "SELECT * FROM projects WHERE category=$cat";
	}

	if(!mysqli_query($conn,$sql)){
		echo "No Projects in this Category";
	}else{
		$result = mysqli_query($conn,$sql);
  		while($row = mysqli_fetch_assoc($result)){

    	$proj_name = $row["proj_name"]; $fund_exp = $row["fund_exp"]; $deadline = $row["deadline"];
    	$category = $row["category"]; $context = $row["context"]; $about = $row["about"]; 
    	$significance = $row["significance"]; $goal = $row["goal"]; $expenditure = $row["expenditure"]; $prim = $row["prim"];
    
    	echo "<div id=\"portfolio\" class=\"three_quarter\" style=\"float:left; width:30%; margin:0% 1%;\">";
    	echo "<ul class=\"clear\"><li class=\"one_third first\"><article class=\"clear\">";
    	echo "<figure class=\"post-image\" style=\"width:250px; height:200px;\"><img src=\"../proj_img/$prim.jpg\" alt=\"\" style=\"height:100%; width:100%;\"></figure>";
    	echo "<header><h2 class=\"blog-post-title\"><p onclick=\"getprojdetails($prim)\" class=\"catlink\">$proj_name</p></h2>";
    	echo "<div class=\"blog-post-meta\"><ul><li class=\"blog-post-date\"><time datetime=\"2000-04-06T08:15+00:00\"><strong>Deadline:</strong>$deadline</time></li>";
    	echo "</ul></div></header><p>$context</p><footer class=\"read-more\"><p onclick=\"getprojdetails($prim)\" class=\"catlink\">Read More &raquo;</p></footer></article></li></ul></div>";
	}
  }

  mysqli_close($conn);
}else{
  echo "Connection Error";
}
}

function getprojdetails2(){
	$prid = $_REQUEST["projid"];
include 'db.php'; $i=0;

$conn = mysqli_connect($host, $user, $pass, $database); $members = array();
if($conn){
	echo "<p onclick=\"projback()\" class=\"catlink\">Back</p>";

	$sql = "SELECT * FROM projects WHERE prim=$prid";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);

	$proj_name = $row["proj_name"]; $fund_exp = $row["fund_exp"]; $deadline = $row["deadline"];
	$category = $row["category"]; $context = $row["context"]; $about = $row["about"]; 
	$significance = $row["significance"]; $goal = $row["goal"]; $expenditure = $row["expenditure"];

	echo "<img style=\"width:100%; height:250px; margin:3% 0%;\" alt=\"\" src=\"../proj_img/$prid.jpg\">";

	$sql = "SELECT * FROM projteam WHERE projid=$prid";
	if(mysqli_query($conn,$sql)){
		$retval = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($retval)){
			$userid = $row["userid"];
			$sql2 = "SELECT * FROM users WHERE uid=$userid"; $retval2 = mysqli_query($conn,$sql2); $row2 = mysqli_fetch_array($retval2);
			$uname = $row2["name"]; $uemail = $row2["email"]; $upass = $row2["password"]; $uid = $row2["uid"];
			$udet = $uid."%".$uname."%".$uemail."%".$upass; 
			array_push($members, $udet);
		}
	}else{
		echo "No Members";
	}

	echo "<table class=\"form\" id=\"myTable\" cellpadding=\"10\">";
	echo "<tr><th><label><strong>Title</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$proj_name</p></td></tr>";
	echo "<tr><th><label><strong>Fund Expected </strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$fund_exp</p></td></tr>";
	echo "<tr><th><label><strong>Deadline</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$deadline</p></td></tr>";
	echo "<tr><th><label><strong>Category</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$category</p></td></tr>";
	echo "<tr><th><label><strong>Context</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$context</p></p></td></tr>";
	echo "<tr><th><label><strong>ABOUT</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$about</p></td></tr>";
	echo "<tr><th><label><strong>SIGNIFICANCE</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$significance</p></td></tr>";
	echo "<tr><th><label><strong>GOAL</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$goal</p></td></tr>";
	echo "<tr><th><label><strong>EXPENDITURE</strong></label></th><td><p style=\"display:block; border:1px solid #e8e8e8\">$expenditure</p></td></tr>";
	echo "<tr><th><label><strong>MEMBERS</strong></label></th>";

	for($i=0; $i<sizeof($members); $i++){
		$udet2 = explode("%", $udet); $cnt = $i+1;
		echo "<td>Member $cnt : <pre>Id : $udet2[0] 	Name : $udet2[1] 	Email : $udet2[2] 	Password : $udet[3]</pre></td>";
	}
	echo "</tr>";
	
	echo "</table>";

	mysqli_close($conn);
}else{
	echo "Connection Error";
}
}