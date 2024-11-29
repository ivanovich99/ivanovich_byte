import serial
import time

class SerialHandler:
    def __init__(self, port='COM3', baudrate=9600, timeout=1):
        self.ser = serial.Serial(port=port, baudrate=baudrate, timeout=timeout)

    # Lee datos del puerto serial 
    def leer_datos(self):
        if self.ser.in_waiting > 0:
            return self.ser.read(self.ser.in_waiting)
        return b''

    # Cerrar el puerto serial 
    def cerrar(self):
        self.ser.close()

    @staticmethod
    # Procesa los datos recibidos del puerto serial y devuelve una lista de valores flotantes.
    def procesar_datos(datos):
        try:
            # texto sin codificar 
            # print(datos)
            
            texto = datos.decode('utf-8').strip()
            # print(texto)
            valores = [float(v) for v in texto.split() if v.replace('.', '').isdigit()]
            return valores
        except Exception as e:
            print(f"Error al procesar datos: {e}")
            return []
