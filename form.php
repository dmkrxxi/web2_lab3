<form action="" method="POST">

  ФИО:<br>
  <input name="fio" /><br>

  Телефон:<br>
  <input name="phone" /><br>

  Email:<br>
  <input name="email" /><br>

  Дата рождения:<br>
  <input type="date" name="birthdate" /><br>

  Пол:<br>
  <label><input type="radio" name="gender" value="male"> Мужской</label>
  <label><input type="radio" name="gender" value="female"> Женский</label><br>

  Любимые языки программирования:<br>
  <select name="abilities[]" multiple="multiple">
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
  </select><br>

  Биография:<br>
  <textarea name="bio"></textarea><br>

  <label>
    <input type="checkbox" name="contract">
    С контрактом ознакомлен(а)
  </label><br><br>

  <input type="submit" value="Сохранить">
</form>
