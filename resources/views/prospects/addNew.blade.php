<div class="modal fade" id="addnewPropect" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #1e4520 0%, #2d6a31 100%);">
                <h5 class="modal-title d-flex align-items-center text-light" id="clientModalLabel">
                    <i class="fadeIn animated bx bx-plus"></i> Nouveau Prospect
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="clientForm" class="needs-validation" novalidate>
                    @csrf
                    
                    <div class="form-progress-wrapper mb-5">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" role="progressbar" id="formProgress" style="width: 25%; background-color: #1e4520"></div>
                        </div>
                        <ul class="nav nav-pills justify-content-between mt-n3" id="formSteps">
                            <li class="nav-item">
                                <button class="step-dot active" id="step1-tab" data-bs-target="#step1" type="button" role="tab">1</button>
                                <span class="step-label">Identité</span>
                            </li>
                            <li class="nav-item text-center">
                                <button class="step-dot" id="step2-tab" data-bs-target="#step2" type="button" role="tab" disabled>2</button>
                                <span class="step-label">Profession</span>
                            </li>
                            <li class="nav-item text-center">
                                <button class="step-dot" id="step3-tab" data-bs-target="#step3" type="button" role="tab" disabled>3</button>
                                <span class="step-label">Services</span>
                            </li>
                            <li class="nav-item text-end">
                                <button class="step-dot" id="step4-tab" data-bs-target="#step4" type="button" role="tab" disabled>4</button>
                                <span class="step-label">Fin</span>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content mt-4" id="formStepsContent">
                        
                        <div class="tab-pane fade show active" id="step1" role="tabpanel">
                            <fieldset class="border p-4 rounded-3">
                                <legend class="float-none w-auto px-3 fs-6 fw-bold text-success">
                                    <i class="fadeIn animated bx bx-id-card"></i> INFORMATIONS PERSONNELLES
                                </legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fadeIn animated bx bx-user text-muted"></i></span>
                                            <input type="text" class="form-control" name="first_name" required placeholder="Ex: Jean">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" required placeholder="Ex: Dupont">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fadeIn animated bx bx-mail-send"></i></span>
                                            <input type="email" class="form-control" name="email" placeholder="nom@exemple.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Téléphone <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fadeIn animated bx bx-phone text-muted"></i></span>
                                            <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="15" minlength="10" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Ville</label>
                                        <select name="city" class="form-select select2">
                                            <option value="" disabled selected>Où habite le prospect ?</option>
                                            @foreach ($villes as $item)
                                                <option value="{{ $item->IdTblVille }}">{{ $item->MonLibelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-primary px-4 next-step" data-next="step2" style="background-color: #1e4520;">
                                    Continuer <i class="fas fa-chevron-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step2" role="tabpanel">
                            <fieldset class="border p-4 rounded-3">
                                <legend class="float-none w-auto px-3 fs-6 fw-bold text-success">
                                    <i class="bx bx-briefcase me-2"></i> CADRE PROFESSIONNEL
                                </legend>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Nature du Prospect <span class="text-danger">*</span></label>
                                        <div class="d-flex gap-3">
                                            <input type="radio" class="btn-check" name="natureProspect" id="nat1" value="Suspect" required>
                                            <label class="btn btn-outline-secondary w-100" for="nat1">Suspect</label>
                                            
                                            <input type="radio" class="btn-check" name="natureProspect" id="nat2" value="Prospect">
                                            <label class="btn btn-outline-secondary w-100" for="nat2">Prospect</label>

                                            <input type="radio" class="btn-check" name="natureProspect" id="nat3" value="Déjà client">
                                            <label class="btn btn-outline-secondary w-100" for="nat3">Déjà client</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label class="form-label fw-semibold">Profession</label>
                                        <select class="form-select select2-init" name="profession_uuid">
                                            @foreach ($professions as $item)
                                                <option value="{{ $item->IdProfession }}">{{ $item->MonLibelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label class="form-label fw-semibold">Secteur d'Activité</label>
                                        <select class="form-select modal-select" name="secteurActivity_uuid">
                                            @foreach ($secteurActivites as $item)
                                                <option value="{{ $item->IdSecteurActiviteSocietes }}">{{ $item->MonLibelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-light prev-step" data-prev="step1"><i class="fas fa-chevron-left me-2"></i> Retour</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step3" style="background-color: #1e4520;">Suivant <i class="fas fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        @php
                            $descriptions = [
                                'YKE_2018' => 'Yako est une assurance santé qui offre une couverture complète pour vous et votre famille.',
                                'LPREVO' => 'Prévoyance emprunteur est un produit qui couvre les risques liés au crédit.',
                                'DOIHOO' => 'DOIHOO est un produit qui couvre les risques liés au crédit. Il offre une couverture complète pour vous et votre famille.',
                            ];
                        @endphp

                        <div class="tab-pane fade" id="step3" role="tabpanel">
                            <h6 class="fw-bold mb-3"><i class="bx bx-shield-alt text-success me-2"></i> Choisissez les produits d'intérêt</h6>
                            <div class="row g-3 overflow-auto m-0" style="max-height: 400px;">
                                @foreach ($product as $item)
                                <div class="col-md-4">
                                    <label class="product-card">
                                        <input type="checkbox" name="products[]" value="{{ $item->codeproduitformule }}" class="d-none">
                                        <div class="card h-100 border-2">
                                            <div class="card-body text-center p-3">
                                                <div class="icon-circle mb-2">
                                                    <i class="bx bx-box-open"></i>
                                                </div>
                                                <h6 class="card-title fw-bold mb-1 text-truncate">{{ $item->libelleproduit ?? 'Produit Sans Nom' }}</h6>
                                                <p class="small text-muted mb-0">
                                                    {{ $descriptions[$item->codeproduit] ?? 'Couverture complète et assistance personnalisée.' }}
                                                </p>
                                            </div>
                                            <div class="selected-badge"><i class="bx bx-check"></i></div>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-light prev-step" data-prev="step2"><i class="bx bx-chevron-left me-2"></i> Retour</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step4" style="background-color: #1e4520;">Suivant <i class="bx bx-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step4" role="tabpanel">
                            <fieldset class="border p-4 rounded-3 bg-light">
                                <div class="text-center mb-4">
                                    <div class="display-6 text-success"><i class="fas fa-check-circle"></i></div>
                                    <h5 class="fw-bold">Dernière étape</h5>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 text-start">
                                        <label class="form-label fw-semibold">Lieu de prospection</label>
                                        <input type="text" class="form-control" name="lieuEvenement" placeholder="Où l'avez-vous rencontré ?">
                                    </div>
                                    <div class="col-12 text-start mt-3">
                                        <label class="form-label fw-semibold">Statut actuel</label>
                                        <select class="form-select" name="status" required>
                                            <option value="nouveau">Nouveau</option>
                                            <option value="en_cours">En cours</option>
                                            <option value="finalise">Finalisé</option>
                                        </select>
                                    </div>
                                    <div class="col-12 text-start mt-3">
                                        <label class="form-label fw-semibold">Notes & Observations</label>
                                        <textarea class="form-control" name="note" rows="3"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-light prev-step" data-prev="step3"><i class="fas fa-chevron-left me-2"></i> Retour</button>
                                <button type="submit" class="btn btn-success px-5 shadow-sm" id="saveClientBtn" style="background-color: #1e4520;">
                                    <i class="fas fa-save me-2"></i> ENREGISTRER LE PROSPECT
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Steps Custom Design */
    .form-progress-wrapper { position: relative; padding: 0 10px; }
    .step-dot {
        width: 35px; height: 35px; border-radius: 50%; border: 2px solid #dee2e6;
        background: white; position: relative; z-index: 2; transition: 0.3s;
        font-weight: bold; color: #6c757d;
    }
    .step-dot.active {
        background: #1e4520; color: white; border-color: #1e4520;
        box-shadow: 0 0 0 4px rgba(30, 69, 32, 0.2);
    }
    .step-label { display: block; font-size: 0.75rem; margin-top: 5px; font-weight: 600; color: #6c757d; }
    .step-dot.active + .step-label { color: #1e4520; }

    /* Product Cards Selection */
    .product-card { width: 100%; cursor: pointer; }
    .product-card .card {
        transition: all 0.2s ease-in-out; border: 1px solid #eee;
        position: relative; border-radius: 12px;
    }
    .product-card input:checked + .card {
        border-color: #1e4520; background-color: #f0fdf4;
        transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    }
    .selected-badge {
        position: absolute; top: -10px; right: -10px; background: #1e4520;
        color: white; width: 25px; height: 25px; border-radius: 50%;
        display: none; align-items: center; justify-content: center; font-size: 12px;
    }
    .product-card input:checked + .card .selected-badge { display: flex; }
    
    .icon-circle {
        width: 45px; height: 45px; background: #f8f9fa; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; 
        margin: 0 auto; color: #1e4520; font-size: 1.2rem;
    }

    /* Form Styles */
    fieldset { border: 1px solid #e9ecef !important; }
    .form-control:focus, .form-select:focus {
        border-color: #1e4520; box-shadow: 0 0 0 0.25rem rgba(30, 69, 32, 0.1);
    }

    .natureActif {
        background-color: #1e4520 !important;
        color: white !important;
        border-color: #1e4520 !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étapes du formulaire
    const progressBar = document.getElementById('formProgress');
    const totalSteps = 4;
    let currentStep = 1;
    
    // Initialisation correcte de Select2 dans un modal
    function initSelect2InModal() {
        $('.modal-selection').select2({
            width: '100%',
            dropdownParent: $('#addnewPropect'), // Assurez-vous que c'est le bon ID de modal
            placeholder: "Sélectionner...",
            allowClear: true,
            dropdownCssClass: 'select2-dropdown-modal' // Classe CSS supplémentaire si nécessaire
        });
    }

    // Appeler cette fonction après l'ouverture du modal
    $('#addnewPropect').on('shown.bs.modal', function() {
        initSelect2InModal();
        
        // Réinitialiser les sélections si nécessaire
        $('.modal-selection').val(null).trigger('change');
    });
    
    // Mettre à jour la barre de progression
    function updateProgress() {
        const progress = (currentStep / totalSteps) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);
    }
    
    // Activer l'étape suivante
    function enableNextStep(nextStep) {
        const nextTab = document.getElementById(`step${nextStep}-tab`);
        if (nextTab) {
            nextTab.disabled = false;
        }
    }
    
    // Valider l'étape courante
    function validateCurrentStep(step) {
        let isValid = true;
        const stepElement = document.getElementById(`step${step}`);
        
        // Valider tous les champs required de l'étape
        const requiredFields = stepElement.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
                
                // Scroll vers le premier champ invalide
                if (isValid === false) {
                    field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Validation spécifique pour le téléphone
        if (step === 1) {
            const mobileField = document.getElementById('mobile');
            if (mobileField.value && !/^[0-9]{10}$/.test(mobileField.value)) {
                mobileField.classList.add('is-invalid');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    // Navigation entre les étapes
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = this.getAttribute('data-next').replace('step', '');
            const currentTab = document.querySelector(`#step${nextStep}-tab`);
            
            // Valider l'étape courante avant de continuer
            if (!validateCurrentStep(currentStep)) {
                return;
            }
            
            // Passer à l'étape suivante
            if (currentTab) {
                const tab = new bootstrap.Tab(currentTab);
                tab.show();
                currentStep = parseInt(nextStep);
                updateProgress();
                enableNextStep(currentStep + 1);
                
                // Scroll vers le haut de l'étape
                document.getElementById(`step${nextStep}`).scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Retour à l'étape précédente
    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = this.getAttribute('data-prev').replace('step', '');
            const prevTab = document.querySelector(`#step${prevStep}-tab`);
            
            if (prevTab) {
                const tab = new bootstrap.Tab(prevTab);
                tab.show();
                currentStep = parseInt(prevStep);
                updateProgress();
                
                // Scroll vers le haut de l'étape
                document.getElementById(`step${prevStep}`).scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Gestion de la soumission du formulaire
    const prospectForm = document.getElementById('clientForm');
    const saveProspectBtn = document.getElementById('saveClientBtn');
    
    prospectForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Valider toutes les étapes avant soumission
        let allValid = true;
        for (let i = 1; i <= totalSteps; i++) {
            if (!validateCurrentStep(i)) {
                allValid = false;
                // Afficher l'étape avec erreur
                const tab = new bootstrap.Tab(document.querySelector(`#step${i}-tab`));
                tab.show();
                currentStep = i;
                updateProgress();
                break;
            }
        }
        
        if (!allValid) {
            return;
        }
        
        // Afficher un indicateur de chargement
        saveProspectBtn.disabled = true;
        saveProspectBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...';
        
        // Soumission du formulaire via AJAX
        const formData = new FormData(prospectForm);
        
        fetch('/prospect/store', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Afficher un toast de succès
                showToast('success', 'Prospect enregistré avec succès!');
                
                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addnewPropect'));
                modal.hide();
                
                // Réinitialiser le formulaire
                prospectForm.reset();
                $('.form-select').val(null).trigger('change');
                currentStep = 1;
                updateProgress();
                
                // Désactiver toutes les étapes sauf la première
                document.querySelectorAll('#formSteps .nav-link:not(#step1-tab)').forEach(btn => {
                    btn.disabled = true;
                });
                
                // Rafraîchir la liste des prospects si nécessaire
                if (typeof window.refreshProspectsTable === 'function') {
                    window.refreshProspectsTable();
                } else {
                    window.location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Afficher les erreurs de validation
            if (error.errors) {
                let errorMessages = 'Veuillez corriger les erreurs suivantes:<br><br>';
                for (const [key, messages] of Object.entries(error.errors)) {
                    errorMessages += `- ${messages.join('<br>')}<br>`;
                }
                showToast('error', errorMessages);
            } else {
                showToast('error', error.message || 'Une erreur est survenue lors de l\'enregistrement');
            }
        })
        .finally(() => {
            saveProspectBtn.disabled = false;
            saveProspectBtn.innerHTML = '<i class="fas fa-save me-2"></i> Enregistrer';
        });
    });
    
    // Fonction pour afficher les toasts
    function showToast(type, message) {
        const toastContainer = document.getElementById('toastContainer') || createToastContainer();
        const toastId = 'toast-' + Math.random().toString(36).substr(2, 9);
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `toast show align-items-center text-white bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        // Fermeture automatique après 5 secondes
        setTimeout(() => {
            const toastElement = document.getElementById(toastId);
            if (toastElement) {
                toastElement.remove();
            }
        }, 5000);

        
    }
    
    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'toast-container position-fixed top-0 end-0 p-3';
        container.style.zIndex = '1100';
        document.body.appendChild(container);
        return container;
    }
    
    // Validation en temps réel pour le téléphone
    document.getElementById('mobile')?.addEventListener('input', function() {
        if (this.value && !/^[0-9]{0,10}$/.test(this.value)) {
            this.value = this.value.slice(0, 10);
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        $('#products').select2({
            multiple: true,
            placeholder: "Sélectionner un ou plusieurs produits",
            allowClear: true,
            dropdownParent: $('#addnewPropect')
        });
    });

    
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const radios = document.querySelectorAll('input[name="natureProspect"]');

        radios.forEach(function(radio){

            radio.addEventListener("change", function () {

                // retirer la classe active sur tous les labels
                document.querySelectorAll('label[for^="nat"]').forEach(function(label){
                    label.classList.remove("natureActif");
                });

                // ajouter la classe sur le label correspondant
                const label = document.querySelector('label[for="'+ this.id +'"]');
                label.classList.add("natureActif");

            });

        });

    });
</script>

