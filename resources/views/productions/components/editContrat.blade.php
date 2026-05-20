<form method="POST" action="{{ route('prod.contrat.update', $contrat->id) }}" class="submitForm">
    @csrf

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-8">
            <div class="card my-3">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes par :</label>
                    <div class="mt-4">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="VIR" id="Virement_bancaire"
                                    @if ($contrat->modepaiement === 'VIR') checked @endif>
                                <label class="form-check-label" for="Virement_bancaire">Virement bancaire</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="ESP" id="Espece"
                                    @if ($contrat->modepaiement === 'ESP') checked @endif>
                                <label class="form-check-label" for="Espece">Espèce</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="CHK" id="Cheque"
                                    @if ($contrat->modepaiement === 'CHK') checked @endif>
                                <label class="form-check-label" for="Cheque">Chèque</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="EBANK" id="EBANK"
                                    @if ($contrat->modepaiement === 'Mobile_money' || $contrat->modepaiement === 'EBANK') checked @endif>
                                <label class="form-check-label" for="EBANK">Paiement Elèctronique</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="SOURCE" id="Prelevement_source"
                                    @if ($contrat->modepaiement === 'SOURCE') checked @endif>
                                <label class="form-check-label" for="Prelevement_source">Prélèvement à la source</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="SOCIETE" id="Prelevement_societe"
                                    @if ($contrat->modepaiement === 'SOCIETE') checked @endif>
                                <label class="form-check-label" for="Prelevement_societe">Prélèvement sur salaire</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="DEF" id="defense"
                                    @if ($contrat->modepaiement === 'DEF') checked @endif>
                                <label class="form-check-label" for="defense">Prélèvement à la defense</label>
                            </div>
                        </div>

                        <!-- SECTION BANCAIRE -->
                        <div class="row mb-3" id="mode_bancaire" style="display: none;">
                            <div class="col-12 mb-3">
                                <label for="banque" class="form-label">Ma banque ou organisme de prélèvement</label>
                                <select class="form-select selection" id="banque" name="organisme">
                                    <option selected value="" disabled>Sélectionnez la banque</option>
                                    <!-- Les options seront chargées dynamiquement -->
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="agence" class="form-label">L'agence de prélèvement</label>
                                <select class="form-select selection" id="agence" name="agence">
                                    <option selected value="" disabled>Sélectionnez l'agence</option>
                                    <!-- Les options seront chargées dynamiquement -->
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="codebanque" class="form-label">Code Banque</label>
                                    <input type="text" class="form-control account-number-input" id="codebanque"
                                        name="codebanque" readonly value="{{ $contrat->codebanque ?? '' }}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="codeguichet" class="form-label">Code Guichet</label>
                                    <input type="text" class="form-control account-number-input" id="codeguichet"
                                        name="codeguichet" readonly value="{{ $contrat->codeguichet ?? '' }}">
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="numerocompte" class="form-label">Mon N° de compte (Matricule)</label>
                                <input type="text" class="form-control account-number-input" id="numerocompte"
                                    name="numerocompte" value="{{ $contrat->numerocompte ?? '' }}"
                                    maxlength="11" pattern="[0-9]{11}">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="rib" class="form-label">Clé RIB</label>
                                <input type="text" class="form-control account-number-input" id="rib"
                                    name="rib" value="{{ $contrat->rib ?? '' }}"
                                    maxlength="2" pattern="[0-9]{2}">
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

                        <!-- SECTION MOBILE MONEY -->
                        <div class="mb-3" id="mode_mobile" style="display: none;">
                            <div class="col-12 mb-3">
                                <label for="numMobile" class="form-label">Mon N° Mobile</label>
                                <input type="text" class="form-control" id="numMobile" name="numMobile"
                                    value="{{ $contrat->numerocompte ?? '' }}">
                            </div>
                        </div>
                        <!-- SECTION societé de prélèvement sur salaire -->
                        <div class="mb-3 row" id="mode_societe" style="display: none;">

                            <div class="col mb-3">
                                <label for="ma_societe" class="form-label">Ma Societé</label>
                                <input type="text" class="form-control" name="ma_societe" value="{{ $contrat->organisme ?? '' }}">
                            </div>
                            <div class="col mb-3">
                                <label for="matricule" class="form-label">Mon N° Matricule / Mecano</label>
                                <input type="text" class="form-control" id="matricule" name="matricule"
                                    value="{{ $contrat->numerocompte ?? '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <label for="nomagent" class="form-label">Votre conseiller client</label>
                                <input type="text" class="form-control" id="nomagent" name="nomagent"
                                    disabled value="{{ $contrat->nomagent ?? Auth::user()->membre->nom ?? '' }} {{ Auth::user()->membre->prenom ?? '' }}">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="CodeConseiller" class="form-label">Code</label>
                                <input type="text" class="form-control" id="CodeConseiller"
                                    disabled value="{{ $contrat->codeConseiller ?? Auth::user()->membre->codeagent ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card mx-0">
                <div class="card-body">
                    <label class="form-label">Je souhaite payer mes primes chaque :</label>
                    <div class="">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="M" id="Mois"
                                    @if ($contrat->periodicite === 'M') checked @endif>
                                <label class="form-check-label" for="Mois">Mois</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="T" id="Trimestre"
                                    @if ($contrat->periodicite === 'T') checked @endif>
                                <label class="form-check-label" for="Trimestre">Trimestre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="S" id="Semestre"
                                    @if ($contrat->periodicite === 'S') checked @endif>
                                <label class="form-check-label" for="Semestre">Semestre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="A" id="Annee"
                                    @if ($contrat->periodicite === 'A') checked @endif>
                                <label class="form-check-label" for="Annee">Année</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="U" id="Versement_unique"
                                    @if ($contrat->periodicite === 'U') checked @endif>
                                <label class="form-check-label" for="Versement_unique">Versement unique</label>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="duree">Durée <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" min="0" id="duree" name="duree"  value="{{ $contrat->duree ?? 0 }}" required>
                                <span class="input-group-text">Ans</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le : <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{ $contrat->dateeffet ?? '' }}" id="DateEffet" name="dateEffet" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de : <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="primepricipale" name="primepricipale"
                                    min="1000" value="{{ $contrat->primepricipale ?? '' }}" readonly required>
                                    <div class="input-group-text">FCFA</div>
                                </div>

                            </div>
                            <div class="col-12 mb-3">
                                <label for="surprime" class="form-label">Surprime : </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="surprime" name="surprime"
                                    min="0" value="{{ $contrat->surprime ?? '' }}">
                                    <div class="input-group-text">FCFA</div>
                                </div>

                            </div>
                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="capital" name="capital"
                                    value="{{ $contrat->capital ?? '' }}" readonly>
                                    <div class="input-group-text">FCFA</div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="rente" class="form-label">Montant de la Rente :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="rente" name="rente"
                                    value="{{ $contrat->montantrente ?? '' }}" readonly>
                                    <div class="input-group-text">FCFA</div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="fraisadhesion" class="form-label">Frais d'adhesion :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="fraisadhesion" name="fraisadhesion"
                                        value="{{ $contrat->fraisadhesion ?? '' }}">
                                    <div class="input-group-text">FCFA</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer mb-3">
        <button type="submit" class="btn btn-md btn-primary">Enregistrer</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {


    // ==================== GESTION MODES DE PAIEMENT ====================
    const modePaiementRadios = document.querySelectorAll('input[name="modepaiement"]');
    const modeBancaire = document.getElementById('mode_bancaire');
    const modeMobile = document.getElementById('mode_mobile');
    const modeSociete = document.getElementById('mode_societe');

    // Inputs bancaires
    const inputsBancaire = document.querySelectorAll('#mode_bancaire input, #mode_bancaire select');
    const inputsMobile = document.querySelectorAll('#mode_mobile input');
    const inputsSociete = document.querySelectorAll('#mode_societe input');

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ==================== VARIABLES GLOBALES ====================
    let banquesData = [];
    let currentBanqueSigle = null;

    // Récupérer la banque et l'agence actuelles du contrat
    const currentBanque = "{{ $contrat->organisme ?? '' }}";
    const currentAgence = "{{ $contrat->agence ?? '' }}";
    const currentCodeBanque = "{{ $contrat->codebanque ?? '' }}";
    const currentCodeGuichet = "{{ $contrat->codeguichet ?? '' }}";

    function resetAllSections() {
        // Cacher les blocs
        if (modeBancaire) modeBancaire.style.display = 'none';
        if (modeMobile) modeMobile.style.display = 'none';
        if (modeSociete) modeSociete.style.display = 'none';

        // Enlever required partout
        [...inputsBancaire, ...inputsMobile].forEach(input => {
            input.required = false;
        });
    }

    // Gestion de l'affichage des sections selon le mode de paiement
    modePaiementRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            resetAllSections();

            // Virement bancaire
            if (this.value === 'VIR') {
                if (modeBancaire) modeBancaire.style.display = 'block';
                inputsBancaire.forEach(input => {
                    input.required = true;
                });
            }

            // Mobile money
            if (this.value === 'EBANK') {
                // alert('EBANK');
                if (modeMobile) modeMobile.style.display = 'block';
                inputsMobile.forEach(input => {
                    input.required = true;
                });
            }
            // modeSociete
            if (this.value === 'SOCIETE' || this.value === 'DEF') {
                // alert('EBANK');
                if (modeSociete) modeSociete.style.display = 'block';
                inputsSociete.forEach(input => {
                    input.required = true;
                });
            }
        });
    });



    // ==================== FONCTIONS DE GESTION DES BANQUES ====================

    function extraireBanquesDistinctes(data) {
        const banquesMap = new Map();

        data.forEach(item => {
            const sigle = item.sigle || 'Autre';
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

        // Sélectionner la banque actuelle si elle existe
        if (currentBanque) {
            selectBanque.value = currentBanque;
            // Déclencher le chargement des agences
            chargerAgencesParCodeBanque(currentCodeBanque, currentAgence);
        }
    }

    function chargerAgencesParCodeBanque(codeBanque, selectedAgence = null) {
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

        if (codeBanqueInput) codeBanqueInput.value = codeBanque || '';
        if (codeGuichetInput) codeGuichetInput.value = '';

        updateNumeroComplet();

        fetch('/banque-agence', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ codeBanque: codeBanque })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(agences => {
            remplirSelectAgences(agences, select2Active, selectedAgence);
            agenceSelect.disabled = false;
        })
        .catch(error => {
            console.error('Erreur lors du chargement des agences:', error);
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

    function remplirSelectAgences(agences, reactiverSelect2 = true, selectedAgence = null) {
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
                option.value = agence.nom_long || '';
                option.textContent = agence.nom_long || 'Agence sans nom';
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

                // Sélectionner l'agence actuelle si elle existe
                if (selectedAgence) {
                    jQuery(agenceSelect).val(selectedAgence).trigger('change');
                }
            }, 50);
        } else if (selectedAgence) {
            agenceSelect.value = selectedAgence;
            // Déclencher manuellement le changement pour remplir les champs
            const changeEvent = new Event('change', { bubbles: true });
            agenceSelect.dispatchEvent(changeEvent);
        }
    }

    // ==================== GESTIONNAIRES D'ÉVÉNEMENTS ====================

    function handleBanqueChange(event) {
        event.stopPropagation();

        let codeBanque = null;
        let selectedSigle = null;

        // Gestion événement natif
        if (event.target && event.target.tagName === 'SELECT') {
            const selectedOption = event.target.selectedOptions[0];
            if (selectedOption && selectedOption.dataset.codeBanque) {
                codeBanque = selectedOption.dataset.codeBanque;
                selectedSigle = event.target.value;
            }
        }
        // Gestion événement Select2
        else if (event.params && event.params.data) {
            codeBanque = event.params.data.element?.dataset?.codeBanque;
            selectedSigle = event.params.data.id;
        }

        if (!codeBanque) {
            console.error('Code banque non trouvé');
            return;
        }

        currentBanqueSigle = selectedSigle;
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

        const codeBanqueVal = codeBanque?.value || '_____';
        const codeGuichetVal = codeGuichet?.value || '_____';
        const numeroCompteVal = numeroCompte?.value || '___________';
        const ribVal = rib?.value || '__';

        const codeBanqueFormatted = codeBanqueVal.length < 5 ? codeBanqueVal.padEnd(5, '_') : codeBanqueVal.substring(0, 5);
        const codeGuichetFormatted = codeGuichetVal.length < 5 ? codeGuichetVal.padEnd(5, '_') : codeGuichetVal.substring(0, 5);
        const numeroCompteFormatted = numeroCompteVal.length < 11 ? numeroCompteVal.padEnd(11, '_') : numeroCompteVal.substring(0, 11);
        const ribFormatted = ribVal.length < 2 ? ribVal.padEnd(2, '_') : ribVal.substring(0, 2);

        numeroComplet.textContent = `${codeBanqueVal} - ${codeGuichetFormatted} - ${numeroCompteFormatted} - ${ribFormatted}`;
    }

    // ==================== CHARGEMENT DES BANQUES ====================
    fetch('/banque-agence', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => {
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

        setTimeout(() => {
            // Réinitialiser Select2 après chargement
            if (typeof jQuery !== 'undefined') {
                const selectBanque = document.getElementById('banque');
                if (selectBanque && !jQuery(selectBanque).data('select2')) {
                    jQuery(selectBanque).select2({
                        placeholder: 'Sélectionnez la banque',
                        allowClear: true
                    });
                }
            }
        }, 100);
    })
    .catch(error => {
        console.error('Erreur lors de la requête des banques :', error);
        const selectBanque = document.getElementById('banque');
        if (selectBanque) {
            selectBanque.innerHTML = '<option selected value="" disabled>Erreur de chargement des banques</option>';
        }
    });

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
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
            updateNumeroComplet();
        });
    }

    const ribInput = document.getElementById('rib');
    if (ribInput) {
        ribInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);
            updateNumeroComplet();
        });
    }

    updateNumeroComplet();
});
</script>

