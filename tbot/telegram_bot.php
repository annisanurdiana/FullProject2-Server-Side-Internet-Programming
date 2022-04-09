<?php
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
    
    $message_ = $result["message"]["text"];
}
        
sendTelegram("Hello! This message from tell_ssip bot", BOT_TOKEN, CHAT_ID);



// ----------------------------------------------------------------------------------------//
// if (strpos($message, "/start") === 0) {
// $location = substr($message, 9);
// $weather = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$location."&appid=mytoken"), TRUE)["weather"][0]["main"];
// file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Here's the weather in ".$location.": ". $weather);
// }


?>