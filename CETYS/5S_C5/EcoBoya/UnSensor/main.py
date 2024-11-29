import tkinter as tk
from tkinter import ttk, messagebox
import threading
import time
from serial_com import SerialHandler
from plot_utils import PlotManager

# Variables globales
lectura_activa = False

# Inicialización de clases
serial_handler = SerialHandler(port='COM3', baudrate=9600)

# Creacion de Interfaz
root = tk.Tk()
root.title("Monitor de pH")
root.geometry("1950x1000")
plot_manager = PlotManager(frame_grafica=tk.Frame(root))

# Funciones principales
def iniciar_lectura():
    global lectura_activa
    lectura_activa = True
    btn_iniciar.config(state=tk.DISABLED)
    btn_pausar.config(state=tk.NORMAL)
    threading.Thread(target=leer_datos, daemon=True).start()

def pausar_lectura():
    global lectura_activa
    lectura_activa = False
    btn_iniciar.config(state=tk.NORMAL)
    btn_pausar.config(state=tk.DISABLED)

def leer_datos():
    global lectura_activa
    while lectura_activa:
        datos = serial_handler.leer_datos()
        valores = serial_handler.procesar_datos(datos)
        if valores:
            ph_value = valores[0]
            if 0 <= ph_value <= 300:
                plot_manager.actualizar(ph_value)
        time.sleep(1)

def mostrar_ultimo_valor():
    if plot_manager.data_buffer:
        ultimo_valor = plot_manager.data_buffer[-1]
        messagebox.showinfo("Último Valor", f"Último valor leído: {ultimo_valor:.2f} pH")
    else:
        messagebox.showwarning("Advertencia", "No hay datos disponibles.")

# Interfaz gráfica
frame_grafica = plot_manager.canvas_widget.master
frame_grafica.pack(fill=tk.BOTH, expand=True)

# Interfaz de botones 
frame_botones = tk.Frame(root)
frame_botones.pack(pady=10)

btn_iniciar = tk.Button(frame_botones, 
                        text="Iniciar Lectura", 
                        command=iniciar_lectura, 
                        bg="#2aa50f", 
                        fg="white", 
                        font=("Arial", 20, "bold"),
                        width=30,
                        height=2,
                        cursor="hand2",
                        activebackground="#2aa50f",
                        activeforeground= "white",
                        disabledforeground="white",
                        relief="raised", borderwidth=7)
btn_iniciar.grid(row=0, column=0, padx=10)

btn_pausar = tk.Button(frame_botones, 
                       text="Pausar Lectura", 
                       command=pausar_lectura, 
                       bg="#a50f0f", 
                       fg="white", 
                        font=("Arial", 20, "bold"),
                        width=30,
                        height=2,
                        cursor="hand2",
                        activebackground= "#a50f0f",
                        activeforeground= "white",
                        disabledforeground="white",
                        relief="raised", borderwidth=7)
btn_pausar.grid(row=0, column=1, padx=10)

btn_mostrar_valor = tk.Button(frame_botones, 
                              text="Mostrar Último Valor", 
                              command=mostrar_ultimo_valor,
                              bg="#c2ca10", 
                            fg="white", 
                            font=("Arial", 20, "bold"),
                            width=30,
                            height=2,
                            cursor="hand2",
                            activebackground= "#c2ca10",
                            activeforeground= "white",
                            disabledforeground="white",
                            relief="raised", borderwidth=7)
btn_mostrar_valor.grid(row=0, column=2, padx=10)

# Iniciar la aplicación
root.mainloop()
serial_handler.cerrar()
