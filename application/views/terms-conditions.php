<?php
//include_once("db_connection.php");
//include("qry/Query.php");
?>
<?php include_once('header.php'); ?>
<style>
.landing-menu {
    margin: 18px 0;    
	margin-bottom: 0px;
    float: left;
}
.menu {
    margin-bottom: 0;
    display: table-cell;
    vertical-align: middle;
}
.menu li {
    display: inline;    
	background-color: #eec64a;
    padding: 10px;    
	margin-right: 5px;
}
.menu a, .mobile-menu a {
    font-size: 15px;
    color: #000 !important;
    letter-spacing: .03em;
    font-weight: 400;
    padding: 3px 10px;
	font-weight: bold;
    font-family: 'Open Sans',sans-serif;
}
</style>
 <style> 
 .nav {
    position: relative;
 }
 .container .form-group label{color:#000;font-weight: 600;margin-bottom:0px;}
 .container .form-group label.error{color:red;font-size:11px;}
 .container .form-group input{ border: 1px solid #ccc;margin-bottom: 0px;}
 .form-control[readonly] {
		cursor:auto;
	  background-color:#f8f8f8
} .form-control[readonly]:focus {
      -webkit-box-shadow: none;  
      box-shadow: none;  
	  background-color:#f8f8f8
}
#btnRegisterSubmit{}
.form-group {margin-bottom: 0px;}
form .col-lg-6{min-height: 75px;}
textarea{margin-bottom:0}
 </style>
 


<style>
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<!-- ......................... -->
<section id="career" class="container">
<div class="terms-of-serviceContent">

	    <h2>Contest Terms & Conditions</h2>
		<div class="terms">
<ul>
<li>These terms and conditions are applicable to all participants who participate in the Super Brain Challenge online contest. A Participant can participate in the Contest only if he/she agrees to the Terms and Conditions.</li>
<li class="alterLi">The participation in the contest is voluntary.</li>
<li>The Super Brain Challenge will be conducted online through our Brain Skill assessment platform. The student’s core brain skills which will be assessed are Memory, Visual Processing, Focus & Attention, Problem Solving and Linguistics.</li>
<li class="alterLi"> The Super Brain Challenge will be open to school students from LKG to XII grade.</li>
<li> Please visit <a style="color:maroon" href="<?php echo $baseurl; ?>"><?php echo $baseurl; ?></a> for more details on the event.</li>
<li class="alterLi"> Participants will be provided with login credentials upon successful registration and will receive an E-mail acknowledging/confirming the registration. Please make sure to enter and check your email id and mobile number during Registration.</li>
<li > Participants must read the instructions and guidlines before starting the game.</li>
<li class="alterLi"> Each game will have a defined time limit. Participants are expected to complete the game suite given to them within the defined time limit. Incomplete game plays will affect final skill scores and overall ranking.</li>
<li> The brain skill ranking will be based on the final skill score and time taken to complete the game suite.</li> 
<li> By accepting the Terms & Conditions of the Super Brain Challenge, you are bound by an honor code to take up the Challenge without any help or support from others and in a fair manner.</li>
<li class="alterLi"> The Certificate of Participation and Brain Skill Report will be emailed after the announcement of results.</li>
<li> Edsix reserves the right to disqualify the Participant from the Contest if identified with involvement of any fraudulent activity or non-adherence of the Honor code.</li>
<li class="alterLi"> The winners of the Finals will be published on our website, <a style="color:maroon" href="<?php echo $baseurl; ?>"><?php echo $baseurl; ?></a></li>
<li> Winning constitutes permission to use Winner’s name and photograph (at Sponsor’s discretion) for future advertising, publicity in any and all media now or hereafter devised throughout the world in perpetuity, without additional compensation, notification or permission.</li>
<li class="alterLi"> The winner of the contest shall win prizes and the same will be communicated through online communication or will be posted on website as per the rules</li>
<li>Any disputes arising out of this shall be subject to be exclusive jurisdiction of the high court of Chennai.</li> 
</ul> 
</div>	
</div>
</section>
<?php include_once('footer.php'); ?><!--/#footer-->


