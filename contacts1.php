<?php include("db.php") ?>
<?php include('auth.php') ?>
<?php include "header.php"; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// New Data Add
	if($_REQUEST['contact_id']!=''){	
		$contact_name=mysqli_real_escape_string($conn, $_REQUEST['contact_name']);
    $contact_mobile=mysqli_real_escape_string($conn, $_REQUEST['contact_mobile']);
    $contact_email=mysqli_real_escape_string($conn, $_REQUEST['contact_email']);
    $assigned_member_id=mysqli_real_escape_string($conn, $_REQUEST['assigned_member_id']);
    $lead_status=mysqli_real_escape_string($conn, $_REQUEST['lead_status']);
    $remarks=mysqli_real_escape_string($conn, $_REQUEST['remarks']);
    $contact_id=mysqli_real_escape_string($conn, $_REQUEST['contact_id']);
		// $conn=mysqli_connect('localhost','root','','register');
		$sql = "UPDATE `contacts` SET `contact_name`='".$contact_name."', `contact_mobile`='".$contact_mobile."', `contact_email`='".$contact_email."', `assigned_member_id`='".$assigned_member_id."', `lead_status`='".$lead_status."', `remarks`='".$remarks."' WHERE `contact_id`='".$contact_id."'";
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg= "Record updated successfully";
		$redirectUrl=ADMIN_URL.'contacts.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg= "Error" . $conn->error;
		$redirectUrl=ADMIN_URL.'contacts.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Add Data
	else{
		$contact_name=$_REQUEST['contact_name']; 
    $contact_mobile=$_REQUEST['contact_mobile']; 
    $contact_email=$_REQUEST['contact_email']; 
    $assigned_member_id=$_REQUEST['assigned_member_id'];
    $lead_status=$_REQUEST['lead_status']; 
    $remarks=$_REQUEST['remarks']; 
		$sql = "INSERT INTO `contacts`(`contact_name`,`contact_mobile`,`contact_email`,`assigned_member_id`,`lead_status`,`remarks`) VALUES ('".$contact_name."','".$contact_mobile."','".$contact_email."','".$assigned_member_id."','".$lead_status."','".$remarks."')";
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg= "New record created successfully";
		$redirectUrl=ADMIN_URL.'contacts.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg= "Error" . $conn->error;
		$redirectUrl=ADMIN_URL.'contacts.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
} 
//Delete Data
if(isset($_REQUEST['delete']))
{
	$sql = "DELETE FROM `contacts` WHERE `contact_id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'contacts.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'contacts.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
} 
?> 
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container"> 
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
  <!-- END PAGE HEAD --> 
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Member Details </span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important"><a href="#draggable" id="add_new" class="btn btn-primary" data-toggle="modal" title="ADD NEW">+ Add New</a>
              </div>
                <div class="col-md-1 col-sm-1 col-xs-1 table-toolbar">
                  <div class="btn-group pull-right">
                    <!--<button class="btn btn-sm grey-cascade dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="#" onclick="window.print();return false;"> Print </a> </li>
                      <li> <a href="javascript:;"> Save as PDF </a> </li>
                      <li> <a href="javascript:;"> Export to Excel </a> </li>
                    </ul>-->
                  </div>
                </div>
              </div>
              <div class="row number-stats" >
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                	<?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>                    
                        <button class="close" data-close="alert"></button>
                        <span><?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?> </span>
					</div>
                 </div>                
              </div>
              <table class="table table-bordered" id="sample_editable_1">
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>Contact Name</th>
                    <th>Contact Mobile</th>
                    <th>Contact Email</th>                   
                    <th>Assigned Member Id</th>
                    <th>Call Status</th>
                    <th>Lead Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $conn=mysqli_connect('localhost','root','','register');        
                  $sql=mysqli_query($conn,"SELECT * FROM contacts");
                 //  $result3=$conn->query($sql3) ;
                  $contact_id=1;
                  while ($row3=mysqli_fetch_array($sql,MYSQLI_ASSOC))
                  {
                  ?>        
                  <tr>
                    <td> <?php echo $contact_id; ?></td>
                    <td> <?php echo $row3['contact_name']; ?></td>
                    <td> <?php echo $row3['contact_mobile']; ?></td>               
                    <td> <?php echo $row3['contact_email']; ?></td>
                    <td> <?php echo $row3['assigned_member_id']; ?></td>
                    <td>
                      <a href="call_status.php?contact_id=<?php echo $row3['contact_id'];?>" onclick="return confirm('Are you sure')">
                        <?php
                        if($row3['call_status']==1)
                        {
                          echo "picked";
                        }
                        elseif($row3['call_status']==2)
                        {
                          echo "not picked";
                        }
                        ?>
                      </a> 
                    </td>
                    <td> <?php if($row3['lead_status']==1){echo 'hot';} elseif($row3['lead_status']==2){echo 'cold';} elseif($row3['lead_status']==3){echo 'warm';} ?></td>
                    <td> <?php echo $row3['remarks']; ?></td>
                    <td> <a onClick="check('<?php echo $row3['contact_id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> | <a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['contact_id'];  ?>"><i class="fa fa-trash" title="Delete"></i> </a></td>  
                  </tr>
                  <?php 
                  $contact_id++; }
                  ?>
                </tbody>
              </table>
              
                  <!--Modal-->
                  <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog" id="model_header">
                      <div class="modal-content"> 
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Contacts</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                              <form name="myForm" action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Contact Name:</label>
                                  <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Enter text"/>
                                  <input type="hidden" name="contact_id" id="contact_id" class="form-control" placeholder="Enter id" />
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Contact Mobile:</label>
                                  <input type="text" name="contact_mobile" id="contact_mobile" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" class="form-control" placeholder="Enter text"/>
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Contact Email:</label>
                                  <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="contact_email" id="contact_email" class="form-control" placeholder="Enter text"/>
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Assigned Member Id:</label>
                                  <select  name="assigned_member_id" id="assigned_member_id" class="form-control" >
                                    <option value="">None</option>
                                    <?php 
                                    $sql7="select * from `members` ";
                                    $result7=$conn->query($sql7) ;
                                    while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){
                                      echo '<option value="'.$row7['id'].'" '; if($row3['contact_name']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <select  name="lead_status" id="lead_status" class="form-control" >
                                    <option value="1">Hot</option>
                                    <option value="2">Cold</option>
                                    <option value="3">Warm</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="remarks" class="col-form-label">Remarks:</label>
                                  <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
                                <div class="form-actions top">
                                  <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                      <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                                      <!--<button type="button" class="btn default">Cancel</button>-->
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <!-- END FORM--> 
                        </div>
                            
                       
                      </div>
                      <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                  </div>
              
              <!--Modal End-->
              
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET--> 
        </div>
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<!-- END PAGE CONTAINER --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#contact_name").val(empty);
				$("#contact_email").val(empty);
				$("#contact_mobile").val(empty);
        $("#assigned_member_id").val(empty);
        $("#lead_status").val(empty);
        $("#remarks").val(empty);
				$("#contact_id").val(empty);				
				});
      });
