<?php session_start(); ?>
<?php

$a = $_POST['age'];
$w = $_POST['weight'];
$g = $_POST['gender'];
$h = $_POST['height'];
$cu = $_POST['Cuisine'];
$favorid = $_POST[$cu];

if($a==null){$a=$_SESSION['age'];}
if($w==null){$w=$_SESSION['weight'];}
if($g==null){$g=$_SESSION['gender'];}
if($h==null){$h=$_SESSION['height'];}


$url = "http://52.91.113.244:8080/user?id=".$_SESSION['id']."&age=".$a."&weight=".$w."&gender=".$g."&height=".$h;
$url2 = "http://52.91.113.244:8080/favourite?userID=".$_SESSION['id']."&recipeID=".$favorid;
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
$result = json_decode($response,true);
curl_close($ch);

if($favorid!=null)
{
    $ch2 = curl_init();
	curl_setopt($ch2, CURLOPT_URL, $url2);
	curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	$response2  = curl_exec($ch2);
	curl_close($ch2);
	if($response2 == false)
	{
	    echo "<script> alert('Oops. Please Reset Your Preference.'); </script>"; 
        echo "<meta http-equiv='Refresh' content='0;URL=./update_preference.php'>";
	}
	else
	{
    	echo "<meta http-equiv='Refresh' content='0;URL=./update_preference.php'>";
	}
}

if($response == false)
{
	echo "<script> alert('Oops. Please Reset Your Preference.'); </script>"; 
    echo "<meta http-equiv='Refresh' content='0;URL=./edit.php'>";
}
else
{
	$_SESSION['age'] = $a;
	$_SESSION['gender'] = $g;
	$_SESSION['weight'] = $w;
	$_SESSION['height'] = $h;
	if($favorid!=null)
	{
	    $_SESSION['result']=null;
	}
	if($_SESSION['edit']==1)
        echo "<meta http-equiv='Refresh' content='0;URL=./edit.php'>";
	else
	    echo "<meta http-equiv='Refresh' content='0;URL=./editfr.php'>";
}


?>