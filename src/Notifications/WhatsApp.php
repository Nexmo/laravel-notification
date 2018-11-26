<?php

namespace Nexmo\Notifications;

class WhatsApp extends MessageChannel {
    protected $channelName = 'whatsapp';
    protected $channelIdField = 'number';
    protected $notificationMappingMethod = 'toNexmoWhatsApp';
}
