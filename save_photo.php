<?php
// Получаем изображение в формате base64 из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);
$imageData = $data['image'];

// Удаляем префикс "data:image/png;base64,"
$imageData = str_replace('data:image/png;base64,', '', $imageData);
$imageData = str_replace(' ', '+', $imageData);

// Декодируем изображение в бинарные данные
$image = base64_decode($imageData);

// Сохраняем изображение на сервере
$filePath = 'uploads/photo_' . time() . '.png';
file_put_contents($filePath, $image);

// Отправляем ответ
echo json_encode(["status" => "success", "filePath" => $filePath]);
?>