<script>
// Fonction pour activer/désactiver les sections et les champs requis
function activatePaymentMode() {
    const selectedMode = document.querySelector('input[name="modepaiement"]:checked');

    console.log('Mode sélectionné:', selectedMode ? selectedMode.value : 'Aucun'); // Debug

    // Références aux sections
    const modeBancaire = document.getElementById('mode_bancaire');
    const modeMobile = document.getElementById('mode_mobile');
    const modeSociete = document.getElementById('mode_societe');

    // Références aux inputs
    const inputsBancaire = document.querySelectorAll('#mode_bancaire input, #mode_bancaire select');
    const inputsMobile = document.querySelectorAll('#mode_mobile input');
    const inputsSociete = document.querySelectorAll('#mode_societe input');

    // Cacher toutes les sections
    if (modeBancaire) modeBancaire.style.display = 'none';
    if (modeMobile) modeMobile.style.display = 'none';
    if (modeSociete) modeSociete.style.display = 'none';

    // Désactiver tous les inputs de toutes les sections
    inputsBancaire.forEach(input => {
        input.required = false;
        input.disabled = true; // Désactiver les champs
    });
    inputsMobile.forEach(input => {
        input.required = false;
        input.disabled = true;
    });
    inputsSociete.forEach(input => {
        input.required = false;
        input.disabled = true;
    });

    // Activer la section correspondante
    if (selectedMode) {
        if (selectedMode.value === 'VIR') {
            if (modeBancaire) {
                modeBancaire.style.display = 'block';
                inputsBancaire.forEach(input => {
                    input.required = true;
                    input.disabled = false; // Activer les champs
                });
                console.log('Mode bancaire activé'); // Debug
            }
        } else if (selectedMode.value === 'EBANK') {
            if (modeMobile) {
                modeMobile.style.display = 'block';
                inputsMobile.forEach(input => {
                    input.required = true;
                    input.disabled = false;
                });
                console.log('Mode mobile activé'); // Debug
            }
        } else if (selectedMode.value === 'SOCIETE' || selectedMode.value === 'DEF') {
            if (modeSociete) {
                modeSociete.style.display = 'block';
                inputsSociete.forEach(input => {
                    input.required = true;
                    input.disabled = false;
                });
                console.log('Mode société activé'); // Debug
            }
        }
    }
}

// Fonction pour gérer les changements manuels des radios
function setupPaymentModeListeners() {
    const radioButtons = document.querySelectorAll('input[name="modepaiement"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                activatePaymentMode();
            }
        });
    });
}

// Activer au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Petit délai pour s'assurer que tous les éléments sont chargés
    setTimeout(function() {
        activatePaymentMode();
        setupPaymentModeListeners();
    }, 100);
});
</script>
