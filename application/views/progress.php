<?php
    $perSkill = isset($progressPayload['perSkill']) && is_array($progressPayload['perSkill'])
        ? $progressPayload['perSkill']
        : array();
    $streakDays = isset($progressPayload['streakDays']) ? (int) $progressPayload['streakDays'] : 0;
    $streakTarget = isset($progressPayload['streakTarget']) ? (int) $progressPayload['streakTarget'] : 0;
    $skillsCompleted = isset($progressPayload['skillsCompleted']) ? (int) $progressPayload['skillsCompleted'] : 0;
    $skillTarget = isset($progressPayload['skillTarget']) ? (int) $progressPayload['skillTarget'] : 0;
    $badgeTarget = isset($progressPayload['badgeTarget']) ? (int) $progressPayload['badgeTarget'] : count($badges);
    $earnedBadges = array_reduce($badges, static function ($carry, $badge) {
        return $carry + (!empty($badge['earned']) ? 1 : 0);
    }, 0);
?>

<section class="progress-hero">
    <div class="container">
        <div class="progress-header">
            <div>
                <p class="eyebrow">Progress</p>
                <h1>Badges &amp; milestones</h1>
                <p class="subtitle">Track what you have unlocked and what is still waiting for you.</p>
            </div>
            <div class="progress-actions" aria-label="Progress preferences">
                <label class="sound-toggle" for="sound-toggle">
                    <input type="checkbox" id="sound-toggle" />
                    <span class="toggle-display" aria-hidden="true"></span>
                    <span id="sound-toggle-label" class="toggle-label">Sound effects on</span>
                </label>
                <button class="ds-button ds-button--ghost" type="button" data-modal-open="progress-help">
                    Accessibility tips
                </button>
            </div>
        </div>
        <div class="badge-legend" aria-hidden="true">
            <span class="legend earned"></span> Earned
            <span class="legend locked"></span> Locked
        </div>
    </div>
</section>

<section class="progress-summary">
    <div class="container">
        <div class="progress-summary__grid" role="list">
            <article class="ds-card" role="listitem">
                <p class="metric-label">Active streak</p>
                <p class="metric-value"><?php echo $streakDays; ?> days</p>
                <div
                    class="ds-progress"
                    role="progressbar"
                    aria-label="Streak progress"
                    aria-valuemin="0"
                    aria-valuemax="<?php echo $streakTarget; ?>"
                    aria-valuenow="<?php echo min($streakDays, $streakTarget); ?>"
                >
                    <div class="ds-progress__bar" style="--progress-value: <?php echo $streakTarget > 0 ? min(100, ($streakDays / $streakTarget) * 100) : 0; ?>%"></div>
                </div>
                <p class="metric-label">Goal: <?php echo $streakTarget; ?> days</p>
            </article>

            <article class="ds-card" role="listitem">
                <p class="metric-label">Skills completed</p>
                <p class="metric-value"><?php echo $skillsCompleted; ?> of <?php echo $skillTarget; ?></p>
                <div
                    class="ds-progress"
                    role="progressbar"
                    aria-label="Skill completion"
                    aria-valuemin="0"
                    aria-valuemax="<?php echo $skillTarget; ?>"
                    aria-valuenow="<?php echo min($skillsCompleted, $skillTarget); ?>"
                >
                    <div class="ds-progress__bar" style="--progress-value: <?php echo $skillTarget > 0 ? min(100, ($skillsCompleted / $skillTarget) * 100) : 0; ?>%"></div>
                </div>
                <p class="metric-label">Keep going to reach your target.</p>
            </article>

            <article class="ds-card" role="listitem">
                <p class="metric-label">Badges unlocked</p>
                <p class="metric-value"><?php echo $earnedBadges; ?> of <?php echo $badgeTarget; ?></p>
                <div
                    class="ds-progress"
                    role="progressbar"
                    aria-label="Badge progress"
                    aria-valuemin="0"
                    aria-valuemax="<?php echo $badgeTarget; ?>"
                    aria-valuenow="<?php echo min($earnedBadges, $badgeTarget); ?>"
                >
                    <div class="ds-progress__bar" style="--progress-value: <?php echo $badgeTarget > 0 ? min(100, ($earnedBadges / $badgeTarget) * 100) : 0; ?>%"></div>
                </div>
                <p class="metric-label">Earn badges by keeping your streak alive.</p>
            </article>
        </div>
    </div>
