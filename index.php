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

$page = $user->getPage();

if ($text == "/start") {
    chooseLanguage();
}
//else {
//    switch ($page) {
//        case "language":
//            switch ($text) {
//                case "English 🇺🇸":
//                    $user->setLanguage("eng");
//                    break;
//                case "Русский 🇷🇺":
//                    $user->setLanguage("ru");
//                    break;
//                case "O'zbek tili 🇺🇿":
//                    $user->setLanguage("uz");
//                    break;
//            }
//            break;
//    }
//}


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
    $user->createUser();
    $user->setPage("main");
    $user->setLanguage("uz");

    $text = $user->GetText("main");

    $options = [
        [$telegram->buildKeyboardButton("button")]
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