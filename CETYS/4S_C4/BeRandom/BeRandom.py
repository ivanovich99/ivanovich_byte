import tkinter as tk
import math as mt

# Simulacion Minis Menus 
def mostrar_campos():
    # Ocultar todos los cuadros de texto primero
    for widget in entry_frames:
        widget.pack_forget()
    
    # Mostrar cuadros de texto según la opción seleccionada
    if var_opcion.get() == 1:
        frame_bin.pack(pady=10)
    elif var_opcion.get() == 2:
        frame_hiper.pack(pady=10)
    elif var_opcion.get() == 3:
        frame_poiss.pack(pady=10)

# Boton Calcular cualquier distribucion 
def calcular():
    try:
        # DIST BINOMIAL 
        if var_opcion.get() == 1:
            # Obtener los valores de los cuadros de texto
            n = int(bin_n.get())  # Veces realiza experimento 
            p = float(bin_p.get())  # Probabilidad Exito 
            x = int(bin_x.get())  # Cantidad Exitos

            # Calcular distribucion 
            bin_resul = (mt.factorial(n) / (mt.factorial(x) * mt.factorial(n - x))) * (p ** x) * ((1 - p) ** (n - x))  
            
            # Mostrar el resultado en la etiqueta
            resul_bin.config(text=f"Resultado: {round(bin_resul, 4)} = {round(bin_resul * 100, 2)}%")

        # DIST HIPER
        elif var_opcion.get() == 2:
            # Obtener los valores de los cuadros de texto
            NN = int(hiper_NN.get())  # Tamaño Poblacion 
            n = int(hiper_n.get())  # Tamaño Muestra
            d = int(hiper_d.get())  # Numero Elementos Poblaicion Og Categoria Deseada
            x = int(hiper_x.get()) # Numero Elementos Pertenecientes Categoria 

            hiper_resul = ( mt.comb(d,x) * mt.comb(NN-d,n-x) ) / (mt.comb(NN,n))
            
            resul_hiper.config(text=f"Resultado: {round(hiper_resul, 4)} = {round(hiper_resul * 100, 2)}%")

        # DIST POISSON
        elif var_opcion.get() == 3:
            # Obtener los valores de los cuadros de texto
            lam = float(poiss_lam.get())  # Media Cant Veces Presenta Evento  
            x = int(poiss_x.get())  # Tamaño Muestra

            poss_resul = ((lam ** x) * (mt.exp(-1 * lam))) / (mt.factorial(x))

            resul_poiss.config(text=f"Resultado: {round(poss_resul, 4)} = {round(poss_resul * 100, 2)}%")

    except ValueError:
        # Manejar el caso en que el usuario no ingrese un número válido
        if var_opcion.get() == 1:
            resul_bin.config(text="ERROR DATOS INVÁLIDOS")
        elif var_opcion.get() == 2:
            resul_hiper.config(text="ERROR DATOS INVÁLIDOS")
        elif var_opcion.get() == 3:
            resul_poiss.config(text="ERROR DATOS INVÁLIDOS")
        
# Crear la ventana principal
root = tk.Tk()
root.geometry("450x480")  # Ancho x Alto en píxeles
root.title("BeRandom")  # Titulo 

# Crear los cuadros de texto y etiquetas
label0 = tk.Label(root, text="BeRandom")
label0.pack(pady=10)

# Crear un botón de verificación para controlar la visibilidad de los campos de texto
var_opcion = tk.IntVar()

radio1 = tk.Radiobutton(root, text="Distribución Binomial", variable=var_opcion, value=1, command=mostrar_campos)
radio1.pack(anchor=tk.W, pady=5)

radio2 = tk.Radiobutton(root, text="Distribución Hipergeométrica", variable=var_opcion, value=2, command=mostrar_campos)
radio2.pack(anchor=tk.W, pady=5)

radio3 = tk.Radiobutton(root, text="Distribución Poisson", variable=var_opcion, value=3, command=mostrar_campos)
radio3.pack(anchor=tk.W, pady=5)

# Crear frames para agrupar los cuadros de texto
frame_bin = tk.Frame(root)
frame_hiper = tk.Frame(root)
frame_poiss = tk.Frame(root)

# --- INICIO DIST BINOMIAL ---
# Frame para la información en frame_bin
info_frame_bin = tk.Frame(frame_bin)
info_frame_bin.grid(row=0, column=0, padx=5, pady=5)

tk.Label(info_frame_bin, text="n = Veces Realiza Experimento:").grid(row=0, column=0, padx=5, pady=5, sticky=tk.W)
tk.Label(info_frame_bin, text="p = Probabilidad de Exito").grid(row=1, column=0, padx=5, pady=5, sticky=tk.W)
tk.Label(info_frame_bin, text="x = Cantidad de Exitos").grid(row=2, column=0, padx=5, pady=5, sticky=tk.W)

# Frame para los cuadros de texto en frame_bin
entry_frame_bin = tk.Frame(frame_bin)
entry_frame_bin.grid(row=1, column=0, padx=5, pady=5)

# Agregar cuadros de texto al primer frame con grid
tk.Label(entry_frame_bin, text="n = ").grid(row=3, column=0, padx=5, pady=5, sticky=tk.W)
bin_n = tk.Entry(entry_frame_bin, width=30)
bin_n.grid(row=3, column=1, padx=5, pady=5)

tk.Label(entry_frame_bin, text="p = ").grid(row=4, column=0, padx=5, pady=5, sticky=tk.W)
bin_p = tk.Entry(entry_frame_bin, width=30)
bin_p.grid(row=4, column=1, padx=5, pady=5)

