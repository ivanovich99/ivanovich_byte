import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// Modelo 3D
let model;
let loader = new GLTFLoader();

// Setup the renderer
const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setClearColor(0x222230);
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true;
document.body.appendChild(renderer.domElement);

// Create a new scene
const scene = new THREE.Scene();

// Setup scene lighting
const light = new THREE.DirectionalLight();
light.intensity = 2;
light.position.set(2, 5, 10);
light.castShadow = true;
scene.add(light);
scene.add(new THREE.AmbientLight(0xffffff, 0.5));


// Setup camera
const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.set(-10, 5, 30);
camera.layers.enable(1);

const controls = new OrbitControls(camera, renderer.domElement);

// Delimitar distancia para que no salga del objeto 
// controls.minDistance = 5;
// controls.maxDistance = 30;
controls.enableRotate = false;
controls.enablePan = false;
controls.enableDamping = true;
controls.zoomSpeed = 0.3;
controls.enableZoom = false;
// controls.target.set(0, 0, 0);
controls.update();

// Render loop
function animate() {
  requestAnimationFrame(animate);
  controls.update();
  renderer.render(scene, camera);
}

let INTERSECTED;
const selectedObjects = new Set();
const selectedSeats = new Set();
const maxSelectionsOg = 2; // Quien no se actualizara
let maxSelections = maxSelectionsOg; // Quien llevara conteo 


// Funcion para volver a llamar otro objeto una vez cambie de perspectiva 
function loadModel(modelPath, onLoadCallback) {
  if (model) {
    scene.remove(model);
  }

  loader.load(modelPath, (gltf) => {
    model = gltf.scene;
    let row = 'A';
    let seatNumber = 1;
    
    model.traverse((child) => {
      if (child.isMesh && child.name.includes('Seat')) { // Asumir que los asientos tienen 'Seat' en su nombre
        child.castShadow = true;
        child.receiveShadow = true;
        child.userData = {
          id: `${row}${seatNumber++}`,
          originalColor: new THREE.Color(child.material.color.getHex()),
          isSelected: false,
          isSelectable: true // Marca el objeto como seleccionable
        };
        if (seatNumber > 4 || (row == 'B' && seatNumber > 2)) {
          seatNumber = 1;
          row = String.fromCharCode(row.charCodeAt(0) + 1);
        }
      } else {
        child.userData.isSelectable = false; // No seleccionable
      }
    });
    
    scene.add(model);
 
    // Llamar al callback si existe
    if (onLoadCallback) {
      onLoadCallback();
    }
  }, undefined, (error) => {
    console.error(error);
  });
}

// Model Inicial 
loadModel('../models/flybyte2/flybyte.gltf');

// BOTONES EVENTOS
// document.getElementById( "btnMaxSeats").onclick = function () {
//   // Si cambia perspectiva, limpia asientos guardados y reinicia contador
//   selectedSeats.clear();
  
//   const userMax = prompt('Enter the maximum number of selections:');
//   if (userMax !== null) {
//     maxSelections = parseInt(userMax, 10);
//     if (isNaN(maxSelections) || maxSelections <= 0) {
//       maxSelections = 5; // Default value
//       alert('Invalid input. Using default value of 5.');
//     }
//     alert(`Max selections set to: ${maxSelections}`);
//   }
// }

// Variables para saber si se presionó el botón y vuelve a presionar, para que se actualice a original 
var btnAct1 = false;
var btnAct2 = false;

// Vista Superior 
document.getElementById("btnTop").onclick = function () {
  // Si no lo ha presionado, entonces falso y se cambia perspectiva 
  if (!btnAct1) {
    loadModel('../models/flybyte3/flybyte.gltf', () => {
      camera.position.set(0, 37, 0);
      // Delimitar vista usuario se mantenga dentro del obj 
      controls.minDistance = 0;
      controls.maxDistance = 37;

      // Reiniciar el contador de maxSelections
      maxSelections += selectedSeats.size;

      // Vaciar el conjunto selectedSeats
      selectedSeats.clear();

      btnAct2 = false;
    });
  } else { // Ya fue presionado y vuelve a presionar, regresar a default 
    loadModel('../models/flybyte2/flybyte.gltf', () => {
      controls.enableZoom = false;
      camera.position.set(-10, 5, 30);

      // Reiniciar el contador de maxSelections
      maxSelections += selectedSeats.size;

      // Vaciar el conjunto selectedSeats
      selectedSeats.clear();
    });
  }

  // Cambia para saber si se presionó o no 
  btnAct1 = !btnAct1;
};
// Vista Interior 
document.getElementById("btnIn").onclick = function () {
  // btnAct2 = false, no se ha activado 
  if (!btnAct2) {
    controls.enableZoom = true;
    camera.position.set(0, 0, 30);

    // Reiniciar el contador de maxSelections
    maxSelections += selectedSeats.size;

    // Vaciar el conjunto selectedSeats
    selectedSeats.clear();

    loadModel('../models/flybyte2/flybyte.gltf', () => {
      model.position.z = 15.6;

      // Delimitar vista usuario se mantenga dentro del obj 
      controls.minDistance = 5.5;
      controls.maxDistance = 30;

      btnAct1 = false;
    });
  } else { // Ya fue presionado y vuelve a presionar 
    camera.position.set(-10, 5, 30);

    // Reiniciar el contador de maxSelections
    maxSelections += selectedSeats.size;

    // Vaciar el conjunto selectedSeats
    selectedSeats.clear();

    loadModel('../models/flybyte2/flybyte.gltf');
  }

  // Cambia para saber si se presionó o no 
  btnAct2 = !btnAct2;
};

