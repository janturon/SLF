<?
// requires 1-blocks
if($ext=getVar($GLOBAL, "EXTENSION", "array", true))
if(!getVar($ext,"blocks")) error("missing dependency blocks in forms extension");

if($GLOBAL["FORM"]=POST("form")) {
  $error = "";
  if(!is_file("pages/forms/$GLOBALS[PAGE].php")) $error = "$GLOBALS[PAGE] form handler missing";
  else $error = trim(loadFile("pages/forms/$GLOBALS[PAGE].php"));
  if(!$error) exit(header("Refresh:0"));
  else error($error);
}
?>