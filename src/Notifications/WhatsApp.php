<?php

namespace Nexmo\Notifications;

class WhatsApp extends MessageChannel {
    protected $channelName = 'nexmo-whatsapp';
    protected $channelIdField = 'number';
    protected $notificationMappingMethod = 'toNexmoWhatsApp';
}
