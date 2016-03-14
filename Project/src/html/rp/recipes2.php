<?php session_start(); ?>

<?php

// set the PHP timelimit to 10 minutes
set_time_limit(600);
// rest of your code will be able to run for the next 10 minutes before timing out
ini_set('max_execution_time',600);

?>

<?php $url_receipe = "http://52.91.113.244:8080/recommendation?userID=".$_SESSION['id'];

$_SESSION['data_receipe'] = file_get_contents($url_receipe);


?>

<?php
$obj_receipe = json_decode($_SESSION['data_receipe']);
$_SESSION['rid1']=$obj_receipe[0][0];
$_SESSION['rid2']=$obj_receipe[0][1];
$_SESSION['rid3']=$obj_receipe[0][2];
?>


<?php

$url1 = "http://52.91.113.244:8080/recipes?recipeID=".$_SESSION['rid1'];
$url2 = "http://52.91.113.244:8080/recipes?recipeID=".$_SESSION['rid2'];
$url3 = "http://52.91.113.244:8080/recipes?recipeID=".$_SESSION['rid3'];

$data1 = file_get_contents($url1);
$obj1 = json_decode($data1);
$data2 = file_get_contents($url2);
$obj2 = json_decode($data2);
$data3 = file_get_contents($url3);
$obj3 = json_decode($data3);

if(isset($obj1[0])!=NULL)
{
    $_SESSION['rname1'] = $obj1[0]->name;
    $_SESSION['rlargeImage1'] = $obj1[0]->largeImage;
	$_SESSION['rnumberOfServings1'] = $obj1[0]->numberOfServings;
	$_SESSION['rating1'] = $obj1[0]->rating;
    $_SESSION['sourceRecipeUrl1'] = $obj1[0]->sourceRecipeUrl;	
}
if(isset($obj2[0])!=NULL)
{
    $_SESSION['rname2'] = $obj2[0]->name;
    $_SESSION['rlargeImage2'] = $obj2[0]->largeImage;
	$_SESSION['rnumberOfServings2'] = $obj2[0]->numberOfServings;
	$_SESSION['rating2'] = $obj2[0]->rating;
    $_SESSION['sourceRecipeUrl2'] = $obj2[0]->sourceRecipeUrl;	
}
if(isset($obj1[0])!=NULL)
{
    $_SESSION['rname3'] = $obj3[0]->name;
    $_SESSION['rlargeImage3'] = $obj3[0]->largeImage;
	$_SESSION['rnumberOfServings3'] = $obj3[0]->numberOfServings;
	$_SESSION['rating3'] = $obj3[0]->rating;
    $_SESSION['sourceRecipeUrl3'] = $obj3[0]->sourceRecipeUrl;	
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet'>
    <link href="bootstrap.css" rel="stylesheet">
    <link href="style4.css" rel="stylesheet">
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
	<link href="recipes.css" rel="stylesheet">
    <title></title>
	<script>
    body{
	    background-attachment: fixed;
	    background-repeat: no-repeat;
    }
	</script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	

  </head>
  <body>
  
  
  
  
  
  
<div id="c">

<h1 class="title2">Monday Meal Plan</h1><br>
<select onChange="location = this.options[this.selectedIndex].value;">
<option value="#">Select A Day</option>
<option value="recipes2.php">Monday</option>
<option value="tues.php">Tuesday</option>
<option value="wed.php">Wednesday</option>
<option value="thur.php">Thursday</option>
<option value="fri.php">Friday</option>
<option value="satu.php">Saturday</option>
<option value="sun.php">Sunday</option>
</select>

      <div class="article current">
        <div class="item row">
          <div class="col-xs-3">
            <p class="source"><img src=<?php echo $_SESSION['rlargeImage1'] ?>></p>
          </div>
          <div class="col-xs-7" style="padding-top:55px">
            <p class="title"><?php if($_SESSION['rname1']==null){echo "N/A";} else{echo $_SESSION['rname1'];} ?></p>
          </div>
          <div class="col-xs-2" style="padding-top:55px">
            <p class="pubdate">Rating: <?php if($_SESSION['rname1']==null){echo "N/A";} else{echo $_SESSION['rating1'];} ?></p>
          </div>
        </div>
         <div class="description row">
          <div class="col-xs-3">&nbsp;</div>
          <div class="col-xs-7">
            <p><a href="<?php if($_SESSION['sourceRecipeUrl1']==null){echo "N/A";} else{echo $_SESSION['sourceRecipeUrl1'];} ?>">To See Details</a></p>
          </div>
          <div class="col-xs-2">&nbsp;</div>
        </div>
      </div>

      <div class="article">
        <div class="item row">
          <div class="col-xs-3">
            <p class="source"><img src=<?php echo $_SESSION['rlargeImage2'] ?>></p>
          </div>
          <div class="col-xs-7" style="padding-top:55px">
            <p class="title"><?php if($_SESSION['rname2']==null){echo "N/A";} else{echo $_SESSION['rname2'];} ?></p>
          </div>
          <div class="col-xs-2" style="padding-top:55px">
            <p class="pubdate">Rating: <?php if($_SESSION['rname2']==null){echo "N/A";} else{echo $_SESSION['rating2'];} ?></p>
          </div>
        </div>
        <div class="description row">
          <div class="col-xs-3">&nbsp;</div>
          <div class="col-xs-7">
            <p><a href="<?php if($_SESSION['sourceRecipeUrl2']==null){echo "N/A";} else{echo $_SESSION['sourceRecipeUrl2'];} ?>">To See Details</a></p>
          </div>
          <div class="col-xs-2">&nbsp;</div>
        </div>
      </div>

      <div class="article">
        <div class="item row">
          <div class="col-xs-3">
            <p class="source"><img src=<?php echo $_SESSION['rlargeImage3'] ?>></p>
          </div>
          <div class="col-xs-7" style="padding-top:55px">
            <p class="title"><?php if($_SESSION['rname3']==null){echo "N/A";} else{echo $_SESSION['rname3'];} ?></p>
          </div>
          <div class="col-xs-2" style="padding-top:55px">
            <p class="pubdate">Rating: <?php if($_SESSION['rname3']==null){echo "N/A";} else{echo $_SESSION['rating3'];} ?></p>
          </div>
        </div>
        <div class="description row">
          <div class="col-xs-3">&nbsp;</div>
          <div class="col-xs-7">
            <p><a href="<?php if($_SESSION['rname3']==null){echo "N/A";} else{echo $_SESSION['sourceRecipeUrl3'];} ?>">To See Details</a></p>
          </div>
          <div class="col-xs-2">&nbsp;</div>
        </div>
      </div>
	  
	  <br>
  
     <a href="./recipes3.php" class="myButton">Get Shopping List!</a>
  
  
   
</div>
    
    <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="app2.js"></script>
	<script src="app3.js"></script>
	<script> 
    </script> 
  </body>
</html>