tk.Label(entry_frame_bin, text="x = ").grid(row=5, column=0, padx=5, pady=5, sticky=tk.W)
bin_x = tk.Entry(entry_frame_bin, width=30)
bin_x.grid(row=5, column=1, padx=5, pady=5)

# Boton hacer calculo 
btn_bin = tk.Button(entry_frame_bin, text="Calcular", command=calcular)
btn_bin.grid(row=6, column=0, padx=5, pady=5)

# Crear una etiqueta para mostrar el resultado en una columna aparte
resul_bin = tk.Label(entry_frame_bin, text="Resultado: ")
resul_bin.grid(row=6, column=1, padx=5, pady=5)
# --- FIN DIST BINOMIAL ---

# --- INICIO DIST HIPER ---
# Frame para la información en frame_hiper
info_frame_hiper = tk.Frame(frame_hiper)
info_frame_hiper.grid(row=0, column=0, padx=5, pady=5)

tk.Label(info_frame_hiper, text="N = Tamaño de Población").grid(row=0, column=0, padx=5, pady=5, sticky=tk.W)
tk.Label(info_frame_hiper, text="n = Tamaño Muestra Extraída").grid(row=1, column=0, padx=5, pady=5, sticky=tk.W)
tk.Label(info_frame_hiper, text="d = Numero Elementos Población Original Pertenecen Categoría Deseada").grid(row=2, column=0, padx=5, pady=5, sticky=tk.W)
tk.Label(info_frame_hiper, text="x = Numero Elementos En Muestra Pertenecientes a Categoría").grid(row=3, column=0, padx=5, pady=5, sticky=tk.W)

# Frame para los cuadros de texto en frame_hiper
entry_frame_hiper = tk.Frame(frame_hiper)
entry_frame_hiper.grid(row=1, column=0, padx=5, pady=5)

# Agregar cuadros de texto al primer frame con grid
tk.Label(entry_frame_hiper, text="N = ").grid(row=3, column=0, padx=5, pady=5, sticky=tk.W)
hiper_NN = tk.Entry(entry_frame_hiper, width=30)
hiper_NN.grid(row=3, column=1, padx=5, pady=5)

tk.Label(entry_frame_hiper, text="n = ").grid(row=4, column=0, padx=5, pady=5, sticky=tk.W)
hiper_n = tk.Entry(entry_frame_hiper, width=30)
hiper_n.grid(row=4, column=1, padx=5, pady=5)

tk.Label(entry_frame_hiper, text="d = ").grid(row=5, column=0, padx=5, pady=5, sticky=tk.W)
hiper_d = tk.Entry(entry_frame_hiper, width=30)
hiper_d.grid(row=5, column=1, padx=5, pady=5)

tk.Label(entry_frame_hiper, text="x = ").grid(row=6, column=0, padx=5, pady=5, sticky=tk.W)
hiper_x = tk.Entry(entry_frame_hiper, width=30)
hiper_x.grid(row=6, column=1, padx=5, pady=5)

# Boton hacer calculo 
btn_hiper = tk.Button(entry_frame_hiper, text="Calcular", command=calcular)
btn_hiper.grid(row=7, column=0, padx=5, pady=5)

# Crear una etiqueta para mostrar el resultado en una columna aparte
resul_hiper = tk.Label(entry_frame_hiper, text="Resultado: ")
resul_hiper.grid(row=7, column=1, padx=5, pady=5)

# -- FIN DIST HIPER ---

# --- INICIO DIST POISSON ---
# Frame para la información en frame_poiss
info_frame_poiss = tk.Frame(frame_poiss)
info_frame_poiss.grid(row=0, column=0, padx=5, pady=5)

tk.Label(info_frame_poiss, text="λ = Media De Cantidad de Veces Presenta Evento En Intervalo de Población").grid(row=0, column=0, padx=5, pady=5, sticky=tk.W)
tk.Label(info_frame_poiss, text="x = Numero De Veces Presenta Evento").grid(row=1, column=0, padx=5, pady=5, sticky=tk.W)

# Frame para los cuadros de texto en frame_poiss
entry_frame_poiss = tk.Frame(frame_poiss)
entry_frame_poiss.grid(row=1, column=0, padx=5, pady=5)

# Agregar cuadros de texto al primer frame con grid
tk.Label(entry_frame_poiss, text="λ = ").grid(row=3, column=0, padx=5, pady=5, sticky=tk.W)
poiss_lam = tk.Entry(entry_frame_poiss, width=30)
poiss_lam.grid(row=3, column=1, padx=5, pady=5)

tk.Label(entry_frame_poiss, text="x = ").grid(row=4, column=0, padx=5, pady=5, sticky=tk.W)
poiss_x = tk.Entry(entry_frame_poiss, width=30)
poiss_x.grid(row=4, column=1, padx=5, pady=5)

# Boton hacer calculo 
btn_poiss = tk.Button(entry_frame_poiss, text="Calcular", command=calcular)
btn_poiss.grid(row=5, column=0, padx=5, pady=5)

# Crear una etiqueta para mostrar el resultado en una columna aparte
resul_poiss = tk.Label(entry_frame_poiss, text="Resultado: ")
resul_poiss.grid(row=5, column=1, padx=5, pady=5)

# --- FIN DIST POISSON ---

# Almacenar los frames en una lista para facilitar su manejo
entry_frames = [frame_bin, frame_hiper, frame_poiss]

# Ejecutar el bucle principal de la aplicación
root.mainloop()