</section>

<?php if (!empty($perSkill)): ?>
    <section class="progress-summary">
        <div class="container">
            <h2 class="progress-section-heading">Skill focus</h2>
            <div class="progress-summary__grid" role="list">
                <?php foreach ($perSkill as $skillKey => $skillAttempts): ?>
                    <?php
                        $attemptCount = is_array($skillAttempts) ? count($skillAttempts) : 0;
                        $progressPercent = min(100, $attemptCount * 10);
                        $readableSkill = ucwords(str_replace('_', ' ', $skillKey));
                    ?>
                    <article class="ds-card ds-card--muted" role="listitem">
                        <p class="metric-label"><?php echo htmlspecialchars($readableSkill, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="metric-value"><?php echo $progressPercent; ?>%</p>
                        <div
                            class="ds-progress"
                            role="progressbar"
                            aria-label="<?php echo htmlspecialchars($readableSkill, ENT_QUOTES, 'UTF-8'); ?> progress"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            aria-valuenow="<?php echo $progressPercent; ?>"
                        >
                            <div class="ds-progress__bar" style="--progress-value: <?php echo $progressPercent; ?>%"></div>
                        </div>
                        <p class="metric-label">Attempts logged: <?php echo $attemptCount; ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="badge-section">
    <div class="container">
        <div class="badge-grid" role="list">
            <?php foreach ($badges as $badge): ?>
                <?php $stateClass = !empty($badge['earned']) ? 'ds-badge-card--earned' : 'ds-badge-card--locked'; ?>
                <button
                    class="ds-badge-card <?php echo $stateClass; ?>"
                    type="button"
                    role="listitem"
                    aria-pressed="false"
                    aria-label="<?php echo htmlspecialchars($badge['title'], ENT_QUOTES, 'UTF-8'); ?> badge: <?php echo !empty($badge['earned']) ? 'Unlocked' : 'Locked'; ?>"
                    data-tooltip="<?php echo htmlspecialchars($badge['description'], ENT_QUOTES, 'UTF-8'); ?>"
                >
                    <div class="ds-badge-card__icon" aria-hidden="true">
                        <i class="fa <?php echo $badge['icon']; ?>"></i>
                    </div>
                    <div class="badge-content">
                        <p class="ds-badge-card__title"><?php echo htmlspecialchars($badge['title'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="ds-badge-card__status"><?php echo !empty($badge['earned']) ? 'Unlocked' : 'Locked'; ?></p>
                    </div>
                    <?php if (empty($badge['earned'])): ?>
                        <span class="ds-badge-card__lock" aria-hidden="true"><i class="fa fa-lock"></i></span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div
    id="progress-data"
    data-progress-payload='<?php echo json_encode($progressPayload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>'
></div>

<div class="ds-modal" id="progress-help" role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="progress-help-title">
    <div class="ds-modal__backdrop" data-modal-close></div>
    <div class="ds-modal__dialog">
        <h2 id="progress-help-title">Keyboard and focus tips</h2>
        <p>Use the Tab key to move between cards and buttons. Press Enter or Space to activate a badge card or toggle sound effects.</p>
        <ul>
            <li>Progress bars include an accessible label and announce their value to screen readers.</li>
            <li>Badge cards show a tooltip on hover or focus. Focus outlines remain visible for contrast.</li>
            <li>Press Escape to dismiss this modal or click outside the dialog.</li>
        </ul>
        <button class="ds-button ds-modal__close" type="button" data-modal-close>Close</button>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/confetti.js"></script>
<script src="<?php echo base_url(); ?>assets/js/progress.js"></script>
