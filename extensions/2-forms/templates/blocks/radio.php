<?
  // html::radio(name, values [,checked=false])
  // values: array(key=>val); key=name index, val=checkbox label
  // checked: name index to be checked
  $name = getVar($args, 0, "string", true);
  $items = getVar($args, 1, "array", true);
  $checked = getVar($args, 2);
?>
<?foreach($items as $key=>$val): $appendix = $checked==$key ? " checked" : ""; ?>
  <label class="radio">
    <input type="radio" name="<?=$name?>" value="<?=$key?>"<?=$appendix?>>
    <span><?=$val?></span>
  </label>
<?endforeach?>