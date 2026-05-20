@extends('layouts.main')

@section('content')

<style>
    .ribbon {
        position: relative;
        background: #11771f;
        color: white;
        padding: 10px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }

    .btn-inactif {
        background-color: #d9d9d9;
        color: #666;
        cursor: not-allowed;
        pointer-events: none;
    }

    .optional-garantie {
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border-left: 4px solid #6c757d;
    }

    .api-info {
        background-color: #e9ecef;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        font-size: 0.9em;
    }

    .loading {
        color: #6c757d;
        font-style: italic;
    }

    .auto-update {
        border-left: 4px solid #0d6efd;
    }

    .sante-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
        border: 1px solid #dee2e6;
    }

    .sante-title {
        background-color: #e9ecef;
        padding: 8px;
        margin: -15px -15px 15px -15px;
        border-radius: 8px 8px 0 0;
        font-weight: bold;
    }

    .pathologie-row {
        margin-bottom: 10px;
        padding: 5px;
        border-bottom: 1px dashed #dee2e6;
    }

    .radio-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card p-4 auto-update">
                <h4 class="text-center text-uppercase">Simulateur de prime</h4>
                <fieldset>
                    <legend class="text-center w-auto float-none px-2 "><small>Données de simulation</small></legend>

                    <form id="primeFormLprevo">
                        @csrf

                       <div class="form-group row">

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Code Produit :</label>
                                <input type="text" class="form-control" id="CodeProduit" name="CodeProduit"
                                    value="{{ $formule['CodeProduit']}}" required readonly>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Périodicité :</label>
                                <input type="hidden" id="codePeriodiciteLprevo" name="codePeriodicite" value="A">
                                <input type="text" class="form-control" value="ANNUELLE" readonly>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Capital souhaité :</label>
                                <div class="input-group">
                                    <select name="capitalSouscrit" id="capitalSouscrit" class="form-select" required>
                                        <option value="" selected>Sélectionnez un capital</option>
                                        <option value="100000">100 000</option>
                                        <option value="250000">250 000</option>
                                        <option value="500000">500 000</option>
                                    </select>
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Durée :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="dureeLprevo"
                                        name="duree" value="1" min="1" max="1" required readonly>
                                    <span class="input-group-text">Année</span>
                                </div>
                            </div>

                        </div>

                        <!-- Formulaire de déclaration de santé -->
                        <div class="sante-card">
                            <div class="sante-title">
                                <i class="fas fa-heartbeat me-2"></i>Déclaration de santé "Assuré" par le souscripteur
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="bonneSante" checked>
                                    <label class="form-check-label fw-bold" for="bonneSante">
                                        L'assuré déclare être en bonne santé.
                                    </label>
                                </div>
                            </div>

                            <div class="alert alert-info mb-3">
                                <small><i class="fas fa-info-circle me-1"></i>L'assuré souffre-t-il de l'une des conditions suivantes :</small>
                            </div>

                            <div class="row">
                                <div class="pathologie-row col-sm-12 col-md-6 col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="fw-bold">Diabète :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <div class="radio-option">
                                                    <input type="radio" name="diabete" id="diabeteOui" value="oui" class="pathologie-radio" data-pathologie="diabete">
                                                    <label for="diabeteOui">Oui</label>
                                                </div>
                                                <div class="radio-option">
                                                    <input type="radio" name="diabete" id="diabeteNon" value="non" checked class="pathologie-radio" data-pathologie="diabete">
                                                    <label for="diabeteNon">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pathologie-row col-sm-12 col-md-6 col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="fw-bold">AVC :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <div class="radio-option">
                                                    <input type="radio" name="avc" id="avcOui" value="oui" class="pathologie-radio" data-pathologie="avc">
                                                    <label for="avcOui">Oui</label>
                                                </div>
                                                <div class="radio-option">
                                                    <input type="radio" name="avc" id="avcNon" value="non" checked class="pathologie-radio" data-pathologie="avc">
                                                    <label for="avcNon">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pathologie-row col-sm-12 col-md-6 col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="fw-bold">Cancer :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <div class="radio-option">
                                                    <input type="radio" name="cancer" id="cancerOui" value="oui" class="pathologie-radio" data-pathologie="cancer">
                                                    <label for="cancerOui">Oui</label>
                                                </div>
                                                <div class="radio-option">
                                                    <input type="radio" name="cancer" id="cancerNon" value="non" checked class="pathologie-radio" data-pathologie="cancer">
                                                    <label for="cancerNon">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pathologie-row col-sm-12 col-md-6 col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="fw-bold">Hypertension :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <div class="radio-option">
                                                    <input type="radio" name="hypertension" id="hypertensionOui" value="oui" class="pathologie-radio" data-pathologie="hypertension">
                                                    <label for="hypertensionOui">Oui</label>
                                                </div>
                                                <div class="radio-option">
                                                    <input type="radio" name="hypertension" id="hypertensionNon" value="non" checked class="pathologie-radio" data-pathologie="hypertension">
                                                    <label for="hypertensionNon">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pathologie-row col-sm-12 col-md-6 col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="fw-bold">Insuffisance Rénale :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <div class="radio-option">
                                                    <input type="radio" name="insuffRenale" id="insuffRenaleOui" value="oui" class="pathologie-radio" data-pathologie="insuffRenale">
                                                    <label for="insuffRenaleOui">Oui</label>
                                                </div>
                                                <div class="radio-option">
                                                    <input type="radio" name="insuffRenale" id="insuffRenaleNon" value="non" checked class="pathologie-radio" data-pathologie="insuffRenale">
                                                    <label for="insuffRenaleNon">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mt-3">
                            <button type="button" id="resetBtn" class="btn btn-outline-secondary w-100 mt-2">Réinitialiser</button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
           <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-white text-center py-3">
                    <h5 class="text-uppercase mb-0">Résultat du simulateur</h5>
                </div>

                <div class="card-body">
                    <div class="container">
                        <table class="table table-bordered table-striped ">
                            <thead class="table-light ">
                                <tr>
                                    <th>Garantie</th>
                                    <th>Prime</th>
                                    <th>Capital</th>
                                </tr>
                            </thead>
                            <tbody id="result" class="">
                                <!-- Les résultats seront affichés ici -->
                                <tr>
                                    <td colspan="3" class="text-center">Veuillez remplir les informations de simulation</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <tr>
                                <td><strong class="text-uppercase fs-6">Frais d'adhésion </strong><small class="text-muted text-danger">(payable une seule fois)</small></td>
                                <td><span class="text-success">+</span> <strong> {{ number_format(5500, 0, ',', ' ')}}</strong> FCFA</td>
                            </tr>
                            <tr id="pathologiePrimeRow" style="display: none;">
                                <td><strong class="text-uppercase fs-6">Suppl. pathologie(s)</strong></td>
                                <td><span class="text-warning">+</span> <strong id="pathologiePrimeMontant">0</strong> FCFA</td>
                            </tr>
                        </table>

                        <div class="ribbon">Prime totale/annuelle</div>

                        <table class="table">
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Montant total (F CFA):</td>
                                    <td id="primeTotal" class="fw-bold">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <a href="{{ route('prod.create',$product->CodeProduit) }}" id="btn-souscription" class="btn btn-primary btn btn-inactif">Souscrire</a>
            </div>
        </div>
    </div>
