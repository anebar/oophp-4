<?php
namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h1>Rolling <?= $rolls ?> graphic dices</h1>

<p>
<?php foreach ($class as $value) : ?>
    <i class="dice-sprite <?= $value ?>"></i>
    <!-- <span class="dice-sprite <?= $value ?>"></span> -->
<?php endforeach; ?>
</p>

<p class="dice-utf8">
<?php foreach ($class as $value) : ?>
    <!-- <i class="<?= $value ?>"></i> -->
    <span class="<?= $value ?>"></span>
<?php endforeach; ?>
</p>

<p><?= implode(", ", $res) ?></p>
<p>Sum is: <?= array_sum($res) ?>.</p>
<p>Average is: <?= round(array_sum($res) / 6, 1) ?>.</p>
