


document.getElementById("loanSimulatorForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const duree = parseInt(document.getElementById("loanDuration").value);
    const montant = parseFloat(document.getElementById("loanMontant").value);
    const dob = document.getElementById("dob").value;

    const resultat = document.getElementById("resultat");
    console.log("DOB:", dob);

    // Vérifier si DOB est valide
    if (!dob) {
        swal.fire({

            icon: "error",
            title: "Erreur !",
            text: "Veuillez renseigner votre date de naissance.",
            showConfirmButton: true,
            confirmButtonText: "OK",
            timer: 2000

            })
            .then(() => {
            window.location.reload();
        });
        return;
    }

    // Vérifier si DOB est dans le futur
    const todayVerif = new Date();
    const birthDateverif = new Date(dob);
    if (birthDateverif > todayVerif) {
        swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Veuillez renseigner une date de naissance valide.'
        }).then(() => {
            window.location.reload();

        })
    }

    // Calcul de l'âge
    const birthDate = new Date(dob);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    console.log("Âge calculé :", age);



    // Vérification du montant max
    if (montant > 30000000) {
        resultat.innerHTML = `
            <div class="alert alert-danger text-center fw-bold">
                Veuillez contacter YAKO AFRICA pour les montants supérieurs à 30 000 000.
            </div>`;
        setTimeout(() => window.location.reload(), 5000);
        return;
    }

    // Application des règles de taux
    let taux = null;
    if (age >= 18 && age <= 60 && duree >= 1 && duree <= 24) {
        taux = 0.65 / 100;
    } else if (age >= 18 && age <= 50 && duree >= 25 && duree <= 48) {
        taux = 0.65 / 100;
    } else {
        resultat.innerHTML = `
            <div class="alert alert-warning text-center fw-bold">
                Merci de contacter YAKO AFRICA pour ce type de prêt.
            </div>`;
        return;
    }

    // Garantie Yako obsèque → désactivée / valeur fixe 0
    const primeObseque = 0;
    document.getElementById('primeObseque').innerText = primeObseque.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });

    // Calcul prime
    const prime = montant * taux;
    const primeFinal = prime + primeObseque;

    // Affichage
    document.getElementById('prime').innerText = prime.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });
    document.getElementById('totalPremium').innerText = primeFinal.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });

    resultat.innerHTML = `
        <div class="alert alert-success py-2 animate__animated animate__fadeIn">
            <i class="fas fa-check-circle me-2"></i>
            Simulation calculée avec succès
        </div>
    `;

    if (primeFinal > 10) {
        document.getElementById("btnSouscrition").disabled = false;
    }

    // Envoi données backend
   const data = {
        duree: duree,
        montant: montant,
        dob: dob,
        age: age,
        prime: prime,
        primeFinal: primeFinal,
        primeObseque: primeObseque,
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
});

function saveSimulationData(data) {
    sessionStorage.setItem('simulationData.simulationValue', JSON.stringify(data));
}
