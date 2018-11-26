<?php

namespace Nexmo\Notifications;

class ViberServiceMessage extends MessageChannel {
    protected $channelName = 'viber_service_msg';
    protected $channelFromField = 'id';
    protected $channelIdField = 'number';
    protected $notificationMappingMethod = 'toNexmoViberServiceMessage';
}

