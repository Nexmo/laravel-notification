<?php

namespace Nexmo\Notifications\Message;

class Template extends Base {

    protected $name;
    protected $parameters;

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function parameters($parameters) {
        $this->parameters = $parameters;
        return $this;
    }

    public function toNexmoApi($from, $to) {
        return [
            'from' => $from,
            'to' => $to,
            'message' => [
                'content' => [
                    'type' => 'template',
                    "template" => [
                        "name" => $this->name,
                        "parameters" => $this->parameters
                    ]
                ]
            ]
        ];
    }

}
