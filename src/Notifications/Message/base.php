<?php

namespace Nexmo\Notifications\Message;

abstract class Base {
    protected $from;

    public function from($from) {
        $this->from = $from;
        return $this;
    }

    public function getFrom($channelName){
        $defaultEnv = env('NEXMO_FROM');
        $specificEnv = env('NEXMO_FROM_'. strtoupper($channelName));

        if (!$this->from) {
            if ($specificEnv) {
                return $specificEnv;
            }
            return $defaultEnv;
        }

        return $this->from;
    }
}
