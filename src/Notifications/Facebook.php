<?php

namespace Nexmo\Notifications;

class Facebook extends MessageChannel {
    protected $channelName = 'nexmo-messenger';
    protected $channelIdField = 'id';
    protected $notificationMappingMethod = 'toNexmoFacebook';
}

