import serial
from datetime import datetime
import mysql.connector



#definimos los IDs de los sensores que se van a ocupar en este caso Humedad, Temperatura, CO2, Metano.
idsSensores={}

dbConect={
    'host' : 'localhost',
    'user' : 'root',
    'password': '',
    'database': 'pasaromorir'
}

conexion = mysql.connector.connect(**dbConect)
cursor=conexion.cursor()


#sqlinser que se utilizaron
sqlNuevaLectura="insert into sensores(idNombreS, valor, fecha) VALUES ('%s', '%s', '%s')"
# idSensor
# idNombreS
# valor
# fecha
 
ser= serial.Serial('COM7', 9600)
encoding = 'utf-8'
var1=0

#tamaño de la consulta para verificar si ya se ha dado de  alta
ubicacion=0








print("se inicia  con la subida de los datos a la base")
while True:
    #Se comienza con la  lectura de los  valores de los sensores
    string = str(ser.readline(),encoding)
    print(string)
    
    today = datetime.now()
    formatted_date = today.strftime('%Y-%m-%d %H:%M:%S')
    


    cursor.execute(sqlNuevaLectura % ('Sensor2', str(eval(string)['Metano']), formatted_date))
    cursor.execute(sqlNuevaLectura % ('Sensor3', str(eval(string)['CO2']), formatted_date))
    cursor.execute(sqlNuevaLectura % ('Sensor1', str(eval(string)['Temperatura']), formatted_date))
    cursor.execute(sqlNuevaLectura % ('Sensor4', str(eval(string)['Humedad']), formatted_date))


    conexion.commit()
