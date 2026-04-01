<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Лаб. 3</title>
  <style>
    body {
      font-family: Arial;
      max-width: 600px;
      margin: auto;
    }
    input, textarea, select {
      width: 100%;
      margin-bottom: 10px;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>

<h2>Форма</h2>

<?php
if (!empty($_SESSION['errors'])) {
  foreach ($_SESSION['errors'] as $e) {
    echo "<p class='error'>$e</p>";
  }
  unset($_SESSION['errors']);
}
?>

<form action="form.php" method="POST">

  <label>
    ФИО:<br>
    <input type="text" name="name" required>
  </label>

  <label>
    Телефон:<br>
    <input type="tel" name="phone" required>
  </label>

  <label>
    Email:<br>
    <input type="email" name="email" required>
  </label>

  <label>
    Дата рождения:<br>
    <input type="date" name="birthdate" required>
  </label>

  <p>Пол:</p>
  <label><input type="radio" name="gender" value="male" required> Мужской</label>
  <label><input type="radio" name="gender" value="female"> Женский</label>

  <label>
    Любимые языки программирования:<br>
    <select name="languages[]" multiple required>
      <option value="1">Pascal</option>
      <option value="2">C</option>
      <option value="3">C++</option>
      <option value="4">JavaScript</option>
      <option value="5">PHP</option>
      <option value="6">Python</option>
      <option value="7">Java</option>
      <option value="8">Haskel</option>
      <option value="9">Clojure</option>
      <option value="10">Prolog</option>
      <option value="11">Scala</option>
      <option value="12">Go</option>
    </select>
  </label>

  <label>
    Биография:<br>
    <textarea name="bio" required></textarea>
  </label>

  <label>
    <input type="checkbox" name="contract" required>
    С контрактом ознакомлен(а)
  </label>

  <br><br>
  <input type="submit" value="Сохранить">
</form>

</body>
</html>
