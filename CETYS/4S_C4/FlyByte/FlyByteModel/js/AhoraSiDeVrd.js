import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// Modelo 3D
let model;
let loader = new GLTFLoader();

// Renderizar escena 
const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setClearColor(0x222230);
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true;
document.body.appendChild(renderer.domElement);

// Crear donde se pondra la escena 
const scene = new THREE.Scene();

// Crear la luz 
const light = new THREE.DirectionalLight();
light.intensity = 2;
light.position.set(2, 5, 10);
light.castShadow = true;
scene.add(light);
scene.add(new THREE.AmbientLight(0xffffff, 0.5));

// Crear la camara 
const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.set(-10, 5, 30);
camera.layers.enable(1); // Para que solo escoga el objeto que esta de frente 

// Controls para poder manipular movimientos de la camara 
const controls = new OrbitControls(camera, renderer.domElement);
// Delimitar distancia para que no salga del objeto 
controls.enableRotate = false;
controls.enablePan = false;
controls.enableDamping = true;
controls.enableZoom = false;
controls.zoomSpeed = 0.3;
controls.update();

// Bucle para animacion 
function animate() {
  requestAnimationFrame(animate);
  controls.update();
  renderer.render(scene, camera);
}

// Arreglos y variable para identificaor si fue seleccionado y cuales objetos y id de asientos 
let INTERSECTED;
const selectedObjects = new Set();
const selectedSeats = new Set();
const maxSelections = 4; // Maximo seleccion de asientos con base al usuario 

// Variables para saber si se presionó el botón y vuelve a presionar, para que se actualice a original 
let btnAct1 = false;
let btnAct2 = false;

// Funcion para volver a llamar otro objeto una vez cambie de perspectiva 
function loadModel(modelPath, onLoadCallback) {
  // Para que no guarde objetos seleccioandos anteriores pero si los nuevos, que son los "mismos" 
  selectedObjects.clear();

  // Quitar modelo anterior para dar paso al siguiente 
  if (model) {
    scene.remove(model);
  }

  // Como se cargara todo el modelo 
  loader.load(modelPath, (gltf) => {
    
    model = gltf.scene;
    // Crear IDs A1, A2, B1, B2...
    let row = 'A';
    let seatNumber = 1;
    
    model.traverse((child) => {

      // Cada objeto que en el modelo tenga "Seat" en su nombre, asi el modelo del avion no se otorge ID, puro asiento 
      if (child.isMesh && child.name.includes('Seat')) { 
        child.castShadow = true;
        child.receiveShadow = true;
        child.userData = {
          // Asignar ID A1, A2, B1, B2...
          id: `${row}${seatNumber++}`,
          
          // Color original del propio material 
          originalColor: new THREE.Color(child.material.color.getHex()),
          
          // Aun no ha sido seleccionado 
          isSelected: false,

          // Marca el objeto como seleccionable
          isSelectable: true 
        };

        // Si en otra perspectiva tenia asientos seleccionados y es el mismo que se carga, entonces impelmentar color y agregarlo de nuevo a arreglo
        if (selectedSeats.has(child.userData.id)) {
          
          // Color de seleccionado 
          child.material.color.set(0x0000ff); 

          // Se deben volver a agregar porque a pesar de ser mismos objetos en cada render difieren, solo como recordatorio que son los mismos 
          selectedObjects.add(child);

          // Si es igual a arreglo de asientos entonces marcar con que es seleccionado 
          child.userData.isSelected = true;
        }
        
        // Para ir cambiando de ID conforme la cantidad de asientos que hay en el modelo (Fila B solo dos asientos, por eso)
        if (seatNumber > 4 || (row === 'B' && seatNumber > 2)) {
          seatNumber = 1;
          row = String.fromCharCode(row.charCodeAt(0) + 1);
        }
        // Donde nombre de objeto difiere a Seat, entonces no podra ser seleccionado 
      } else {
        child.userData.isSelectable = false;
      }
    });
    
    // Agregar modelo existente 
    scene.add(model);

    // Llamar al callback si existe
    if (onLoadCallback) {
      onLoadCallback();
    }
  }, undefined, (error) => {
    console.error(error);
  });
}

// Modelo Inicial 
loadModel('../models/flybytein/flybyte.gltf');

// Vista Superior 
document.getElementById("btnTop").onclick = function () {
  // Para desactivar el zoom y solo sea dentro del In 
  controls.enableZoom = false;
  
  // Si no lo ha presionado, entonces es falso y se cambia activa
  if (!btnAct1) {
    loadModel('../models/flybytetop/flybyte.gltf', () => {
      // Vista Aerea
      camera.position.set(0, 37, 0);

      // Delimitar vista usuario se mantenga dentro del obj 
      controls.minDistance = 0;
      controls.maxDistance = 37;

      btnAct2 = false;
    });
  // Ya fue presionado y vuelve a presionar, regresar a default 
  } else { 
    loadModel('../models/flybytein/flybyte.gltf', () => {
      camera.position.set(-10, 5, 30);
    });
  }

  // Cambia para saber si se presionó o no 
  btnAct1 = !btnAct1;
};

