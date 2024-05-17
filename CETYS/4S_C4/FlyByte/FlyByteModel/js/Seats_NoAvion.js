import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// Setup the renderer
const renderer = new THREE.WebGLRenderer();
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
scene.add(new THREE.AmbientLight(0xffffff, 0.1));

// Setup camera
const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
const controls = new OrbitControls(camera, renderer.domElement);

// Delimitar distancia para que no salga del objeto 
controls.enableDamping = true;
controls.zoomSpeed = 1;

camera.position.set(-5, 5, 12);
camera.layers.enable(1);
controls.target.set(-1, 2, 0);
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

// Load a glTF model
const loader = new GLTFLoader();
loader.load('../models/testNoSel/scene.gltf', (gltf) => {
  const model = gltf.scene;
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
      // Cambia de fila después de cierto número de asientos, por ejemplo, 4 asientos por fila
      if (seatNumber > 4) {
        seatNumber = 1;
        row = String.fromCharCode(row.charCodeAt(0) + 1);
      }
    } else {
      child.userData.isSelectable = false; // No seleccionable
    }
  });
  scene.add(model);
}, undefined, (error) => {
  console.error(error);
});

// Setup raycaster
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
      // Select the object
      clickedObject.material.color.set(0x0000ff); // Click color
      selectedObjects.add(clickedObject);
      selectedSeats.add(clickedObject.userData.id);
    }
    clickedObject.userData.isSelected = !clickedObject.userData.isSelected;
    console.log(`Object ID ${clickedObject.userData.id} clicked!`);
  }
}

animate();

// Mostrar los asientos seleccionados en la consola cada 5 segundos
setInterval(() => {
  console.log('Asientos seleccionados:', Array.from(selectedSeats));
}, 5000);
