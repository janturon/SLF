<?
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

class Model extends SQLite3 {

  function select($query, $values="", $keys="") {
    $return = array();
    $result = $this->query($query);
    if($result===false) {
      error("Query <b>$query</b> failed.");
      return $return;
    }
    $from = array();
    $i = 0;
    while($row=$result->fetchArray(SQLITE3_ASSOC)) {
      if($values && !$from) $from = array_map(function($v) { return ":$v"; }, array_keys($row));
      $to = array_values($row);
      $key = $keys ? str_replace($from, $to, $keys) : $i++;
      $return[$key] = $values ? str_replace($from, $to, $values) : $row;
      $first = false;
    }
    return $return;
  }

  static function format($type, &$i) {
    if($type=='i') $i = (int)$i;
    else if($type=='f') $i = (float)$i;
    else $i = "'".SQLite3::escapeString($i)."'";
  }

  static function formats($types, &$i0, &$i1=null, &$i2=null, &$i3=null) {
    $len = strlen($types);
    if($len>3) self::format($types[3], $i3);
    if($len>2) self::format($types[2], $i2);
    if($len>1) self::format($types[1], $i1);
    if($len>0) self::format($types[0], $i0);
  }

  function __construct($db) {
    if(!is_file($db)) error("$db does not exist.");
    $this->open($db);
    $this->createFunction('hm','hm');
    $this->createFunction('m2t','m2t');
  }
  function __destruct() {
    $this->close();
  }
}
?>