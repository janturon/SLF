<?
  $GLOBALS["TEMPLATE"] = "";

  // global MODEL is set by load.php to work with database defined there
  // call /admin.php to run phpliteadmin
  $MODEL = new Model("data/sqlite/db/example-sqlite.db");

  $hours = $MODEL->querySingle("SELECT m2t(SUM(hm(hours))) FROM times");

  class MyModel extends Model {
    function getTime($rowid,$name) {
      $query = $this->buildQuery("SELECT hours FROM times WHERE rowid=%d AND name=%s", $rowid, $name);
      return $this->querySingle($query);
    }
  }
  $MODEL2 = new MyModel("data/sqlite/db/example-sqlite.db");
?>
<!DOCTYPE html>
<meta charset="UTF-8">

Total hours: <?=$hours?><br>

<table>
  <tr>
    <th>Name
    <th>Time
  <?foreach($MODEL->select("SELECT name,hours FROM times", "jméno :name", "čas :hours") as $name=>$time):?>
  <tr>
    <td><?=$name?>
    <td><?=$time?>
  <?endforeach?>
</table><br>

John's time <?=$MODEL2->getTime(1,"John")?>