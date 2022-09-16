<?php

include 'Telegram.php';

$bot_token = "5645695314:AAGiw1PMNkMLbzqc-RVWYOMtG-QQPpdCnjY";
$telegram = new Telegram($bot_token);
$chat_id = $telegram->ChatID();
$text = $telegram->Text();
$data = $telegram->getData();
$message = $data['message'];

$user = new User($chat_id);
//$admin_chat_id = 967469906;

if ($text == "/start"){
    showMainPage();
}

function showMainPage(){
    global $chat_id,$telegram, $user;
    $user->createUser();
    $user->setPage("main");
    $user->setLanguage("uz");

    $text = $user->GetText("main");

    $options = [
        [$telegram->buildKeyboardButton("button")]
    ];
    $keyboard = $telegram->buildKeyBoard($options,false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}


?>