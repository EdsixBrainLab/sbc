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
</style>
<!-- ......................... -->
<section id="career" class="container">
<div class="terms-of-serviceContent">

	    <h2>FAQ</h2>
		<div class="terms">
		<h3>1. How to Sign Up?</h3> 
<ul>
<li>Ensure that you have a valid E-Mail ID</li>
<li class="alterLi">Go to <a style="color:maroon" href="http://superbrainolympiad.com">http://superbrainolympiad.com </a>and register your details</li>
<li>Fill in the details ( Note: Providing fraudulent data may lead to disqualification)</li>
<li class="alterLi">Click 'Register'</li>
</ul>

<h3>2. How do we know whether the registration was successful or not?</h3> 
<ul>
<li>If you receive the mail "Registration Confirmation - Super Brain Game 2017", your registration is successful. You can also try login in the website <a style="color:maroon" href="http://superbrainolympiad.com">http://superbrainolympiad.com</a> using the email id and password sent in this mail.</li>
<li class="alterLi">SMS will be sent to the Mobile No(For India Nos Only)</a></li>
</ul>

<h3>3. How to know the contest date and slot selected by me?</h3> 
<ul>
<li>You can cross check the time slot and contest date details in the ‘Super Brain Olympiad 2017 - Registration Successful’ mail and you can also login in your account and you can see the same details.</li>
</ul>

<h3>4. What to do when I do not receive the registration mails?</h3> 
<ul>
<li>If you haven't received any e-mails in your inbox from Super Brain Olympiad 2017, please check for the e-mail in the junk or spam or bulk folder.</li>
</ul>
<h3>5. What to do when the e-mail entered by me is stated "This E-Mail ID is already registered. Please try with new id"?</h3> 
<ul>
<li>This indicates that the given e-mail id is already used once for the registration. An e-mail id can be used only once for registering in the super brain game contest</li>
</ul>

<h3>6. From when will the login credentials work and be accessible?</h3> 
<ul>
<li>As soon as the registration is completed</li>
</ul>

<h3>7.What do I do when I can't login successfully or if I'm having trouble logging in?</h3> 
<ul>
<li>Verify the credentials in the email sent to you</li>
<li>If you still can't access your account, contact our customer support team</li>
</ul>

<h3>8. What if I register in multiple accounts?</h3> 
<ul>
<li>Only one registration will be considered at the time of result announcement. The first instance of play will be considered and the rest will be ignored.</li>
</ul>

<h3>9. Do I have to pay for registering in the contest?</h3> 
<ul>
<li>No. The contest is Free of cost</li>
</ul>

<h3>10. Is there any practice session / sample games to practice?</h3> 
<ul>
<li>Yes. You can try the demo games in the link: <a style="color:maroon" href="http://superbrainolympiad.com">http://superbrainolympiad.com</a></li>
</ul>

<h3>11. What do I do if I cannot view the website clearly / legibly in my computer?</h3> 
<ul>
<li>Check for the browser version and flash player plugin support, OS Compatibility and Compatible devices as suggested in the Technical requirements</li>
</ul>


<h3>12. I forget my login ID. How do I retrieve it?</h3> 
<ul>
<li>Your login ID is your email id. In case, you forgot that, contact customer support team or drop a mail to pro.gensmart@gteceducation.com with the following details: First Name, Last Name, DOB, Gender, Mobile No, Grade, City, State, Country. We will help you out.</li>
</ul>

<h3>13. I want to change my password for the contest. How do I do it?</h3> 
<ul>
<li>Contact customer support team or drop a mail to pro.gensmart@gteceducation.com giving the email id and mobile no that you used for registration. We will help you out.</li>
</ul>

<h3>14. I have done the registration successfully, but I couldn't see the games for playing.</h3> 
<ul>
<li>The games will be available only on the date and time slot booked by you.</li>
<li>If you have issues in game play during contest slot, please check the following:</li>
<li>Ensure that your browser is up-to-date.</li>
<li>Ensure that the flash player plugins are up-to-date.</li>
<li>Ensure that you have an active internet connection of min. 2 mbps speed.</li>
<li>Ensure the proxy addresses are configured if you’re bound to a highly secured network.</li>
</ul>

<h3>15. What dates are available for the contest?</h3> 
<ul>
<li>Round 1 : 1st Nov 2017 to 9th Nov 2017</li>
<li>Round 2 [For shortlisted users] : 11th Nov 2017 to 13th Nov 2017</li>
</ul>

<h3>16. What time slots are available for the contest?</h3> 
<ul>
<li>One hour slots are available from 9.00 AM to 4.00 PM on weekends and one hour slots from 4.00 PM to 6.00 PM on weekdays</li>
</ul>

