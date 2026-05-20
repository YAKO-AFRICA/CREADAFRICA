document.addEventListener("DOMContentLoaded", function() {
    // ==================== INITIALISATION DES ÉLÉMENTS DOM ====================
    const elements = {
        form: document.getElementById("primeForm_2008"),
        dateNaissance: document.getElementById("dateNaissance"),
        age: document.getElementById("age"),
        garantieSeniorCheck: document.getElementById("garantieSeniorCheck"),
        seniorPrimeInputWrapper: document.getElementById("seniorPrimeInputWrapper"),
        seniorPrimeInput: document.getElementById("seniorPrimeInput"),
        result: document.getElementById("result"),
        primeTotal: document.getElementById("primeTotal"),
        btnSouscription: document.getElementById("btn-souscription"),
        btnReset: document.getElementById("btn-reset"),
        codePeriodicite: document.getElementById("codePeriodicite"),
        capitalSouscrit: document.getElementById("capitalSouscrit"),
        duree: document.getElementById("duree"),
        dateEffet: document.getElementById("dateEffet"),
        isAssureOui: document.getElementById("isAssureOui"),
        isAssureNon: document.getElementById("isAssureNon"),
        fraisAdhesionValue: document.getElementById("fraisAdhesionValue")
    };

    // ==================== CONSTANTES ====================
    const CONSTANTS = {
        FRAIS_ADHESION: 7500,
        CAPITAL_SENIOR: 500000,
        CODE_PRODUIT: elements.form?.querySelector('[name="CodeProduit"]')?.value || ''
    };

    // ==================== ÉTAT DE LA SIMULATION ====================
    let simulationData = {
        garantieData: [],
        infoSimulation: null,
        totalPrime: 0,
        totalPurePrime: 0
    };

    // ==================== NETTOYAGE AU CHARGEMENT ====================
    sessionStorage.removeItem("simulationData");
    resetForm();

    // ==================== GESTIONNAIRES D'ÉVÉNEMENTS ====================

    // Calcul automatique de l'âge
    if (elements.dateNaissance) {
        elements.dateNaissance.addEventListener("change", function() {
            const dateNaissance = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dateNaissance.getFullYear();
            const monthDiff = today.getMonth() - dateNaissance.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dateNaissance.getDate())) {
                age--;
            }

            if (elements.age) {
                elements.age.value = age;
                elements.age.dispatchEvent(new Event('change'));
            }
        });
    }

    // Gestion affichage garantie senior
    if (elements.garantieSeniorCheck) {
        elements.garantieSeniorCheck.addEventListener("change", function() {
            if (elements.seniorPrimeInputWrapper) {
                elements.seniorPrimeInputWrapper.style.display = this.checked ? "block" : "none";
            }
            if (!this.checked && elements.seniorPrimeInput) {
                elements.seniorPrimeInput.value = "";
            }
        });
    }

    // Bouton réinitialiser
    if (elements.btnReset) {
        elements.btnReset.addEventListener("click", function(e) {
            e.preventDefault();
            resetForm();
            showNotification("Formulaire réinitialisé avec succès", "success");
        });
    }

    // ==================== FONCTIONS PRINCIPALES ====================

    /**
     * Réinitialise complètement le formulaire et l'état
     */
    function resetForm() {
        // Réinitialiser le formulaire
        if (elements.form) {
            elements.form.reset();

            // Réinitialiser les champs spécifiques
            if (elements.duree) elements.duree.value = "5";
            if (elements.codePeriodicite) elements.codePeriodicite.value = "M";
        }

        // Réinitialiser l'affichage
        if (elements.result) elements.result.innerHTML = "";
        if (elements.primeTotal) elements.primeTotal.textContent = "0";

        // Cacher la section senior
        if (elements.seniorPrimeInputWrapper) {
            elements.seniorPrimeInputWrapper.style.display = "none";
        }

        // Désactiver le bouton de souscription
        setSouscriptionButtonState(false);

        // Réinitialiser l'état
        simulationData = {
            garantieData: [],
            infoSimulation: null,
            totalPrime: 0,
            totalPurePrime: 0
        };

        // Nettoyer le sessionStorage
        sessionStorage.removeItem("simulationData");
    }

    /**
     * Active ou désactive le bouton de souscription
     */
    function setSouscriptionButtonState(active) {
        if (elements.btnSouscription) {
            if (active) {
                elements.btnSouscription.classList.remove("btn-inactif");
                elements.btnSouscription.style.pointerEvents = "auto";
                elements.btnSouscription.disabled = false;
            } else {
                elements.btnSouscription.classList.add("btn-inactif");
                elements.btnSouscription.style.pointerEvents = "none";
                elements.btnSouscription.disabled = true;
            }
        }
    }

    /**
     * Valide les données du formulaire
     */
    function validateForm() {
        const errors = [];

        if (!elements.dateNaissance?.value) errors.push("La date de naissance est requise");
        if (!elements.capitalSouscrit?.value) errors.push("Le capital souscrit est requis");
        if (!elements.dateEffet?.value) errors.push("La date d'effet est requise");

        const isAssure = elements.isAssureOui?.checked || elements.isAssureNon?.checked;
        if (!isAssure) errors.push("Veuillez indiquer si le souscripteur est l'assuré");

        if (elements.age) {
            const age = parseInt(elements.age.value);
            if (isNaN(age) || age < 18) errors.push("L'assuré doit avoir au moins 18 ans");
            if (age > 70) errors.push("L'assuré ne doit pas dépasser 70 ans");
        }

        if (errors.length > 0) {
            showNotification(errors.join("<br>"), "error");
            return false;
        }

        return true;
    }

    /**
     * Récupère les données du formulaire
     */
    function getFormData() {
        return {
            CodeProduit: CONSTANTS.CODE_PRODUIT,
            codePeriodicite: elements.codePeriodicite?.value || "M",
            age: parseInt(elements.age?.value || 0),
            capitalSouscrit: parseFloat(elements.capitalSouscrit?.value || 0),
            duree: parseInt(elements.duree?.value || 5),
            dateEffet: elements.dateEffet?.value || "",
            dateNaissance: elements.dateNaissance?.value || "",
            isAssure: elements.isAssureOui?.checked ? "oui" : "non"
        };
    }

    /**
     * Processus principal de simulation
     */
    if (elements.form) {
        elements.form.addEventListener("submit", async function(e) {
            e.preventDefault();

            // Validation
            if (!validateForm()) return;

            // Réinitialiser les résultats précédents
            clearResults();

            // Afficher le chargement
            showLoading();

            // Récupérer les données du formulaire
            const formData = getFormData();
            const garantiesToProcess = garanties.filter(g => g.codeproduitgarantie !== "SENIOR");

            // Réinitialiser l'état
            simulationData = {
                garantieData: [],
                infoSimulation: null,
                totalPrime: 0,
                totalPurePrime: 0
            };

            // Traiter chaque garantie
            for (const garantie of garantiesToProcess) {
                await processGarantie(garantie, formData);
            }

            // Ajouter les frais d'adhésion
            simulationData.totalPurePrime = simulationData.totalPrime;
            simulationData.totalPrime += CONSTANTS.FRAIS_ADHESION;

            // Gérer la garantie senior si cochée
            if (elements.garantieSeniorCheck?.checked) {
                await addSeniorGarantie(formData);
            }

            // Finaliser la simulation
            finishSimulation(formData);
        });
    }

    /**
     * Traite une garantie individuelle
     */
    async function processGarantie(garantie, formData) {
        try {
            const response = await fetch(
                "https://api.yakoafricassur.com/enov/prime-garantie",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        ...formData,
                        codeGarantie: garantie.codeproduitgarantie
                    })
                }
            );

            if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);

            const data = await response.json();

            if (Array.isArray(data)) {
                data.forEach(item => {
                    if (item.Prime > 0) {
                        const prime = Number(item.Prime || 0);

                        // Mettre à jour les totaux
                        simulationData.totalPrime += prime;
                        simulationData.totalPurePrime += prime;

                        // Ajouter aux données de garantie
                        simulationData.garantieData.push({
                            codeGarantie: garantie.codeproduitgarantie,
                            prime: prime,
                            capital: formData.capitalSouscrit,
                            libelle: garantie.libelle || garantie.codeproduitgarantie
                        });

                        // Afficher la garantie
                        displayGarantie(
                            garantie.libelle || garantie.codeproduitgarantie,
                            prime,
                            formData.capitalSouscrit
                        );
                    }
                });
            }

        } catch (error) {
            console.error(`Erreur pour la garantie ${garantie.codeproduitgarantie}:`, error);
            showNotification(`Erreur lors du calcul de ${garantie.libelle || garantie.codeproduitgarantie}`, "error");
        }
    }

    /**
     * Ajoute la garantie senior
     */
    async function addSeniorGarantie(formData) {
        return new Promise((resolve) => {
            const seniorPrime = parseFloat(elements.seniorPrimeInput?.value) || 0;

            if (seniorPrime <= 0) {
                showNotification("Veuillez saisir une prime valide pour la garantie Senior", "error");
                resolve(false);
                return;
            }

            // Mettre à jour les totaux
            simulationData.totalPrime += seniorPrime;
            simulationData.totalPurePrime += seniorPrime;

            // Ajouter aux données
            simulationData.garantieData.push({
                codeGarantie: "SENIOR",
                prime: seniorPrime,
                capital: CONSTANTS.CAPITAL_SENIOR,
                libelle: "Garantie optionnelle Senior"
            });

            // Afficher la garantie
            displayGarantie(
                "Garantie Senior",
                seniorPrime,
                CONSTANTS.CAPITAL_SENIOR
            );

            resolve(true);
        });
    }

    /**
     * Finalise la simulation
     */
    function finishSimulation(formData) {
        // Masquer le chargement
        hideLoading();

        // Mettre à jour le total affiché
        if (elements.primeTotal) {
            elements.primeTotal.textContent = simulationData.totalPrime.toLocaleString('fr-FR');
        }

        // Afficher le total
        displayTotal();

        // Construire les données de simulation
        simulationData.infoSimulation = {
            isAssure: formData.isAssure,
            primeFinal: simulationData.totalPrime,
            primepricipale: simulationData.totalPurePrime,
            codeProduit: CONSTANTS.CODE_PRODUIT,
            periodicite: formData.codePeriodicite,
            duree: formData.duree,
            age: formData.age,
            capital: formData.capitalSouscrit,
            dateEffet: formData.dateEffet,
            datenaissance: formData.dateNaissance,
            fraisadhesion: CONSTANTS.FRAIS_ADHESION
        };

        console.log("Données de simulation:", simulationData);

        // Sauvegarder dans sessionStorage
        sessionStorage.setItem("simulationData", JSON.stringify(simulationData));

        // Envoyer au serveur
        sendSimulationToServer();

        // Activer le bouton de souscription
        setSouscriptionButtonState(simulationData.totalPurePrime > 10);

        showNotification("Simulation effectuée avec succès", "success");
    }

    /**
     * Envoie les données de simulation au serveur
     */
    function sendSimulationToServer() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

        if (!csrfToken) {
            console.error("CSRF token non trouvé");
            return;
        }

        fetch("{{ route('storeSimulationPrime') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            },
            body: JSON.stringify(simulationData)
        })
        .then(response => {
            if (!response.ok) throw new Error("Erreur réseau");
            return response.json();
        })
        .then(data => {
            if (data && !data.error) {
                console.log("Simulation enregistrée avec succès");
            } else {
                throw new Error(data?.message || "Erreur serveur");
            }
        })
        .catch(error => {
            console.error("Erreur d'envoi:", error);
        });
    }

    // ==================== FONCTIONS D'AFFICHAGE ====================

    /**
     * Nettoie les résultats précédents
     */
    function clearResults() {
        if (elements.result) {
            elements.result.innerHTML = "";
        }
    }

    /**
     * Affiche une garantie dans le tableau
     */
    function displayGarantie(libelle, prime, capital) {
        if (!elements.result) return;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${libelle}</td>
            <td class="text-end">${prime.toLocaleString('fr-FR')} FCFA</td>
            <td class="text-end">${capital.toLocaleString('fr-FR')} FCFA</td>
        `;
        elements.result.appendChild(row);
    }

    /**
     * Affiche le total des primes
     */
    function displayTotal() {
        if (!elements.result) return;

        const row = document.createElement('tr');
        row.className = 'table-primary';
        row.innerHTML = `
            <td colspan="2"><strong>TOTAL PRIME / périodique</strong></td>
            <td class="text-end"><strong>${simulationData.totalPurePrime.toLocaleString('fr-FR')} FCFA</strong></td>
        `;
        elements.result.appendChild(row);
    }

    /**
     * Affiche l'indicateur de chargement
     */
    function showLoading() {
        if (!elements.result) return;

        elements.result.innerHTML = `
            <tr>
                <td colspan="3" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Calcul en cours...</span>
                    </div>
                    <p class="mt-2 mb-0">Calcul des primes en cours...</p>
                </td>
            </tr>
        `;
    }

    /**
     * Masque l'indicateur de chargement
     */
    function hideLoading() {
        // Supprimer la ligne de chargement si elle existe
        if (elements.result) {
            const loadingRow = elements.result.querySelector('.text-center.py-4');
            if (loadingRow) {
                const row = loadingRow.closest('tr');
                if (row) row.remove();
            }
        }
    }

    /**
     * Affiche une notification
     */
    function showNotification(message, type = "info") {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
        notification.style.zIndex = '9999';
        notification.style.maxWidth = '400px';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        document.body.appendChild(notification);

        // Auto-suppression après 5 secondes
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    // Initialisation - définir la date d'effet par défaut
    if (elements.dateEffet) {
        const today = new Date().toISOString().split('T')[0];
        elements.dateEffet.value = today;
    }
});
