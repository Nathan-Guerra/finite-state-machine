<?php

namespace NathanGuerra\FiniteStateMachine;

/**
 * Finite State Machine
 * 
 * The FSM is an abstract machine that can be in exactly one of a finite number of states at any given time. 
 * An FSM is defined by a list of its states, its initial state, and the inputs that trigger each transition.
 * The process of switching between states is called a transition.
 * The transition may or may not generate an output.
 *
 * Current FSM:
 *
 * -> OPEN <=> LOCKED
 * 
 * OPEN receives input 'open': do nothing
 * LOCKED receives input 'open': change state
 * LOCKED receives input 'push': do nothing
 * OPEN receives input 'push': change state
 *
 * States:
 *  - OPEN -> the turnstile is open
 *  - LOCKED -> the turnstile is locked.
 *
 * Transitions:
 *  - push
 *  - insert
 */
class Turnstile
{
    const OPEN = 1;
    const LOCKED = 2;

    private int $currentState;

    private array $toString;

    public function __construct()
    {
        // TODO: Abstract function
        $this->currentState = self::LOCKED;
        $this->toString = [
            self::OPEN => 'open',
            self::LOCKED => 'locked',
        ];
    }

    public function input(string $input)
    {
        if ($input === 'insert') {
            $this->insert();
        }

        if ($input === 'push') {
            $this->push();
        }
    }
    public function checkState(): void
    {
        echo 'Current state is `' . $this->toString[$this->currentState] . '`' . PHP_EOL;
    }

    private function push(): void
    {
        if ($this->currentState === self::LOCKED) {
            echo 'You can\'t enter with the turnstile locked.' . PHP_EOL;
            return;
        }

        $this->setState(self::LOCKED);
        echo 'You entered. The turnstile is now `' . $this->toString[$this->currentState] . '`' . PHP_EOL;
    }

    private function insert(): void
    {
        if ($this->currentState === self::OPEN) {
            echo 'You can\'t insert a coin while the turnstile is open.' . PHP_EOL;
            return;
        }

        $this->setState(self::OPEN);
        echo 'The turnstile is now `' . $this->toString[$this->currentState] . '`.' . PHP_EOL;
    }

    private function setState(int $newState): void
    {
        $this->currentState = $newState;
    }
}
