<?php
// Устанавливаем заголовки для JSON-ответа
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// Получаем изображение из POST-запроса
$imageData = $data['image'];

// Убираем префикс "data:image/png;base64,"
$imageData = str_replace('data:image/png;base64,', '', $imageData);
$imageData = str_replace(' ', '+', $imageData);

// Декодируем base64 в изображение
$image = base64_decode($imageData);

// Генерируем уникальное имя для файла
$fileName = 'photo_' . uniqid() . '.png';

// Путь к папке, где будем сохранять изображения
$filePath = 'uploads/' . $fileName;

// Проверяем, существует ли папка для сохранения
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

// Сохраняем изображение в файл
file_put_contents($filePath, $image);

// Ответ в JSON формате
echo json_encode(['status' => 'success', 'message' => 'Фото сохранено', 'file' => $fileName]);
?>