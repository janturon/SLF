<?
  $GLOBALS["TEMPLATE"] = "";

  $data = array(
    "first item",
    "second item",
  );
?>

<ul>
  <?=html::listItems($data)?>
</ul>
