<?

// after form data are sent, the page is refreshed to avoid data resend by F5
// see load.php
switch($FORM) {
case "select":
case "text":
case "choice":
  ob_start();
    print_r($_POST);
    $_SESSION["data"] = ob_get_contents();
  ob_end_clean();
break;
case "files":
  ob_start();
    print_r($_FILES);
    $_SESSION["data"] = ob_get_contents();
  ob_end_clean();
break;
}
?>