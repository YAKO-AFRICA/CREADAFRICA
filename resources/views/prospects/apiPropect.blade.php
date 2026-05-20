<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YAKO AFRICA - Formulaire de Prospection</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        :root { --yako-green: #1e4520; --yako-light: #f0fdf4; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        /* Étapes */
        .step-dot {
            width: 40px; height: 40px; border-radius: 50%; border: 2px solid #dee2e6;
            background: white; z-index: 2; transition: all 0.4s ease;
            display: flex; align-items: center; justify-content: center; font-weight: bold; color: #6c757d;
        }
        .step-dot.active {
            background: var(--yako-green); color: white; border-color: var(--yako-green);
            transform: scale(1.1); box-shadow: 0 0 15px rgba(30, 69, 32, 0.3);
        }
        .step-label { font-size: 0.8rem; font-weight: 600; color: #6c757d; margin-top: 8px; }
        .active + .step-label { color: var(--yako-green); }

        /* Cartes Produits */
        .product-card { cursor: pointer; height: 100%; }
        .product-card input:checked + .card {
            border-color: var(--yako-green); background-color: var(--yako-light);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .selected-check {
            position: absolute; top: 10px; right: 10px; color: var(--yako-green);
            display: none; font-size: 1.2rem;
        }
        .product-card input:checked + .card .selected-check { display: block; }

        /* Custom Buttons */
        .btn-yako { background-color: var(--yako-green); color: white; border: none; padding: 10px 25px; transition: 0.3s; }
        .btn-yako:hover { background-color: #143116; color: white; transform: translateY(-2px); }
        .nature-btn input:checked + label { background-color: var(--yako-green) !important; color: white !important; border-color: var(--yako-green); }

        /* Select2 Customization */
        .select2-container--bootstrap-5 .select2-selection { border-radius: 0.375rem; border: 1px solid #dee2e6; }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-lg border-0 radius-15 overflow-hidden">
            <div class="card-header bg-white border-0 pt-4 text-center">
                <h4 class="fw-bold text-uppercase" style="color: var(--yako-green)">Fiche de Prospection</h4>
                <p class="text-muted">Complétez les informations pour un suivi personnalisé</p>
            </div>
            
            <div class="card-body p-4">
                <div class="form-progress-wrapper mb-5 px-md-5">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar" id="formProgress" style="width: 25%; background-color: var(--yako-green)"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-n3" style="margin-top: -22px;">
                        <div class="text-center">
                            <div class="step-dot active" id="step1-tab">1</div>
                            <span class="step-label d-none d-md-block">Identité</span>
                        </div>
                        <div class="text-center">
                            <div class="step-dot" id="step2-tab">2</div>
                            <span class="step-label d-none d-md-block">Profession</span>
                        </div>
                        <div class="text-center">
                            <div class="step-dot" id="step3-tab">3</div>
                            <span class="step-label d-none d-md-block">Services</span>
                        </div>
                        <div class="text-center">
                            <div class="step-dot" id="step4-tab">4</div>
                            <span class="step-label d-none d-md-block">Finalisation</span>
                        </div>
                    </div>
                </div>

                <form id="prospectForm" class="needs-validation" novalidate>
                    <div class="tab-content" id="formStepsContent">
                        
                        <div class="tab-pane fade show active" id="step1">
                            <h5 class="mb-4 fw-bold border-start border-4 border-success ps-3">Informations Personnelles</h5>
                            <div class="row g-3">
                                <input type="hidden" name="commercial_id" value="{{ $token }}">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fa-solid fa-user text-muted"></i></span>
                                        <input type="text" class="form-control" name="first_name" required placeholder="Jean">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" required placeholder="Dupont">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fa-solid fa-envelope text-muted"></i></span>
                                        <input type="email" class="form-control" name="email" placeholder="jean.dupont@mail.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Téléphone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fa-solid fa-phone text-muted"></i></span>
                                        <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" required placeholder="0102030405">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Ville de résidence</label>
                                    <select name="city" class="form-select select2-city">
                                        <option value=""></option>
                                        @foreach ($villes as $item)
                                            <option value="{{ $item->IdTblVille }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-5">
                                <button type="button" class="btn btn-yako px-4 next-step" data-next="2">
                                    Continuer <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step2">
                            <h5 class="mb-4 fw-bold border-start border-4 border-success ps-3">Cadre Professionnel</h5>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-semibold d-block mb-3">Nature du Prospect <span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col-md-4 nature-btn">
                                            <input type="radio" class="btn-check" name="natureProspect" id="nat1" value="Suspect" required>
                                            <label class="btn btn-outline-secondary w-100 py-3" for="nat1">
                                                <i class="fa-solid fa-magnifying-glass mb-2 d-block fs-4"></i> Suspect
                                            </label>
                                        </div>
                                        <div class="col-md-4 nature-btn">
                                            <input type="radio" class="btn-check" name="natureProspect" id="nat2" value="Prospect">
                                            <label class="btn btn-outline-secondary w-100 py-3" for="nat2">
                                                <i class="fa-solid fa-user-tie mb-2 d-block fs-4"></i> Prospect
                                            </label>
                                        </div>
                                        <div class="col-md-4 nature-btn">
                                            <input type="radio" class="btn-check" name="natureProspect" id="nat3" value="Déjà client">
                                            <label class="btn btn-outline-secondary w-100 py-3" for="nat3">
                                                <i class="fa-solid fa-circle-check mb-2 d-block fs-4"></i> Déjà client
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Profession</label>
                                    <select class="form-select select2-basic" name="profession_uuid">
                                        @foreach ($professions as $item)
                                            <option value="{{ $item->IdProfession }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Secteur d'Activité</label>
                                    <select class="form-select select2-basic" name="secteurActivity_uuid">
                                        @foreach ($secteurActivites as $item)
                                            <option value="{{ $item->IdSecteurActiviteSocietes }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light prev-step" data-prev="1"><i class="fa-solid fa-chevron-left me-2"></i> Retour</button>
                                <button type="button" class="btn btn-yako next-step" data-next="3">Suivant <i class="fa-solid fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step3">
                            <h5 class="mb-2 fw-bold border-start border-4 border-success ps-3">Produits d'intérêt</h5>
                            <p class="text-muted small mb-4">Sélectionnez un ou plusieurs services qui pourraient intéresser le client.</p>
                            <div class="row g-3">
                                @foreach ($products as $item)
                                <div class="col-md-4">
                                    <label class="product-card d-block">
                                        <input type="checkbox" name="products[]" value="{{ $item->codeproduitformule }}" class="d-none">
                                        <div class="card border-2 position-relative">
                                            <div class="selected-check"><i class="fa-solid fa-circle-check"></i></div>
                                            <div class="card-body text-center p-3">
                                                <div class="mb-2 text-success fs-3">
                                                    <i class="fa-solid fa-shield-halved"></i>
                                                </div>
                                                <h6 class="fw-bold text-dark">{{ $item->libelleproduit }}</h6>
                                                <p class="small text-muted mb-0">Protection optimale et accompagnement Yako.</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light prev-step" data-prev="2"><i class="fa-solid fa-chevron-left me-2"></i> Retour</button>
                                <button type="button" class="btn btn-yako next-step" data-next="4">Suivant <i class="fa-solid fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step4">
                            <div class="text-center mb-4">
                                <div class="bg-light-success p-3 rounded-circle d-inline-block mb-3">
                                    <i class="fa-solid fa-paper-plane fs-1 text-success"></i>
                                </div>
                                <h5 class="fw-bold">Notes Finales</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Adresse complète</label>
                                    <textarea class="form-control" name="adress" rows="2" placeholder="Quartier, Rue, Porte..."></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Observations particulières</label>
                                    <textarea class="form-control" name="note" rows="3" placeholder="Besoin spécifique, meilleur moment pour rappeler..."></textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light prev-step" data-prev="3"><i class="fa-solid fa-chevron-left me-2"></i> Retour</button>
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow" id="submitBtn" style="background-color: var(--yako-green);">
                                    <i class="fa-solid fa-cloud-arrow-up me-2"></i> ENREGISTRER LE PROSPECT
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
    <script>
    $(document).ready(function() {
        let currentStep = 1;
        const totalSteps = 4;

        // Initialisation Select2 avec thème Bootstrap 5
        $('.select2-basic').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        $('.select2-city').select2({
            theme: 'bootstrap-5',
            placeholder: "Sélectionnez une ville",
            allowClear: true,
            width: '100%'
        });

        // Navigation Suivant
        $('.next-step').click(function() {
            if (validateStep(currentStep)) {
                currentStep = $(this).data('next');
                showStep(currentStep);
            }
        });

        // Navigation Retour
        $('.prev-step').click(function() {
            currentStep = $(this).data('prev');
            showStep(currentStep);
        });

        function showStep(step) {
            // Update Tabs
            $('.tab-pane').removeClass('show active');
            $(`#step${step}`).addClass('show active');
            
            // Update Progress Dots
            $('.step-dot').removeClass('active');
            for(let i=1; i<=step; i++) {
                $(`#step${i}-tab`).addClass('active');
            }

            // Update Progress Bar
            let percent = (step / totalSteps) * 100;
            $('#formProgress').css('width', percent + '%');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function validateStep(step) {
            const fields = $(`#step${step} [required]`);
            let valid = true;
            
            fields.each(function() {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!valid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Champs manquants',
                    text: 'Veuillez remplir tous les champs obligatoires avant de continuer.',
                    confirmButtonColor: '#1e4520'
                });
            }
            return valid;
        }

        // Soumission Finale avec SweetAlert2
        $('#prospectForm').on('submit', function(e) {
            e.preventDefault();
            
            if (!validateStep(4)) return;

            const btn = $('#submitBtn');
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Traitement...');

            const formData = new FormData(this);

            $.ajax({
                url: "{{ route('storeProspect', $token) }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    Swal.fire({
                        title: 'Félicitations !',
                        text: 'Le prospect a été enregistré avec succès.',
                        icon: 'success',
                        confirmButtonText: 'Aller sur le site',
                        confirmButtonColor: '#1e4520',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'https://web.yakoafricassur.com/';
                        }
                    });
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up me-2"></i> ENREGISTRER');
                    let msg = "Une erreur est survenue.";
                    if(xhr.responseJSON && xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        html: msg,
                        confirmButtonColor: '#d33'
                    });
                }
            });
        });

        // Validation téléphone (chiffres uniquement)
        $('#mobile').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
    </script>
    
</body>
</html>