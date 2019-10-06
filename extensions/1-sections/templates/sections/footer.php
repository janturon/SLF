<?
  $config = getVar($args, 0, "array", true);
  $name = getVar($config, "name");
  $year = getVar($config, "year");
  $contact = getVar($config, "contact");
?>
<footer>
  <?if($name || $year):?>
    <?="&copy; $year $name"?>
  <?endif?>
  <?if($contact):?>
    <?=" | $contact"?>
  <?endif?>
</footer>