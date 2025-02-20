// script.js

// Fonction pour valider le formulaire d'inscription
function validateSignupForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('Les mots de passe ne correspondent pas.');
        return false;
    }
    return true;
}

// Fonction pour afficher un message de confirmation avant de participer à un covoiturage
function confirmParticipation(creditCost) {
    const confirmation = confirm(`Participer à ce covoiturage coûtera ${creditCost} crédits. Voulez-vous continuer ?`);
    return confirmation;
}

// Appel AJAX pour rechercher des covoiturages
function searchCarpools() {
    const departure = document.getElementById('departure').value;
    const arrival = document.getElementById('arrival').value;
    const date = document.getElementById('date').value;

    fetch(`liste_covoiturages.php?departure=${departure}&arrival=${arrival}&date=${date}`)
        .then(response => response.json())
        .then(data => displayCarpools(data))
        .catch(error => console.error('Erreur lors de la recherche des covoiturages:', error));
}

// Fonction pour afficher les résultats des covoiturages
function displayCarpools(carpools) {
    const resultsContainer = document.getElementById('carpool-results');
    resultsContainer.innerHTML = '';

    if (carpools.length === 0) {
        resultsContainer.innerHTML = '<p>Aucun covoiturage disponible.</p>';
        return;
    }

    carpools.forEach(carpool => {
        const carpoolElement = document.createElement('div');
        carpoolElement.classList.add('carpool-item');
        carpoolElement.innerHTML = `
            <p>Chauffeur : ${carpool.driver} (${carpool.rating} ⭐)</p>
            <p>Départ : ${carpool.departureTime} - Places disponibles : ${carpool.seatsLeft}</p>
            <button onclick="confirmParticipation(${carpool.creditCost})">Participer</button>
        `;
        resultsContainer.appendChild(carpoolElement);
    });
}

// Validation simple du formulaire de connexion
function validateLoginForm() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (email === '' || password === '') {
        alert('Veuillez remplir tous les champs.');
        return false;
    }
    return true;
}

function showNotification(message) {
    const notif = document.createElement("div");
    notif.className = "notification";
    notif.innerText = message;
    document.body.appendChild(notif);
    notif.style.display = "block";
    setTimeout(() => notif.remove(), 3000);
}


// Gestion du bouton "Retour en haut de page"
const scrollToTopButton = document.getElementById('scrollToTop');
window.addEventListener('scroll', () => {
    if (window.scrollY > 200) {
        scrollToTopButton.style.display = 'block';
    } else {
        scrollToTopButton.style.display = 'none';
    }
});

scrollToTopButton.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
