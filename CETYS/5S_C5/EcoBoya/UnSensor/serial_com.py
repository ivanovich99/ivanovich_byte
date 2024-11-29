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

        print("Inicio")
        # Arreglo dos entradas, [0] = pH, [1] = TDS
        print(datos)
        try: 
            texto = datos.decode('utf-8').strip() 
            print(texto)

            lineas = texto.split('\r') 

            print(lineas, "-", len(lineas))

            valores = []
            for linea in lineas:  # Procesar líneas completas
                linea = linea.strip()
                if linea:
                    try:
                        valores.append(float(linea) if '.' in linea else int(linea))
                    except ValueError:
                        print(f"Error: {linea}")
            
            print(f"{valores} - {len(valores)}")

            # Forzar tamaño 2
            while len(valores) < 2:
                valores.append(None)  # Rellenar con None si faltan elementos
            if len(valores) > 2:
                valores = valores[:2]  # Mantener solo los dos primeros elementos
            
            # Ordenar por tipo de dato: float primero (pH), int después (TDS)
            if isinstance(valores[1], float) and isinstance(valores[0], int):
                valores = [valores[1], valores[0]]

            print(f"{valores} - {len(valores)}")
            print("Fin\n")
            
            # Regresa lista con dos valores, uno ph y otro TDS
            return valores


        except Exception as e: 
            print(f"Error {e}") 
            return [], []
