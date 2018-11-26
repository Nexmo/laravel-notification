<?php

namespace Nexmo\Notifications;

class Facebook extends MessageChannel {
    protected $channelName = 'messenger';
    protected $channelIdField = 'id';
    protected $notificationMappingMethod = 'toNexmoFacebook';
}

