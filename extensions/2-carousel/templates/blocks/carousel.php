<?
  // html::carousel(width, height, values)
  // values: array(key=>val); key=image url, val=click target
  $width = getVar($args, 0, "integer", true);
  $height = getVar($args, 1, "integer", true);
  $items = getVar($args, 2, "array", true);
?>
<div class="carousel" style="width:<?=$width?>px; height:<?=$height?>px">
  <ul>
<?foreach($items as $item): getVar($item, 2, "string", true); ?>
    <li data-text="<?=$item[2]?>"><a href="<?=$item[1]?>"><img src="<?=$item[0]?>"></a>
<?endforeach?>
  </ul>
  <div>
    <button>&#x0E800;</button>
    <button>&#x0E801;</button>
    <span><?=$items[0][2]?></span>
  </div>
</div>
