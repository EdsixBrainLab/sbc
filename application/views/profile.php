<?php //include_once('headerinner.php'); ?>
<?php //if($countdowntime>0){header("Location:countdown.php");} ?>
<?php //echo '<pre>'; print_r($_SESSION); ?>
<div id="wrapper">
	<div class="container">
<!--MyProfile starts here -->
	<div id="divMyProfile" class="MyProfilePager1 pageHomePagerHide Dashboardhide mygameshide myreporthide ">
			<div class="row" >
                <div class="col-lg-12">
                    <h1 class="page-header">My Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
        		<div class="col-lg-12 profileContainer">
                	<div class="col-lg-3 col-md-3 profileBigImage">
						<img src="<?php echo base_url(); ?>assets/images/Parrot_logo_wink2.png" width="150" height="150" class="img-circle">
					</div>
					<div class="col-lg-9 col-lg-9">
						<h3><?php echo $this->session->name; ?></h3>
						<ul>   
						<?php
						//	if($_SESSION['asid']==3)
							//{
						//		$class=str_replace("Grade ","",$this->session->gradename);
						//	}
							//else
							{
								$class=str_replace("Grade ","",$this->session->gradename)." - ".$this->session->section;
							}
						?>
						    <li><label>School</label> : <?php echo $this->session->schoolname; ?></li>
							<li><label>Class</label> : <?php echo $class; ?></li>
							<!--<li><label>Contest Start Date</label> : <?php echo date('d-m-Y',strtotime($_SESSION["conteststartdate"]));?></li>-->
							<?php if($_SESSION["section"]!=''){ ?>
							<!--<li><label>Section</label> : <?php echo $this->session->section; ?></li>-->
							<?php } ?>
							<!--<li><label>Contest Start Date</label> : <?php echo date('d-m-Y',strtotime($this->session->conteststartdate)); ?></li>
							<li><label>Contest End Date</label> : <?php echo date('d-m-Y',strtotime($this->session->contestenddate)); ?></li>
							 <li><label>Grade :</label>{{StudentGrade}}</li> -->

						</ul>
					</div>
                </div>
			</div>
	</div>
<!-- home page starts here -->
<div class="pageHomePager Dashboardhide mygameshide myreporthide myprofilehide">
</div>
<!--home page ends here  -->
</div>
<?php //include_once('footer.php'); ?>
