import tkinter as tk
from tkinter import ttk, messagebox
import threading
import time
from serial_com import SerialHandler
from plot_utils import PlotManager

# Variables globales
lectura_activa = True

# Para que todos sepan cuales fueron los ultimos dos valores 
valores_sensor_1 = 0
valores_sensor_2 = 0

# Inicialización de clases
serial_handler = SerialHandler(port='COM3', baudrate=9600)

# Creacion de Interfaz
root = tk.Tk()
root.title("Monitor de Sensores")
root.geometry("1950x1000")

# Funciones principales
def iniciar_lectura():
    global lectura_activa
    lectura_activa = True
    threading.Thread(target=leer_datos, daemon=True).start()

def leer_datos():
    global lectura_activa
    while lectura_activa:
        datos = serial_handler.leer_datos()
        lecturas = serial_handler.procesar_datos(datos)
        if lecturas:
            # Dividir los valores para cada sensor
            valores_sensor_1 = [lecturas[0]]  # Valores del primer sensor (por ejemplo, pH)
            valores_sensor_2 = [lecturas[1]]  # Valores del segundo sensor (por ejemplo, otro parámetro)

            # Actualizar ambas gráficas con los valores correspondientes
            plot_manager_1.actualizar(valores_sensor_1)
            plot_manager_2.actualizar(valores_sensor_2)
            print("")

        time.sleep(1)

def mostrar_ultimo_valor():
    if plot_manager_1.data_buffer and plot_manager_2.data_buffer:
        ultimo_valor_1 = float(plot_manager_1.data_buffer[-1])
        ultimo_valor_2 = float(plot_manager_2.data_buffer[-1])

        print(ultimo_valor_1, "-", ultimo_valor_2)

         # Verificar si los últimos valores son números antes de mostrar
        if ultimo_valor_1 is not None and ultimo_valor_2 is not None:
            # Mostrar los últimos valores de cada sensor
            messagebox.showinfo(
                "Últimos Valores",
                f"Sensor pH: {ultimo_valor_1} pH\nSensor TDS: {ultimo_valor_2} ppm",
            )
        else:
            messagebox.showwarning("Advertencia", "Uno de los valores es None.")
    else:
        messagebox.showwarning("Advertencia", "No hay datos disponibles.")

# Organizar los frames
# Frames para las gráficas
frame_grafica_1 = tk.Frame(root)
frame_grafica_2 = tk.Frame(root)

# Creación del marco principal para las gráficas
frame_graficas = tk.Frame(root,width=3500, height=1000,)
frame_graficas.pack(fill=tk.BOTH, expand=True)

# Marco para la gráfica del Sensor 1 (izquierda)
frame_grafica_1 = tk.Frame(frame_graficas, width=1200, height=700, bg="white")
frame_grafica_1.pack(side=tk.LEFT, padx=10, pady=10, fill=tk.BOTH, expand=True)

# Marco para la gráfica del Sensor 2 (derecha)
frame_grafica_2 = tk.Frame(frame_graficas, width=1200, height=700, bg="white")
frame_grafica_2.pack(side=tk.RIGHT, padx=10, pady=10, fill=tk.BOTH, expand=True)

# Instanciación de las gráficas
plot_manager_1 = PlotManager(
    frame_grafica=frame_grafica_1,
    title="Sensor pH",
    ylim=(0, 14),
    xlabel="Muestras",
    ylabel="pH"
)

plot_manager_2 = PlotManager(
    frame_grafica=frame_grafica_2,
    title="Sensor TDS",
    ylim=(0, 250),
    xlabel="Muestras",
    ylabel="TDS ppm"
)

# Marco para los botones (debajo de las gráficas)
frame_botones = tk.Frame(root)
frame_botones.pack(fill=tk.X, pady=10)

# Submarco para centrar los botones horizontalmente
sub_frame_botones = tk.Frame(frame_botones)
sub_frame_botones.pack(pady=5)

btn_mostrar_valor = tk.Button(sub_frame_botones, 
                              text="Mostrar Último Valor", 
                              command=mostrar_ultimo_valor,
                              bg="#c2ca10", 
                            fg="white", 
                            font=("Arial", 20, "bold"),
                            width=100,
                            height=2,
                            cursor="hand2",
                            activebackground= "#c2ca10",
                            activeforeground= "white",
                            disabledforeground="white",
                            relief="raised", borderwidth=7)
btn_mostrar_valor.pack(side=tk.LEFT, padx=5)

# Iniciar la aplicación
iniciar_lectura()
root.mainloop()
serial_handler.cerrar()
