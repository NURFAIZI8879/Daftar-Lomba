<?php
// Breadcrumb partial
// Usage: require base_path('views/partials/breadcrumb.php');
// Variables: $breadcrumbs = [['label' => 'Home', 'url' => '/'], ...]
if (!isset($breadcrumbs)) {
    $breadcrumbs = [['label' => 'Dashboard', 'url' => '/']];
}
?>
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $i => $bc): ?>
        <?php if ($i > 0): ?>
            <span class="breadcrumb-separator">/</span>
        <?php endif; ?>
        <?php if (isset($bc['url']) && $i < count($breadcrumbs) - 1): ?>
            <a href="<?= htmlspecialchars($bc['url']) ?>" class="breadcrumb-link"><?= htmlspecialchars($bc['label']) ?></a>
        <?php else: ?>
            <span class="breadcrumb-current"><?= htmlspecialchars($bc['label']) ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</div>