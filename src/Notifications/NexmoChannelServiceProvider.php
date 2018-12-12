<?php

namespace Nexmo\Notifications;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class NexmoChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $channels = [
            'nexmo-messenger' => Facebook::class,
            'nexmo-whatsapp' => WhatsApp::class,
            'nexmo-viber_service_msg' => ViberServiceMessage::class,
            'nexmo-sms' => Sms::class,
        ];

        foreach($channels as $name => $className) {
            Notification::extend($name, function () use ($className) {
                return new $className;
            });
        }
    }
}
