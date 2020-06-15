#define GAS_PIN A1


// Incluimos librería
#include <DHT.h>
 
// Definimos el pin digital donde se conecta el sensor
#define DHTPIN 2
// Dependiendo del tipo de sensor
#define DHTTYPE DHT11
 
// Inicializamos el sensor DHT11
DHT dht(DHTPIN, DHTTYPE);



void setup() {
  Serial.begin(9600);
    // Comenzamos el sensor DHT
  dht.begin();
}

int analogValue = -1;
int s_analogica_mq135=0;

//Es como se encuentran em la base de datos
//1=CO2 
//2=Metano
//3=Temperatura
//4=Humedad

void loop() {
  int analogNew = analogRead(GAS_PIN);
  //Serial.println(String("gas: ") + analogNew);
  
 //del mq135 el pin A0
  s_analogica_mq135 = analogRead(A0);       
  //Serial.println(String("CO2: ") + s_analogica_mq135);
  
  
//El pin de datos del sensor de temperatura es  el pin numero 2

    // Esperamos 5 segundos entre medidas
  
  // Leemos la humedad relativa
  float h = dht.readHumidity();
  // Leemos la temperatura en grados centígrados (por defecto)
  float t = dht.readTemperature();
  // Leemos la temperatura en grados Fahrenheit
  float f = dht.readTemperature(true);
 
  // Comprobamos si ha habido algún error en la lectura
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Error obteniendo los datos del sensor DHT11");
    return;
  }



//Es como se encuentran em la base de datos
//1=CO2 
//2=Metano
//3=Temperatura
//4=Humedad

  
 //SE TIENE QUE ESPESIFICAR EL NOMBRE O IDENTIFICACION DEL LUGAR QUE SE ESTA SENSANDO EN ESTE CASO "CHIGNAUAPAN"
 
  Serial.println(String("{'place':'CHIGNAHUAPAN','Metano':") + analogNew + String(",'CO2':") + s_analogica_mq135 + String(",'Humedad':") + h + String(",'Temperatura':") + t + String("}") );
  delay(900000);
 
 
}
