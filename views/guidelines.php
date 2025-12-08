<?php
include_once("db_connection.php");
include("qry/Query.php");
?>
<!-- START NAVIGATION -->
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
#career p{color:#000;}
</style>
<!-- ......................... -->
 
  <section id="career" class="container">
<div class="terms-of-serviceContent">
<h2 style="text-align:center">Skillangels Super Brain Challenge</h2>

	    <h3>Registration</h3>
		<div class="terms">
<ul>
<li>Children can register for the contest online at <a style="color:maroon" href="http://superbrainolympiad.com">http://superbrainolympiad.com</a></li>
<li class="alterLi">Participants are expected to fill all the fields and provide relevant information in the registration form without leaving them empty.</li>
<li>To ensure an accurate assessment, please ensure that the date of birth and grade in which the student is in, is accurate.</li>
<li class="alterLi">Participants have to opt a time slot from the available options to take part in the contest. Please note that these time slots are meant exclusively for those who register for them.</li>
<li>Once the form is submitted, no changes will be entertained like change in time slots etc.</li>
<li class="alterLi">The registrations will be open till the time slots are available and it is on first come first serve basis.</li>
<li>The contest is an online contest and Participants have to login at their chosen time slot which they chose during registration. They can login from any internet enabled facility to take part in the contest. Please read below in the Technical section for the system requirement of the contest.</li>
<li class="alterLi">Unique username and password would be given to every successful registration and using those credentials participant can login to the portal for trial puzzles and for the main contest.</li>
<li>Please read the FAQ section for any further information/clarifications if any.</li>
</ul>
</div>
<h3>Super Brain Challenge 2017 - Contest</h3>
		<div class="terms">
<ul>
<li>The Super Brain Challenge 2017 is conducted in a brain skill platform where the participant’s core brain skills will be assessed through gamified puzzles.</li>
<li class="alterLi">Each puzzle will be on a specific skill and would have a defined time limit to complete it. Scores will be based on correct answers and speed of completion.</li>
<li>Participants will be given a Brain skill suite designed for their grade/age.</li>
<li class="alterLi">Participants are expected to read the instructions before starting the contest.</li>
<li>Participants can take up a set of 5 trial puzzles (of various combinations) once they log in using their credentials.</li>
<li class="alterLi">During the contest, participants are expected to complete the puzzle suite given to them. Incomplete suits will affect your final skill scores and overall ranking.</li>
<li>Participants are expected to take the contest on their own without consulting/getting help from others including parents.</li>
</ul>
</div>
<h3>Technical Specifications for the contest and portal</h3>
		<div class="terms">
<ul>
<li>The puzzle suite is optimized for desktop computers, laptops and Android ,IOS tablets and mobile phones.</li>
<li class="alterLi">Participants are expected to read the below technical specification for the system required to take the skill challenge.</li>
</ul>
<table class="table table-bordered">
<tbody>
<tr>
<td>Browser</td>
<td>Google Chrome 54 and above / Latest Version</td>
</tr>

<tr>
<td>Screen Resolution</td>
<td>1024 X 768 pixels</td>
</tr>
<tr>
<td>CPU / Processor</td>
<td>Pentium Core I3 or above</td>
</tr>
<tr>
<td>Operating System</td>
<td>Windows 7 or above</td>
</tr>
<tr>
<td>RAM</td>
<td>2GB or more</td>
</tr>
<tr>
<td>Colour Depth</td>
<td>32-bit (highest)</td>
</tr><tr>
<td>Keyboard</td>
<td></td>
</tr><tr>
<td>Mouse</td>
<td></td>
</tr><tr>
<td>Internet Connection Speed</td>
<td>Minimum 2 Mbps or above</td>
</tr>
</tbody>
</table>

</div>

<h3>Contest Rules & Regulations</h3>
<div class="terms">
<p>Entry into this contest constitutes your acceptance of the rules and terms and conditions.</p>

<p><strong>Contest Registration:</strong></p>
<p>The registrations will be open till the time slots are available and it is on first come first serve basis.</p>

<p><strong>Who can participate?</strong></p>
<p>- Contest is open to children in class I to VIII and the contest will be held grade wise of the participants.</p>
<p>- Participants are requested to submit their School ID proof</p>
<p>- All communications will be sent only through registered mail id used for registration</p>
</p>

<p><strong>Contest Objective:</strong></p>
<p>The objective of the contest is to help create awareness of the brain skills and the skill landscape to the participants through a brain skill platform and puzzle challenges.</p>

<p><strong>Contest Venue:</strong></p>
<p>The contestant can take up the skill challenge in any internet enabled environment with the prescribed technical setup.</p>

</div>

<h3>Contest Procedure:</h3>
		<div class="terms">
<ul>
<li>Registration will be acknowledged by a confirmation mail and sms from Super Brain Challenge Game</li>
<li class="alterLi">Username and password along with the timeslot details will be sent through the mail.</li>
<li>The participants can take up the contest only on the specified time slot (date and time).</li>
<li class="alterLi">The Brain Skill Report and the Certificate of Participation will be available for download in the participant’s registered account</li>
<li>The participants will be responsible for making all arrangements to take the test online, which includes the computer, constant internet connection, power back up etc. The organizer is not responsible for any technical failure from the participant’s end.</li>

</ul>
</div>

<h3>Notification of Contest Winners:</h3>
		<div class="terms">
<ul>
<li>Winners will be determined at the end of the contest and will be notified through the registered E-mail ID. Participants may be disqualified for any of the following reasons. If the participant
<ul style="padding-left:20px;">
<li>- is not eligible based on the eligibility requirements,</li>
<li>- has provided any wrong information in terms of Date of Birth or currently studying Class</li>
<li>- has not complied with rules of the contest</li>
<li>- has not submitted valid school id proof</li>
</ul>
</li>
<li class="alterLi">In any such cases, the next qualifying participant may be declared as the winner.</li>
<li>If a participant is found of having taken multiple game play through different registrations, the first instance of play will be considered for ranking and prizes, if any</li>
<li class="alterLi">Winning constitutes permission to use Winner’s name and photograph (all at Super Brain Challenge Game Team discretion) for future advertising, publicity in any and all media now or hereafter devised throughout the world in perpetuity, without additional compensation, notification or permission.</li>
<li>Winners list will be announced in the website.</li>

</ul>
</div>


</div>
</div>
</section>

<?php include_once('footer.php'); ?><!--/#footer-->
