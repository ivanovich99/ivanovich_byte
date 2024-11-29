import matplotlib.pyplot as plt
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg

class PlotManager:
    def __init__(self, frame_grafica, title="Gráfica", ylim=(0, 300), xlabel="Muestras", ylabel="Valores"):
        self.data_buffer = []
        self.tiempo = []
        self.title = title
        self.ylim = ylim
        self.xlabel = xlabel
        self.ylabel = ylabel
        self.fig, self.ax = plt.subplots()
        self.canvas = FigureCanvasTkAgg(self.fig, master=frame_grafica)
        self.canvas_widget = self.canvas.get_tk_widget()
        self.canvas_widget.pack(fill='both', expand=True)
        self._configurar_grafica()

    def _configurar_grafica(self):
        self.ax.set_ylim(self.ylim)
        self.ax.set_title(self.title, fontsize=35)
        self.ax.set_xlabel(self.xlabel, fontsize=20)
        self.ax.set_ylabel(self.ylabel, fontsize=20)
        self.ax.grid(True, linestyle='--', color='gray', alpha=0.7)
        self.ax.tick_params(axis='x', labelsize=20)
        self.ax.tick_params(axis='y', labelsize=20)

    def actualizar(self, value):
        # Validar que el valor sea un número antes de añadirlo
        if isinstance(value, list) and len(value) == 1:
            value = value[0]  # Desempaquetar si es una lista con un solo elemento
        if isinstance(value, (int, float)):
            self.data_buffer.append(value)
            self.tiempo.append(len(self.tiempo))
            self.ax.clear()
            self.ax.plot(self.tiempo, self.data_buffer, label="Muestras", color='blue')
            self._configurar_grafica()
            self.canvas.draw()
        else:
            print(f"Error: Valor inválido recibido para graficar: {value}")
