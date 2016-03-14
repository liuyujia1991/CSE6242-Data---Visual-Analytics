<?php session_start(); ?>

<!--This page is designed and built by Yi-Nung Yeh-->

<?php

$drid = $_POST['delete'];
$url = 'http://52.91.113.244:8080/favourite?userID='.$_SESSION['id'].'&recipeID='.$drid;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
if($output == false)
{
	echo "<script> alert('Oops.'); </script>";
	echo "<meta http-equiv='Refresh' content='0;URL=./favorite.php''>"; 
}
else
{
    $result = json_decode($output,true);
	$_SESSION['result']=null;
    echo "<meta http-equiv='Refresh' content='0;URL=./favorite.php'>";
}

curl_close($ch);

?>