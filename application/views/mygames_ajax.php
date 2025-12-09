<?php
$baseurl = base_url();
$isexpired['conteststatus']=$this->session->isexpired;

$bgcolor=array("1"=>"MemoryGame","2"=>"VisualProcessingGame","3"=>"FocusGame","4"=>"ProblemSolvingGame","5"=>"LinguisticsGame");
$btncolor=array("1"=>"btn-success-red","2"=>"btn-success-yellow","3"=>"btn-success-green","4"=>"btn-success-orange","5"=>"btn-success-blue");
$bordercolor=array("1"=>"#f00","2"=>"#ffc000","3"=>"#92d050","4"=>"#ff6600","5"=>"#00b0f0");
$starcolor=array("1"=>"memoryStar","2"=>"VPStar1","3"=>"FAStar1","4"=>"PSStar1","5"=>"linguisticsStar1");  
$scorecolor=array("1"=>"memory","2"=>"VP","3"=>"FA","4"=>"PS","5"=>"linguistics");
$contestActive = ($this->session->isexpired == '1');
$contestStatusLabel = $contestActive ? 'Contest Active' : 'Contest Closed';
$contestStatusNote = $contestActive ? 'Your challenges are live and ready to play.' : 'The contest window has closed for now.';
?>
<!--My games starts here -->
<div class="MyGamesPager pageHomePagerHide Dashboardhide myreporthide myprofilehide">
    <div class="portal-shell">
        <div class="portal-hero">
            <div>
                <div class="portal-hero__eyebrow">Super Brain Challenge · 2025</div>
                <h1>Jump back into your SkillAngels quests</h1>
                <p>Pick a skill, keep your streak alive, and earn more stars.</p>
            </div>
            <div class="portal-hero__pill">
                <span class="<?php echo $contestActive ? 'fa fa-bolt' : 'fa fa-clock-o'; ?>" aria-hidden="true"></span>
                <div>
                    <strong><?php echo $contestStatusLabel; ?></strong><br>
                    <small><?php echo $contestStatusNote; ?></small>
                </div>
            </div>
        </div>

        <?php if($this->session->isexpired=='0'){ ?>
        <div class="page-header1" aria-live="polite" style="margin-top:12px;">Contest has expired</div>
        <?php } ?>

        <div class="games-toolbar">
            <div>
                <p class="subtitle">Choose any game tile to start. Keep an eye on your stars and progress meter.</p>
            </div>
            <a href="<?php echo base_url(); ?>index.php/home/reports" class="nav-link-pill secondary" aria-label="Open my reports"><i class="fa fa-bar-chart"></i> View my reports</a>
        </div>

        <div class="contentbox">
        <?php if (!empty($GameDetails)): ?>
            <div class="gameboard-grid">
            <?php
            foreach($GameDetails as $games)
            {
            ?>
                <div class="game-card bounceIn animated">
                    <div class="game-card__badge" style="color: <?php echo $bordercolor[$games['Skill_ID']]; ?>;">Skill: <?php echo $games['Skill_Name']; ?></div>
                    <div class="game-card__icon">
                        <img src="<?php echo base_url(); ?>assets/images/<?php echo $games['Game_Icon_Path']; ?>" alt="<?php echo $games['Skill_Name'];?>">
                    </div>
                    <h3 title="<?php echo $games['Skill_Description']; ?>"><?php echo $games['Game_Name']; ?></h3>
                    <h4 title="<?php echo $games['Game_Description']; ?>"><?php echo $games['Skill_Name'];?> • <?php echo $games['Skill_Description']; ?></h4>
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
                                        $PlayStatusIcon="statusNotPlayIcon";$PlayStatusClass="is-active";
                                }
                                else if($games['tot_ques_attend']==10)
                                {
                                        $btnText="Played";$btnclass="not-active";$GameLink="javascript:;";$PlayStatus="Completed";$PlayStatusIcon="statusCompletedIcon";$PlayStatusClass="";
                                }
                                else if($games['tot_ques_attend']>0 && $games['tot_ques_attend']!='TO')
                                {
                                        $btnText="Continue";$btnclass="";$PlayStatus="In-complete";
                                        $GameLink=$baseurl."assets/swf/1/games.php?gamename=".$games['Game_Path'];
                                        $PlayStatusIcon="statusInCompletedIcon";$PlayStatusClass="is-progress";
                                }
                                else if($games['tot_ques_attend']=='TO')
                                {
                                        $btnText="Time Over";$btnclass="not-active";$GameLink="javascript:;";$PlayStatus="In-complete";
                                        $PlayStatusIcon="statusInCompletedIcon";$PlayStatusClass="is-expired";
                                }
                        ?>
                        <div class="stat-stack">
                            <span class="stat-chip">Total: <?php echo $games['Total_Questions']; ?></span>
                            <span class="stat-chip">Attempted: <?php echo $games['Total_Attempted_Question']; ?></span>
                            <span class="stat-chip">Correct: <?php echo $games['Total_Correct_Answer']; ?></span>
                        </div>
                        <div class="progress-bar-modern" aria-label="Game score">
                            <span style="width:<?php echo $games['tot_game_score']; ?>%"></span>
                        </div>
                        <div class="stars-row" aria-label="Stars earned">
                            <?php foreach($TotalStars as $row){ ?>
                                <span class="<?php echo $row['classApply']; ?>"></span>
                            <?php } ?>
                        </div>
                        <div class="play-meta">
                            <span class="status-pill <?php echo $PlayStatusClass; ?>" title="<?php echo $PlayStatus; ?>">Status: <?php echo $PlayStatus; ?></span>
                            <a class="portal-button gamepopup viewMoreBtn <?php echo $btnclass;?>" href="<?php echo $GameLink;?>" data-href="<?php echo $GameLink;?>" title="<?php echo $btnText; ?>"><?php echo $btnText; ?></a>
                        </div>
                        <?php
                        }
                        ?>
                </div>
            <?php
            }
            ?>
            </div>
        <?php else: ?>
            <?php $this->load->view('components/empty_state', array(
                'componentId' => 'games-empty-state',
                'eyebrow' => 'Games',
                'title' => 'No games assigned yet',
                'message' => 'When a new contest opens or a coach assigns more challenges, they will appear here.',
                'action' => array(
                    'label' => 'Refresh games',
                    'href' => 'javascript:;',
                    'attributes' => 'class="js-refresh-games" role="button" aria-label="Refresh games"'
                )
            )); ?>
        <?php endif; ?>
        </div>
    </div>
</div>
<!--my games ends here-->
