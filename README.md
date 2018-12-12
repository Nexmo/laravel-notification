# Nexmo / Laravel Notifications

Although Nexmo is [built in to Laravel](https://laravel.com/docs/5.7/notifications#sms-notifications) as the default SMS provider, that is only a small portion of the available communication channels we offer.

This package adds the ability to send notifications to WhatsApp, Facebook Messenger and Viber via Nexmo.

## Usage

To use this package, run `composer require nexmo/laravel-notification`. Once it completes, you can implement the following methods on your notification:

* `toNexmoWhatsApp`
* `toNexmoFacebook`
* `toNexmoViberServiceMessage`
* `toNexmoSms`

See [examples/Notification/MerryChristmas.php](examples/Notification/MerryChristmas.php) for a complete example.

To send a notification, specify the channel you'd like to use:

```php
// To a user
$user->notify(new \App\Notifications\MerryChristmas());

// To any person
Notification::route(
    'nexmo-whatsapp',
    'YOUR_NUMBER'
)->notify(new \App\Notifications\MerryChristmas());
```

The available channels are:

* `nexmo-sms`
* `nexmo-whatsapp`
* `nexmo-facebook`
* `nexmo-viber_service_msg`

As each notification receives a `$notifiable` (usually a user) it can decide how best to route the information. In this case, it checks the `via_whatsapp` property on the user and sends via WhatsApp if it's true. Otherwise it falls back to email

```
public function via($notifiable)
{
    return $notifiable->via_whatsapp ? ['nexmo-whatsapp'] : ['mail'];
}
```

### Message Types

Nexmo supports multiple message types, depending on the channel that you're sending to. The `Text` type is the safest if you want to deliver to all channels:

```
public function toNexmoWhatsApp($notifiable)
{
    return (new \Nexmo\Notifications\Message\Text)
        ->content('This is a message being sent to WhatsApp');
}
```

### Caveats

For some channels you need to send a templated message before you can send a free text message due to spam control rules. Here's an example of how to use a preapproved template intended for two-factor authentication purposes:

```
public function toNexmoWhatsApp($notifiable)
{
    return (new \Nexmo\Notifications\Message\Template)
        ->name("whatsapp:hsm:technology:nexmo:verify")
        ->parameters([
            ["default" => "Your Brand"],
            ["default" => "64873"],
            ["default" => "10"],
        ]);
}
```

If the recipient replies to your message, you can send them `Text` type messages without any issues

## Configuration

### Authentication

This notifications package is built on top of [nexmo/laravel](https://github.com/Nexmo/nexmo-laravel) and uses the Nexmo client from there.

For this to work, you need to set your application ID and path to your private key in the `.env` file:

```
NEXMO_APPLICATION_ID=my_application_id
NEXMO_PRIVATE_KEY=./private.key
```

### Setting the `from` address

You can set a `from `address via the `.env` file. This package will look for provider specific entries before falling back to `NEXMO_FROM`.

```
NEXMO_FROM_SMS=""
NEXMO_FROM_WHATSAPP=""
NEXMO_FROM_MESSENGER=""
NEXMO_FROM_VIBER_SERVICE_MSG=""
NEXMO_FROM="" # This is the default if any of the above aren't set
```

Alternatively, you can set a `from` address for a single notification by calling the `->from()` method on a message:

```php
public function toNexmoViberServiceMessage($notifiable)
{
    return (new Text)->content('Merry Christmas Viber!')->from("YOUR_ID");
}
```
