<?
  // html::listItems($items)
  // items: array(string)
  $items = getVar($args, 0, "array", true);
?>
<?foreach($items as $item):?>
  <li><?=$item?>
<?endforeach?>