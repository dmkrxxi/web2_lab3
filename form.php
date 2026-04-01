<form action="" method="POST">

<style>
body {
  font-family: Arial, sans-serif;
  background: #f5f5f5;
}

form {
  background: white;
  padding: 20px;
  max-width: 600px;
  margin: 40px auto;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

input, textarea, select {
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
}

label {
  display: block;
  margin-bottom: 5px;
}
</style>

<h2>Анкета</h2>

<label>ФИО:</label>
<input name="fio" required maxlength="150" />

<label>Телефон:</label>
<input name="phone" required />

<label>Email:</label>
<input type="email" name="email" required />

<label>Дата рождения:</label>
<input type="date" name="birthdate" required />

<label>Пол:</label>
<label><input type="radio" name="gender" value="male" required> Мужской</label>
<label><input type="radio" name="gender" value="female"> Женский</label>

<label>Любимые языки программирования:</label>
<p style="font-size: 12px;">Удерживайте Ctrl (или Cmd), чтобы выбрать несколько</p>

<select name="abilities[]" multiple="multiple" size="6" required>
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

<label>Биография:</label>
<textarea name="bio" required></textarea>

<label>
  <input type="checkbox" name="contract" required>
  С контрактом ознакомлен(а)
</label>

<input type="submit" value="Сохранить">

</form>
