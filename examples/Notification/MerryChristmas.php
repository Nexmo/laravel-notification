<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

use Nexmo\Notifications\Sms;
use Nexmo\Notifications\WhatsApp;
use Nexmo\Notifications\Facebook;
use Nexmo\Notifications\ViberServiceMessage;

use Nexmo\Notifications\Message\Text;

class MerryChristmas extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [
            Sms::class,
            WhatsApp::class,
            Facebook::class,
            ViberServiceMessage::class,
        ];
    }

    public function toNexmoWhatsApp($notifiable)
    {
        return (new Text)->content('Merry Christmas WhatsApp!');
    }

    public function toNexmoFacebook($notifiable)
    {
        return (new Text)->content('Merry Christmas Facebook!');
    }

    public function toNexmoViberServiceMessage($notifiable)
    {
        return (new Text)->content('Merry Christmas Viber!');
    }

    public function toNexmoSms($notifiable)
    {
        return (new Text)->content('Merry Christmas SMS!');
    }
}

