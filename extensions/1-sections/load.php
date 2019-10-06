<?
class section {
  static function __callStatic($section, $args) {
    return loadFile("templates/sections/$section.php",$args);
  }
}
?>