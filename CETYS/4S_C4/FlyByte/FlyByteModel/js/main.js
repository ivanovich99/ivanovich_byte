//Import the THREE.js library
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
// To allow for the camera to move around the scene
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
// To allow for importing the .gltf file
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

//Create a Three.JS Scene
const scene = new THREE.Scene();
//create a new camera with positions and angles
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

//Keep track of the mouse position, so we can make the eye move
let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;

//Keep the 3D object on a global variable so we can access it later
let object;

//OrbitControls allow the camera to move around the scene
let controls;

//Set which object to render
let objToRender = 'plane';

// Variables Tamaño Canvas
let widthCanvas = 1000;
let heighCanvas = 500;

// Variables para sber si se presiono boton y vuelve a presionar, para que se actualice a original 
var btnAct1 = false;
var btnAct2 = false;

//Instantiate a loader f  or the .gltf file
const loader = new GLTFLoader().setPath('../models/plane/');;

//Load the file
loader.load(
  `scene.gltf`,
  function (gltf) {
    //If the file is loaded, add it to the scene
    object = gltf.scene;
    scene.add(object);
  },
  function (xhr) {
    //While it is loading, log the progress
    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
  },
  function (error) {
    //If there is an error, log it
    console.error(error);
  }
);

//Instantiate a new renderer and set its size
const renderer = new THREE.WebGLRenderer({ alpha: true }); //Alpha: true allows for the transparent background

// Tamaño del Canva donde irá el DOM 
renderer.setSize(widthCanvas,heighCanvas);

//Add the renderer to the DOM
document.getElementById("container3D").appendChild(renderer.domElement);

//Set how far the camera will be from the 3D model
camera.position.z = objToRender === "plane" ? 30 : 25;

//Add lights to the scene, so we can actually see the 3D model
const topLight = new THREE.DirectionalLight(0xffffff, 1); // (color, intensity)
topLight.position.set(500, 500, 500) //top-left-ish
topLight.castShadow = true;
scene.add(topLight);

const ambientLight = new THREE.AmbientLight(0x333333, objToRender === "plane" ? 1 : 1);
scene.add(ambientLight);

//This adds controls to the camera, so we can rotate / zoom it with the mouse
if (objToRender === "plane") {
  controls = new OrbitControls(camera, renderer.domElement);
  
  // Delimitar distancia para que no salga del objeto 
  controls.minDistance = 5;
  controls.maxDistance = 30;
  
  // Deshabilitar la rotación de la cámara
  controls.enableRotate = false;
}

//Render the scene
function animate() {
  requestAnimationFrame(animate);
  controls.update();
  renderer.render(scene, camera);
}



// BOTONES CAMBIO DE PERSPECTIVAS
document.getElementById( "btnAerea" ).onclick = function () {

  // Siempre regresar a default y dependerá si fue seleccionado o no para que entre 
  camera.position.z = 30;
  object.position.x = 0; 
  object.rotation.y = 0; 
  object.position.z = 0; 
  object.rotation.x = 0; 
  object.rotation.y = 0; 
  object.rotation.z = 0; 

  // Si no lo ha presionado, entonces falso y se cambia perspectiva 
  if(!btnAct1)
    {
      object.rotation.x = Math.PI/2; 
      object.rotation.y = 0; 
      object.rotation.z = 0; 

      btnAct2 = false;
    }

    // Cambia para saber si se presiono o no 
    btnAct1 = !btnAct1;
  };

document.getElementById( "btnFrontal" ).onclick = function () {
  
  // Siempre regresar a default y dependerá si fue seleccionado o no para que entre 
  object.position.x = 0; 
  object.rotation.y = 0; 
  object.position.z = 0; 
  object.rotation.x = 0; 
  object.rotation.y = 0; 
  object.rotation.z = 0; 

  if(!btnAct2)
    {
      object.position.x = 0; 
      object.rotation.y = 0; 
      object.position.z = 17.3; 

      // Delimitar vista usuario se mantenga dentro de obj 

      controls.minDistance = 7;
      controls.maxDistance = 30.3;


      // controls.minPolarAngle = 0.5;
      // controls.maxPolarAngle = 1.5;
      btnAct1 = false;
    }

    // Cambia para saber si se presiono o no 
    btnAct2 = !btnAct2;
  };

//Add a listener to the window, so we can resize the window and the camera
window.addEventListener("resize", function () {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
});

//add mouse position listener, so we can make the eye move
document.onmousemove = (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
}

//Start the 3D rendering
animate();

// RAYCASTER
