<?
$SQLITE_ADMIN_PATH = "/admin";
$SQLITE_DATABASE = "example-sqlite.db";

if($GLOBALS["URL"]["path"]==$SQLITE_ADMIN_PATH) {
  exit(include("data/sqlite/phpliteadmin.php"));
}

include "data/sqlite/model.php";
$GLOBALS["MODEL"] = new Model("data/sqlite/db/$SQLITE_DATABASE");
?>