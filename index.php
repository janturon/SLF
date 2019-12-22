<?
session_start();

function error($msg) {
  echo "<pre>$msg";
  exit;
}

function debug($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

// $PAGE and $URL
$URL = parse_url($_SERVER["REQUEST_URI"]);
$PAGE = pathinfo($URL["path"], PATHINFO_FILENAME);
$PAGE = preg_replace("/^[\/\\\\]+/", "", $PAGE);
$PAGE = preg_replace("/\.{2,}/", "", $PAGE);
if(!$PAGE) $PAGE = "index";
if(!is_file("pages/$PAGE.php")) $PAGE = "404";

$VIEWPORT = "";

function getVar(&$arr, $val, $default=null, $yell=false) {
  if(!isset($arr)) {
    if($yell) error("getVar variable does not exists.");
    return $default;
  }
  if(!isset($arr[$val])) {
    if($yell) error("missing argument $val");
    return $default;
  }
  if($yell && $default) {
    $type = gettype($arr[$val]);
    if($type!=$default) error("argument expected $default type, got $type instead");
  }
	return $arr[$val];
}
function SESS($val) { return getVar($_SESSION, $val); }
function POST($val) { return getVar($_POST, $val); }

function loadFile($file, $args=array()) {
  if(!is_file($file)) error("Missing file $file.");
  if(count($args)==0) extract($GLOBALS);
  ob_start();
    include $file;
    $result = ob_get_contents();
  ob_end_clean();
  return $result;
}

function loadExtensions() {
  $dirs = array();
  $dd = opendir("extensions");
  while($dir=readdir($dd)) if($dir[0]!='.') $dirs[] = $dir;
  closedir($dd);
  sort($dirs);
  foreach($dirs as $dir) {
		$name = substr(basename($dir),2);
		$GLOBAL["EXTENSION"][$name] = true;
    $loader = "extensions/$dir/load.php";
    if(!is_file($loader)) error("Missing loader for extension $dir.");
    include $loader; // variables in local context unless GLOBALS is used
  }
}
$EXTENSION = array();
loadExtensions();

// page and viewport
if($PAGE=="404") header("HTTP/1.0 404 Not Found");
$CONTENTS = loadFile("pages/$PAGE.php");
if($VIEWPORT) $CONTENTS = loadFile("templates/$VIEWPORT");
echo $CONTENTS;
?>