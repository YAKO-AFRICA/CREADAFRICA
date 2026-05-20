<div class="modal fade" id="EditUsers{{ $item->idmembre }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->idmembre }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <style>
            .steps-banner-edit {
                position: relative;
                border-bottom: 1px solid #ddd;
                margin-bottom: 20px;
            }

            .step-indicators-edit {
                display: flex;
                justify-content: space-between;
            }

            .step-indicator-edit {
                text-align: center;
                flex-grow: 1;
                font-size: 0.9rem;
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin: 0 5px;
                color: #555;
                transition: background 0.3s, color 0.3s;
            }

            .step-indicator-edit.active {
                background: #076633;
                color: #fff;
                font-weight: bold;
            }

        </style>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifié le Membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body{{ $item->idmembre }}">
                <form action="{{ route('setting.user.update', $item->idmembre) }}" method="POST" class="submitForm">
                    @csrf
                    <div class="modal-body">

                        <div class="steps-banner-edit mb-4">
                            <ul class="step-indicators-edit d-flex justify-content-between list-unstyled p-0">
                                <li id="step-edit-1" class="step-indicator-edit active">1. Réseau</li>
                                <li id="step-edit-2" class="step-indicator-edit">2. Informations</li>
                                <li id="step-edit-3" class="step-indicator-edit">3. Comptes</li>
                                <li id="step-edit-4" class="step-indicator-edit">4. Contacts</li>
                            </ul>
                        </div>

                        <div id="step-group-1" class="step-edit">
                            <fieldset class="border p-3" style="width: 100%;">

                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 1 : Reseau</h5></small></legend>

                                {{-- <div class="mb-3">
                                    <label for="codeagent" class="form-label">Code Agent <span class="text-danger">*</span></label>
                                    <input type="text" name="codeagent" id="codeagent" class="form-control" value="{{ $item->codeagent }}" required>
                                </div> --}}
                                <div class="row">
                                    <div class="mb-3 col-sm-12 col-md-6">
                                        <label for="codereseau" class="form-label">Réseau de commercialisation</label>
                                        <select name="codereseau" id="codereseau" class="form-select">
                                            <option value="{{ $item->codereseau }}">{{ $item->reseau->libelle ?? '' }}</option>
                                            @foreach ($reseaux as $reseau)
                                                @if ($reseau->id != $item->codereseau)
                                                    <option class="form-control" value="{{ $reseau->id }}">{{ $reseau->libelle }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-12 col-md-6">
                                        <label for="codezone" class="form-label">Zone/Departement</label>
                                        <select name="codezone" id="codezone" class="form-select" id="">
                                            <option value="{{ $item->codezone }}">{{ $item->zone->libellezone ?? '' }}</option>
                                            @foreach ($zones as $zone)
                                                @if ($zone->id != $item->codezone)
                                                    <option class="form-control" value="{{ $zone->id }}">{{ $zone->libellezone }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-12 col-md-6">
                                        <label for="codeequipe" class="form-label">Equipe/Agence</label>
                                        <select name="codeequipe" id="codeequipe" class="form-select">
                                            @foreach ($agenceByReseeaus as $agenceByReseeau)
                                                <option class="form-control" value="{{ $agenceByReseeau['CodeUnite'] }}">
                                                    {{ $agenceByReseeau['MonLibelle'] ?? ''}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-12 col-md-6">
                                        <label for="codePart" class="form-label">Partenaire</label>
                                        <input type="text" name="codePart" class="form-control" value="{{ $item->partenaire ?? '' }}" readonly disabled>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <div id="step-group-2" class="step-edit d-none">
                            <fieldset class="border p-3" style="width: 100%;">
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 2 : Informations personnelles</h5></small></legend>

                                <div class="mb-3">
                                    <label class="form-label d-block">Sexe</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="sexeF" name="sexe" value="F" class="form-check-input" {{ $item->sexe == 'F' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sexeF">Féminin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="sexeM" name="sexe" value="M" class="form-check-input" {{ $item->sexe == 'M' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sexeM">Masculin</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $item->nom ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prenoms</label>
                                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $item->prenom ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="datenaissance" class="form-label">Date de naissance</label>
                                            <input type="date" name="datenaissance" id="datenaissance" class="form-control" value="{{ $item->datenaissance ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Profession</label>
                                            <input type="text" name="profession" id="profession" class="form-control" value="{{ $item->profession ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <div id="step-group-3" class="step-edit d-none">
                            <fieldset class="border p-3" style="width: 100%;">

                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 3 : Comptes</h5></small></legend>
                                <div class="mb-3">
                                    <label for="login" class="form-label">Nom d'utilisateur (Login) <span class="text-danger">*</span></label>
                                    <input type="text" name="login" id="login" class="form-control" required value="{{ $item->login ?? '' }}">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="brancheSelect" class="form-label">
                                        Branche <span class="text-danger">*</span>
                                    </label>

                                    <select name="branche" id="brancheSelect" class="form-select" required>
                                        <option value="" disabled {{ !isset($item->branche) ? 'selected' : '' }}>-- Choisir une option --</option>

                                        <option value="BANKASS" @selected(isset($item) && $item->branche == 'BANKASS')>BANKASS</option>
                                        <option value="COURTAGE" @selected(isset($item) && $item->branche == 'COURTAGE')>COURTAGE</option>
                                        <option value="COM" @selected(isset($item) && $item->branche == 'COM')>COM</option>
                                        <option value="IND" @selected(isset($item) && $item->branche == 'IND')>IND</option>
                                        <option value="AGTGLE" @selected(isset($item) && $item->branche == 'AGTGLE')>AGTGLE</option>
                                        <option value="SAAF" @selected(isset($item) && $item->branche == 'SAAF')>SAAF</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 form-group">
                                            <label for="profileSelect" class="form-label">
                                                Profile <span class="text-danger">*</span>
                                            </label>

                                            <select name="profile_id" id="profileSelect" class="form-control" required>
                                                <option value="" disabled {{ !isset($item) ? 'selected' : '' }}>Choisir un profil...</option>

                                                @foreach ($profiles as $profile)
                                                    <option value="{{ $profile->id }}"
                                                        {{ (isset($item) && $item->coderole == $profile->id) ? 'selected' : '' }}>
                                                        {{ $profile->role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="roleSelect" class="form-label">
                                            Rôle <span class="text-danger">*</span>
                                        </label>

                                        <select name="role_id" id="roleSelect" class="form-control" required>
                                            {{-- Option par défaut si aucune donnée n'est sélectionnée --}}
                                            <option value="" disabled {{ !isset($item) ? 'selected' : '' }}>Choisir un rôle...</option>

                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @selected(isset($item) && $item->id_role == $role->id)>
                                                    {{ $role->name ?? 'Nom non défini' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </fieldset>
                        </div>
                        <div id="step-group-4" class="step-edit d-none">
                            <fieldset class="border p-3" style="width: 100%;">

                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 4 : Contacts</h5></small></legend>
                                <div class="mb-3">
                                    <label for="login" class="form-label">Email  <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{ $item->email ?? '' }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cel" class="form-label">Mobile 1</label>
                                            <input type="text" name="cel" id="cel" class="form-control" value="{{ $item->cel ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tel" class="form-label">Mobile 2</label>
                                            <input type="tel" name="tel" id="tel" class="form-control" value="{{ $item->tel ?? '' }}">
                                        </div>
                                    </div>
                                </div>


                            </fieldset>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary prev-edit-step d-none">Précédent</button>
                        <button type="button" class="btn btn-primary next-edit-step">Suivant</button>
                        <button type="submit" class="btn btn-success d-none finish-edit-step">Terminer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // 1. Gestion des étapes du Modal
    $('.modal').on('shown.bs.modal', function() {
        const modal = $(this);
        let currentStep = 1;

        // Reset au cas où le modal est réouvert
        currentStep = 1;
        updateStepDisplay(modal, currentStep);

        modal.find('.next-edit-step').off('click').click(function() {
            if (currentStep < 4) {
                currentStep++;
                updateStepDisplay(modal, currentStep);
            }
        });

        modal.find('.prev-edit-step').off('click').click(function() {
            if (currentStep > 1) {
                currentStep--;
                updateStepDisplay(modal, currentStep);
            }
        });

        function updateStepDisplay(modal, step) {
            modal.find('.step-edit').addClass('d-none');
            modal.find(`#step-group-${step}`).removeClass('d-none');

            modal.find('.step-indicator-edit').removeClass('active');
            modal.find(`#step-edit-${step}`).addClass('active');

            // Affichage des boutons
            modal.find('.prev-edit-step').toggleClass('d-none', step === 1);
            modal.find('.next-edit-step').toggleClass('d-none', step === 4);
            modal.find('.finish-edit-step').toggleClass('d-none', step !== 4);
        }
    });

    // 2. Gestion de la soumission avec SweetAlert2
    $(document).on('submit', '.submitForm', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const url = form.getAttribute('action');

            Swal.fire({
                title: 'Confirmer la modification ?',
                text: "Voulez-vous enregistrer les changements ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#076633',
                confirmButtonText: 'Oui, enregistrer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                // Affichage du loader
                Swal.fire({
                    title: 'Traitement en cours...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                // Envoi des données via AJAX (fetch)
                        fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.type === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Succès !',
                                    text: data.message,
                                    confirmButtonColor: '#076633'
                                }).then(() => {
                                    // Optionnel : recharger la page ou rediriger
                                    if(data.urlback === 'back') {
                                        window.location.reload();
                                    } else if(data.urlback) {
                                        window.location.href = data.urlback;
                                    }
                                });
                            } else {
                                Swal.fire('Erreur', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Erreur', 'Une erreur système est survenue.', 'error');
                            console.error(error);
                        });
                    }
                });
            });
        });
    </script>

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestion des étapes pour tous les modals
                $('.modal').on('shown.bs.modal', function() {
                    const modal = $(this);
                    let currentStep = 1;

                    modal.find('.next-edit-step').click(function() {
                        if (currentStep < 4) {
                            currentStep++;
                            updateStepDisplay(modal, currentStep);
                        }
                    });

                    modal.find('.prev-edit-step').click(function() {
                        if (currentStep > 1) {
                            currentStep--;
                            updateStepDisplay(modal, currentStep);
                        }
                    });

                    function updateStepDisplay(modal, step) {
                        modal.find('.step-edit').addClass('d-none');
                        modal.find(`#step-group-${step}`).removeClass('d-none');

                        modal.find('.step-indicator-edit').removeClass('active');
                        modal.find(`#step-edit-${step}`).addClass('active');

                        if (step === 1) {
                            modal.find('.prev-edit-step').addClass('d-none');
                        } else {
                            modal.find('.prev-edit-step').removeClass('d-none');
                        }

                        if (step === 4) {
                            modal.find('.next-edit-step').addClass('d-none');
                            modal.find('.finish-edit-step').removeClass('d-none');
                        } else {
                            modal.find('.next-edit-step').removeClass('d-none');
                            modal.find('.finish-edit-step').addClass('d-none');
                        }
                    }
                });
            });
        </script> --}}

</div>
