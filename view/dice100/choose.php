<?php
namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h1><?= $title ?></h1>

<form method="get" action="start">
    <select name="diceAmount" autofocus>
        <option value="" disabled selected>Choose amount of dices...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select>

    <input type="submit" value="Choose amount of dices">
</form>
