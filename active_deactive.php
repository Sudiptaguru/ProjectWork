<?php
include "db.php";
$id=$_REQUEST['id'];
$sql=mysqli_query($conn,"SELECT * FROM members WHERE id=".$id);
$fetch=mysqli_fetch_array($sql);
// print_r($fetch);

if($fetch['crm_access']==1)
{
	$update=mysqli_query($conn,"UPDATE members SET crm_access='0' WHERE id=".$id); 
	if($update)
	{
		header("location:savedata.php");
	}

}

if($fetch['crm_access']==0)
{
	$update=mysqli_query($conn,"UPDATE members SET crm_access='1' WHERE id=".$id);
	if($update)
	{
		header("location:savedata.php");
	}

}

?>