<?
  // html::checkbox(name, values [,checked=false])
  // values: array(key=>val); key=name index, val=checkbox label
  // checked: array or string; name index to be checked
  $name = getVar($args, 0, "string", true);
  $items = getVar($args, 1, "array", true);
  $checked = getVar($args, 2);
  if(!is_array($checked)) $checked = array($checked);
?>
<?foreach($items as $key=>$val): $appendix = in_array($key, $checked) ? " checked" : ""; ?>
  <label class="checkbox">
    <input type="hidden" name="<?=$name?>[<?=$key?>]" value="0">
    <input type="checkbox" name="<?=$name?>[<?=$key?>]" value="1"<?=$appendix?>>
    <span><?=$val?></span>
  </label>
<?endforeach?>