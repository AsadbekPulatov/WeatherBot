<?php

include 'Telegram.php';
require_once 'User.php';

//$key = "a85c63aee77341ee89b50718223004";


//7 day
//http://api.weatherapi.com/v1/forecast.json?key=a85c63aee77341ee89b50718223004&q=Urganch&days=7&aqi=no&alerts=no

//History
//http://api.weatherapi.com/v1/future.json?key=a85c63aee77341ee89b50718223004&q=Urganch&dt=2022-10-16

$bot_token = "5645695314:AAGiw1PMNkMLbzqc-RVWYOMtG-QQPpdCnjY";
$telegram = new Telegram($bot_token);

$chat_id = $telegram->ChatID();
$text = $telegram->Text();

$data = $telegram->getData();
$message = $data['message'];

$user = new User($chat_id);

//$admin_chat_id = 967469906;

$page = $user->getPage();

if ($text == "/start") {
    chooseLanguage();
} else {
    switch ($page) {
        case "language":
            switch ($text) {
                case "English 🇺🇸":
                    $user->setLanguage("eng");
                    showMainPage();
                    break;
                case "Русский 🇷🇺":
                    $user->setLanguage("ru");
                    showMainPage();
                    break;
                case "O'zbek tili 🇺🇿":
                    $user->setLanguage("uz");
                    showMainPage();
                    break;
            }
            break;
        case "main":
            switch ($text) {
                case $user->GetText("menu_settings"):
                    chooseLanguage();
                    break;
            }
            break;
    }
}


function chooseLanguage()
{
    global $chat_id, $telegram, $user;
    $user->createUser($chat_id);
    $user->setPage("language");

    $text = "Please select a language.\nПожалуйста выберите язык.\nIltimos, tilni tanlang.";

    $options = [
        [$telegram->buildKeyboardButton("English 🇺🇸"), $telegram->buildKeyboardButton("Русский 🇷🇺"), $telegram->buildKeyboardButton("O'zbek tili 🇺🇿")]
    ];
    $keyboard = $telegram->buildKeyBoard($options, false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

function showMainPage()
{
    global $chat_id, $telegram, $user;
    $user->setPage("main");

    $text = $user->GetText("main");

    $options = [
        [$telegram->buildKeyboardButton($user->GetText("menu_now"))],
        [$telegram->buildKeyboardButton($user->GetText("menu_today")), $telegram->buildKeyboardButton($user->GetText("menu_tomorrow"))],
        [$telegram->buildKeyboardButton($user->GetText("menu_day"))],
        [$telegram->buildKeyboardButton($user->GetText("menu_settings"))],
    ];
    $keyboard = $telegram->buildKeyBoard($options, false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}


?>