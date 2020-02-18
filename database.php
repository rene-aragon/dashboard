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
      if ($result = $this->mysqli->query("select * from sensores where idNombreS = '$sensor' order by fecha desc limit $n"))
      {
        $i = 0;
        while($values[$i] = $result->fetch_assoc())
          $i++;

        $result->close();
        return $values;
      }
    }
}
?>
