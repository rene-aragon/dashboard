<?php

putenv(
    'GOOGLE_APPLICATION_CREDENTIALS=D:\Documentos\GitHub\dashboard\firebaseconfig.json'
    );
    require_once 'vendor/autoload.php';
    use Google\Cloud\Firestore\FirestoreClient;
    //use Google\Cloud\Core\Timestamp; //para sacar el formato de fecha de google
    

class MyFirestore{
    
    private $db = null;
    
    public function __construct()
    {
        // Create the Cloud Firestore client
        $this->db = new FirestoreClient();
        if($this->db == null)
        {
            echo"Error al conectar con Firebase";
            exit();
        }/*else{        
            //printf('Created Cloud Firestore client with default project ID.' . PHP_EOL);
        }//*/
    }
    
    public function subeDatos(){
        $db=$this->db;
        
        $lastId = $this->getLastId()+1;
        $docID = $lastId;

        $co2 = 10;
        $temperatura = 10;
        $metano = 10;
        $humedad = 10;
        $fecha = date("Y-m-d h:i:s",strtotime("now"));//new Timestamp(new DateTime());
    
        $docRef = $db->collection('Sensores')->document($docID);
        $docRef->set([
            'co2' => $co2,
            'temperatura' => $temperatura,
            'metano' => $metano,
            'humedad' => $humedad,
            'fecha' => $fecha
        ]);
        $this->refreshEnvirioment($lastId,$valor,$co2,$temperatura,$metano,$humedad);
        printf('Added data to the '.$docID.' document in the users collection.' . PHP_EOL);
    }    
    
    private function refreshEnvirioment($lastId,$lastValue,$co2,$temperatura,$metano,$humedad)
    {
        $db=$this->db;
        $docID = 'UltimosValores';
        $fecha = new Timestamp(new DateTime());
    
        $docRef = $db->collection('IndicesDeEntorno')->document($docID);
        $docRef->set([
            'ID' => $lastId,
            'co2' => $co2,
            'temperatura' => $temperatura,
            'metano' => $metano,
            'humedad' => $humedad,
        ]);
    }

    public function muestraDatos(){
        //echo('<br>');
        $db = new FirestoreClient();
        $usersRef = $db->collection('Sensores');
        $snapshot = $usersRef->documents();
        foreach ($snapshot as $user) {
            printf('User: %s <br>' . PHP_EOL, $user->id());
            
            printf('co2: %d' . PHP_EOL, $user['co2']);
            if (!empty($user['humedad'])) {
                printf('humedad: %s' . PHP_EOL, $user['humedad']);
            }
            printf('valor: %d' . PHP_EOL, $user['temperatura']);
            printf('valor: %d' . PHP_EOL, $user['metano']);
            printf('Fecha: %s' . PHP_EOL, $user['fecha']);
            printf(PHP_EOL);
            echo('<br>');
        }
        printf('Retrieved and printed out all documents from the users collection.' . PHP_EOL);
    }

    public function getValuesByDate($dateQuery)// NOT OK
    {
        $table="";
        $inicio = substr($dateQuery,-40,16);
        $fin = substr($dateQuery,-17,16);
        $db = new FirestoreClient();
        $usersRef = $db->collection('Sensores')
        ->where("fecha", ">=", $inicio)
        ->where("fecha", "<=", $fin)
        ->orderBy("fecha", "desc");
        $snapshot = $usersRef->documents();
        foreach($snapshot as $user)
        {
            $table .= "<tr>
            <td>".date("d-m-Y",strtotime($user['fecha']))."</td>
            <td>".date("h:i",strtotime($user['fecha']))."</td>
            <td>".$user['temperatura']." °C</td>
            <td>".$user['metano']." ppm</td>
            <td>".$user['co2']." ppm</td>";
            if (!empty($user['humedad'])) {
            $table .="
            <td>".$user['humedad']."</td>
            </tr>";
            }else{
            $table .="
            <td> </td>
            </tr>";
            }
        }
        return $table;
    }

    public function getLastValueOf($sensor)//OK
    {
        $db = new FirestoreClient();
        $usersRef = $db->collection('IndicesDeEntorno');
        $snapshot = $usersRef->documents();   
        foreach ($snapshot as $user) {
            if (!empty($user[$sensor])) {
                return $user[$sensor];
            }
            return'--';
        }
        //printf('Retrieved and printed out all documents from the users collection.' . PHP_EOL);
    }

    public function getLastNValuesOf($n, $sensor)//OK
    {
        if($sensor == "allsensors")
        {

            $table = "";
            $db = new FirestoreClient();
            $usersRef = $db->collection('Sensores')->orderBy("fecha", "desc")->limit($n);
            $snapshot = $usersRef->documents();
            
            foreach($snapshot as $user)
            {
                $table .= "<tr>
                <td>".date("d-m-Y",strtotime($user['fecha']))."</td>
                <td>".date("h:i",strtotime($user['fecha']))."</td>
                <td>".$user['temperatura']." °C</td>
                <td>".$user['metano']." ppm</td>
                <td>".$user['co2']." ppm</td>";
                if (!empty($user['humedad'])) {
                    $table .="
                    <td>".$user['humedad']."</td>
                    </tr>";
                    }else{
                    $table .="
                    <td> </td>
                    </tr>";
                    }
                $n = $n-1;
                if($n<0){
                    return $table;
                }
            }
            return $table;
        }

        try{
            $db = new FirestoreClient();
            $usersRef = $db->collection('Sensores')->orderBy("fecha", "desc");
            $snapshot = $usersRef->documents();
            $i = 0;
            foreach($snapshot as $user)
            {
                $values[$i] = $user[$sensor];
                echo "<script>console.log('XD')</script>";

                $i++;
                if($i>=$n)
                {
                    return $values;
                }
            }
        }catch(Exeption $e){
            echo($e->getMessage());
            return null;
        }
    }
    
    public function getChartValues($n,$sensor)//NOT OK
    {
        $db = new FirestoreClient();
        $usersRef = $db->collection('Sensores')->orderBy("fecha", "desc")->limit($n);
        $snapshot = $usersRef->documents();
        $i=0;
        foreach ($snapshot as $user) {
            if (!empty($user[$sensor])) {
                $res[$i]=$user;
                $i++;
            }
        }

        for ($a=$n-1; $a >=0 ; $a--)
            $val[] = date("h:i",strtotime($res[$a]['fecha']));
        
        for ($a=$n-1; $a >=0 ; $a--)
            $val[] = $res[$a][$sensor];
        
        return implode(",",$val);        
    }

    private function getLastId()
    {
        $db = new FirestoreClient();
        $usersRef = $db->collection('IndicesDeEntorno');
        $snapshot = $usersRef->documents();
        foreach ($snapshot as $user) {
            if (!empty($user['ID'])) {
                return $user['ID'];
            }
            return'0';
        }
        printf('Retrieved and printed out all documents from the users collection.' . PHP_EOL);
    }
}
