<?php session_start(); ?>

<!--This page is designed and built by Yi-Nung Yeh-->

<?php

$which01 = $_POST['dis01'];
$which02 = $_POST['dis02']; 
$which03 = $_POST['dis03'];
$which11 = $_POST['dis11'];
$which12 = $_POST['dis12']; 
$which13 = $_POST['dis13']; 
$which21 = $_POST['dis21'];
$which22 = $_POST['dis22']; 
$which23 = $_POST['dis23'];
$which31 = $_POST['dis31'];
$which32 = $_POST['dis32']; 
$which33 = $_POST['dis33'];
$which41 = $_POST['dis41'];
$which42 = $_POST['dis42']; 
$which43 = $_POST['dis43'];
$which51 = $_POST['dis51'];
$which52 = $_POST['dis52']; 
$which53 = $_POST['dis53'];
$which61 = $_POST['dis61'];
$which62 = $_POST['dis62']; 
$which63 = $_POST['dis63'];


$obj_r = $_SESSION['result'];

if($which01 != null)
{
    $_SESSION['dislike']=$obj_r[0][0];
}
else if($which02 != null)
{
    $_SESSION['dislike']=$obj_r[0][1];
}
else if($which03 != null)
{
    $_SESSION['dislike']=$obj_r[0][2];
}
else if($which11 != null)
{
    $_SESSION['dislike']=$obj_r[1][0];
}
else if($which12 != null)
{
    $_SESSION['dislike']=$obj_r[1][1];
}
else if($which13 != null)
{
    $_SESSION['dislike']=$obj_r[1][2];
}
else if($which21 != null)
{
    $_SESSION['dislike']=$obj_r[2][0];
}
else if($which22 != null)
{
    $_SESSION['dislike']=$obj_r[2][1];
}
else if($which23 != null)
{
    $_SESSION['dislike']=$obj_r[2][2];
}
else if($which31 != null)
{
    $_SESSION['dislike']=$obj_r[3][0];
}
else if($which32 != null)
{
    $_SESSION['dislike']=$obj_r[3][1];
}
else if($which33 != null)
{
    $_SESSION['dislike']=$obj_r[3][2];
}
else if($which41 != null)
{
    $_SESSION['dislike']=$obj_r[4][0];
}
else if($which42 != null)
{
    $_SESSION['dislike']=$obj_r[4][1];
}
else if($which43 != null)
{
    $_SESSION['dislike']=$obj_r[4][2];
}
else if($which51 != null)
{
    $_SESSION['dislike']=$obj_r[5][0];
}
else if($which52 != null)
{
    $_SESSION['dislike']=$obj_r[5][1];
}
else if($which53 != null)
{
    $_SESSION['dislike']=$obj_r[5][2];
}
else if($which61 != null)
{
    $_SESSION['dislike']=$obj_r[6][0];
}
else if($which62 != null)
{
    $_SESSION['dislike']=$obj_r[6][1];
}
else if($which63 != null)
{
    $_SESSION['dislike']=$obj_r[6][2];
}


if($obj_r[0]!=NULL)
{
		if($which01 !=null || $which02 !=null || $which03 !=null)
		{
			echo "<meta http-equiv='Refresh' content='0;URL=./recipes2.php'>";
		}
		else if($which11 !=null || $which12 !=null || $which13 !=null)
		{
	        echo "<meta http-equiv='Refresh' content='0;URL=./tues.php'>";
		}
		else if($which21 !=null || $which22 !=null || $which23 !=null)
		{
	        echo "<meta http-equiv='Refresh' content='0;URL=./wed.php'>";
		}
		else if($which31 !=null || $which32 !=null || $which33 !=null)
		{
	        echo "<meta http-equiv='Refresh' content='0;URL=./thur.php'>";
		}
		else if($which41 !=null || $which42 !=null || $which43 !=null)
		{
	        echo "<meta http-equiv='Refresh' content='0;URL=./fri.php'>";
		}
		else if($which51 !=null || $which52 !=null || $which53 !=null)
		{
	        echo "<meta http-equiv='Refresh' content='0;URL=./satu.php'>";
		}
		else if($which61 !=null || $which62 !=null || $which63 !=null)
		{
	        echo "<meta http-equiv='Refresh' content='0;URL=./sun.php'>";
		}
		echo "<meta http-equiv='Refresh' content='0;URL=../graph.html'>"; 
}
else
{
	    echo "<script> alert('Oops.'); </script>";
	    echo "<meta http-equiv='Refresh' content='0;URL=./recipes2.php'>"; 
}

?>