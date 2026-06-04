<?php
// ==========================================
// НАСТРОЙКИ TELEGRAM (ДАННЫЕ ВШИТЫ)
// ==========================================
$token = "8547308401:AAHh8ui2JbsuK6fUjc_H0Am0Hht3tmLm5qc";
$chat_id = "7455634264";

// Проверяем, что форма была отправлена методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Получаем данные из полей и очищаем их от мусора
    $name = trim(strip_tags($_POST['name']));
    $phone = trim(strip_tags($_POST['phone']));

    // Формируем текст сообщения для Telegram
    $arr = array(
        '🔥 Новая заявка на сайте SRJ MOTORS!' => '',
        '👤 Имя клиента: ' => $name,
        '📞 Телефон: ' => $phone
    );

    $txt = "";
    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };

    // Отправляем запрос в Telegram API
    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

    // Если всё ушло успешно, перенаправляем пользователя на страницу "Спасибо"
    if ($sendToTelegram) {
        header('Location: thanks.html');
        exit();
    } else {
        echo "Ошибка отправки! Проверьте, запущен ли бот в Telegram, или свяжитесь с администрацией.";
    }
} else {
    // Если файл открыли напрямую в браузере — возвращаем на главную
    header('Location: index.html');
    exit();
}
?>
