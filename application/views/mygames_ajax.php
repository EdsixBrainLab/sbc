<?php
$baseurl = base_url();
$isexpired['conteststatus']=$this->session->isexpired;

$bgcolor=array("1"=>"MemoryGame","2"=>"VisualProcessingGame","3"=>"FocusGame","4"=>"ProblemSolvingGame","5"=>"LinguisticsGame");
$btncolor=array("1"=>"btn-success-red","2"=>"btn-success-yellow","3"=>"btn-success-green","4"=>"btn-success-orange","5"=>"btn-success-blue");
$bordercolor=array("1"=>"#f00","2"=>"#ffc000","3"=>"#92d050","4"=>"#ff6600","5"=>"#00b0f0"); 
$starcolor=array("1"=>"memoryStar","2"=>"VPStar1","3"=>"FAStar1","4"=>"PSStar1","5"=>"linguisticsStar1");  
$scorecolor=array("1"=>"memory","2"=>"VP","3"=>"FA","4"=>"PS","5"=>"linguistics");  
?>
<!--My games starts here -->
<div class="MyGamesPager pageHomePagerHide Dashboardhide myreporthide myprofilehide">
			<div class="row">
				<div class="col-lg-12">
				<?php if($this->session->isexpired=='1'){ //echo $this->session->isexpired; ?>
					<h1 class="page-header" style="font-size:28px;text-align:center;">Super Brain Challenge - 2025</h1>
				<?php } else { ?>
				<!--<div class="col-lg-6"><h1 class="page-header">My Games</h1></div>
				<div class="col-lg-6"><h1 class="page-header">Contest has expired</h1></div>-->
				<?php } ?>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<?php if($this->session->isexpired=='0'){ ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header1">Contest has expired</h2>
				</div>
			</div>
			<?php } ?> 
			<div class="row">
				<div class="col-lg-12">
					<div class="contentbox"> 
					<?php
					foreach($GameDetails as $games)
					{ //echo "<pre>";print_r($games['tot_ques_attend']);exit;
					?>
						<div class="gamesList bounceIn animated">
							<div class="gameBox <?php echo $bgcolor[$games['Skill_ID']]; ?>">
								<h3 title="<?php echo $games['Skill_Description']; ?>"><?php echo $games['Skill_Name'];?></h3>
								<img src="<?php echo base_url(); ?>assets/images/<?php echo $games['Game_Icon_Path']; ?>" alt="<?php echo $games['Skill_Name'];?>">
								<h4 style="margin-bottom: 20px;" title="<?php echo $games['Game_Description']; ?>"><?php echo $games['Game_Name']; ?></h4>
								<?php 
								$starsWon=0;

								$Stars=array(
								array(
								"Star1"=>"NoStar",
								"Star2"=>"NoStar",
								"Star3"=>"NoStar",
								"Star4"=>"NoStar",
								"Star5"=>"NoStar",
								"Star6"=>"NoStar",
								"Star7"=>"NoStar",
								"Star8"=>"NoStar",
								"Star9"=>"NoStar",
								"Star10"=>"NoStar")
								);

								if($games['tot_game_score']>0 ) {$Stars[0]['Star1']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>10) {$Stars[0]['Star2']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>20) {$Stars[0]['Star3']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>30 ) {$Stars[0]['Star4']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>40 ) {$Stars[0]['Star5']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>50 ) {$Stars[0]['Star6']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>60 ) {$Stars[0]['Star7']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>70 ) {$Stars[0]['Star8']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>80 ) {$Stars[0]['Star9']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								if($games['tot_game_score']>90 ) {$Stars[0]['Star10']=$starcolor[$games['Skill_ID']];$starsWon=$starsWon+1;}
								
								$TotalStars=array(
								array('classApply'=> $Stars[0]['Star1']),
								array('classApply'=> $Stars[0]['Star2']),
								array('classApply'=> $Stars[0]['Star3']),
								array('classApply'=> $Stars[0]['Star4']),
								array('classApply'=> $Stars[0]['Star5']),
								array('classApply'=> $Stars[0]['Star6']),
								array('classApply'=> $Stars[0]['Star7']),
								array('classApply'=> $Stars[0]['Star8']),
								array('classApply'=> $Stars[0]['Star9']),
								array('classApply'=> $Stars[0]['Star10'])
								);

								if($isexpired['conteststatus']==1)
								{ 
									if($games['tot_ques_attend']==0 && $games['tot_ques_attend']!='TO')
									{
										$btnText="Play Now";$btnclass="";$PlayStatus="Yet to Play";
										$GameLink=$baseurl."assets/swf/1/games.php?gamename=".$games['Game_Path'];
										$PlayStatusIcon="statusNotPlayIcon";
									}
									else if($games['tot_ques_attend']==10)
									{
										$btnText="Played";$btnclass="not-active";$GameLink="javascript:;";$PlayStatus="Completed";$PlayStatusIcon="statusCompletedIcon";
									}
									else if($games['tot_ques_attend']>0 && $games['tot_ques_attend']!='TO')
									{
										$btnText="Continue";$btnclass="";$PlayStatus="In-complete";
										$GameLink=$baseurl."assets/swf/1/games.php?gamename=".$games['Game_Path'];
										$PlayStatusIcon="statusInCompletedIcon";
									}
									else if($games['tot_ques_attend']=='TO')
									{
										$btnText="Time Over";$btnclass="not-active";$GameLink="javascript:;";$PlayStatus="In-complete";
										$PlayStatusIcon="statusInCompletedIcon";
									}
								?>
									<a class="gamepopup viewMoreBtn <?php echo $btnclass;?>" href="<?php echo $GameLink;?>" data-href="<?php echo $GameLink;?>" title="<?php echo $btnText; ?>"><?php echo $btnText; ?></a>
								<?php 
								} 
								?> 
							</div>
							<div class="gameStatusContainer" style="border: 3px solid <?php echo $bordercolor[$games['Skill_ID']]; ?>;">
								<ul>
									<li><p>Total Questions</p><span><?php echo $games['Total_Questions']; ?></span></li>
									<li><p>Attempted</p><span><?php echo $games['Total_Attempted_Question']; ?></span></li>
									<li><p>Correct</p><span><?php echo $games['Total_Correct_Answer']; ?></span></li>
									<li class="gameStatusBtn" title="<?php echo $PlayStatus; ?>">Status<br><a class="btn <?php echo $btncolor[$games['Skill_ID']]; ?>" href="javascript:;" style="cursor:none;"><span class="<?php echo $PlayStatusIcon; ?>"></span><?php echo $PlayStatus;?> </a></li> 
								</ul>
							</div>
							<div class="gamescoreContainer" style="border: 4px dotted <?php echo $bordercolor[$games['Skill_ID']]; ?>">
								<h4 class="score-head">Score</h4>
								<div class="gamePercentageMemory">
							   
									<span class="<?php echo $scorecolor[$games['Skill_ID']]; ?><?php echo $games['tot_game_score'];?>"><?php echo $games['tot_game_score']; ?> %</span>
								</div>
								<div class="earnedStars">
									<ul>
										<?php foreach($TotalStars as $row){ ?>
										<li>
											<span class="<?php echo $row['classApply']; ?>"></span>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					</div>
				</div>
			</div>
		</div>
<!--my games ends here-->
