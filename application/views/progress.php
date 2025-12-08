<div class="container progress-dashboard">
    <div class="row">
        <div class="col-md-4">
            <div class="streak-card">
                <h3><?php echo isset($this->lang) ? $this->lang->line('current_streak') ?: 'Current streak' : 'Current streak'; ?></h3>
                <?php
                $ringCircumference = isset($streak['circumference']) ? $streak['circumference'] : 339.292;
                $streakPercent = isset($streak['percent']) ? $streak['percent'] : 0;
                $streakOffset = $ringCircumference - ($ringCircumference * $streakPercent / 100);
                ?>
                <div class="streak-ring-wrapper" data-percent="<?php echo $streakPercent; ?>">
                    <svg class="streak-ring" viewBox="0 0 120 120" role="img" aria-label="Streak ring">
                        <circle class="streak-ring__bg" cx="60" cy="60" r="54"></circle>
                        <circle
                            class="streak-ring__progress"
                            cx="60"
                            cy="60"
                            r="54"
                            style="stroke-dasharray: <?php echo $ringCircumference; ?>; stroke-dashoffset: <?php echo $streakOffset; ?>; --streak-offset: <?php echo $streakOffset; ?>;"
                        ></circle>
                    </svg>
                    <div class="streak-ring__label">
                        <span class="streak-count"><?php echo isset($streak['count']) ? $streak['count'] : 0; ?></span>
                        <span class="streak-caption"><?php echo isset($this->lang) ? $this->lang->line('days_streak') ?: 'day streak' : 'day streak'; ?></span>
                    </div>
                </div>
                <p class="streak-subtext"><?php echo isset($this->lang) ? $this->lang->line('streak_message') ?: 'Keep playing to extend your streak!' : 'Keep playing to extend your streak!'; ?></p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="skill-progress-card">
                <h3><?php echo isset($this->lang) ? $this->lang->line('skill_progress') ?: 'Skill progress' : 'Skill progress'; ?></h3>
                <?php if (!empty($skillStats)) { ?>
                    <div class="skills-grid">
                        <?php foreach ($skillStats as $skill) { ?>
                            <div class="skill-card">
                                <div class="skill-card__header">
                                    <div>
                                        <p class="skill-name"><?php echo $skill['name']; ?></p>
                                        <p class="skill-description"><?php echo $skill['description']; ?></p>
                                    </div>
                                    <span class="skill-progress-value"><?php echo $skill['progress']; ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="bar" style="width:<?php echo $skill['progress']; ?>%"></div>
                                </div>
                                <p class="skill-meta"><?php echo $skill['attempts']; ?> <?php echo isset($this->lang) ? $this->lang->line('attempts_label') ?: 'attempts logged' : 'attempts logged'; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <p class="no-progress"><?php echo isset($this->lang) ? $this->lang->line('no_progress_yet') ?: 'Progress data will appear after you play some games.' : 'Progress data will appear after you play some games.'; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
