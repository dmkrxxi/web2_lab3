<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=login', 'login', 'password', [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$gender = $_POST['gender'] ?? '';
$languages = $_POST['languages'] ?? [];
$bio = $_POST['bio'] ?? '';
$contract = isset($_POST['contract']);

$errors = [];

/* ВАЛИДАЦИЯ */

// ФИО
if (!preg_match("/^[a-zA-Zа-яА-Я\s]{1,150}$/u", $name)) {
  $errors[] = "Некорректное ФИО";
}

// Телефон
if (!preg_match("/^\+?[0-9\s\-\(\)]+$/", $phone)) {
  $errors[] = "Некорректный телефон";
}

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Некорректный email";
}

// Пол
if (!in_array($gender, ['male', 'female'])) {
  $errors[] = "Некорректный пол";
}

// Языки
$valid_languages = range(1, 12);
foreach ($languages as $lang) {
  if (!in_array((int)$lang, $valid_languages)) {
    $errors[] = "Некорректный язык программирования";
    break;
  }
}

// Чекбокс
if (!$contract) {
  $errors[] = "Необходимо согласие";
}

// Если есть ошибки
if (!empty($errors)) {
  $_SESSION['errors'] = $errors;
  header("Location: index.php");
  exit();
}

/* СОХРАНЕНИЕ */

// вставка заявки
$stmt = $pdo->prepare("
  INSERT INTO application 
  (name, phone, email, birthdate, gender, bio, contract) 
  VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
  $name,
  $phone,
  $email,
  $birthdate,
  $gender,
  $bio,
  $contract
]);

$app_id = $pdo->lastInsertId();

// вставка языков
$stmt = $pdo->prepare("
  INSERT INTO application_language (application_id, language_id)
  VALUES (?, ?)
");

foreach ($languages as $lang) {
  $stmt->execute([$app_id, $lang]);
}

echo "Данные успешно сохранены!";
