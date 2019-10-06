<?
class html {
  static function __callStatic($block, $args) {
    return loadFile("templates/blocks/$block.php",$args);
  }
}
?>