// Vista Interior 
document.getElementById("btnIn").onclick = function () {
  
  // Para desactivar el zoom y solo sea dentro del In 
  controls.enableZoom = false;

  // Si es falso entonces se activara
  if (!btnAct2) {
    loadModel('../models/flybytein/flybyte.gltf', () => {
      
      // Para que pueda hacer zoom y "recorrer" el avion 
      controls.enableZoom = true;
      camera.position.set(0, 0, 30);

      model.position.z = 15.6;

      // Delimitar vista usuario se mantenga dentro del obj 
      controls.minDistance = 5.5;
      controls.maxDistance = 30;

      btnAct1 = false;
    });
  // Ya fue presionado y vuelve a presionar, regresar a default 
  } else { 
    loadModel('../models/flybytein/flybyte.gltf', () => {
      camera.position.set(-10, 5, 30);
    });
  }

  // Cambia para saber si se presionó o no 
  btnAct2 = !btnAct2;
};

// Botón Reset 
document.getElementById("btnReset").onclick = function () {
  console.log('Reset Aplicado');

  // Vaciar el conjunto de objetos seleccionados 
  selectedObjects.clear();
  selectedSeats.clear();

  // Reset aplicado Vista Top
  if(btnAct1){
    loadModel('../models/flybytetop/flybyte.gltf', () => {
      camera.position.set(0, 37, 0);
      // Delimitar vista usuario se mantenga dentro del obj 
      controls.minDistance = 0;
      controls.maxDistance = 37;

      btnAct2 = false;
           
    });
  // Reset aplicado Vista In 
  } else if(btnAct2){
    loadModel('../models/flybytein/flybyte.gltf', () => {
      camera.position.set(0, 0, 30);
      
      model.position.z = 15.6;

      // Delimitar vista usuario se mantenga dentro del obj 
      controls.minDistance = 5.5;
      controls.maxDistance = 30;

      btnAct1 = false;
    });
  }
}

// RAYCASTER 
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();

// Evento cuando se mueve el mouse o cuando se hace click 
document.addEventListener('mousemove', onMouseMove);
document.addEventListener('mousedown', onMouseDown);

function onMouseMove(event) {
  event.preventDefault();

  // Leer posicion del mouse 
  mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
  mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

  raycaster.setFromCamera(mouse, camera);

  // Variable de los objetos interactuados 
  const intersects = raycaster.intersectObjects(scene.children, true).filter(intersect => intersect.object.userData.isSelectable);

  if (intersects.length > 0) {
    const intersectedObject = intersects[0].object;

    if (INTERSECTED !== intersectedObject) {
      if (INTERSECTED) {
         // Hover seleccion color
        if (selectedObjects.has(INTERSECTED)) {
          INTERSECTED.material.color.set(0x0000ff);
        } else {
          // Sino no hover color
          INTERSECTED.material.color.copy(INTERSECTED.userData.originalColor);
        }
      }
      INTERSECTED = intersectedObject;

      if (!selectedObjects.has(INTERSECTED)) {
        // Hover color
        INTERSECTED.material.color.set(0x0000FF); 
      } else {
        // Seleccionado hover color
        INTERSECTED.material.color.set(0xFF0000); 
      }
    }
    // Mostrar el ID del asiento en el div
    document.getElementById('seatInfo').innerHTML = `Asiento: ${intersectedObject.userData.id}`;
    // console.log(`Asiento: ${intersectedObject.userData.id}`);
  } else {
    if (INTERSECTED) {
      if (selectedObjects.has(INTERSECTED)) {
        // Selección color
        INTERSECTED.material.color.set(0x0000ff); 
      } else {
        INTERSECTED.material.color.copy(INTERSECTED.userData.originalColor);
      }
    }
    INTERSECTED = null;

    // Ocultar el ID del asiento cuando no hay hover
    document.getElementById('seatInfo').innerHTML = 'Asiento: ID';
  }
}
// Cuando hace click 
function onMouseDown(event) {
  
  // Posiciona mouse en pantalla 
  event.preventDefault();
  mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
  mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

  raycaster.setFromCamera(mouse, camera);

  const intersects = raycaster.intersectObjects(scene.children, true).filter(intersect => intersect.object.userData.isSelectable);
  
  if (intersects.length > 0) {
    const clickedObject = intersects[0].object;
    if (selectedObjects.has(clickedObject)) {
      // Si quita seleccion de un objeto 
      clickedObject.material.color.copy(clickedObject.userData.originalColor);
      selectedObjects.delete(clickedObject);
      selectedSeats.delete(clickedObject.userData.id);
    } else {
      if (selectedSeats.size >= maxSelections) {
        // Si se pasa de la cantidad de seleccion de asientos 
        alert(`Solo puedes seleccionar ${maxSelections} asientos.`);
        return;
      }
      // Seleccionar objetos y agregarlo a los arreglos 
      clickedObject.material.color.set(0x0000ff); // Click color
      selectedObjects.add(clickedObject);
      selectedSeats.add(clickedObject.userData.id);
    }
    // Cambiar de posicion e imprimir en consola cuantos asientos lleva y cual fue seleccionado 
    clickedObject.userData.isSelected = !clickedObject.userData.isSelected;
    console.log(`Object ID ${clickedObject.userData.id} seleccionado`);
    console.log('Asientos seleccionados:', Array.from(selectedSeats));
  }
}

animate();

// Mostrar los asientos seleccionados en la consola cada 5 segundos, para verificar 
// setInterval(() => {
//   console.log('---');
//   console.log('selectedSeats:', Array.from(selectedSeats));
//   console.log('selectedObjects:', Array.from(selectedObjects));
//   console.log('maxSelections:', maxSelections);
// }, 3000);
