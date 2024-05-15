import random

cantPrg = 3
cntBuenas = 0
luck = False

posiNum = []
posiDen = []
posiRes = ["","","",""]

# Guarda preguntas hechas 
arStrPosiPrg = []

# Guarda preguntas en texto y en que index estan 
arIndxBuena = []
arStrBuena = []

# Guardan respuestas de index de usuario y texto 
arStrUsuario = []
arIndxUsuario = []

# Guarda en cuales difirio con indx de buena para resumen final 
arIndxMalas = []

opcLP = 0

# Menu Principal Dos Opciones
#   Sección Tutorial
#     Despliegue texto y formulas para que aprenda a jugar
#   Sección MateLovers Individual/Grupal
#     Laplace


print("BIENVENIDO A MATELOVERS")



print("LaPlace 10 preguntas")
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
  # L{k}
  if nRndPrg == 0:
    arStrBuena.append(f"{nRndStr} / s")
  # L{t^n}
  elif nRndPrg == 1:
     arStrBuena.append(f"{nRndStr}! / s^{str(nRndInt+1)}")
  # L{e^kt}
  elif nRndPrg == 2:
     arStrBuena.append(f"1 / s - {nRndStr}")
  # L{sin(kt)}
  elif nRndPrg == 3:
     arStrBuena.append(f"{nRndStr} / s^2 + {str(nRndInt**2)}")
  # L{cos(kt)}
  elif nRndPrg == 4:
     arStrBuena.append(f"s / s^2 + {str(nRndInt**2)}")
  # L{sinh(kt)}
  elif nRndPrg == 5:
     arStrBuena.append(f"{nRndStr} / s^2 - {str(nRndInt**2)}")
  # L{cosh(kt)}
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

# Si cantidad de buenas difiera a cantidad de preguntas, entonces alguna se sacó mal
if(cntBuenas != cantPrg):
  print(f"RESUMEN ERRORES")
  # print("arStrBuena: ",arStrBuena)
  # print("arIndxBuena: ",arIndxBuena)
  # print("arIndxMalas (preguntas): ",arIndxMalas)
  # print("posiPrg: ", arStrPosiPrg)

  for m in range(len(arIndxMalas)):
    print(f"{arIndxMalas[m]+1}. {arStrPosiPrg[arIndxMalas[m]]} = {arStrBuena[arIndxMalas[m]]}")
    print(f"Error (Op{arIndxUsuario[arIndxMalas[m]]+1}): {arStrUsuario[arIndxMalas[m]]}")
    print("")

#     AntiPlace
# print("Anti LaPlace 10 preguntas")
