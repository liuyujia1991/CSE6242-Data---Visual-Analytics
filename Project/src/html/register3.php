<?php session_start(); ?>
<?php

$n = $_POST['name'];
$p = $_POST['password'];

$url = "http://54.210.167.207:8080/user?name=".$n."&password=".$p;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch); 

$result = json_decode($output,true);
if($n==NULL && $p!=NULL)
{
    echo "<script> alert('Username is Required. Redirecting to Index Page.'); </script>";
	echo "<meta http-equiv='Refresh' content='0;URL=./team15_index.php'>"; 
}
else if($n!=NULL && $p==NULL)
{
	echo "<script> alert('Password is Required. Redirecting to Index Page.'); </script>";
	echo "<meta http-equiv='Refresh' content='0;URL=./team15_index.php'>"; 
}
else if($n==NULL && $p==NUll)
{
	echo "<script> alert('Username and Password are Required. Redirecting to Index Page.'); </script>";
	echo "<meta http-equiv='Refresh' content='0;URL=./team15_index.php'>"; 
}
else if($output == false)
{
	echo "<script> alert('Oops. Redirecting to Index Page.'); </script>";
	echo "<meta http-equiv='Refresh' content='0;URL=./team15_index.php'>"; 
}
else
{
    echo "<script> alert('Welcome!!! You Are Logged in. Redirecting to Index Page.'); </script>";
	$_SESSION['login']=true;
	$_SESSION['id'] = $result->_id;
    $_SESSION['name'] = $result->name;
	echo "<meta http-equiv='Refresh' content='0;URL=./team15_index.php'>"; 
}

curl_close($ch);

?>