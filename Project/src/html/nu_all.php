<?php session_start(); ?>

<?php
$obj_r =$_SESSION['result'];

$url1 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[0][0];
$url2 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[0][1];
$url3 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[0][2];
$url4 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[1][0];
$url5 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[1][1];
$url6 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[1][2];
$url7 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[2][0];
$url8 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[2][1];
$url9 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[2][2];
$url10 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[3][0];
$url11 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[3][1];
$url12 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[3][2];
$url13 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[4][0];
$url14 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[4][1];
$url15 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[4][2];
$url16 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[5][0];
$url17 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[5][1];
$url18 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[5][2];
$url19 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[6][0];
$url20 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[6][1];
$url21 = "http://52.91.113.244:8080/nutrition?recipeID=".$obj_r[6][2];


$data1 = file_get_contents($url1);
$data2 = file_get_contents($url2);
$data3 = file_get_contents($url3);
$data4 = file_get_contents($url4);
$data5 = file_get_contents($url5);
$data6 = file_get_contents($url6);
$data7 = file_get_contents($url7);
$data8 = file_get_contents($url8);
$data9 = file_get_contents($url9);
$data10 = file_get_contents($url10);
$data11 = file_get_contents($url11);
$data12 = file_get_contents($url12);
$data13 = file_get_contents($url13);
$data14 = file_get_contents($url14);
$data15 = file_get_contents($url15);
$data16 = file_get_contents($url16);
$data17 = file_get_contents($url17);
$data18 = file_get_contents($url18);
$data19 = file_get_contents($url19);
$data20 = file_get_contents($url20);
$data21 = file_get_contents($url21);

$arr=array(
array($data1,$data2,$data3),
array($data4,$data5,$data6),
array($data7,$data8,$data9),
array($data10,$data11,$data12),
array($data13,$data14,$data15),
array($data16,$data17,$data18),
array($data19,$data20,$data21)
);

echo json_encode($arr);

?>