function check(contact_id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/contacts_ajax.php",
						dataType : "json", 
						data : "contact_id="+contact_id,
						success : function(data) {						
							//alert(data.flag);
							try{
								
								 $('#draggable').modal('show'); 								
								 $("#contact_name").val(data.contact_name);
								 $("#contact_email").val(data.contact_email);
								 $("#contact_mobile").val(data.contact_mobile);
                 $("#assigned_member_id").val(data.assigned_member_id);
                 $("#lead_status").val(data.lead_status);
                 $("#remarks").val(data.remarks);
								 $("#contact_id").val(data.contact_id);								
								
							}
							catch(err){
								alert(err.message);
							}
						
						}
					});
				}catch(err){
					alert(err.message);
				}
setInterval(function(){
   $('#error_msg').html('');
  }, 5000);
 
}
	  
</script>
<script>
function validateForm() {
  let contact_name = document.forms["myForm"]["contact_name"].value;
  if (contact_name == "") {
    alert("Contact Name must be filled out");
    return false;
  }
  let contact_email = document.forms["myForm"]["contact_email"].value;
  if (contact_email == "") {
    alert("Email must be filled out");
    return false;
  }
  let contact_mobile = document.forms["myForm"]["contact_mobile"].value;
  if (contact_mobile == "") {
    alert("Phone Number must be filled out");
    return false;
  }
}
</script>
<?php include "footer.php" ?>

