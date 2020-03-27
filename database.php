<?php
class dataBase
{
    public $mysqli;

    public function __construct()
    {
      $this->mysqli = new mysqli("127.0.0.1", "rene", "rene", "registro");
      if ($this->mysqli->connect_errno)
      {
        echo"Falló la conexión: $this->mysqli->connect_error";
        exit();
      }
    }

    public function getValuesByDate($dateQuery)
    {
      $sensor1 = $this->mysqli->query($dateQuery." AND idNombreS='Sensor1'");
      $sensor2 = $this->mysqli->query($dateQuery." AND idNombreS='Sensor2'");
      $sensor3 = $this->mysqli->query($dateQuery." AND idNombreS='Sensor3'");
      $table = "";

      if ($sensor1 AND $sensor2 AND $sensor3)
      {
        $s1 = $sensor1->fetch_assoc();
        $s2 = $sensor2->fetch_assoc();
        $s3 = $sensor3->fetch_assoc();

        if(!($s1 AND $s2 AND $s3))
          return "<tr><td>Sin resultados</td></tr>";

        while($s1 AND $s2 AND $s3)
        {
          $table .= "<tr><td>".date("d-m-Y",strtotime($s1['fecha']))."</td><td>".date("h:i",strtotime($s1['fecha']))."</td><td>".$s1['valor']." °C</td><td>".$s2['valor']." ppm</td><td>".$s3['valor']." ppm</td></tr>";
          $s1 = $sensor1->fetch_assoc();
          $s2 = $sensor2->fetch_assoc();
          $s3 = $sensor3->fetch_assoc();
        }
      }

      return $table;
    }

    public function getLastValueOf($sensor)
    {
      if ($result = $this->mysqli->query("select valor from sensores where idNombreS = '$sensor' order by fecha desc limit 1"))
      {
        $row = $result->fetch_assoc();
        $result->close();

        return (isset($row["valor"])) ? $row["valor"] : "0";
      }

      return "--";
    }

    public function getLastNValuesOf($n, $sensor)
    {
      if($sensor == "allsensors")
      {
        $table = "";
        $tmp = $this->getLastNValuesOf($n,"Sensor1");
        $ch4 = $this->getLastNValuesOf($n,"Sensor2");
        $co2 = $this->getLastNValuesOf($n,"Sensor3");

        $n = ((sizeof($tmp)-1)<$n) ? (sizeof($tmp)-1) : $n;

        for($a=0; $a<$n; $a++)
        {
          $table .= "<tr><td>".date("h:i",strtotime($tmp[$a]['fecha']))."</td><td>".$tmp[$a]['valor']." °C</td><td>".$ch4[$a]['valor']." ppm</td><td>".$co2[$a]['valor']." ppm</td></tr>";
        }
        return $table;
      }

      if ($result = $this->mysqli->query("select * from sensores where idNombreS = '$sensor' order by fecha desc limit $n"))
      {
        $i = 0;
        while($values[$i] = $result->fetch_assoc())
          $i++;

        $result->close();
        return $values;
      }

    }

    public function getChartValues($n,$sensor)
    {
      if ($result = $this->mysqli->query("select * from sensores where idNombreS = '$sensor' order by fecha desc limit $n"))
      {
        $i = 0;
        while($res[$i] = $result->fetch_assoc())
          $i++;

        for($a=$n; $a>=0; $a--)
          $val[] = date("h:i",strtotime($res[$a]['fecha']));

        for($a=$n; $a>=0; $a--)
          $val[] = $res[$a]['valor'];

        $result->close();
        return implode(",",$val);
      }
    }
}
?>
