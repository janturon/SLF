<?
  // html::file(name [[[,multiple=false], button="soubor"|"soubory"], accept="*.*"])
  $name = getVar($args, 0, "string", true);
  $multiple = getVar($args, 1, false);
  $button = getVar($args, 2, $multiple?"soubory":"soubor");
  $accept = getVar($args, 3, false);

  $appendix = "";
  if($multiple) $appendix.= " multiple";
  if($accept) $appendix.= " accept=\"$accept\"";
?>
<label class="file">
  <input type="file" name="<?=$args[0]?>"<?=$appendix?>><span></span>
  <button><?=$button?></button>
</label>