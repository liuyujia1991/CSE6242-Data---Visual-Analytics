<?php session_start(); ?>


<!doctype html>
<html>
  <head>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet'>
    <link href="bootstrap.css" rel="stylesheet">
    <link href="style3.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Luckiest+Guy' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="icon.ico">
	<title>Smart Meal Planner</title>
  </head>
  <body>

    <div class="header">
      <div class="container2">
        <a href="team15_index.php" class="logo-icon">
          <img src="logo.png">
        </a>
		
						  
		<ul class="menu">
		  <ul class="menu">
		  <li><a data-toggle="modal" href="#example"><?php if($_SESSION['login']==TRUE){echo "Log Out";} else {echo "Register/ Log In";}?></a></li>
		  <li><a href="howto.php">How It Works</a></li>
          <li><a data-toggle='<?php if($_SESSION['login']==TRUE){echo "null";} else {echo "modal";}?>' href='<?php if($_SESSION['login']==TRUE){echo "./recipes.php";} else {echo "#example";}?>'>Recipes</a></li>
          <li><a data-toggle='<?php if($_SESSION['login']==TRUE){echo "null";} else {echo "modal";}?>' href='<?php if($_SESSION['login']==TRUE){echo "./nutrition_analysis.php";} else {echo "#example";}?>'>Nutrition Analysis</a></li>
          <li><a data-toggle='<?php if($_SESSION['login']==TRUE){echo "null";} else {echo "modal";}?>' href='<?php if($_SESSION['login']==TRUE){echo "./shoppinglist.php";} else {echo "#example";}?>'>Weekly Shopping List</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle">More <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Community</a></li>
              <li><a href="#">Our Blog</a></li>
              <li><a href="#">Advertisers</a></li>
              <li><a href="aboutus.php">About Us</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
	
	<div id="example" class="modal hide fade in" role="dialog" style="display: none; " aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-header">
					<h3 class="title2"><center>Be A Smart Meal Planner!</center></h3>
				</div>
				<div class="modal-body">
                  <div id="mod">
                    <div id='fg_membersite_content'>
				        <iframe src='<?php if($_SESSION['login']==TRUE){echo "./logout.html";} else {echo "./register.html";}?>' width="400px" height="380px" scrolling="no" frameborder="0" align="center"> </iframe>
                    </div>
                  </div>
                </div>
                
    </div>

</div>

    <div class="slider">

      <div class="slide active-slide">
	    <div class="slide-copy">
        <div class="container">
          <div class="row">
		  <div class="col-xs-12">
			<h1 class="title">Smart Meal Planner</h1>
		    <h3 class="subtitle">Your Personalized Recipe Recommendation System</h3>
            

            </div>            
          </div>
        </div>
		<a data-toggle="modal" href="#example" class="classname">TRY NOW</a>
      </div>      
      </div>

      <div class="slide slide-feature">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
			<h1 class="title">Enjoy Cooking</h1>
		    <h3 class="subtitle">Afraid of Cooking? Let Us Help!</h3>
			
			



            </div>            
          </div>
        </div>
		<a data-toggle="modal" href="#example" class="classname">TRY NOW</a>
      </div> 

      <div class="slide slide-feature2">
        <div class="container">
          <div class="row">
          <div class="col-xs-12">
          <h1 class="title">Eat Nutritious Food</h1>
		   <h3 class="subtitle">Eat Fresh, Eat Right!</h3>


            </div>            
          </div>
        </div>
		<a data-toggle="modal" href="#example" class="classname">TRY NOW</a>
      </div> 


      <div class="slide slide-feature3">
        <div class="container">
          <div class="row">
          <div class="col-xs-12">
		  <h1 class="title">Happy Life</h1>
		   <h3 class="subtitle">Live Long, Live Strong!</h3>


            </div>            
          </div>
        </div>
		<a data-toggle="modal" href="#example" class="classname">TRY NOW</a>
      </div> 

    </div>

    <div class="slider-nav">
      <a href="#" class="arrow-prev"><img src="http://s3.amazonaws.com/codecademy-content/courses/ltp2/img/flipboard/arrow-prev.png"></a>
      <ul class="slider-dots">
        <li class="dot active-dot">&bull;</li>
        <li class="dot">&bull;</li>
        <li class="dot">&bull;</li>
        <li class="dot">&bull;</li>
      </ul>
      <a href="#" class="arrow-next"><img src="http://s3.amazonaws.com/codecademy-content/courses/ltp2/img/flipboard/arrow-next.png"></a>
    </div>
	

	
	<script src="http://connect.facebook.net/zh_TW/all.js"></script>
	<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
	<!-- AddToAny END -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="bootstrap-modal.js"></script>
    <script src="app3.js"></script>
  </body>
</html>