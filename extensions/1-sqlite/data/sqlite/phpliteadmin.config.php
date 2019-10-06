<?
$password = "kladivo";
$directory = "data/sqlite/db";

function hm($str) {
  $items = explode(':',$str,2);
  if(count($items)<2) return 0;
  return 60*(int)$items[0]+(int)$items[1];
}
function m2t($m) {
  $mm = (int)($m%60);
  if($mm<10) $mm = '0'.$mm;
  return (int)($m/60).':'.$mm;
}

$custom_functions[] = 'hm';
$custom_functions[] = 'm2t';
?>