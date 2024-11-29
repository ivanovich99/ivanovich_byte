import matplotlib.pyplot as plt
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg

class PlotManager:
    def __init__(self, frame_grafica):
        self.data_buffer = []
        self.tiempo = []
        self.fig, self.ax = plt.subplots()
        self.canvas = FigureCanvasTkAgg(self.fig, master=frame_grafica)
        self.canvas_widget = self.canvas.get_tk_widget()
        self.canvas_widget.pack(fill='both', expand=True)
        self._configurar_grafica()

    
    # Configura los parámetros iniciales de la gráfica.
    def _configurar_grafica(self):
        self.ax.set_ylim(0, 300)
        self.ax.set_title("Medición de pH en Tiempo Real",  fontsize=35)
        self.ax.set_xlabel("Muestras",  fontsize=20)
        self.ax.set_ylabel("pH",  fontsize=20)
        self.ax.grid(True, linestyle='--', color='gray', alpha=0.7)
        self.ax.tick_params(axis='x', labelsize=20) 
        self.ax.tick_params(axis='y', labelsize=20)  


    # Actualiza la gráfica con un nuevo valor de pH.
    def actualizar(self, ph_value):
        self.data_buffer.append(ph_value)
        self.tiempo.append(len(self.tiempo))
        self.ax.clear()
        self.ax.plot(self.tiempo, self.data_buffer, label="pH", color='blue')
        self._configurar_grafica()
        self.canvas.draw()
