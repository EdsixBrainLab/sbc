<section class="progress-hero">
    <div class="container">
        <div class="progress-header">
            <div>
                <p class="eyebrow">Progress</p>
                <h1>Badges</h1>
                <p class="subtitle">Track what you have unlocked and what is still waiting for you.</p>
            </div>
            <div class="badge-controls" aria-label="Progress preferences">
                <label class="sound-toggle" for="sound-toggle">
                    <input type="checkbox" id="sound-toggle" />
                    <span class="toggle-display" aria-hidden="true"></span>
                    <span id="sound-toggle-label" class="toggle-label">Sound effects on</span>
                </label>
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

<div
    id="progress-data"
    data-progress-payload='<?php echo json_encode($progressPayload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>'
></div>

<style>
.badge-controls {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sound-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-weight: 600;
    color: #444;
}

.sound-toggle input {
    display: none;
}

.toggle-display {
    position: relative;
    width: 44px;
    height: 24px;
    border-radius: 20px;
    background: #d0d0d0;
    transition: background 0.2s ease;
}

.toggle-display::after {
    content: '';
    position: absolute;
    top: 3px;
    left: 3px;
    width: 18px;
    height: 18px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);
    transition: transform 0.2s ease;
}

.sound-toggle input:checked + .toggle-display {
    background: #00bfa5;
}

.sound-toggle input:checked + .toggle-display::after {
    transform: translateX(20px);
}

.toggle-label {
    font-size: 14px;
}
</style>

<script src="<?php echo base_url(); ?>assets/js/confetti.js"></script>
<script src="<?php echo base_url(); ?>assets/js/progress.js"></script>
