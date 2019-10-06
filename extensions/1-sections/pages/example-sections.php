<?
  $GLOBALS["TEMPLATE"] = "";

  $data = array(
    "name" => "Jan Turoň",
    "year" => "2019",
    "contact" => "janturon.cz"
  );
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<style>
  <? include "client/section-footer.css" ?>
</style>
<?=section::footer($data)?>
