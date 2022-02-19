<?php
include "db.php";
$contact_id=$_REQUEST['contact_id'];
$sql=mysqli_query($conn,"SELECT * FROM contacts WHERE contact_id=".$contact_id);
$fetch=mysqli_fetch_array($sql);
// print_r($fetch);

if($fetch['call_status']==1)
{
	$update=mysqli_query($conn,"UPDATE contacts SET call_status='2' WHERE contact_id=".$contact_id); 
	if($update)
	{
		header("location:contacts.php");
	}

}

if($fetch['call_status']==2)
{
	$update=mysqli_query($conn,"UPDATE contacts SET call_status='1' WHERE contact_id=".$contact_id);
	if($update)
	{
		header("location:contacts.php");
	}

}

?>