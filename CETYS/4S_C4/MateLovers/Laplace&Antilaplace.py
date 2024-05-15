import random

cantPrg = 3
cntBuenas = 0
luck = False
indxPosiRes = 0
opcUsuario = 0

posiNum = []
posiDen = []
posiRes = ["","","",""]
posiPrg = []
posiNumTemp = [] # Temporal de posible respuesta en anti laplace

# Guarda preguntas hechas y respuestas random
arStrPosiPrg = []

# Guarda preguntas en texto y en que index estan
arIndxBuena = []
arStrBuena = []

# Guardan respuestas de index de usuario y texto
arStrUsuario = []
arIndxUsuario = []

# Guarda en cuales difirio con indx de buena para resumen final
arIndxMalas = []

# Verifica que no se repitan respuestas, especialmente en anti laplace
arRndResp = []

posiNum.clear()

# Menu Principal Dos Opciones
#   Sección Tutorial
#     Despliegue texto y formulas para que aprenda a jugar
#   Sección MateLovers Individual/Grupal
#     Laplace

while(opcUsuario != 4):
  print("")
  print("BIENVENIDO A MATELOVERS")
  print("1) Laplace")
  print("2) Anti Laplace")
  print("3) Tutorial")
  print("4) Salir")
  opcUsuario = int(input("Opcion: "))

  # Limpieza variables/listas
  posiNum.clear()
  posiDen.clear()
  posiRes = ["","","",""]
  arStrPosiPrg.clear()
  arIndxBuena.clear()
  arStrBuena.clear()
  arStrUsuario.clear()
  arIndxUsuario.clear()
  arIndxMalas.clear()
  arRndResp.clear()
  posiNumTemp.clear()
  cntBuenas = 0
  indxPosiRes = 0

  if(opcUsuario == 1):
    print("")
    print("Laplace")


    # Ciclo 10 preguntas
    for i in range (0, cantPrg):
      # Valor Random entero y string
      nRndInt = int(random.uniform(1, 10))
      nRndStr = str(nRndInt)

      # Posibles preguntas por hacer
      # L{k}, L{t^n}, L{e^kt}, L{sin(kt)}, L{cos(kt)}, L{sinh(kt)}, L{cosh(kt)}
      posiPrg = [nRndStr, f"t^{nRndStr}", f"e^{nRndStr}t", f"sin({nRndStr}t)",  f"cos({nRndStr}t)",f"sinh({nRndStr}t)",  f"cosh({nRndStr}t)"]

      # Valor random que eligira cual operacion sera numero random pregunta
      nRndPrg = int(random.uniform(0, 7))

      # Depende el caso, será el resultado, entonces un swithc para poder definir el resultado correcto que sera utilizado
      # L{k} = k/s
      if nRndPrg == 0:
        arStrBuena.append(f"{nRndStr} / s")
      # L{t^n} = n!/s^n+1
      elif nRndPrg == 1:
        arStrBuena.append(f"{nRndStr}! / s^{str(nRndInt+1)}")
      # L{e^kt} = 1/s-k
      elif nRndPrg == 2:
        arStrBuena.append(f"1 / s - {nRndStr}")
      # L{sin(kt)} = k/s^2+k^2
      elif nRndPrg == 3:
        arStrBuena.append(f"{nRndStr} / s^2 + {str(nRndInt**2)}")
      # L{cos(kt)} = s/s^2+k^2
      elif nRndPrg == 4:
        arStrBuena.append(f"s / s^2 + {str(nRndInt**2)}")
      # L{sinh(kt)} = k/s^2-k^2
      elif nRndPrg == 5:
        arStrBuena.append(f"{nRndStr} / s^2 - {str(nRndInt**2)}")
      # L{cosh(kt)} = s/s^2-k^2
      elif nRndPrg == 6:
        arStrBuena.append(f"s / s^2 - {str(nRndInt**2)}")

      # PREGUNTA QUE CONTESTARA USUARIO
      # print(f"{i}. L{ {posiPrg[nRndPrg]} } = ¿?")
      print(str(i+1) + ". L{" + posiPrg[nRndPrg] + "} = ¿?")

      # Registro de preguntas realizadas en iteraccion, para apartado de comparar las malas
      arStrPosiPrg.append("L{" + posiPrg[nRndPrg] + "}")

      # Posibles respuestas numerador con base a nRnd
      posiNum = ["1", f"{nRndStr}!", nRndStr, "s"]

      # Posibles respuestas denominador con base a nRnd
      posiDen = ["s", f"s^{ str(nRndInt+1) }", f"s + {nRndStr}", f"s - {nRndStr}" , f"s^2 + {str(nRndInt**2)}", f"s - {str(nRndInt**2)}"]

      # Cada nuevas respuestas random que no se tiene suerte
      luck = False

      # Ciclo donde se unen posibles respuestas
      for k in range(4):
        # Une ambas posibildades todo random, tanto numerador como denominador
        posiRes[k] = posiNum[k] + " / " + posiDen[int(random.uniform(0, 6))]

        # Si algun valor de posibles respuestas ya se genero respuesta, guardarlo
        if(posiRes[k] == arStrBuena[i]):
          indxBuena = k
          # Guardara la posicion/opcion de la respuesta correcta para luego comparar con eleccion usuario
          arIndxBuena.append(indxBuena)

          # Si llego increible caso donde se tuvo suerte que respuestas random dieron respuesta verdadera
          luck = True
        # Si ya va en el ultimo y no tuvo suerte de hacerse random
        elif(k == 3 and luck == False):
          # En que lugar se encuentra la respuesta correcta
          indxBuena = int(random.uniform(0, 4))
          posiRes[indxBuena] = arStrBuena[i]

          # Guardara la posicion/opcion de la respuesta correcta para luego comparar con eleccion usuario
          arIndxBuena.append(indxBuena)

      # Ciclo 4 opciones
      for j in range (4):
        # 1) 1 / s
        print(f"   {j+1}) {posiRes[j]}")

      # INTERACCION USUARIO PREGUNTA CUAL OPCION DESEA ELEGIR GUARDA INDEX Y RESPUESTA
      arIndxUsuario.append(int(input("Opcion: ")) - 1)
      arStrUsuario.append(posiRes[arIndxUsuario[i]])

      print("")

    # VERIFICA CUANTAS BUENAS SACASTE
    for z in range(cantPrg):
      # Eligio respuesta correcta
      if(arIndxBuena[z] == arIndxUsuario[z]):
        cntBuenas = cntBuenas + 1
      # Caso donde se la saco mal, guardar eleccion
      else:
        arIndxMalas.append(z)

    print(f"FELICIDADES SACASTE {cntBuenas}/{cantPrg}")
    print("")

    # Si en arreglo de index malas hay algo entonces minimo una se sacó mal
    if(len(arIndxMalas) > 0):
      print(f"RESUMEN ERRORES")

      for m in range(len(arIndxMalas)):
        print(f"{arIndxMalas[m]+1}. {arStrPosiPrg[arIndxMalas[m]]} = {arStrBuena[arIndxMalas[m]]}")
        print(f"Error (Op{arIndxUsuario[arIndxMalas[m]]+1}): {arStrUsuario[arIndxMalas[m]]}")
        print("")

  # OPCION ANTI LAPLACE
  elif(opcUsuario == 2):
    print("")
    print("Anti Laplace")

    # Ciclo 10 preguntas
    for i in range (0, cantPrg):
      # Valor Random entero y string
      nRndInt = int(random.uniform(1, 10))
      nRndStr = str(nRndInt)

      # Posibles preguntas por hacer
      # L^-1{k/s}, L^-1{n!/s^n+1}, L^-1{1/s-k}, L^-1{k/s^2+k^2},L^-1{s/s^2+k^2}, L^-1{k/s^2-k^2},L^-1{s/s^2-k^2
      posiPrg = [f"{nRndStr} / s", f"{nRndStr}! / s^{str(nRndInt+1)}", f"1 / s - {nRndStr}", f"{nRndStr} / s^2 + {str(nRndInt**2)}",  f"s / s^2 + {str(nRndInt**2)}", f"{nRndStr} / s^2 - {str(nRndInt**2)}",  f"s / s^2 - {str(nRndInt**2)}"]

      # Valor random que eligira cual operacion sera numero random pregunta
      nRndPrg = int(random.uniform(0, 7))

      # Depende el caso, será el resultado, entonces un swithc para poder definir el resultado correcto que sera utilizado
      # L^-1{k/s} = k
      if nRndPrg == 0:
        arStrBuena.append(f"{nRndStr}")
      # L^-1{n!/s^n+1} = t^n
      elif nRndPrg == 1:
        arStrBuena.append(f"t^{nRndStr}")
      # L^-1{1/s-k} = e^kt
      elif nRndPrg == 2:
        arStrBuena.append(f"e^{nRndStr}t")
      # L^-1{k/s^2+k^2} = sin(kt)
      elif nRndPrg == 3:
        arStrBuena.append(f"sin({nRndStr}t)")
      # L^-1{s/s^2+k^2} = cos(kt)
      elif nRndPrg == 4:
        arStrBuena.append(f"cos({nRndStr}t)")
      # L^-1{k/s^2-k^2} = sinh(kt)
      elif nRndPrg == 5:
        arStrBuena.append(f"sinh({nRndStr}t)")
      # L^-1{s/s^2-k^2 = cosh(kt)
      elif nRndPrg == 6:
        arStrBuena.append(f"cosh({nRndStr}t)")

      # PREGUNTA QUE CONTESTARA USUARIO
      # print(f"{i}. L{ {posiPrg[nRndPrg]} } = ¿?")
      print(str(i+1) + ". L^-1{" + posiPrg[nRndPrg] + "} = ¿?")

      # Registro de preguntas realizadas en iteraccion, para apartado de comparar las malas
      arStrPosiPrg.append("L^-1{" + posiPrg[nRndPrg] + "}")

      # Posibles respuestas, aqui son mas sencillas
      posiNum = [nRndStr, f"t^{nRndStr}", f"e^{nRndStr}t", f"sin({nRndStr}t)",  f"cos({nRndStr}t)",f"sinh({nRndStr}t)",  f"cosh({nRndStr}t)"]

      # Temporal para que cada respuesta la vaya sacando y no se repita al final
      posiNumTemp = posiNum.copy()

      # Cada nuevas respuestas random que no se tiene suerte
      luck = False

      # Ciclo donde se unen posibles respuestas
      for k in range(4):
        # Elige una posible respuesta random pero no repetida
        indxPosiRes = int(random.uniform(0, len(posiNumTemp))) # Crea posicion random con base al tamaño de posiNumTem
        posiRes[k] = posiNumTemp[indxPosiRes] # Mete respuesta random

        del posiNumTemp[indxPosiRes] # Elimina la que ya se desplego, para no repetirse

        # Si algun valor de posibles respuestas ya se genero respuesta, guardarlo
        if(posiRes[k] == arStrBuena[i]):
          indxBuena = k
          # Guardara la posicion/opcion de la respuesta correcta para luego comparar con eleccion usuario
          arIndxBuena.append(indxBuena)

          # Si llego increible caso donde se tuvo suerte que respuestas random dieron respuesta verdadera
          luck = True
        # Si ya va en el ultimo y no tuvo suerte de hacerse random
        elif(k == 3 and luck == False):
          # En que lugar se encuentra la respuesta correcta
          indxBuena = int(random.uniform(0, 4))
          posiRes[indxBuena] = arStrBuena[i]

          # Guardara la posicion/opcion de la respuesta correcta para luego comparar con eleccion usuario
          arIndxBuena.append(indxBuena)

      # Ciclo 4 opciones
      for j in range (4):
        # 1) k, t^n...
        print(f"   {j+1}) {posiRes[j]}")

      # INTERACCION USUARIO PREGUNTA CUAL OPCION DESEA ELEGIR GUARDA INDEX Y RESPUESTA
      arIndxUsuario.append(int(input("Opcion: ")) - 1)
      arStrUsuario.append(posiRes[arIndxUsuario[i]])

      print("")

    # VERIFICA CUANTAS BUENAS SACASTE
    for z in range(cantPrg):
      # Eligio respuesta correcta
      if(arIndxBuena[z] == arIndxUsuario[z]):
        cntBuenas = cntBuenas + 1
      # Caso donde se la saco mal, guardar eleccion
      else:
        arIndxMalas.append(z)

    print(f"FELICIDADES SACASTE {cntBuenas}/{cantPrg}")
    print("")

    # Si en arreglo de index malas hay algo entonces minimo una se sacó mal
    if(len(arIndxMalas) > 0):
      print(f"RESUMEN ERRORES")

      for m in range(len(arIndxMalas)):
        print(f"{arIndxMalas[m]+1}. {arStrPosiPrg[arIndxMalas[m]]} = {arStrBuena[arIndxMalas[m]]}")
        print(f"Error (Op{arIndxUsuario[arIndxMalas[m]]+1}): {arStrUsuario[arIndxMalas[m]]}")
        print("")

  # OPCION DE TUTORIAL
  elif(opcUsuario == 3):
    print("")
    print("Tutorial MateLovers")
    print("L{k} = k/s ")
    print("L{t^n} = n!/s^n+1 ")
    print("L{e^kt} = 1/s-k  ")
    print("L{sin(kt)} = k/s^2+k^2 ")
    print("L{cos(kt)} = s/s^2+k^2 ")
    print("L{sinh(kt)} = k/s^2-k^2 ")
    print("L{cosh(kt)} = s/s^2-k^2")
    print("L^-1{k/s} = k ")
    print("L^-1{n!/s^n+1} = t^n")
    print("L^-1{1/s-k} = e^kt")
    print("L^-1{k/s^2+k^2} = sin(kt)")
    print("L^-1{s/s^2+k^2} = cos(kt)")
    print("L^-1{k/s^2-k^2} = sinh(kt)")
    print("L^-1{s/s^2-k^2 = cosh(kt)")


  # OPCION DE SALIDA
  elif(opcUsuario == 4):
    print("")
    print("Gracias por usar MateLovers")

  # OPCION NO ELIGE NINGUNA
  else:
    print("")
    print("ERROR")
