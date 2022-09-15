<?php

require_once 'connect.php';
include 'Telegram.php';

$bot_token = "5645695314:AAGiw1PMNkMLbzqc-RVWYOMtG-QQPpdCnjY";
$telegram = new Telegram($bot_token);
$chat_id = $telegram->ChatID();
$text = $telegram->Text();
$firstname = $telegram->FirstName();

//$user = new User($chat_id);

//$admin_chat_id = 967469906;

$content = [
    'chat_id' => $chat_id,
    'text' => $text,
];
$telegram->sendMessage($content);

?>