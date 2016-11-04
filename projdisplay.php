<!DOCTYPE html>
<html>
<head>
<title>Fund My Research</title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="../layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<!--[if lt IE 9]>
<link href="../layout/styles/ie/ie8.css" rel="stylesheet" type="text/css" media="all">
<script src="../layout/scripts/ie/css3-mediaqueries.min.js"></script>
<script src="../layout/scripts/ie/html5shiv.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../css/dropdown.css" />
<script type = "text/javascript" 
         src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
</head>
<style type="text/css">
  .catlink{
    padding:2%; cursor:pointer;
  }
  .catlink:hover{
    text-decoration: underline; 
  }
</style>
<body class="">
<div class="wrapper row1">
  <header id="header" class="full_width clear">
    <div id="hgroup">
      <h1><a href="../index.html">Fund My Research</a></h1>
    </div>
    <div id="header-contact">
      <ul class="list none">
     <li><a href="#" id="userdet1">sohamthaker@gmail.com</a></li>
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
      <li><a class="last child" href="#" title="Pages">Discover</a>
      </li>
      <li><a class="last child" href="howitworks.html" title="Elemenst">How it works</a>
      </li>
      <li class="last-child"><a href="signup.html" title="A Very Long Link Text" id="signuplink">Sign Up</a></li>
      <li class="last-child"><a href="signin.html" title="A Very Long Link Text" id="signinlink">Sign In</a></li>
      <li class="last-child"><a href="pre.php" title="Input New Project">Input Project</a></li>
    </ul>
  </nav>
</div>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <aside>
        <!-- ########################################################################################## -->
        <h2>Discover</h2>
        <nav>
          <ul>
          <li><p onclick="projdisplayinit('myprojects')" class="catlink">My Projects</p></li>
            <li><p onclick="projdisplayinit('education')" class="catlink">Education</p></li>
            <li><p onclick="projdisplayinit('healthcare')" class="catlink">Health Care</p>
                <li><p onclick="projdisplayinit('agriculture')" class="catlink">Agriculture</p></li>
                <li><p onclick="projdisplayinit('renewable')" class="catlink">Renewable</p></li>
                <li><p onclick="projdisplayinit('init')" class="catlink">All</p></li>
              </ul>
        </nav>
        <!-- /nav -->
        </aside>
    </div>
    <!-- ################################################################################################ -->

    <div id="portfolio" class="three_quarter"></div>

    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<div class="wrapper row2">
  <div id="footer" class="clear">
    <div class="one_quarter first">
      <h2 class="footer_title">Footer Navigation</h2>
      <nav class="footer_nav">
        <ul class="nospace">
          <li><a href="../index.html">Home Page</a></li>
          <li><a href="education.html">Discover</a></li>
          <li><a href="howitworks.html">How it works</a></li>
        </ul>
      </nav>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">Contact Us</h2>
      <form class="rnd5" action="#" method="post">
        <div class="form-input clear">
          <label for="ft_author">Name <span class="required">*</span><br>
            <input type="text" name="ft_author" id="ft_author" value="" size="22">
          </label>
          <label for="ft_email">Email <span class="required">*</span><br>
            <input type="text" name="ft_email" id="ft_email" value="" size="22">
          </label>
        </div>
        <div class="form-message">
          <textarea name="ft_message" id="ft_message" cols="25" rows="10"></textarea>
        </div>
        <p>
          <input type="submit" value="Submit" class="button small orange">
          &nbsp;
          <input type="reset" value="Reset" class="button small grey">
        </p>
      </form>
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

var tempdata;
          window.onload = function() {
            getuserdet();
            projdisplayinit("init");
        };  

        function getuserdet(){
             $.post("../projects.php", {c: 4},
              function(data){
                if(!data){
                  document.getElementById("drpdwn").style.display = "none";
                  document.getElementById("userdet1").style.display = "block";
                }else{
                  document.getElementById("userdet1").style.display = "none";
                  document.getElementById("drpdwn").style.display = "block";
                  document.getElementById("userdet2").innerHTML = data;
                  document.getElementById("signinlink").style.display = "none"; document.getElementById("signuplink").style.display = "none";
                }
              })        
        }

  function projdisplayinit(catg){
    $.post("projdisplay2.php", {c: 1, cat: catg},
      function(data){
        document.getElementById("portfolio").innerHTML = data; tempdata = data;
    })
  }

  function getprojdetails(prim){
    $.post("projdisplay2.php", {c: 2, projid: prim},
      function(data){
        document.getElementById("portfolio").innerHTML = data; tempdata = data;
    })    
  }

  function projback(){
    document.getElementById("portfolio").innerHTML = tempdata;
  }

</script>

</body>
</html>