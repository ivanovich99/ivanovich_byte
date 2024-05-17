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
// controls.minDistance = 5;
// controls.maxDistance = 30;
// controls.enableRotate = true;
// controls.enablePan = false;
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
let CLICKED;
let previousColor = new THREE.Color();

// Load a glTF model
const loader = new GLTFLoader();
loader.load('../models/seats/scene.gltf', (gltf) => {
  const model = gltf.scene;
  model.traverse((child) => {
    if (child.isMesh) {
      child.castShadow = true;
      child.receiveShadow = true;
    }
  });
  scene.add(model);
}, undefined, (error) => {
  console.error(error);
});

// ========= END SCENE SETUP =========

// Setup raycaster
const raycaster = new THREE.Raycaster();

document.addEventListener('mousemove', onMouseMove);
document.addEventListener('mousedown', onMouseDown);

function onMouseMove(event) {
  const coords = new THREE.Vector2(
    (event.clientX / renderer.domElement.clientWidth) * 2 - 1,
    -((event.clientY / renderer.domElement.clientHeight) * 2 - 1),
  );

  raycaster.setFromCamera(coords, camera);

  const intersections = raycaster.intersectObjects(scene.children, true);

  if (intersections.length > 0) {
    const selectedObject = intersections[0].object;
    if (INTERSECTED !== selectedObject) {
      if (INTERSECTED && INTERSECTED !== CLICKED) {
        // Restore the previous color of the previously intersected object
        INTERSECTED.material.color.copy(previousColor);
      }
      // Store the current color and change the color to indicate hover
      INTERSECTED = selectedObject;
      previousColor.copy(INTERSECTED.material.color);
      if (INTERSECTED !== CLICKED) {
        INTERSECTED.material.color.set(0xff0000); // Change to red on hover
      }
    }
  } else {
    if (INTERSECTED && INTERSECTED !== CLICKED) {
      // Restore the previous color if no object is intersected
      INTERSECTED.material.color.copy(previousColor);
      INTERSECTED = null;
    }
  }
}

function onMouseDown(event) {
  const coords = new THREE.Vector2(
    (event.clientX / renderer.domElement.clientWidth) * 2 - 1,
    -((event.clientY / renderer.domElement.clientHeight) * 2 - 1),
  );

  raycaster.setFromCamera(coords, camera);

  const intersections = raycaster.intersectObjects(scene.children, true);
  if (intersections.length > 0) {
    if (CLICKED) {
      CLICKED.material.color.copy(previousColor); // Restore the previous color of the last clicked object
    }
    CLICKED = intersections[0].object;
    previousColor.copy(CLICKED.material.color); // Store the clicked object's color
    CLICKED.material.color.set(0x0000ff); // Change to blue on click
    console.log(`${CLICKED.name} was clicked!`);
  }
}

animate();
