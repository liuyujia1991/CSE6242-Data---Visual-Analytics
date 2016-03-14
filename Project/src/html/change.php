<?php session_start(); ?>


<?php  
	$_SESSION['change']=$_POST['id3'];
	
	$obj_r =$_SESSION['result'];
	$x=sizeof($obj_r[0]);
	$y=sizeof($obj_r);

	if($_SESSION['change']!=null)
	{

        for($i=0;$i<$y;$i++)
		{
            for($j=0;$j<$x;$j++)
		    {
	            if($obj_r[$i][$j]==$_SESSION['dislike'])
				{
		            $obj_r[$i][$j]=$_SESSION['change'];
		        }
	        }
        }
    }
	
	

    $_SESSION['result']=$obj_r;
    $_SESSION['change']=null;

?>