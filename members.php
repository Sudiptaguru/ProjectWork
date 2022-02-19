<?php

// error_reporting(1);

require('db.php');

include("auth.php"); //include auth.php file on all secure pages ?>

<?php include('header.php') ?>

<?php 

//Add Code

if(isset($_REQUEST['submit']))

{

  // New Data Add

  if($_REQUEST['id']!=''){  

    $name=$_REQUEST['name'];

    $email=$_REQUEST['email'];

    $phone=$_REQUEST['phone']; 

    $id=$_REQUEST['id'];

    // $conn=mysqli_connect('localhost','root','','register');

    $sql = "UPDATE `members` SET `name`='".$name."', `email`='".$email."', `phone`='".$phone."' WHERE `id`='".$id."'";

    if($conn->query($sql)===TRUE)

    {

    $flg=0;

    $msg= "Record updated successfully";

    $redirectUrl=ADMIN_URL.'members.php?msg='.$msg.'&flg='.$flg;

    echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

    else

    {

    $flg=1;

    $msg= "Error" . $conn->error;

    $redirectUrl=ADMIN_URL.'members.php?msg='.$msg.'&flg='.$flg;

    echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

  }

  //Add Data

  else{

    $name=$_REQUEST['name'];

    $email=$_REQUEST['email'];

    $phone=$_REQUEST['phone']; 

    $sql = "INSERT INTO `members`(`name`,`email`,`phone`) VALUES ('".$name."','".$email."','".$phone."')";

    if($conn->query($sql)===TRUE)

    {

    $flg=0;

    $msg= "New record created successfully";

    $redirectUrl=ADMIN_URL.'members.php?msg='.$msg.'&flg='.$flg;

    echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

    else

    {

    $flg=1;

    $msg= "Error" . $conn->error;

    $redirectUrl=ADMIN_URL.'members.php?msg='.$msg.'&flg='.$flg;

    echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

  }

} 

//Delete Data

if(isset($_REQUEST['delete']))

{

  $sql = "DELETE FROM `members` WHERE `id`='".$_REQUEST['delete']."'";

  $result=$conn->query($sql);

  if ($conn->query($sql) === TRUE)

  {

  $flg=0;

  $msg= "Record deleted successfully";

  $redirectUrl=ADMIN_URL.'members.php?msg='.$msg.'&flg='.$flg;

  echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

  }

  else 

  {

  $flg=1;

  $msg= "Error deleting record: " . $conn->error;

  $redirectUrl=ADMIN_URL.'members.php?msg='.$msg.'&flg='.$flg;

  echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

  }

} 

?> 
<link rel="stylesheet" href="css/members.css">

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

              

              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                <!-- <p style="text-align:right">Search By Name</p> -->

                <thead>

                  <tr>

                    <th>Sl. No</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>CRM Access</th>                    

                    <th>Action</th>

                  </tr>

                </thead>

                <tbody>

                  <?php 

                  

          $sql=mysqli_query($conn,"SELECT * FROM members");

         //  $result3=$conn->query($sql3) ;

          $id=1;

         while ($row3=mysqli_fetch_array($sql,MYSQLI_ASSOC))

         {

           ?>                 

                   <tr >

                    <td> <?php echo $id; ?></td>

                    <td> <?php echo $row3['name']; ?></td>

                    <td> <?php echo $row3['email']; ?></td>

                    <td> <?php echo $row3['phone']; ?></td>

                    <!-- <td><a onClick="if(confirm('Are you sure?')) return true; else return false;" href="active_deactive.php?id=

                    <?php 

                    // echo $row3['id'];

                    ?>">



                      <?php

                      // if($row3['crm_access']==1)

                      // {

                      //  echo "Active";

                      // }

                      // else

                      // {

                      //  echo "Inactive";

                      // }

                      ?></a>

                    </td>  --> 

                    <td>

                      <label class="switch">

                        <input type="checkbox" id="<?=$row3['id']?>"  name="onoffswitch" value="<?=$row3['crm_access']?>" class="js-switch" <?=$row3['crm_access'] == '1' ? 'checked' : '' ;?>/>

                        <span class="slider round"></span>

                      </label>

                    </td>                 

                    <td> <a onClick="check('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> | <a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['id'];  ?>"><i class="fa fa-trash" title="Delete"></i> </a></td>                   

                  </tr>

                  <?php 

          $id++; }

          ?>

                 

                </tbody>

              </table>

              

                  <!--Modal-->

                  <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">

                    <div class="modal-dialog" id="model_header">

                      <div class="modal-content"> 

                        <div class="modal-header">

                          <h5 class="modal-title" id="exampleModalLabel">Members</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                          </button>

                        </div>

                        <div class="modal-body">

                              <form name="myForm" action="" method="post" class="form-horizontal" onsubmit="return validateForm()">

                                <div class="form-group">

                                  <label for="recipient-name" class="col-form-label">Name:</label>

                                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter text"/>

                                  <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />

                                </div>

                                <div class="form-group">

                                  <label for="recipient-name" class="col-form-label">Email:</label>

                                  <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" placeholder="Enter Email"/>

                                </div>

                                <div class="form-group">

                                  <label for="recipient-name" class="col-form-label">Phone:</label>

                                  <input type="text" name="phone" id="phone" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" class="form-control" placeholder="Enter Phone Number"/>

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

        

      

function check(id){



try{

    //alert(id);

    $.ajax({

            type : "POST",

            url : "<?php echo ADMIN_URL; ?>ajax/members_ajax.php",

            dataType : "json", 

            data : "id="+id,

            success : function(data) {            

              //alert(data.flag);

              try{

                

                 $('#draggable').modal('show');                 

                 $("#name").val(data.name);

                 $("#email").val(data.email);

                 $("#phone").val(data.phone);

                 $("#id").val(data.id);               

                

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

  let name = document.forms["myForm"]["name"].value;

  if (name == "") {

    alert("Name must be filled out");

    return false;

  }

  let email = document.forms["myForm"]["email"].value;

  if (email == "") {

    alert("Email must be filled out");

    return false;

  }

  let phone = document.forms["myForm"]["phone"].value;

  if (phone == "") {

    alert("Phone Number must be filled out");

    return false;

  }

}

</script>

<script type="text/javascript">

  $('input[name=onoffswitch]').click(function(){

var id=$(this).attr('id');

var crm_access = $(this).val();

if(crm_access == 1) {

    crm_access = 0; 

} else {

    crm_access = 1; 

}

//alert(id);

$.ajax({

        type:'POST',

        url:'active_deactive.php',

        data:'id= ' + id + '&crm_access='+crm_access

    });

});

</script>

<?php include "footer.php" ?>



