<?php
$componentId = isset($componentId) && $componentId ? trim($componentId) : '';
$eyebrow = isset($eyebrow) && $eyebrow ? $eyebrow : 'Nothing here yet';
$title = isset($title) && $title ? $title : 'No data available';
$message = isset($message) && $message ? $message : 'There is nothing to show right now.';
$illustration = isset($illustration) && $illustration ? $illustration : base_url('assets/images/empty-state-illustration.svg');
$action = isset($action) && is_array($action) ? $action : array();
$actionLabel = isset($action['label']) ? $action['label'] : '';
$actionHref = isset($action['href']) ? $action['href'] : '';
$actionAttributes = isset($action['attributes']) ? trim($action['attributes']) : '';

if ($actionLabel && $actionHref) {
    if (strpos($actionAttributes, 'class=') === false) {
        $actionAttributes = trim('class="ds-button ds-button--ghost" ' . $actionAttributes);
    } else {
        $actionAttributes = preg_replace('/class="([^"]*)"/', 'class="$1 ds-button ds-button--ghost"', $actionAttributes);
    }
}
?>
<div class="ds-empty-state" <?php echo $componentId ? 'id="' . htmlspecialchars($componentId, ENT_QUOTES, 'UTF-8') . '"' : ''; ?> role="status" aria-live="polite">
    <div class="ds-empty-state__media" aria-hidden="true">
        <img src="<?php echo $illustration; ?>" alt="" loading="lazy" />
    </div>
    <div class="ds-empty-state__body">
        <p class="ds-empty-state__eyebrow"><?php echo htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
        <h3 class="ds-empty-state__title"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h3>
        <p class="ds-empty-state__message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php if ($actionLabel && $actionHref): ?>
            <a href="<?php echo $actionHref; ?>" <?php echo $actionAttributes; ?>>
                <?php echo htmlspecialchars($actionLabel, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
