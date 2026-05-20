<div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
    <h5 class="mb-1">Informations du ou des bénéficiaire(s)</h5>
    <p class="mb-4">Veuillez entrer les informations relatives au(x) bénéficiaire(s) en tenant compte des champs
        obligatoires.</p>

    <div class="row g-3">


        @if ($product->CodeProduit == 'YKE_2018' || $product->CodeProduit == 'YKE_2008')
            <div class="col-12 col-lg-6" @disabled(true)>
                <label for="" class="form-label">Au terme du contrat</label>
                <div class="card" style="width: 80%">
                    <div class="card-body" disabled>
                        <small>
                            Pas de beneficiaire au terme du contrat pour ce produit
                        </small>
                    </div>
                </div>
            </div>
        @elseif ($product->CodeProduit == 'DOIHOO')
             <div class="col-12 col-lg-6">
                <label for="" class="form-label">Au terme du contrat</label>
                <div class="card" style="width: 80%">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addBeneficiary" value="adherent" name="benef_terme" checked readonly>
                            <label class="form-check-label" for="addBeneficiary" >Adhérent</label>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Au terme du contrat</label>

                        <div class="form-check">
                            <input type="radio" name="benef_terme" value="adherent" class="form-check-input">
                            <label class="form-check-label">Adhérent</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="benef_terme" value="conjoint" class="form-check-input">
                            <label class="form-check-label">Conjoint</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="benef_terme" value="enfants" class="form-check-input">
                            <label class="form-check-label">Enfants</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="benef_terme" value="autre" class="form-check-input">
                            <label class="form-check-label">Autre</label>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="col-12 col-lg-6">
            <label for="" class="form-label">En cas de décès avant le terme</label>
            <div class="card" style="width: 80%">
                <div class="card-body">
                    <div class="form-check">
                        <input type="radio" name="benef_deces" value="conjoint">
                        <label class="form-check-label" for="conjoint2">
                            Le conjoint non divorcé, ni séparé de corps
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="benef_deces" value="enfants">
                        <label class="form-check-label" for="enfants2">
                            Les enfants nés et à naître
                        </label>
                    </div>
                    <div class="form-check" data-bs-toggle="modal" data-bs-target="#addBenefModal">
                        <input type="radio" name="benef_deces" value="autre">
                        <label class="form-check-label" for="Autres2">
                            Autres, à préiser
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="card">
            <div class="card-body overflow-auto overflow-scroll">
                <table class="table mb-0 table-striped" id="beneficiariesTable">
                    <thead>
                        <tr>
                            <th scope="col">Nom & Prénoms</th>
                            <th scope="col">Né(e) le</th>
                            <th scope="col">Lieu de naissance</th>
                            <th scope="col">Lieu de résidence</th>
                            <th scope="col">Filiation</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Taux (%)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Beneficiary rows will be appended here -->
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- <div class="col-12"> --}}
            <div class="d-flex align-items-center justify-content-between gap-3">
                <button onclick="event.preventDefault(); stepper1.previous()"
                    class="btn border-btn btn-previous-form"><i
                        class='bx bx-left-arrow-alt'></i>Précédent</button>
                <button onclick="event.preventDefault(); stepper1.next()"
                    class="btn btn-two btn-next-form">Suivant<i
                        class='bx bx-right-arrow-alt'></i></button>
            </div>
        {{-- </div>  --}}
    </div>

    <script>
    // ===============================
    // STATE GLOBAL
    // ===============================
    let beneficiaries = [];

    // ===============================
    // UTILS
    // ===============================
    function getAdherentInfos() {
        return {
            nom: document.getElementById('FisrtName')?.value || '',
            prenom: document.getElementById('LastName')?.value || '',
            dateNaissance: document.getElementById('Date_naissance')?.value || '',
            lieuNaissance: document.getElementById('lieunaissance')?.value || '',
            lieuResidence: document.getElementById('lieuresidence')?.value || '',
            telephone: document.querySelector('input[name="mobile"]')?.value || '',
            email: document.getElementById('email')?.value || ''
        };
    }

    function resetContexte(contexte) {
        beneficiaries = beneficiaries.filter(b => b.contexte !== contexte);
    }

    function updateHiddenInput() {
        document.getElementById('beneficiariesInput').value = JSON.stringify(beneficiaries);
    }

    // ===============================
    // RENDER TABLE
    // ===============================
    function renderTable() {
        const tbody = document.querySelector('#beneficiariesTable tbody');
        if (!tbody) return;
        tbody.innerHTML = '';

        beneficiaries.forEach((b, index) => {
            const badge = b.contexte === 'terme'
                ? '<span class="badge bg-success">Terme</span>'
                : '<span class="badge bg-danger">Décès</span>';

            const row = `
                <tr>
                    <td>${escapeHtml(b.nom)} ${escapeHtml(b.prenom)}</td>
                    <td>${escapeHtml(b.dateNaissance || '')}</td>
                    <td>${escapeHtml(b.lieuNaissance || '')}</td>
                    <td>${escapeHtml(b.lieuResidence || '')}</td>
                    <td>${escapeHtml(b.lien)}</td>
                    <td>${escapeHtml(b.telephone || '')}</td>
                    <td>${escapeHtml(b.email || '')}</td>
                    <td>${b.part}%</td>
                    <td>${badge}</td>
                    <td>
                        <a href="#" class="text-danger" onclick="removeBeneficiary(${index})">
                            <i class="bx bx-x fs-4"></i>
                        </a>
                    </td>
                </tr>
            `;

            tbody.insertAdjacentHTML('beforeend', row);
        });

        updateHiddenInput();
    }

    // Échapper les caractères HTML pour éviter les injections
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    // ===============================
    // AJOUT AUTO BÉNÉFICIAIRE
    // ===============================
    function setAutoBeneficiary(type, contexte) {
        let benef = {};

        if (type === 'adherent') {
            const a = getAdherentInfos();

            if (!a.nom || !a.prenom) {
                // Message plus discret, mais on stocke quand même partiellement
                console.log("Adhérent incomplet, bénéficiaire ajouté partiellement");
            }

            benef = {
                ...a,
                lien: 'Adhérent',
                part: 100,
                contexte
            };
        }

        if (type === 'conjoint') {
            benef = {
                nom: 'Conjoint',
                prenom: 'Non séparé de corps',
                lien: 'Conjoint',
                part: 100,
                contexte
            };
        }

        if (type === 'enfants') {
            benef = {
                nom: 'Enfants',
                prenom: 'Nés et à naître',
                lien: 'Enfants',
                part: 100,
                contexte
            };
        }

        resetContexte(contexte);
        beneficiaries.push(benef);
        renderTable();
    }

    // ===============================
    // INITIALISATION POUR DOIHOO / CADENCE_EDUC
    // ===============================
    function initAutoBeneficiaryForDoihoo() {
        // Vérifier si le produit est DOIHOO ou cadence_educ
        const productCode = '{{ $product->CodeProduit ?? '' }}';
        
        if (productCode === 'DOIHOO' || productCode === 'cadence_educ') {
            // Ajouter automatiquement l'adhérent comme bénéficiaire "terme"
            const adherentInfos = getAdherentInfos();
            
            if (adherentInfos.nom && adherentInfos.prenom) {
                // Vérifier si l'adhérent n'est pas déjà dans la liste
                const alreadyExists = beneficiaries.some(b => 
                    b.contexte === 'terme' && b.lien === 'Adhérent'
                );
                
                if (!alreadyExists) {
                    const benef = {
                        ...adherentInfos,
                        lien: 'Adhérent',
                        part: 100,
                        contexte: 'terme'
                    };
                    beneficiaries.push(benef);
                    renderTable();
                }
            } else {
                // Si l'adhérent n'est pas encore renseigné, on écoute les changements
                const inputs = ['FisrtName', 'LastName', 'Date_naissance', 'lieunaissance', 'lieuresidence', 'email'];
                inputs.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.addEventListener('input', function initDoihoo() {
                            const adherentInfos = getAdherentInfos();
                            if (adherentInfos.nom && adherentInfos.prenom) {
                                const exists = beneficiaries.some(b => 
                                    b.contexte === 'terme' && b.lien === 'Adhérent'
                                );
                                if (!exists) {
                                    const benef = {
                                        ...adherentInfos,
                                        lien: 'Adhérent',
                                        part: 100,
                                        contexte: 'terme'
                                    };
                                    beneficiaries.push(benef);
                                    renderTable();
                                }
                                // Retirer l'écouteur une fois ajouté
                                inputs.forEach(inputId => {
                                    const inputEl = document.getElementById(inputId);
                                    if (inputEl) {
                                        inputEl.removeEventListener('input', initDoihoo);
                                    }
                                });
                            }
                        });
                    }
                });
            }
        }
    }

    // ===============================
    // SUPPRESSION
    // ===============================
    window.removeBeneficiary = function(index) {
        beneficiaries.splice(index, 1);
        renderTable();
    }

    // ===============================
    // MODAL - AJOUT MANUEL
    // ===============================
    function openModal(contexte) {
        document.getElementById('benefContexte').value = contexte;
        new bootstrap.Modal(document.getElementById('addBenefModal')).show();
    }

    function validateField(el) {
        if (!el.value.trim()) {
            el.classList.add('is-invalid');
            return false;
        }
        el.classList.remove('is-invalid');
        el.classList.add('is-valid');
        return true;
    }

    window.addBeneficiary = function() {
        const contexte = document.getElementById('benefContexte').value;

        const nom = document.getElementById('nomBenef');
        const prenom = document.getElementById('prenomBenef');
        const tel = document.getElementById('mobileBenef');

        if (!validateField(nom) || !validateField(prenom) || !validateField(tel)) {
            return;
        }

        const benef = {
            nom: nom.value,
            prenom: prenom.value,
            dateNaissance: document.getElementById('datenaissanceBenef').value,
            lieuNaissance: document.getElementById('lieunaissanceBenef').value,
            lieuResidence: document.getElementById('lieuresidenceBenef').value,
            lien: document.getElementById('lienParenteBenef').selectedOptions[0]?.text || 'Autre',
            telephone: tel.value,
            email: document.getElementById('emailBenef').value,
            part: document.getElementById('partBenef').value || 100,
            contexte
        };

        resetContexte(contexte);
        beneficiaries.push(benef);
        renderTable();

        // reset form
        document.getElementById('beneficiaryForm').reset();

        // Close modal PROPRE
        const modalEl = document.getElementById('addBenefModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modalInstance.hide();

        // nettoyage complet
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    }

    // ===============================
    // EVENTS RADIO
    // ===============================
    function initEvents() {
        // TERME - Gérer tous les cas sauf DOIHOO/cadence_educ où le champ est readonly
        const productCode = '{{ $product->CodeProduit ?? '' }}';
        const isDoihooOrCadence = (productCode === 'DOIHOO' || productCode === 'cadence_educ');
        
        if (!isDoihooOrCadence) {
            document.querySelectorAll('input[name="benef_terme"]').forEach(el => {
                el.addEventListener('change', function() {
                    if (this.value === 'autre') {
                        openModal('terme');
                        return;
                    }
                    setAutoBeneficiary(this.value, 'terme');
                });
            });
        }

        // DÉCÈS - Fonctionne pour tous les produits
        document.querySelectorAll('input[name="benef_deces"]').forEach(el => {
            el.addEventListener('change', function() {
                if (this.value === 'autre') {
                    openModal('deces');
                    return;
                }
                setAutoBeneficiary(this.value, 'deces');
            });
        });

        // AUTO UPDATE ADHERENT (seulement pour les produits non-DOI HOO)
        if (!isDoihooOrCadence) {
            ['FisrtName', 'LastName', 'Date_naissance', 'lieunaissance', 'lieuresidence', 'email']
            .forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', () => {
                        const benefTerme = beneficiaries.find(b => b.contexte === 'terme' && b.lien === 'Adhérent');
                        if (benefTerme) {
                            setAutoBeneficiary('adherent', 'terme');
                        }
                    });
                }
            });
        }
    }

    // ===============================
    // INIT
    // ===============================
    document.addEventListener('DOMContentLoaded', function() {
        initEvents();
        initAutoBeneficiaryForDoihoo();
    });
</script>

</div>
