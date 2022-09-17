<?php

include 'Telegram.php';
require_once 'User.php';
require_once 'Weather.php';

$key = "a85c63aee77341ee89b50718223004";

//History
//http://api.weatherapi.com/v1/future.json?key=a85c63aee77341ee89b50718223004&q=Urganch&dt=2022-10-16

$bot_token = "5645695314:AAGiw1PMNkMLbzqc-RVWYOMtG-QQPpdCnjY";
$telegram = new Telegram($bot_token);

$chat_id = $telegram->ChatID();
$text = $telegram->Text();

$data = $telegram->getData();
$message = $data['message'];

$user = new User($chat_id);
$weather = new Weather($key);
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
                case $user->GetText("menu_now"):
                    $user->setPage("weather_now");
                    askCity();
//                    $data = $weather->now("Urganch");
//                    foreach ($data as $item)
//                    SendMessage(json_encode($item, JSON_PRETTY_PRINT));
                    break;
                case $user->GetText("menu_today"):
                    $user->setPage("weather_today");
                    askCity();
//                    $data = $weather->today("Urganch");
//                    foreach ($data as $item)
//                    SendMessage(json_encode($item, JSON_PRETTY_PRINT));
                    break;
                case $user->GetText("menu_tomorrow"):
                    $user->setPage("weather_tomorrow");
                    askCity();
//                    $data = $weather->tomorrow("Urganch");
//                    foreach ($data as $item)
//                    SendMessage(json_encode($item, JSON_PRETTY_PRINT));
                    break;
                case $user->GetText("menu_day"):
                    $user->setPage("weather_week");
                    askCity();
//                    $data = $weather->week("Urganch");
//                    foreach ($data as $item)
//                    SendMessage(json_encode($item, JSON_PRETTY_PRINT));
                    break;
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

function askCity(){
    global $chat_id, $telegram, $user;
//    $user->setPage("main");

    $text = $user->GetText("text_location");

    $options = [
        [$telegram->buildKeyboardButton($user->GetText("write_location"))],
        [$telegram->buildKeyboardButton($user->GetText("send_location"), false, true)],
    ];
    $keyboard = $telegram->buildKeyBoard($options, false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

function SendMessage($text)
{
    global $chat_id, $telegram;
    $content = [
        'chat_id' => $chat_id,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

//$show = " 📍 Name: " . $data['location']['name'] . "\n" .
//    " 📍 Region: " . $data['location']['region'] . "\n" .
//    " 📍 Country: " . $data['location']['country'] . "\n" .
//    " 🌡 Temperature: " . $data['current']['temp_c'] . "\n" .
//    " 🌪 Wind: " . $data['current']['wind_mph'] . "\n" .
//    " 💧 Humidity: " . $data['current']['humidity'] . "\n" .
//    " 🕔 Time: " . $data['current']['last_updated'] . "\n";


?>