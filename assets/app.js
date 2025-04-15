import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


// Fonction pour récupérer et afficher les voitures
async function fetchCars() {
    const response = await fetch('/api/cars'); // Appel à l'API Symfony
    const cars = await response.json();

    const carList = document.getElementById('car-list');
    carList.innerHTML = ''; // Vider la liste avant de la remplir

    cars.forEach(car => {
        const li = document.createElement('li');
        li.textContent = `${car.name} (${car.brand}, ${car.year})`;
        carList.appendChild(li);
    });
}

// Fonction pour ajouter une voiture
async function addCar(event) {
    event.preventDefault();

    const name = document.getElementById('car-name').value;
    const brand = document.getElementById('car-brand').value;
    const year = document.getElementById('car-year').value;

    const response = await fetch('/api/cars', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, brand, year }),
    });

    if (response.ok) {
        alert('Voiture ajoutée avec succès !');
        fetchCars(); // Rafraîchir la liste des voitures
    } else {
        alert('Erreur lors de l\'ajout de la voiture.');
    }
}

// Ajouter des écouteurs d'événements
document.getElementById('car-form').addEventListener('submit', addCar);

// Charger les voitures au chargement de la page
fetchCars();