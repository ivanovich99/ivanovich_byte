<?php

	 $listaCliente = array();

     // Manda a llamar funcion php con clientes 
	 $listaCliente = getListaCliente();

	//  print_r($listaCliente);

	 //si $listaCliente es diferente de nulo o vacío
	 if($listaCliente!=null)
	 {
	 ?>

     <!-- Creacion de tabla donde se desplegara todo  -->
     <TABLE border="1">
        <TR>
            <TH colspan="18">Lista de Clientes</TH>
        </TR>
        <TR>
            <TR>
            <TH>ID Cliente</TH>
            <TH>Tipo Cliente</TH>
            <TH>Nombre Completo</TH>
            <TH>Direccion</TH>
            <TH>Correo</TH>
            <TH>Teléfono</TH>
            <TH>Fecha de Nacimiento</TH>
            <TH>RFC</TH>
            <TH>Fecha de Registro</TH>
            <TH colspan="2">Acciones/Funcionalidades</TH>
        </TR>

        <?php
        //foreach se utiliza comunmente para arreglos
        foreach ($listaCliente as $renglon=>$campo)
        { ?>
        <TR>
            <!-- Como se desplegaran los datos en front end  -->
            <TD><?=$campo['id_cliente']?></TD>
            <TD>
            <!-- Para que en vez de que salga el valor numerico, salga su significado -->
            <?php 
            if ($campo['id_tipo_cliente'] == 1) {
                echo "Regular";
            } elseif ($campo['id_tipo_cliente'] == 2) {
                echo "Preferente";
            } elseif ($campo['id_tipo_cliente'] == 3) {
                echo "Público General";
            } else {
                echo "Desconocido"; // Por si llega un valor inesperado
            }
            ?>
        </TD>
            <!-- Union de atributos para nombre completo  -->
            <TD> <?=$campo['apellido1']?> <?=$campo['apellido2']?>  </br> <?=$campo['nombre1']?>  <?=$campo['nombre2']?> </TD>
            <!-- Union atributos para direccion  -->
            <TD><?=$campo['direccion_calle']?> <?=$campo['direccion_numero']?> </br> <?=$campo['direccion_colonia']?> <?=$campo['codigo_postal']?> <?=$campo['ciudad']?></TD>

            <TD><?=$campo['correo']?></TD>
            <TD><?=$campo['telefono']?></TD>
            <TD><?=$campo['fecha_nacimiento']?></TD>
            <TD><?=$campo['rfc_cliente']?></TD>
            <TD><?=$campo['fecha_registro']?></TD>

            <!-- Acciones usuario  -->
            <TD><A href="<?=ROOTURL?>?accion=deleteCliente&id_cliente=<?=$campo['id_cliente']?>">Eliminar</A></TD>
            <TD><A href="<?=ROOTURL?>?accion=editCliente&id_cliente=<?=$campo['id_cliente']?>">Modificar</A></TD>
        </TR>

        <?php } ?>

	 </TABLE>

	 <?php } 
     else 
     { ?>
	    No hay datos
 <?php } ?>