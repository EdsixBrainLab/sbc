<section class="progress-hero">
    <div class="container">
        <div class="progress-header">
            <div>
                <p class="eyebrow">Progress</p>
                <h1>Badges</h1>
                <p class="subtitle">Track what you have unlocked and what is still waiting for you.</p>
            </div>
            <div class="badge-legend" aria-hidden="true">
                <span class="legend earned"></span> Earned
                <span class="legend locked"></span> Locked
            </div>
        </div>
    </div>
</section>

<section class="badge-section">
    <div class="container">
        <div class="badge-grid" role="list">
            <?php foreach ($badges as $badge): ?>
                <?php $stateClass = $badge['earned'] ? 'earned' : 'locked'; ?>
                <button
                    class="badge-card <?php echo $stateClass; ?>"
                    type="button"
                    data-tooltip="<?php echo htmlspecialchars($badge['description'], ENT_QUOTES, 'UTF-8'); ?>"
                    role="listitem"
                    aria-pressed="false"
                >
                    <div class="badge-icon" aria-hidden="true">
                        <i class="fa <?php echo $badge['icon']; ?>"></i>
                    </div>
                    <div class="badge-content">
                        <p class="badge-title"><?php echo htmlspecialchars($badge['title'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="badge-status"><?php echo $badge['earned'] ? 'Unlocked' : 'Locked'; ?></p>
                    </div>
                    <?php if (!$badge['earned']): ?>
                        <span class="badge-lock" aria-hidden="true"><i class="fa fa-lock"></i></span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
