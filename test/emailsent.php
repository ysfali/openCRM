<?php
	session_start();
	if(isset($_SESSION))
	{
		if(isset($_SESSION['status']) AND $_SESSION['status']==1)
		{
			if($_SESSION['sent']=="true")
			{
				echo "success";
			}
			else if($_SESSION['sent']=="false")
			{
				echo "fail";
			}
			$_SESSION['status']=0;
		}
	}
?>