<?php session_start(); ?>

<!--This page is designed and built by Yi-Nung Yeh-->

<?php

$which01 = $_POST['add01'];
$which02 = $_POST['add02']; 
$which03 = $_POST['add03'];
$which11 = $_POST['add11'];
$which12 = $_POST['add12']; 
$which13 = $_POST['add13']; 
$which21 = $_POST['add21'];
$which22 = $_POST['add22']; 
$which23 = $_POST['add23'];
$which31 = $_POST['add31'];
$which32 = $_POST['add32']; 
$which33 = $_POST['add33'];
$which41 = $_POST['add41'];
$which42 = $_POST['add42']; 
$which43 = $_POST['add43'];
$which51 = $_POST['add51'];
$which52 = $_POST['add52']; 
$which53 = $_POST['add53'];
$which61 = $_POST['add61'];
$which62 = $_POST['add62']; 
$which63 = $_POST['add63'];


$obj_r = $_SESSION['result'];

if($which01 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[0][0];
}
else if($which02 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[0][1];
}
else if($which03 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[0][2];
}
else if($which11 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[1][0];
}
else if($which12 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[1][1];
}
else if($which13 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[1][2];
}
else if($which21 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[2][0];
}
else if($which22 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[2][1];
}
else if($which23 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[2][2];
}
else if($which31 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[3][0];
}
else if($which32 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[3][1];
}
else if($which33 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[3][2];
}
else if($which41 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[4][0];
}
else if($which42 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[4][1];
}
else if($which43 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[4][2];
}
else if($which51 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[5][0];
}
else if($which52 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[5][1];
}
else if($which53 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[5][2];
}
else if($which61 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[6][0];
}
else if($which62 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[6][1];
}
else if($which63 != null)
{
    $url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$obj_r[6][2];
}


if($obj_r[0]!=NULL)
{
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
	if($output == false)
    {
	    echo "<script> alert('Oops.'); </script>";
	    echo "<meta http-equiv='Refresh' content='0;URL=./recipes2.php''>"; 
    }
	else
	{
        $result = json_decode($output,true);	
		if($which01 !=null || $which02 !=null || $which03 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./recipes2.php'>";
		}
		else if($which11 !=null || $which12 !=null || $which13 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./tues.php'>";
		}
		else if($which21 !=null || $which22 !=null || $which23 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./wed.php'>";
		}
		else if($which31 !=null || $which32 !=null || $which33 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./thur.php'>";
		}
		else if($which41 !=null || $which42 !=null || $which43 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./fri.php'>";
		}
		else if($which51 !=null || $which52 !=null || $which53 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./satu.php'>";
		}
		else if($which61 !=null || $which62 !=null || $which63 !=null)
		{
	        echo "<script> alert('Added to Your Favorite Recipes!'); </script>";
			echo "<meta http-equiv='Refresh' content='0;URL=./sun.php'>";
		}
	}
}

curl_close($ch);

?>