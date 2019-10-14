<?
$SQLITE_ACTIVE = false;
$SQLITE_ADMIN_PATH = "/admin.php";
$SQLITE_DATABASE = "example-sqlite.db";

if(!$SQLITE_ACTIVE) return;

if($GLOBALS["URL"]["path"]==$SQLITE_ADMIN_PATH) {
  exit(include("data/sqlite/phpliteadmin.php"));
}

include "data/sqlite/model.php";
$GLOBALS["MODEL"] = new Model("data/sqlite/db/$SQLITE_DATABASE");
?>