<h3>17. What is the contest all about?</h3> 
<ul>
<li>The contest is all about testing 5 skills: Memory, Visual Processing, Focus & Attention, Problem Solving and Linguistics</li>
</ul>

<h3>18. How many games will be given?</h3> 
<ul>
<li>5 games one per skill</li>
</ul>

<h3>19. What will be the total number of questions?</h3> 
<ul>
<li>Each game will have 10 questions, so 5 games altogther will have 50 questions</li>
</ul>

<h3>20. What would be the time duration for each game?</h3> 
<ul>
<li>It depends upon the game. Approximately each game will have time duration like 180/120 seconds</li>
</ul>

<h3>21. Is it possible to resume if the game is interrupted in middle?</h3> 
<ul>
<li>Yes, the game can be resumed</li>
</ul>

<h3>22. What is the mode of communication language in games?</h3> 
<ul>
<li>English</li>
</ul>

<h3>23. Where the games will be available?</h3> 
<ul>
<li>Once you login, Click "My Games" menu on the left. You will have five games one per skill. Click "Play Game" button to play each game.</li>
</ul>


<h3>24. When will I get my report?</h3> 
<ul>
<li>Report will be available for download once you complete the contest.</li>
</ul>


<h3>25. Where can I download the report?</h3> 
<ul>
<li>After you login, click "My Reports". You will a button titled "Click Here to Download & Share". Click it to download your report
</li>
</ul>


<h3>26. What does "My Skill Pie" represent?</h3> 
<ul>
<li>It represents the percentage of questions attended in each skill</li>
</ul>


<h3>27. I did not upload my id proof during registration. What should I do?</h3> 
<ul>
<li>You can upload your school id proof in the "My Profile" Section</li>
</ul>


<h3>28. What is BSPI?</h3> 
<ul>
<li>BSPI stands for Brain Skill Power Index. It is an average of all five skill scores</li>
</ul>


<h3>29. When will I get my certificate?</h3> 
<ul>
<li>Certificates will be available for download once result is published</li>
</ul>


<h3>30. Where can I download my certificate?</h3> 
<ul>
<li>After you login, click "My Certificates" menu on the left. You will be able to view and download your certificate.</li>
</ul>


<h3>31. I have wrongly selected the grade during registration. What should I do?</h3> 
<ul>
<li>Grade cannot be changed once you register. Alternatively, you can newly reigster with correct grade </li>
</ul>


<h3>32. I have missed my slot. What should I do?</h3> 
<ul>
<li>You can reach out our customer support team.</li>
<li>G-TEC Gensmart Academy +91 9526993944/ 9349863944</li>
<li>We will help you to schedule a new slot</li>
</ul>


<h3>33. I forget what slot I booked. What should I do?</h3> 
<ul>
<li>You can log into your account. You will see the details about the slot booked. In case if you have still have any queries, you can reach out our customer support team. We will help you.</li>
</ul>

<h3>34. I forgot my password. What should I do?</h3> 
<ul>
<li>Click the Forgot Password Link in the Page Header.</li>
<li>You will be prompted to enter your e-mail id.</li>
<li>Type your e-mail id and click 'Submit'</li>
<li>An activation link will be sent to your email.</li>
<li>Click on the activation link you received in your inbox.</li>
<li>Type a new password, confirm it and Click 'Submit'.</li>
<li>You will receive a password reset confirmation mai</li>
</ul>

<h3>35. How to contact Customer Support Team?</h3> 
<ul>
<li>Anyone can contact the customer support team via phone/e-mail</li>
<li>G-TEC Gensmart Academy +91 9526993944/ 0349863944</li>
<li><a style="color:maroon" href="mailto:rm3@gteceducation.com">rm3@gteceducation.com</a> / <a style="color:maroon" href="mailto:pro.gensmart@gteceducation.com">pro.gensmart@gteceducation.com</a></li>
 </ul>

<h3>36. The above FAQ's is not helpful to solve my problem.</h3> 
<ul>
<li>You can call us on </li>
<li>G-TEC Gensmart Academy +91 9526993944/ 9349863944</li>
<li>or you can mail to <a style="color:maroon" href="mailto:rm3@gteceducation.com">rm3@gteceducation.com</a> / <a style="color:maroon" href="mailto:pro.gensmart@gteceducation.com">pro.gensmart@gteceducation.com</a></li>
</ul>
</div>
</div>
</section>
<?php include_once('footer.php'); ?>
<style>
.terms-of-serviceContent ul{padding-left: 40px;}
.terms h3{text-align:left;}
</style>

