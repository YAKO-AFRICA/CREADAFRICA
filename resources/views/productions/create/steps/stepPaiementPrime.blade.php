<div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
    <h5 class="mb-1">Informations relatives aux modes de paiement et à la périodicité</h5>
    <p class="mb-4">Veuillez entrer les informations relatives aux modes de paiement et à la périodicité en tenant compte
        des champs obligatoires.</p>

    <div class="row g-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes par : <span class="text-danger">*</span></label>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="ESP"
                                id="Espece" disabled>
                            <label class="form-check-label" for="Espece">
                                Espèce
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="CHK"
                                id="Cheque">
                            <label class="form-check-label" for="Cheque">
                                Chèque
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="VIR"
                                id="Virement_bancaire" required>
                            <label class="form-check-label" for="Virement_bancaire">
                                Virement bancaire
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                                value="SOURCE" id="Prelevement_source">
                            <label class="form-check-label" for="Prelevement_source">
                                Solde
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                                value="SOCIETE" id="Prelevement_societe">
                            <label class="form-check-label" for="Prelevement_societe">
                                SOCIETE
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="EBANK"
                                id="EBANK">
                            <label class="form-check-label" for="EBANK">
                                Electronique Banking
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="DEF"
                                id="DEF">
                            <label class="form-check-label" for="DEF">
                                Defense
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                                value="ADF" id="Prelevement_ADF">
                            <label class="form-check-label" for="Prelevement_ADF">
                                A definir
                            </label>
                        </div>
                    </div>

                    <!-- SECTION BANCAIRE -->
                    <div class="row mb-3" id="mode_bancaire" style="display: none;">
                        <div class="mb-3" style="width: 100%">
                            <label for="banque" class="form-label">Ma banque ou organisme de prélèvement</label>
                            <br>
                            <select class="form-select selection" id="banque" name="organisme" style="width: 100%">
                                <option selected value="" disabled>Sélectionnez la banque</option>
                                <!-- Les options seront chargées dynamiquement par l'API -->
                            </select>
                        </div>
                        <div class="mb-3" style="width: 100%">
                            <label for="agence" class="form-label">L'agence de prélèvement</label>
                            <br>
                            <select class="form-select selection" id="agence" name="agence" style="width: 100%">
                                <option selected value="" disabled>Sélectionnez l'agence</option>
                                <!-- Les options seront chargées dynamiquement par l'API -->
                            </select>
                        </div>

                        <div class="col-12 mb-3 row w-100">
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <label class="form-label small">Code Banque</label>
                                <input type="text" class="form-control account-number-input" id="codebanque"
                                    placeholder="30003" minlength="5" maxlength="5" name="codebanque" readonly>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <label class="form-label small">Code Guichet</label>
                                <input type="text" class="form-control account-number-input" id="codeguichet"
                                    placeholder="02005" minlength="5" maxlength="5" name="codeguichet" readonly>
                            </div>
                            <div class="col-sm-8 col-md-5 col-lg-5">
                                <label class="form-label small">Numéro de compte</label>
                                <input type="text" class="form-control account-number-input" id="numerocompte"
                                    placeholder="00123456789" maxlength="11" pattern="[0-9]{11}" name="numerocompte"
                                    autocomplete="off">
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label class="form-label small">Clé RIB</label>
                                <input type="text" class="form-control account-number-input" id="rib"
                                    placeholder="12" maxlength="2" pattern="[0-9]{2}" name="rib"
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="bx bxs-show me-2"></i>Aperçu du numéro complet
                            </label>
                            <div class="form-control bg-secondary text-white" id="numero_complet" style="text-align: center; font-size: 18px;">
                                _____ - _____ - ___________ - __
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="mode_ebank" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="numMobile" class="form-label">Mon N° Mobile</label>
                            <input type="text" class="form-control" id="numMobile" name="numMobile">
                        </div>
                    </div>

                    <div class="mb-3" id="mode_defense" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="matricule" class="form-label">N° Mecano / N° Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <label for="Conseiller" class="form-label">Votre conseiller client</label>
                            <input type="text" class="form-control" id="Conseiller" name="Conseiller" disabled
                                value="{{ Auth::user()->membre->nom ?? '' }} {{ Auth::user()->membre->prenom ?? '' }}">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="CodeConseiller" class="form-label">Code</label>
                            <input type="text" class="form-control" id="CodeConseiller" name="codeConseiller"
                                disabled value="{{ Auth::user()->membre->codeagent ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            @if($product->CodeProduit == 'CADENCE')
                <div>
                    <fieldset class="border p-3">
                        <legend class="float-none w-auto px-2">
                            <small>Le capital garanti au contrat doit être réservé au(x) bénéficiaire(s) sous la forme</small>
                        </legend>

                        <!-- Options principales -->
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mode_reserversement" id="paiement_unique" value="unique">
                                <label class="form-check-label" for="paiement_unique">
                                    Paiement unique à la date d’échéance
                                </label>
                            </div>

                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="mode_reserversement" id="rente_certaine" value="rente">
                                <label class="form-check-label" for="rente_certaine">
                                    Rente certaine payée sur une durée
                                </label>
                            </div>
                        </div>

                        <!-- Bloc échéance -->
                        <div id="echeanceBloc" class="mt-3 d-none">
                            <label class="form-label"><strong>Type d’échéance</strong></label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="echeance_reversement" id="mensuelle" value="mensuelle">
                                <label class="form-check-label" for="mensuelle">Mensuelle</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="echeance_reversement" id="trimestrielle" value="trimestrielle">
                                <label class="form-check-label" for="trimestrielle">Trimestrielle</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="echeance_reversement" id="annuelle" value="annuelle">
                                <label class="form-check-label" for="annuelle">Annuelle</label>
                            </div>
                        </div>

                        <!-- Durée (uniquement rente certaine) -->
                        <div id="dureeBloc" class="mt-3 d-none">
                            <label class="form-label">
                                <strong>Durée de la rente (en années)</strong>
                            </label>
                            <input
                                type="number"
                                id="duree_reversement"
                                name="duree_reversement"
                                class="form-control"
                                min="1"
                                placeholder="Ex : 5">
                        </div>
                    </fieldset>
                </div>
            @endif
        </div>

        <div class="col-12 col-lg-4">
            <div class="card mx-0">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes chaque : <span class="text-danger">*</span></label>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="M"
                                id="Mois" required>
                            <label class="form-check-label" for="Mois">
                                Mois
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="T"
                                id="Trimestre">
                            <label class="form-check-label" for="Trimestre">
                                Trimestre
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="S"
                                id="Semestre">
                            <label class="form-check-label" for="Semestre">
                                Semestre
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="A"
                                id="Annee">
                            <label class="form-check-label" for="Annee">
                                Année
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="U"
                                id="Versement_unique">
                            <label class="form-check-label" for="Versement_unique">
                                Versement unique
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        @if ($product->CodeProduit == 'PFA_IND')
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le : <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    : <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale"
                                    min="100" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations (en année, entre 6
                                    et 60) :
                                    </label>
                                <input type="number" min="6" max="60" class="form-control"
                                    id="duree" name="duree" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="montantrente" class="form-label">Montant de la rente (en FCFA) :
                                    <span class="text-danger">*</span></label>
                                <select name="montantrente" id="montantrente" class="form-select" required>
                                    <option value="" selected>Selectionnez le montant de la rente</option>
                                    <option value="50000">50 000</option>
                                    <option value="75000">75 000</option>
                                    <option value="100000">100 000</option>
                                    <option value="150000">150 000</option>
                                    <option value="200000">200 000</option>
                                    <option value="250000">250 000</option>
                                    <option value="500000">500 000</option>
                                    <option value="1000000">1000 000</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Périodicité de la rente:</label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="M" id="Moisrente">
                                        <label class="form-check-label" for="Moisrente">
                                            Mois
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="T" id="Trimestrerente">
                                        <label class="form-check-label" for="Trimestrerente">
                                            Trimestre
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="S" id="Semestrerente">
                                        <label class="form-check-label" for="Semestrerente">
                                            Semestre
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="A" id="Anneerente">
                                        <label class="form-check-label" for="Anneerente">
                                            Année
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="dureerente" class="form-label">Durée de service de la rente (en mois) :</label>
                                <select name="dureerente" id="dureerente" class="form-select">
                                    <option value="" selected>Selectionnez la durée de service de la rente</option>
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                </select>
                            </div>
                        @else
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label input-group-label">Je souhaite payer une prime de :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="primepricipale" name="primepricipale" min="0" required>
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="fraisadhesion" class="form-label">Frais d’adhésion :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="fraisadhesion" name="fraisadhesion"
                                        min="0"  value="7500">
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="surprime" class="form-label">Surprime :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="surprime" name="surprime">
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit (en FCFA) :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="capital" name="capital" required>
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="duree" name="duree" min="0">
                                    <span class="input-group-text">ANNEES</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="produitCode" name="produitCode" value="{{ $product->CodeProduit ?? '' }}">

        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <button onclick="event.preventDefault(); stepper1.previous()"
                    class="btn border-btn btn-previous-form"><i class='bx bx-left-arrow-alt'></i>Précédent</button>
                <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form">Suivant<i
                        class='bx bx-right-arrow-alt'></i></button>
            </div>
        </div>
    </div><!---end row-->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // ==================== GESTION MODES DE PAIEMENT ====================
    const modePaiementRadios = document.querySelectorAll('input[name="modepaiement"]');

    const modeBancaire = document.getElementById('mode_bancaire');
    const modeEbank = document.getElementById('mode_ebank');
    const modeDefense = document.getElementById('mode_defense');

    // Inputs bancaires
    const inputsBancaire = document.querySelectorAll('#mode_bancaire input, #mode_bancaire select');

    // Inputs ebank
    const inputsEbank = document.querySelectorAll('#mode_ebank input');

    // Inputs défense
    const inputsDefense = document.querySelectorAll('#mode_defense input');

    function resetAll() {

        // cacher les blocs
        modeBancaire.style.display = 'none';
        modeEbank.style.display = 'none';
        modeDefense.style.display = 'none';

        // enlever required partout
        [...inputsBancaire, ...inputsEbank, ...inputsDefense].forEach(input => {
            input.required = false;
            input.value = '';
        });
    }

    modePaiementRadios.forEach(radio => {

        radio.addEventListener('change', function () {

            resetAll();

            // 👉 VIREMENT
            if (this.value === 'VIR' || this.value === 'BANK') {
                modeBancaire.style.display = 'block';

                inputsBancaire.forEach(input => {
                    input.required = true;
                });
            }

            // 👉 EBANK
            if (this.value === 'EBANK' || this.value === 'Mobile_money') {
                modeEbank.style.display = 'block';

                inputsEbank.forEach(input => {
                    input.required = true;
                });
            }

            // 👉 DEFENSE
            if (this.value === 'DEF') {
                modeDefense.style.display = 'block';

                inputsDefense.forEach(input => {
                    input.required = true;
                });
            }

            // 👉 ADF, CHK, SOCIETE, ESP → rien (pas de required)

        });

    });

    // ==================== GESTION DU REVERSEMENT (CADENCE) ====================
    const modeReversementRadios = document.querySelectorAll('input[name="mode_reserversement"]');
    const echeanceBloc = document.getElementById('echeanceBloc');
    const dureeBloc = document.getElementById('dureeBloc');

    if (modeReversementRadios.length > 0) {
        modeReversementRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (echeanceBloc) echeanceBloc.classList.remove('d-none');

                if (this.value === 'rente') {
                    if (dureeBloc) dureeBloc.classList.remove('d-none');
                } else {
                    if (dureeBloc) dureeBloc.classList.add('d-none');
                    const dureeInput = document.getElementById('duree_reversement');
                    if (dureeInput) dureeInput.value = '';
                }
            });
        });
    }

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ==================== VARIABLES GLOBALES ====================
    let banquesData = [];

    // ==================== CHARGEMENT DES BANQUES ====================
    fetch('/banque-agence', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        }}).then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }

        return response.json();
    })
    .then(data => {
        console.log('Données reçues pour les banques :', data);
        banquesData = data;

        const banquesDistinctes = extraireBanquesDistinctes(data);
        remplirSelectBanques(banquesDistinctes);

        setTimeout(reinitialiserSelect2, 100);
    })
    .catch(error => {
        console.error('Erreur lors de la requête des banques :', error);
        const selectBanque = document.getElementById('banque');
        if (selectBanque) {
            selectBanque.innerHTML = '<option selected value="" disabled>Erreur de chargement des banques</option>';
            reinitialiserSelect2();
        }
    });

    // Fonction pour réinitialiser Select2
    function reinitialiserSelect2() {
        try {
            const selectBanque = document.getElementById('banque');
            if (selectBanque && typeof jQuery !== 'undefined' && jQuery(selectBanque).data('select2')) {
                jQuery(selectBanque).select2('destroy');
                jQuery(selectBanque).select2({
                    placeholder: 'Sélectionnez la banque',
                    allowClear: true
                });
            }

            const selectAgence = document.getElementById('agence');
            if (selectAgence && typeof jQuery !== 'undefined' && jQuery(selectAgence).data('select2')) {
                jQuery(selectAgence).select2('destroy');
                jQuery(selectAgence).select2({
                    placeholder: 'Sélectionnez l\'agence',
                    allowClear: true
                });
            }
        } catch (e) {
            console.error('Erreur lors de la réinitialisation de Select2:', e);
        }
    }

    // ==================== FONCTIONS DE GESTION DES BANQUES ====================

    function extraireBanquesDistinctes(data) {
        const banquesMap = new Map();

        data.forEach(item => {
            // Utiliser le SIGLE comme nom de banque
            const sigle = item.sigle || 'Autre';
            // Le code banque peut être alphanumérique, on le garde tel quel
            const codeBanque = item.codebanque ? item.codebanque.toString().trim() : '';
            const sigleClean = sigle.toString().trim();

            if (!banquesMap.has(sigleClean) && sigleClean !== '') {
                banquesMap.set(sigleClean, {
                    sigle: sigleClean,
                    codeBanque: codeBanque,
                    premiereAgence: item
                });
            }
        });

        return Array.from(banquesMap.values());
    }



    function remplirSelectBanques(banques) {
        const selectBanque = document.getElementById('banque');
        if (!selectBanque) return;

        let select2Active = false;
        if (typeof jQuery !== 'undefined' && jQuery(selectBanque).data('select2')) {
            select2Active = true;
            jQuery(selectBanque).select2('destroy');
        }

        selectBanque.innerHTML = '<option selected value="" disabled>Sélectionnez la banque</option>';

        if (banques.length === 0) {
            const option = document.createElement('option');
            option.value = "";
            option.textContent = "Aucune banque disponible";
            option.disabled = true;
            selectBanque.appendChild(option);
        } else {
            banques.sort((a, b) => a.sigle.localeCompare(b.sigle));

            banques.forEach(banque => {
                const option = document.createElement('option');
                option.value = banque.sigle;
                option.textContent = banque.sigle;
                // Le code banque peut contenir des lettres et des chiffres
                option.dataset.codeBanque = banque.codeBanque;
                selectBanque.appendChild(option);
            });
        }

        if (select2Active && typeof jQuery !== 'undefined') {
            jQuery(selectBanque).select2({
                placeholder: 'Sélectionnez la banque',
                allowClear: true
            });
        }
    }

    function chargerAgencesParCodeBanque(codeBanque) {
        const agenceSelect = document.getElementById('agence');
        if (!agenceSelect) return;

        let select2Active = false;
        if (typeof jQuery !== 'undefined' && jQuery(agenceSelect).data('select2')) {
            select2Active = true;
            jQuery(agenceSelect).select2('destroy');
        }

        agenceSelect.innerHTML = '<option selected value="" disabled>Chargement des agences...</option>';
        agenceSelect.disabled = true;

        const codeBanqueInput = document.getElementById('codebanque');
        const codeGuichetInput = document.getElementById('codeguichet');
        const numeroCompteInput = document.getElementById('numerocompte');
        const ribInput = document.getElementById('rib');

        // Le code banque peut contenir des lettres et des chiffres
        if (codeBanqueInput) codeBanqueInput.value = codeBanque || '';
        if (codeGuichetInput) codeGuichetInput.value = '';
        if (numeroCompteInput) numeroCompteInput.value = '';
        if (ribInput) ribInput.value = '';

        updateNumeroComplet();

        // Envoyer le code banque tel quel (alphanumérique)


        fetch('/banque-agence', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                codeBanque: codeBanque
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(agences => {
            remplirSelectAgences(agences, select2Active);
            agenceSelect.disabled = false;
        })
        .catch(error => {
            agenceSelect.innerHTML = '<option selected value="" disabled>Erreur de chargement des agences</option>';
            agenceSelect.disabled = false;

            if (select2Active && typeof jQuery !== 'undefined') {
                jQuery(agenceSelect).select2({
                    placeholder: 'Sélectionnez l\'agence',
                    allowClear: true
                });
            }
        });
    }

    function remplirSelectAgences(agences, reactiverSelect2 = true) {
        const agenceSelect = document.getElementById('agence');
        if (!agenceSelect) return;

        agenceSelect.innerHTML = '<option selected value="" disabled>Sélectionnez l\'agence</option>';

        if (!agences || agences.length === 0) {
            const option = document.createElement('option');
            option.value = "";
            option.textContent = "Aucune agence disponible";
            option.disabled = true;
            agenceSelect.appendChild(option);
        } else {
            agences.sort((a, b) => (a.nom_long || '').localeCompare(b.nom_long || ''));

            agences.forEach(agence => {
                const option = document.createElement('option');
                // Créer une valeur unique mais lisible
                option.value = `${agence.codebanque || ''}_${agence.codeguichet || ''}_${agence.nom_long || ''}`;
                option.textContent = agence.nom_long || 'Agence sans nom';
                // Les codes peuvent être alphanumériques
                option.dataset.codeBanque = agence.codebanque ? agence.codebanque.toString().trim() : '';
                option.dataset.codeGuichet = agence.codeguichet ? agence.codeguichet.toString().trim() : '';
                option.dataset.nomAgence = agence.nom_long || '';
                agenceSelect.appendChild(option);
            });
        }

        if (reactiverSelect2 && typeof jQuery !== 'undefined') {
            setTimeout(() => {
                jQuery(agenceSelect).select2({
                    placeholder: 'Sélectionnez l\'agence',
                    allowClear: true
                });
            }, 50);
        }
    }

    // ==================== GESTIONNAIRES D'ÉVÉNEMENTS ====================

    function handleBanqueChange(event) {
        event.stopPropagation();

        let codeBanque = null;

        // Gestion événement natif
        if (event.target && event.target.tagName === 'SELECT') {
            const selectedOption = event.target.selectedOptions[0];
            if (selectedOption && selectedOption.dataset.codeBanque) {
                codeBanque = selectedOption.dataset.codeBanque;
            }
        }
        // Gestion événement Select2
        else if (event.params && event.params.data) {
            codeBanque = event.params.data.element?.dataset?.codeBanque;
        }

        if (!codeBanque) {
            console.error('Code banque non trouvé');
            return;
        }

        console.log('Code banque sélectionné (alphanumérique):', codeBanque);
        chargerAgencesParCodeBanque(codeBanque);
    }

    function handleAgenceChange(event) {
        event.stopPropagation();

        let codeBanque = null;
        let codeGuichet = null;
        let nomAgence = null;

        if (event.target && event.target.tagName === 'SELECT') {
            const selectedOption = event.target.selectedOptions[0];
            if (selectedOption) {
                codeBanque = selectedOption.dataset.codeBanque;
                codeGuichet = selectedOption.dataset.codeGuichet;
                nomAgence = selectedOption.dataset.nomAgence;
            }
        } else if (event.params && event.params.data) {
            codeBanque = event.params.data.element?.dataset?.codeBanque;
            codeGuichet = event.params.data.element?.dataset?.codeGuichet;
            nomAgence = event.params.data.element?.dataset?.nomAgence;
        }

        const codeBanqueInput = document.getElementById('codebanque');
        const codeGuichetInput = document.getElementById('codeguichet');

        if (codeBanqueInput && codeBanque) codeBanqueInput.value = codeBanque;
        if (codeGuichetInput && codeGuichet) codeGuichetInput.value = codeGuichet;

        updateNumeroComplet();
    }

    function updateNumeroComplet() {
        const codeBanque = document.getElementById('codebanque');
        const codeGuichet = document.getElementById('codeguichet');
        const numeroCompte = document.getElementById('numerocompte');
        const rib = document.getElementById('rib');
        const numeroComplet = document.getElementById('numero_complet');

        if (!numeroComplet) return;

        // Pour l'affichage, on garde les valeurs telles quelles sans padding si ce sont des lettres
        const codeBanqueVal = codeBanque?.value || '_____';
        const codeGuichetVal = codeGuichet?.value || '_____';
        const numeroCompteVal = numeroCompte?.value || '___________';
        const ribVal = rib?.value || '__';

        // Formatage adapté : on complète avec des underscores uniquement si la valeur est plus courte
        const codeBanqueFormatted = codeBanqueVal.length < 5 ? codeBanqueVal.padEnd(5, '_') : codeBanqueVal.substring(0, 5);
        const codeGuichetFormatted = codeGuichetVal.length < 5 ? codeGuichetVal.padEnd(5, '_') : codeGuichetVal.substring(0, 5);
        const numeroCompteFormatted = numeroCompteVal.length < 11 ? numeroCompteVal.padEnd(11, '_') : numeroCompteVal.substring(0, 11);
        const ribFormatted = ribVal.length < 2 ? ribVal.padEnd(2, '_') : ribVal.substring(0, 2);

        numeroComplet.textContent = `${codeBanqueVal} - ${codeGuichetFormatted} - ${numeroCompteFormatted} - ${ribFormatted}`;
    }

    // ==================== INITIALISATION DES ÉCOUTEURS ====================

    const selectBanque = document.getElementById('banque');
    if (selectBanque) {
        selectBanque.addEventListener('change', handleBanqueChange);

        if (typeof jQuery !== 'undefined') {
            jQuery(selectBanque).on('select2:select', handleBanqueChange);
        }
    }

    const selectAgence = document.getElementById('agence');
    if (selectAgence) {
        selectAgence.addEventListener('change', handleAgenceChange);

        if (typeof jQuery !== 'undefined') {
            jQuery(selectAgence).on('select2:select', handleAgenceChange);
        }
    }

    const inputsCompte = ['numerocompte', 'rib'];
    inputsCompte.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', updateNumeroComplet);
        }
    });

    const numeroCompteInput = document.getElementById('numerocompte');
    if (numeroCompteInput) {
        numeroCompteInput.addEventListener('input', function(e) {
            // Pour le numéro de compte, on accepte uniquement les chiffres (standard bancaire)
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
            updateNumeroComplet();
        });
    }

    const ribInput = document.getElementById('rib');
    if (ribInput) {
        ribInput.addEventListener('input', function(e) {
            // Pour la clé RIB, on accepte uniquement les chiffres (standard bancaire)
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);
            updateNumeroComplet();
        });
    }

    updateNumeroComplet();
});
</script>
