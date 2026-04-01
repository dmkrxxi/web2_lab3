<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}

// ===== ВАЛИДАЦИЯ =====
$errors = FALSE;

if (empty($_POST['fio']) || !preg_match('/^[a-zA-Zа-яА-Я\s]{1,150}$/u', $_POST['fio'])) {
  print('Некорректное ФИО.<br/>');
  $errors = TRUE;
}

if (empty($_POST['phone']) || !preg_match('/^\+?[0-9\s\-\(\)]+$/', $_POST['phone'])) {
  print('Некорректный телефон.<br/>');
  $errors = TRUE;
}

if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  print('Некорректный email.<br/>');
  $errors = TRUE;
}

if (empty($_POST['birthdate'])) {
  print('Введите дату рождения.<br/>');
  $errors = TRUE;
}

if (empty($_POST['gender']) || !in_array($_POST['gender'], ['male', 'female'])) {
  print('Выберите пол.<br/>');
  $errors = TRUE;
}

if (empty($_POST['abilities']) || !is_array($_POST['abilities'])) {
  print('Выберите хотя бы один язык программирования.<br/>');
  $errors = TRUE;
}

if (empty($_POST['bio']) || strlen($_POST['bio']) < 10) {
  print('Биография должна быть не короче 10 символов.<br/>');
  $errors = TRUE;
}

if (empty($_POST['contract'])) {
  print('Необходимо согласие с контрактом.<br/>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

// ===== ПОДКЛЮЧЕНИЕ К БД =====

$user = 'u82350';
$pass = '9510179';
$dbname = 'u82350';

$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// ===== СОХРАНЕНИЕ =====

try {
  // основная таблица
  $stmt = $db->prepare("
    INSERT INTO application 
    (name, phone, email, birthdate, gender, bio, contract)
    VALUES (?, ?, ?, ?, ?, ?, ?)
  ");

  $stmt->execute([
    $_POST['fio'],
    $_POST['phone'],
    $_POST['email'],
    $_POST['birthdate'],
    $_POST['gender'],
    $_POST['bio'],
    isset($_POST['contract'])
  ]);

  // получаем ID
  $app_id = $db->lastInsertId();

  // вставка языков
  $stmt = $db->prepare("
    INSERT INTO application_language (application_id, language_id)
    VALUES (?, ?)
  ");

  foreach ($_POST['abilities'] as $ability) {
    $stmt->execute([$app_id, $ability]);
  }

}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

// редирект
header('Location: ?save=1');
