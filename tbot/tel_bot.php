<?php
// Telegram id and Token >> tell_ssip
// Initialize a variable that will make it easier for us to call the Telegram API
include "botconnect.php";

define('API_KEY', $db['token']);

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($result);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;

if($text == "/start"){
   $answer = 'Hallo';
}elseif($text == "/help"){
    $answer = 'What?';
}elseif($text == "/info"){
    $answer = 'This is info';
} else{
    $answer = 'Thanks';
}

bot('sendmessage',['chat_id'=>$chat_id, 'text'=>$answer]);

?>

<!-- 

// Telegram id and Token >> tell_ssip
// Initialize a variable that will make it easier for us to call the Telegram API
define('BOT_TOKEN', '1979815815:AAFs0LJamFr2oTuQZRr5nsWI4M1O7r-q6FU');
define('CHAT_ID','941745112 ');

// We will use cURL to access the telegram API.
function sendTelegram($message_) {
    
    $message_ = json_encode($message_);
    $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$message_";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
    
    $message_ = $update["message"]["text"];
}
        
sendTelegram("Hello! Welcome to tell_ssip bot");


 -->


 