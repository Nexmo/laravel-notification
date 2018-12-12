<?php

namespace Nexmo\Notifications;

use Nexmo;
use Illuminate\Notifications\Notification;

abstract class MessageChannel {

    protected $channelName;
    protected $channelIdField;
    protected $channelFromField;
    protected $notificationMappingMethod;

    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->channelName)) {
            return;
        }

        $this->nexmoChannelName = str_replace('nexmo-', '', $this->channelName);

        $message = $notification->{$this->notificationMappingMethod}($notifiable);

        $response = $this->sendMessage(
            $message->toNexmoApi(
                $this->from($message->getFrom($this->nexmoChannelName)),
                $this->to($to)
            )
        );
    }

    protected function toEndpoint($id, $field) {
        return ['type' => $this->nexmoChannelName, $field => $id];
    }

    protected function to($id) {
        return $this->toEndpoint($id, $this->channelIdField);
    }

    protected function from($id) {
        $field = $this->channelIdField;
        if ($this->channelFromField) {
            $field = $this->channelFromField;
        }
        return $this->toEndpoint($id, $field);
    }

    protected function sendMessage($body) {
        $client = new \GuzzleHttp\Client();
        return $client->request('POST', 'https://api.nexmo.com/v0.1/messages', [
            'headers' => [
                'Authorization' => 'Bearer '. Nexmo::generateJwt(),
                'Content-Type' => 'application/json', 
                'Accept' => 'application/json'
            ],
            'body' => json_encode($body)
        ]);
    }
}

