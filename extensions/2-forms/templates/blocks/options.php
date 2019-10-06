<?
  // html::options(options [,selected])
  // options: array(key=>val); key=option value, val=option text
  // selected: option key to be selected
  $options = getVar($args, 0, "array", true);
  $selected = getVar($args, 1);
?>
<?foreach($args[0] as $key=>$val): $appendix = $selected==$key ? " selected" : ""; ?>
  <option value="<?=$key?>"<?=$appendix?>><?=$val?></option>
<?endforeach?>
