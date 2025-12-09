<?php //include_once('headerinner.php'); ?>
<?php //if($countdowntime>0){header("Location:countdown.php");} ?>
<?php //echo '<pre>'; print_r($_SESSION); ?>
<div id="wrapper">
        <div class="container">
<!--MyProfile starts here -->
        <div id="divMyProfile" class="MyProfilePager1 pageHomePagerHide Dashboardhide mygameshide myreporthide ">
            <div class="portal-shell">
                <div class="portal-hero" style="margin-bottom:18px;">
                    <div>
                        <div class="portal-hero__eyebrow">Player card</div>
                        <h1>My Profile</h1>
                        <p>Keep your details fresh so your achievements stay personal.</p>
                    </div>
                    <div class="portal-hero__pill">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div>
                            <strong><?php echo $this->session->name; ?></strong><br>
                            <small>SkillAngels explorer</small>
                        </div>
                    </div>
                </div>
                <div class="portal-stat-grid">
                    <div class="portal-stat-card">
                        <small>School</small>
                        <strong><?php echo $this->session->schoolname; ?></strong>
                        <p class="subtitle">Where your quests begin.</p>
                    </div>
                    <div class="portal-stat-card">
                        <small>Class</small>
                        <strong><?php echo $class; ?></strong>
                        <p class="subtitle">Stay tuned for class challenges.</p>
                    </div>
                    <div class="portal-stat-card">
                        <small>Progress</small>
                        <strong>Leveling up</strong>
                        <p class="subtitle">Play daily to unlock more badges.</p>
                    </div>
                </div>
                <div class="profile-card">
                    <img src="<?php echo base_url(); ?>assets/images/Parrot_logo_wink2.png" width="150" height="150" class="img-circle" alt="Profile avatar">
                    <div>
                        <h3><?php echo $this->session->name; ?></h3>
                        <?php
                                {
                                        $class=str_replace("Grade ","",$this->session->gradename)." - ".$this->session->section;
                                }
                        ?>
                        <ul class="profile-meta">
                            <li><label>School</label><strong><?php echo $this->session->schoolname; ?></strong></li>
                            <li><label>Class</label><strong><?php echo $class; ?></strong></li>
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
