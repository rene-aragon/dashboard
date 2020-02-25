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

    public function getAllValuesOf($sensor, $date)
    {
      if ($result = $this->mysqli->query("select * from sensores where idNombreS = '$sensor' and cast(fecha as date) = '$date' order by fecha desc"))
      {
        $i = 0;
        while($values[$i] = $result->fetch_assoc())
          $i++;

        $result->close();
        return $values;
      }
    }

    public function getLastValueOf($sensor)
    {
      if ($result = $this->mysqli->query("select valor from sensores where idNombreS = '$sensor' order by fecha desc limit 1"))
      {
        $row = $result->fetch_assoc();
        $result->close();

        return $row['valor'];
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
