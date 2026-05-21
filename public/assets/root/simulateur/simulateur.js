document.getElementById("loanSimulatorForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const duree = parseInt(document.getElementById("loanDuration").value);
    const montant = parseFloat(document.getElementById("loanMontant").value);
    const dob = document.getElementById("dob").value;
    const resultat = document.getElementById("resultat");

    // Vérifier si DOB est valide
    if (!dob) {
        Swal.fire({
            icon: "error",
            title: "Erreur !",
            text: "Veuillez renseigner votre date de naissance.",
            showConfirmButton: true,
            confirmButtonText: "OK",
            timer: 2000
        }).then(() => {
            window.location.reload();
        });
        return;
    }

    // Vérifier si DOB est dans le futur
    const todayVerif = new Date();
    const birthDateverif = new Date(dob);
    if (birthDateverif > todayVerif) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Veuillez renseigner une date de naissance valide.'
        }).then(() => {
            window.location.reload();
        });
        return;
    }

    // Calcul de l'âge
    const birthDate = new Date(dob);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    let taux = null;
    let message = "";
    let prime = 0;

    // Application de l'algorithme selon les règles fournies
    if (age >= 18 && age <= 55) {
        if (montant <= 30000000) {
            if (duree >= 1 && duree <= 24) {
                taux = 0.64 / 100;
            } else if (duree >= 25 && duree <= 36) {
                taux = 0.80 / 100;
            } else if (duree >= 37 && duree <= 48) {
                taux = 1.20 / 100;
            } else if (duree >= 49 && duree <= 60) {
                taux = 1.70 / 100;
            } else {
                message = "Contacter YAKO AFRICA";
            }
        } else {
            message = "Contacter YAKO AFRICA";
        }
    } 
    else if (age >= 56 && age <= 60) {
        if (montant <= 10000000) {
            if (duree >= 1 && duree <= 24) {
                taux = 0.64 / 100;
            } else if (duree >= 25 && duree <= 36) {
                taux = 0.80 / 100;
            } else {
                message = "Contacter YAKO AFRICA";
            }
        } else {
            message = "Contacter YAKO AFRICA";
        }
    } 
    else {
        message = "Age non éligible Contacter YAKO AFRICA";
    }

    // Affichage du résultat
    if (message !== "") {
        resultat.innerHTML = `
            <div class="alert alert-warning text-center fw-bold">
                ${message}
            </div>`;
        setTimeout(() => window.location.reload(), 5000);
        return;
    }

    // Calcul de la prime
    if (taux !== null) {
        prime = montant * taux;
        const primeObseque = 0; // Garantie Yako obsèque désactivée
        
        // Affichage des résultats
        document.getElementById('primeObseque').innerText = primeObseque.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });
        document.getElementById('prime').innerText = prime.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });
        document.getElementById('totalPremium').innerText = prime.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });

        resultat.innerHTML = `
            <div class="alert alert-success py-2 animate__animated animate__fadeIn">
                <i class="fas fa-check-circle me-2"></i>
                Simulation calculée avec succès - Taux appliqué : ${(taux * 100).toFixed(2)}%
            </div>
        `;

        if (prime > 10) {
            document.getElementById("btnSouscrition").classList.remove("disabled");
        }

        // Envoi des données au backend
        const data = {
            duree: duree,
            montant: montant,
            dob: dob,
            age: age,
            prime: prime,
            primeFinal: prime,
            primeObseque: primeObseque,
            taux: taux
        };

        fetch('/epret/store-simulation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(data),
        })
        .then(response => response.ok ? console.log('Simulation data stored successfully') : console.error('Failed to store simulation data'))
        .catch(error => console.error('Error:', error));
    }
});

function saveSimulationData(data) {
    sessionStorage.setItem('simulationData.simulationValue', JSON.stringify(data));
}