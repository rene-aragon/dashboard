<?php
  include 'database.php';
  $DB = new dataBase();

  $f = $_REQUEST["f"];
  $p = $_REQUEST["p"];

  switch ($f)
  {
    case 0:
      echo $DB->getLastValueOf($p);
    break;

    case 1:
      echo $DB->getLastNValuesOf(5,"allsensors");
    break;

    case 2:
      echo $DB->getChartValues(5,$p);
    break;

    case 3:
      echo $DB->getValuesByDate($p);
    break;

    default:
      echo "error";
    break;
  }
?>
