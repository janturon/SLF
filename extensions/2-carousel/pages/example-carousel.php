<!DOCTYPE html>
<meta charset="UTF-8">
<style>
  <? include "client/carousel.css"?>
</style>
<script>
  <? include "client/carousel.js"?>
</script>
<?=html::carousel(574, 330, array(
  ["client/example/carousel/yes.png","index.php","I vote Yes!"],
  ["client/example/carousel/no.png","index.php","I vote No!"]
))?>