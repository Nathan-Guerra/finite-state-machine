<?php

require 'vendor/autoload.php';

use NathanGuerra\FiniteStateMachine\Turnstile;

$fsm = new Turnstile();

echo 'You are testing the Finite State Machine.' . PHP_EOL;
echo 'These are your options:' . PHP_EOL;
callMenu();

while ($input = readline("Next action: ")) {
    switch ($input) {
        case '1':
            $action = readline("What action do you want to do? [insert, push] ");
            if (in_array($action, ['insert', 'push'])) {
                $fsm->input($action);
            } else {
                echo 'Invalid action. Valid actions are [insert, push]' . PHP_EOL;
            }
            break;
        case '2':
            $fsm->checkState();
            break;
        default:
            echo 'Thank you for your time. Good bye.';
            exit(1);
    }

    callMenu();
}

function callMenu()
{
    echo <<<TEXT

1. Do an action
2. Check current state of the FSM
3. Exit

TEXT;
}
