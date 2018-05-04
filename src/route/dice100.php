<?php
/**
 * App specific routes.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Page choose
 */
$app->router->get("dice100/choose", function () use ($app) {
    $data = [
        "title" => "Choose amount of dices"
    ];

    // Add view and render page
    $app->view->add("dice100/choose", $data);
    $app->page->render($data);

    // print_r($_SESSION);
    // die();
});


/**
 * Page start, first time
 */
$app->router->get("dice100/start", function () use ($app) {
    // Get incoming
    $diceAmount = $_GET["diceAmount"] ?? 0;
    if ($diceAmount == 0) {
        $data = [
            "title" => "Choose amount of dices"
        ];

        // Add view and render page
        $app->view->add("dice100/choose", $data);
        $app->page->render($data);
    } else {
        $data = [
            "title" => "Play Dice 100 with " . $diceAmount . " dices",
            "noPoints" => false
        ];

        // Set up game with two players. player 0 is me and and player 1 is computer.
        $_SESSION["game"] = new \Anb\Game\Game(2, $diceAmount);

        // $game = $_SESSION["game"];

        // Add view and render page
        $app->view->add("dice100/start", $data);
        $app->page->render($data);
    }
});

/**
 * Page start, repeating times
 */
$app->router->post("dice100/start", function () use ($app) {
    $data = [
        "title" => "Play Dice 100 with " . $_SESSION["game"]->dices . " dices"
    ];

    $game = $_SESSION["game"];

    foreach ($game->players as $player) {
        if ($player->lastNoPoints) {
            $player->resetLastDiceHands();
        }
    }

    if (isset($_POST['play'])) {
        $data = [
            "title" => "Choose amount of dices"
        ];

        // Add view and render page
        $app->view->add("dice100/choose", $data);
        $app->page->render($data);
    } else {
        if (isset($_POST['nopoints']) || isset($_POST['stop'])) {
            $roll = 1; // computer
            $savePoints = 0; // me

            // Save points for me
            if (isset($_POST['stop'])) {
                $game->players[$savePoints]->setDiceHands();
            }
        } elseif (isset($_POST['roll'])) {
            $roll = 0; // me
            $savePoints = 1; // computer

            // Save points for computer
            $game->players[$savePoints]->setDiceHands();
        }
        // computer
        $game->players[$roll]->setLastDiceHand($game->dices);
        $game->players[$roll]->getLastDiceHand()->roll();
        foreach ($game->players[$roll]->getLastDiceHand()->values() as $value) {
            if (!$game->players[$roll]->lastNoPoints && ($value == 1)) {
                $game->players[$roll]->lastNoPoints = true;
            }
        }
        $game->players[$roll]->setLastDiceHands($game->players[$roll]->getLastDiceHand());
        $game->players[$roll]->sumlastDiceHands += $game->players[$roll]->getLastDiceHand()->sum();
    }

    $_SESSION["game"] = $game;

    // Add view and render page
    $app->view->add("dice100/start", $data);
    $app->page->render($data);
});
