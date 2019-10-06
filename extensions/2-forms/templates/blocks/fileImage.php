<?
  // html::fileImage(name [[,multiple=false], button="obrázek"|"obrázky"])
  $name = getVar($args, 0, "string", true);
  $multiple = getVar($args, 1, false);
  $button = getVar($args, 2, $multiple?"obrázky":"obrázek");

  $appendix = "";
  if($multiple) $appendix.= " multiple";
?>
<label class="file image">
  <input type="file" name="<?=$args[0]?>" accept="image/*"<?=$appendix?>><span></span>
  <button><?=$button?></button>
</label>
<div class="preview">
</div>