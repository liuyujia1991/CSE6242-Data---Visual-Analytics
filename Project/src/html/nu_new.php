<?php session_start(); ?>


<?php  
	$url = "http://52.91.113.244:8080/nutrition?recipeID=".$_POST['id2'];
	$data = file_get_contents($url);
	echo $data;
?>