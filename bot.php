<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/*---------------------------------------------------*/
/* include composer autoload and config file
/*---------------------------------------------------*/

require 'vendor/autoload.php';
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
//require_once 'config.php';

/*---------------------------------------------------*/
/* Line Api Namespace
/*---------------------------------------------------*/

// use LINE\LINEBot;
// use LINE\LINEBot\HTTPClient;
// use LINE\LINEBot\HTTPClient\CurlHTTPClient;
// //use LINE\LINEBot\Event;
// //use LINE\LINEBot\Event\BaseEvent;
// //use LINE\LINEBot\Event\MessageEvent;
// use LINE\LINEBot\MessageBuilder;
// use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
// use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
// use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
// use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
// use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
// use LINE\LINEBot\ImagemapActionBuilder;
// use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
// use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
// use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
// use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
// use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
// use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
// use LINE\LINEBot\TemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

/*---------------------------------------------------*/
/* API secret key
/*---------------------------------------------------*/

$API_URL = '1653836756';
$ACCESS_TOKEN = 'AWfgTiKiPRZ+vQc2wiifytwhm4sNvzx+B347DdMWwokxLAqjfy9q2Kf+EGQmAb16dAKpXWRqWqTY+1A85IT711cuEKj4lTLgEqRoorHzeXTZtrnIWS27oHjJbfypOYu6jcJv+bGMzbfTMKpGKQBkIAdB04t89/1O/w1cDnyilFU=';
$CHANNEL_SECRET = '94c84baab00e8d0e6a778ad32b37247d';

/*---------------------------------------------------*/
/* Connecting via HTTP
/*---------------------------------------------------*/

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient( $ACCESS_TOKEN );
$bot = new \LINE\LINEBot( $httpClient, array( 'channelSecret' => $CHANNEL_SECRET) );

/*---------------------------------------------------*/
/* Retrieve user input
/*---------------------------------------------------*/

$content = file_get_contents('php://input');
// Decode JSON to Array
$request_array = json_decode($content, true);

/*---------------------------------------------------*/
/* Handle request
/*---------------------------------------------------*/

if(!is_null($request_array)){
    
    // Main data
    $event = $request_array['events'][0];

    $replyToken = $event['replyToken'];
    $customerMessage = $event['message']['text']

}
// ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
//$textMessageBuilder = new LINE\LINEBot\MessageBuilder\TextMessageBuilder(json_encode($events));
$textMessageBuilder = new LINE\LINEBot\MessageBuilder\TextMessageBuilder( 'You said: ' . $customerMessage );
 

//l ส่วนของคำสั่งตอบกลับข้อความ
$response = $bot->replyMessage($replyToken,$textMessageBuilder);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







?>