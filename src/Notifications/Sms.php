<?php

namespace Nexmo\Notifications;

class Sms extends MessageChannel {
    protected $channelName = 'sms';
    protected $channelIdField = 'number';
    protected $notificationMappingMethod = 'toNexmoSms';
}

