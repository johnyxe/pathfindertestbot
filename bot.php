<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*---------------------------------------------------*/
/* include composer autoload and config file
/*---------------------------------------------------*/
require_once 'vendor/autoload.php';
require_once 'config.php';

/*---------------------------------------------------*/
/* Line Api Namespace
/*---------------------------------------------------*/

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

/*---------------------------------------------------*/
/* API secret key
/*---------------------------------------------------*/

$API_URL = LINE_MESSAGE_CHANNEL_ID;
$ACCESS_TOKEN = LINE_MESSAGE_CHANNEL_SECRET;
$CHANNEL_SECRET = LINE_MESSAGE_ACCESS_TOKEN;

/*---------------------------------------------------*/
/* Connecting via HTTP
/*---------------------------------------------------*/

$httpClient = new CurlHTTPClient( $ACCESS_TOKEN );
$bot = new LINEBot( $httpClient, array( 'channelSecret' => $CHANNEL_SECRET) );

/*---------------------------------------------------*/
/* Retrieve user input
/*---------------------------------------------------*/

$request = file_get_contents('php://input');
// Decode JSON to Array
$request_array = json_decode($request, true);

/*---------------------------------------------------*/
/* Handle request
/*---------------------------------------------------*/

if ( !is_null($request_array) ) {

    foreach ( $request_array['events'] as $event ){
      
      	$reply_message = '';
      	$reply_token = $event['replyToken'];
      	$data = [
         	'replyToken' => $reply_token,
         	'messages' => [
            	[	
            		'type' => 'text', 
             		'text' => json_encode($request_array)
             	]
         	]
      	];

      	// Reply message builder
      	$textMessageBuilder = new TextMessageBuilder( json_encode($event, JSON_UNESCAPED_UNICODE) );

      	// Reply message
      	$response = $bot->replyMessage( $replyToken, $textMessageBuilder );
		if ($response->isSucceeded()) {
		    echo 'Succeeded!';
		    return;
		}

		// Failed
	    echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
   }
}