</div>

<script>
    const garanties = @json($productGarantie);
    const garantieObli = @json($garantieObli);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        sessionStorage.removeItem("simulationData");

        const garanties = @json($productGarantie);
        const garantieObli = @json($garantieObli);

        const fraie_adhesion = 5500;
        const primePathologie = 5500; // Prime supplémentaire par pathologie

        const simulationData = {
            garantieData: [],
            infoSimulation: {},
            pathologies: [] // Pour stocker les pathologies sélectionnées
        };

        const capitalSelect = document.getElementById("capitalSouscrit");
        const bonneSanteCheck = document.getElementById("bonneSante");
        const radiosPathologie = document.querySelectorAll('.pathologie-radio');

        // Gestion de la checkbox "bonne santé"
        bonneSanteCheck.addEventListener('change', function() {
            if (this.checked) {
                // Réinitialiser tous les radios à "Non"
                radiosPathologie.forEach(radio => {
                    if (radio.value === 'non') {
                        radio.checked = true;
                    }
                });
            }
            calculerSimulation();
        });

        // Désactiver la checkbox "bonne santé" si un "Oui" est coché
        radiosPathologie.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'oui') {
                    bonneSanteCheck.checked = false;
                } else {
                    // Vérifier si tous les radios sont à "Non"
                    const tousNon = Array.from(radiosPathologie).every(r => r.value === 'non' || !r.checked);
                    if (tousNon) {
                        bonneSanteCheck.checked = true;
                    }
                }
                calculerSimulation();
            });
        });

        capitalSelect.addEventListener("change", calculerSimulation);

        function calculerPathologies() {
            const pathologies = [];

            if (document.querySelector('input[name="diabete"]:checked')?.value === 'oui') {
                pathologies.push('Diabète');
            }
            if (document.querySelector('input[name="avc"]:checked')?.value === 'oui') {
                pathologies.push('AVC');
            }
            if (document.querySelector('input[name="cancer"]:checked')?.value === 'oui') {
                pathologies.push('Cancer');
            }
            if (document.querySelector('input[name="insuffRenale"]:checked')?.value === 'oui') {
                pathologies.push('Insuffisance Rénale');
            }
            if (document.querySelector('input[name="hypertension"]:checked')?.value === 'oui') {
                pathologies.push('Hypertension');
            }

            return pathologies;
        }

        function calculerSimulation() {

            const capital = capitalSelect.value;

            if(!capital){
                return;
            }

            // Calcul de la prime de base selon le capital
            let primeBase = 0;

            switch(capital){
                case "100000":
                    primeBase = 1000;
                    break;
                case "250000":
                    primeBase = 2500;
                    break;
                case "500000":
                    primeBase = 5000;
                    break;
            }

            // Calcul des pathologies
            const pathologies = calculerPathologies();
            const primePathologiesTotal = pathologies.length * primePathologie;

            // Prime totale (base + pathologies)
            const primeTotale = primeBase + primePathologiesTotal + fraie_adhesion;

            // Mise à jour de l'affichage de la ligne des pathologies
            const pathologieRow = document.getElementById('pathologiePrimeRow');
            const pathologieMontant = document.getElementById('pathologiePrimeMontant');

            if (pathologies.length > 0) {
                pathologieRow.style.display = 'table-row';
                pathologieMontant.textContent = primePathologiesTotal.toLocaleString();
            } else {
                pathologieRow.style.display = 'none';
            }

            simulationData.garantieData = [];
            simulationData.garantieData.push({
                codeGarantie: garantieObli[0].codeproduitgarantie,
                prime: primeBase,
                capital: capital,
                libelle: garantieObli[0].libelle
            });

            simulationData.pathologies = pathologies;
            simulationData.infoSimulation = {
                isAssure: "oui",
                primeFinal: primeTotale,
                primepricipale: primeBase,
                primePathologies: primePathologiesTotal,
                codeProduit: "LPREVO",
                periodicite: "A",
                duree: 1,
                surprime: primePathologiesTotal,
                capital: capital,
                fraisadhesion: fraie_adhesion,
                bonneSante: bonneSanteCheck.checked,
                pathologies: pathologies
            };

            afficherResultat(primeBase, primePathologiesTotal, capital, primeTotale);
            sessionStorage.setItem("simulationData", JSON.stringify(simulationData));

            envoyerSimulation();
            activerSouscription();
        }

        function afficherResultat(primeBase, primePathologies, capital, primeTotale){

            let pathologiesHtml = '';
            if (primePathologies > 0) {
                pathologiesHtml = `
                    <tr class="text-muted">
                        <td colspan="3">
                            <small><i class="fas fa-exclamation-triangle text-warning"></i> Supplément pathologies : ${primePathologies.toLocaleString()} FCFA</small>
                        </td>
                    </tr>
                `;
            }

            document.getElementById('result').innerHTML = `
                <tr>
                    <td>${garantieObli[0].libelle}</td>
                    <td>${primeBase.toLocaleString()}</td>
                    <td>${Number(capital).toLocaleString()}</td>
                </tr>
                ${pathologiesHtml}
            `;

            document.getElementById('primeTotal').innerHTML = primeTotale.toLocaleString();
        }

        function activerSouscription(){
            const btn = document.getElementById('btn-souscription');
            btn.classList.remove('btn-inactif');
        }

        function envoyerSimulation(){
            fetch("{{ route('storeSimulationPrime') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify(simulationData)
            })
            .then(res => res.json())
            .then(data => {
                console.log("Simulation enregistrée", data);
            })
            .catch(error => {
                console.error(error);
            });
        }

        document.getElementById("resetBtn").addEventListener("click", function() {
            capitalSelect.value = "";

            // Réinitialiser la déclaration de santé
            bonneSanteCheck.checked = true;
            radiosPathologie.forEach(radio => {
                if (radio.value === 'non') {
                    radio.checked = true;
                }
            });

            document.getElementById('result').innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">
                        Veuillez remplir les informations de simulation
                    </td>
                </tr>
            `;

            document.getElementById('primeTotal').innerHTML = "0";
            document.getElementById('pathologiePrimeRow').style.display = 'none';
            document.getElementById('btn-souscription').classList.add('btn-inactif');
        });
    });
</script>
@endsection
