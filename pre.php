<html>
<head>
<title>Pusle It</title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="../layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../css/dropdown.css" />
<!--[if lt IE 9]>
<link href="../layout/styles/ie/ie8.css" rel="stylesheet" type="text/css" media="all">
<script src="../layout/scripts/ie/css3-mediaqueries.min.js"></script>
<script src="../layout/scripts/ie/html5shiv.min.js"></script>
<![endif]-->
<link href="layout/scripts/responsiveslides.js-v1.53/responsiveslides.css" rel="stylesheet" type="text/css" media="all">
<script type = "text/javascript" 
         src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
</head>
<body class="">
<div class="wrapper row1">
  <header id="header" class="full_width clear">
    <div id="hgroup">
      <h1><a href="../index.html">Pulse It</a></h1>
    </div>
    <div id="header-contact">
      <ul class="list none">
 <div class="dropdown" id="drpdwn">
  <button class="dropbtn" id="userdet2"></button>
  <div class="dropdown-content">
    <a href="profile.html">Profile</a>
    <a href="logout.php">LogOut</a>
  </div>
</div>
      </ul>
    </div>
  </header>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
      <li class="active"><a href="../index.html" title="Homepage">Homepage</a></li>
      <li><a class="last child" href="history.html" title="Pages">My History</a>
      </li>
        <li><a class="last child" href="tips.html" title="Pages">Tips for my Health</a>
      </li>
      <!--<li class="last-child"><a href="page/projectdetails.html" title="A Very Long Link Text" id="myprojects">My Projects</a></li>-->
    </ul>
  </nav>
</div>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="contact" class="clear">
      <div class="one_half first">
        <h1>Fill in your Health Data</h1>
        <div id="respond">

		<table class="form" id="myTable">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="prform">

			<tr>
				<th><label><strong>Patient Name</strong></label></th>
				<td><input  name="patient_name" id="title" type="text" size="30" /></td>
			</tr>

      	<tr>
				<th><label><strong>Patient Image</strong></label></th>
        <td><input type="file" name="patient_img" accept="image/*" name="patient_img"></td>
        </tr>

			<tr>
				<th><label><strong>Allergies?</strong></label></th>
				<td>
				<textarea name="about" id="about" cols="30" rows="5"></textarea>
				</td>
			</tr>
      			<tr>
				<th ><label ><strong>Medications?</strong></label></th>
				<td>
				<textarea name="context" id="context" cols="30" rows="5"></textarea>
				</td>
			</tr>
      			<tr>
				<th><label><strong>Medical History?</strong></label></th>
				<td>
				<textarea name="significance" id="signi" cols="30" rows="5"></textarea>
				</td>
			</tr>
      			<tr>
				<th><label><strong>Surgical History?</strong></label></th>
				<td>
				<textarea name="goal" id="goal" cols="30" rows="5"></textarea>
				</td>
			</tr>




			<tr>
				<td class="submit-button-right" colspan="2">
        
				</td>
			</tr>
<!--<tr><div id="memberdialog" style="display:none; position:fixed; top:20%; left:30%; width:40%; background:blue;"></div></tr>-->
		</table>
    <input type="submit" value="submit" name="prsub">
    </form>
  <p id="resultop"></p>

    </div>
  </div>
</div>
  </div>
<div class="wrapper row2">
  <div id="footer" class="clear">
    <div class="one_quarter first">
      <h2 class="footer_title">Pulse It</h2>
      <nav class="footer_nav">
        <ul class="nospace">
          <li><a href="../index.html">Home Page</a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>
<div class="wrapper row4">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright 2016 - All Rights Reserved - <a href="#">FundMyResearch.com</a></p>
  </div>
</div>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="../layout/scripts/jquery-latest.min.js"><\/script>\
<script src="../layout/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="../layout/scripts/jquery-mobilemenu.min.js"></script>
<script src="../layout/scripts/custom.js"></script>

<script type="text/javascript">
    function getmeminputfields(){
    //var memberdialog = document.getElementById("memberdialog"); memberdialog.style.display = "block"; 
    var tableRef = document.getElementById('myTable');
    var prdetmem = document.getElementById("prdetmem").value; var i=0;

    for(i = 0; i<parseInt(prdetmem); i++){ 
      var newRow   = tableRef.insertRow(tableRef.rows.length); var newCell1  = newRow.insertCell(0); var newCell2  = newRow.insertCell(1);
      var x = document.createElement("INPUT"); 
      x.setAttribute("type", "text"); x.setAttribute("name", "member"+i); x.setAttribute("placeholder", "Member "+i+": Email");
      newCell2.appendChild(x); 
    }
  }

  function hidememinputfields(){
    var memberdialog = document.getElementById("memberdialog"); memberdialog.style.display = "none";
  }

  window.onload = function() { getuserdet(); } 

        function getuserdet(){
             $.post("../projects.php", {c: 4},
              function(data){
                  document.getElementById("userdet2").innerHTML = data;
              })        
        }

</script>
</body>
</html>