// Botón Confirmar 
document.getElementById("btnConfirm").onclick = function () {
  console.log('Asientos seleccionados:', Array.from(selectedSeats));
  controls.enabled = false;
  document.removeEventListener('mousemove', onMouseMove);
  document.removeEventListener('mousedown', onMouseDown);
}

// Botón Reset 
document.getElementById("btnReset").onclick = function () {
  loadModel('../models/flybyte2/flybyte.gltf', () => {
    selectedObjects.forEach(obj => {
      obj.material.color.copy(obj.userData.originalColor);
    });
    selectedObjects.clear();
    selectedSeats.clear();
  
    controls.minDistance = 0;
    controls.maxDistance = 30;
    camera.position.set(-10, 5, 30);
    
    btnAct1 = false;
    btnAct2 = false;

    controls.enabled = false;

    document.addEventListener('mousemove', onMouseMove);
    document.addEventListener('mousedown', onMouseDown);
  });

  
}

// RAYCASTER 
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();

document.addEventListener('mousemove', onMouseMove);
document.addEventListener('mousedown', onMouseDown);

function onMouseMove(event) {
  event.preventDefault();
  mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
  mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

  raycaster.setFromCamera(mouse, camera);

  const intersects = raycaster.intersectObjects(scene.children, true).filter(intersect => intersect.object.userData.isSelectable);

  if (intersects.length > 0) {
    const intersectedObject = intersects[0].object;

    if (INTERSECTED !== intersectedObject) {
      if (INTERSECTED) {
        if (selectedObjects.has(INTERSECTED)) {
          INTERSECTED.material.color.set(0x0000ff); // Selección color
        } else {
          INTERSECTED.material.color.copy(INTERSECTED.userData.originalColor);
        }
      }
      INTERSECTED = intersectedObject;

      if (!selectedObjects.has(INTERSECTED)) {
        INTERSECTED.material.color.set(0x0000FF); // Hover color
      } else {
        INTERSECTED.material.color.set(0xFF0000); // Seleccionado hover color
      }
    }
  } else {
    if (INTERSECTED) {
      if (selectedObjects.has(INTERSECTED)) {
        INTERSECTED.material.color.set(0x0000ff); // Selección color
      } else {
        INTERSECTED.material.color.copy(INTERSECTED.userData.originalColor);
      }
    }
    INTERSECTED = null;
  }
}

function onMouseDown(event) {
  event.preventDefault();
  mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
  mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

  raycaster.setFromCamera(mouse, camera);

  const intersects = raycaster.intersectObjects(scene.children, true).filter(intersect => intersect.object.userData.isSelectable);
  
  if (intersects.length > 0) {
    const clickedObject = intersects[0].object;
    if (selectedObjects.has(clickedObject)) {
      // Deselect the object
      clickedObject.material.color.copy(clickedObject.userData.originalColor);
      selectedObjects.delete(clickedObject);
      selectedSeats.delete(clickedObject.userData.id);
    } else {

      if (selectedObjects.size >= maxSelections) {
        alert(`You can only select up to ${maxSelectionsOg} seats.`);
        return;
      }
      // Select the object
      clickedObject.material.color.set(0x0000ff); // Click color
      selectedObjects.add(clickedObject);
      selectedSeats.add(clickedObject.userData.id);
    }
    clickedObject.userData.isSelected = !clickedObject.userData.isSelected;
    console.log(`Object ID ${clickedObject.userData.id} clicked!`);
    console.log('Asientos seleccionados:', Array.from(selectedSeats));
  }
}

animate();

// Mostrar los asientos seleccionados en la consola cada 5 segundos
// setInterval(() => {
//   console.log('Asientos seleccionados:', Array.from(selectedSeats));
// }, 5000);
