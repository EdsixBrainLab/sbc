<!DOCTYPE html>
<?php header("Access-Control-Allow-Origin: *"); ?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SkillAngels Challenge – India’s Largest Online Brain Skill contest</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min_index.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/modern-portal.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/design-system-motion.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
<script  type="text/javascript">
if(window==window.top) {
    // not in an iframe
 //window.location.href='http://superbrainolympiad.com/';
}
</script>
</head><!--/head-->
<body>
<?php if(!isset($this->session->userId)) { ?>
<link href="<?php echo base_url(); ?>assets/css/newstyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/design-system.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/modern-portal.css" rel="stylesheet">
<header id="header" class="portal-header">
        <div class="container">
            <div class="portal-nav">
                <div class="portal-brand">
                    <a title="SkillAngels" href="<?php echo base_url();?>index.php">
                        <img src="<?php echo base_url(); ?>assets/images/skillangels_logo.png" alt="SkillAngels" loading="lazy" />
                    </a>
                    <p class="portal-greeting">India's Largest Online Brain Skill Contest</p>
                </div>
                <div class="nav-actions">
                    <a class="nav-link-pill secondary" href="#whats-new"><i class="fa fa-magic"></i> What's new</a>
                    <a class="nav-link-pill primary" href="javascript:;"><i class="fa fa-gamepad"></i> Play hub</a>
                </div>
            </div>
            <div style="display:none;" id="iddivLoading" class="loading">Loading&#8230;</div>
            <form class="portal-login-card" role="form" method="post" id="form-login" aria-label="Login form">
                <div>
                    <label for="User_ID">User name</label>
                    <input type="text" class="form-control" name="user_name" id="User_ID" placeholder="Enter User Name" autocomplete="username" required aria-required="true" aria-describedby="ErrMsg">
                </div>
                <div>
                    <label for="User_PWD">Password</label>
                    <input type="password" class="form-control" name="User_PWD" id="User_PWD" placeholder="Enter password" autocomplete="current-password" required aria-required="true" aria-describedby="ErrMsg">
                </div>
                <div>
                    <label class="sr-only" for="submit">Login</label>
                    <input type="button" id="submit" class="form-control loginLink" value="Login" aria-label="Submit login form">
                </div>
                <div id="ErrMsg" class="col-lg-12 col-sm-12" style="color: #cc0000;font-weight: 700;font-size: 14px;clear: both;" role="alert" aria-live="assertive">  <?php if(isset($ErrMsg)){echo $ErrMsg;}?></div>
            </form>
        </div>
</header>
<?php } else { ?>
<link href="<?php echo base_url(); ?>assets/css/newstyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/modern-portal.css" rel="stylesheet">
<header id="header" class="portal-header">
        <div class="container">
            <div class="portal-nav">
                <div class="portal-brand">
                    <a title="SkillAngels" href="javascript:;">
                        <img src="<?php echo base_url(); ?>assets/images/skillangels_logo.png" alt="SkillAngels" loading="lazy" />
                    </a>
                    <p class="portal-greeting">Welcome back, <span style="color:#ff5c5d"><?php echo $this->session->name; ?></span></p>
                </div>
                <div class="nav-actions">
                    <a class="nav-link-pill secondary" href="<?php echo base_url(); ?>index.php/home/mygames"><i class="fa fa-rocket"></i> My Games</a>
                    <a class="nav-link-pill" href="<?php echo base_url(); ?>index.php/home/reports"><i class="fa fa-bar-chart"></i> Reports</a>
                    <a class="nav-link-pill primary" href="<?php echo base_url(); ?>index.php/home/myprofile"><i class="fa fa-user"></i> Profile</a>
                </div>
            </div>
        </div>
</header>
<?php } ?>

<style>
.padtop{text-align:center;padding:20px 0px 0px 40px;}
.topHead{color: #fff;font-size: 25px;}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

.login-btn .form-control {
  min-height: 44px;
  padding: 10px 14px;
}

.login-btn .nav > li {
  padding-right: 8px;
}

.loginLink:focus-visible,
.form-control:focus-visible {
  outline: 3px solid #1a73e8;
  outline-offset: 2px;
}

.loading {
  position: fixed;
  z-index: 999;
/*   height: 2em;
  width: 2em; */
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #5a5757 url(<?php echo base_url(); ?>assets/images/ajax-page-loader.gif) center center no-repeat;
  background-size: 5%;
  opacity: 0.6;
}
</style>
