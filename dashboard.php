<?php
error_reporting(1);
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<?php include('header.php') ?>
<?php
$sql="SELECT COUNT( DISTINCT `contact_mobile`) AS `total_contact` FROM `contacts`";
$result=$conn->query($sql) ;        
$row = $result->fetch_assoc();
$total_contacts=$row['total_contact'];
$sql2="SELECT COUNT(DISTINCT `contact_id`) AS `today_calls` FROM `contacts` WHERE date(`called_date`)>=CURDATE()";
$result2=$conn->query($sql2) ;        
$row2 = $result2->fetch_assoc();
$today_calls=$row2['today_calls'];
$sql3="SELECT COUNT(DISTINCT `contact_id`) AS `total_calls` FROM `contacts`";
$result3=$conn->query($sql3) ;        
$row4 = $result3->fetch_assoc();
$total_calls=$row4['total_calls'];
?>
<section class="dashboard-counts section-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-2 col-md-4 col-6">
				<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Contacts</strong>
                  <div class="count-number"><?php echo $total_contacts; ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Today Calls</strong>
                  <div class="count-number"><?php echo $today_calls; ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Total Calls</strong>
                  <div class="count-number"><?php echo $total_calls; ?></div>
                </div>
              </div>
            </div>
		</div>
	</div>
</section>
<?php include('footer.php') ?>    

