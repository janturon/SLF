<?
  $GLOBALS["TEMPLATE"] = "";

  $select = array(
    "one" => "jedna",
    "two" => "dvě",
    "three" => "tři",
  );
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<style>
  <? include "client/forms.css"?>

  fieldset { display: inline-block; }
  input, label { display: block; margin: 1px 0; }
</style>
<script>
  <? include "client/forms.js"?>
</script>

Data z formuláře: <?=SESS("data")?>
<? $_SESSION["data"] = ""; ?>

<br><br>

<fieldset>
  <legend>select test</legend>
  <form method="POST">
    <input type="hidden" name="form" value="select">
    <select name="data">
      <?=html::options($select)?>
    </select>
    <input type="submit">
  </form>
</fieldset>

<fieldset>
  <legend>text inputs</legend>
  <form method="POST">
    <input type="hidden" name="form" value="text">
    <input name="title" size="4" placeholder="Title">
    <input name="name" required placeholder="Name">
    <input name="age" type="number" placeholder="Age">
    <input name="email" type="email" placeholder="E-mail">
    <input name="date" type="date" required>
    <input name="time" type="time">
    <input type="submit">
  </form>
</fieldset>

<fieldset>
  <legend>radios and checkboxes</legend>
  <form method="POST">
    <input type="hidden" name="form" value="choice"><br>
    Posílá se 0, pokud nezaškrtne<br>
    <?=html::checkbox("agree", array("a1"=>"Agree 1", "a2"=>"Agree 2", "a3"=>"Agree 3"), array("a1", "a3"))?><br><br>
    Lze zrušit výběr kliknutím nebo mezerníkem<br>
    <?=html::radio("choice", array("one", "two", "three"), 1)?><br><br>
    <input type="submit">
    <input type="reset">
  </form>
</fieldset>

<fieldset>
  <legend>soubory a obrázky</legend>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="form" value="files"><br>
    <?=html::file("file")?><br>
    <?=html::fileImage("images", true)?>
    <input type="submit">
  </form>
</fieldset>
