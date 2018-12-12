<?php

namespace Nexmo\Notifications;

class Sms extends MessageChannel {
    protected $channelName = 'nexmo-sms';
    protected $channelIdField = 'number';
    protected $notificationMappingMethod = 'toNexmoSms';
}

