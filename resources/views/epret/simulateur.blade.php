@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3"><a href="/shared/home" class="text-yako-green"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item text-muted">Epret</li>
                    <li class="breadcrumb-item active fw-bold text-yako-green" aria-current="page">Simulateur</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container my-4">
        <h3 class="text-center text-uppercase fw-bold mb-5 text-dark" style="letter-spacing: 1px;">Simulateur de Prime</h3>
        
        <div class="row g-4">
            <!-- Formulaire -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="card-header bg-yako-green text-white text-center py-3">
                        <h5 class="mb-0 text-uppercase fw-bold tracking-wider text-white"><i class="fas fa-calculator me-2"></i>Donnée de simulation</h5>
                    </div>
                    <div class="card-body px-4 py-4">
                        <form id="loanSimulatorForm" class="row g-4 needs-validation" novalidate>
                            <!-- Date de naissance -->
                            <div class="col-12">
                                <label for="dob" class="form-label fw-bold text-secondary">Date de naissance <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bx bx-calendar-event text-yako-green fs-5"></i></span>
                                    <input type="date" class="form-control py-2 border-start-0 ps-0" id="dob" required>
                                    <div class="invalid-feedback">Veuillez entrer une date valide</div>
                                </div>
                            </div>

                            <!-- Montant du prêt -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="loanMontant" class="form-label fw-bold text-secondary mb-0">Montant du prêt (FCFA) <span class="text-danger">*</span></label>
                                    <span id="montantFormatte" class="badge bg-yako-green-light text-yako-green fw-bold fs-6 px-3 py-1.5 rounded-pill">500 000 FCFA</span>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-light border-end-0"><i class="bx bx-money text-yako-green fs-5"></i></span>
                                    <input type="number" class="form-control py-2 border-start-0 ps-0 fw-bold text-dark" id="loanMontant" placeholder="Ex: 500 000" min="50000" max="30000000" required>
                                    <div class="invalid-feedback">Veuillez entrer un montant valide</div>
                                </div>
                                <div class="px-1">
                                    <input type="range" class="form-range" id="montantRange" min="50000" max="30000000" step="50000">
                                    <div class="d-flex justify-content-between small text-muted fw-medium mt-1">
                                        <span>50 000 F</span>
                                        <span>30 000 000 F</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Durée -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="loanDuration" class="form-label fw-bold text-secondary mb-0">Durée (mois) <span class="text-danger">*</span></label>
                                    <span id="dureeFormatte" class="badge bg-secondary-light text-secondary fw-bold fs-6 px-3 py-1.5 rounded-pill">12 mois</span>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-light border-end-0"><i class="bx bx-timer text-yako-green fs-5"></i></span>
                                    <input type="number" class="form-control py-2 border-start-0 ps-0 fw-bold text-dark" id="loanDuration" placeholder="Ex: 24" required>
                                    <div class="invalid-feedback">Veuillez entrer une durée valide</div>
                                </div>
                                <div class="px-1">
                                    <input type="range" class="form-range" id="dureeRange" min="1" max="60" step="1">
                                    <div class="d-flex justify-content-between small text-muted fw-medium mt-1">
                                        <span>1 mois</span>
                                        <span>60 mois</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Garantie Yako -->
                            <div class="col-12 py-2">
                                <div class="form-check form-switch d-flex align-items-center ps-0">
                                    <input class="form-check-input ms-0 me-3 custom-switch" type="checkbox" id="disableYako" value="0" readonly disabled>
                                    <label class="form-check-label fw-bold text-secondary mb-0 user-select-none" for="disableYako">Inclure la Garantie Yako</label>
                                    <i class="fas fa-info-circle ms-2 text-muted" data-bs-toggle="tooltip" title="Protection du prêt en cas de décès ou d'invalidité" style="cursor: help;"></i>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="col-12 d-flex flex-column flex-sm-row gap-3 justify-content-between align-items-center mt-4">
                                <button type="submit" class="btn btn-sm btn-yako-green w-100 w-sm-auto px-4 py-2.5 rounded-pill text-uppercase fw-bold shadow-sm">
                                    <i class="bx bx-chart-line me-2"></i>Calculer la Prime
                                </button>

                                <a href="{{route('epret.create')}}" class="btn btn-sm btn-outline-yako w-100 w-sm-auto rounded-pill text-uppercase fw-bold shadow-sm disabled text-small" id="btnSouscrition" role="button" aria-disabled="true" style="font-size: 12px">
                                    <i class="fas fa-play me-2"></i>Démarrer la Souscription
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Résultats -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 h-100 overflow-hidden">
                    <div class="card-header bg-yako-green text-white text-center py-3">
                        <h5 class="mb-0 text-uppercase fw-bold tracking-wider text-white"><i class="fas fa-chart-pie me-2"></i>Résultats de simulation</h5>
                    </div>

                    <div class="card-body bg-light-gradient p-4 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Affichage dynamique initial -->
                            <div class="text-center mb-4" id="resultat">
                                <div class="alert alert-info border-0 shadow-sm py-3 px-4 rounded-3 text-start">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-3 fs-4 text-info"></i>
                                        <span id="dynamicText" class="fw-medium">Remplissez le formulaire à gauche puis cliquez sur "Calculer la Prime" pour afficher les détails.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Cartes de résultats -->
                            <div class="space-y-3">
                                <div class="card border-0 shadow-sm mb-3 animate__animated animate__fadeIn d-none" id="primeObsequeCard">
                                    <div class="card-body py-3 px-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title text-muted small fw-bold text-uppercase mb-1"><i class="fas fa-shield-alt me-2 text-warning"></i>Prime Yako Obsèque</h6>
                                                <p class="card-text fs-4 fw-bold text-dark mb-0"><span id="primeObseque">0</span> <small class="fs-6 text-muted fw-normal">FCFA</small></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted opacity-50"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm mb-3 animate__animated animate__fadeIn" id="primeEmprunteurCard">
                                    <div class="card-body py-3 px-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title text-muted small fw-bold text-uppercase mb-1"><i class="fas fa-user-shield me-2 text-info"></i>Prime Emprunteur</h6>
                                                <p class="card-text fs-4 fw-bold text-dark mb-0"><span id="prime">0</span> <small class="fs-6 text-muted fw-normal">FCFA</small></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted opacity-50"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm mb-4 animate__animated animate__fadeIn" id="surprimeCard">
                                    <div class="card-body py-3 px-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title text-muted small fw-bold text-uppercase mb-1"><i class="fas fa-plus-circle me-2 text-danger"></i>Surprime</h6>
                                                <p class="card-text fs-4 fw-bold text-dark mb-0"><span id="surprime">0</span> <small class="fs-6 text-muted fw-normal">FCFA</small></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted opacity-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ribbon pour le total -->
                        <div class="position-relative mt-auto pt-2">
                            <div class="ribbon ribbon-top-right"><span>TOTAL</span></div>
                            <div class="card border-0 bg-white shadow-sm overflow-hidden w-100">
                                <div class="card-body text-center py-4 border-start border-4 border-success">
                                    <h6 class="text-yako-green fw-bold text-uppercase small tracking-wide mb-2"><i class="fas fa-coins me-2"></i>Montant Total des Primes</h6>
                                    <p class="display-6 fw-black text-yako-green mb-0"><span id="totalPremium">0</span> </p>
                                    <small class="text-muted fw-medium">Toutes Taxes Comprises (TTC)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Variables & Couleurs Globales */
        :root {
            --yako-primary: #076633;
            --yako-primary-hover: #054d26;
            --yako-light: rgba(7, 102, 51, 0.08);
        }

        .text-yako-green { color: var(--yako-primary) !important; }
        .bg-yako-green { background-color: var(--yako-primary) !important; }
        .bg-yako-green-light { background-color: var(--yako-light); }
        .bg-secondary-light { background-color: rgba(108, 117, 125, 0.1); }
        .fw-black { font-weight: 800; }
        
        .bg-light-gradient {
            background: linear-gradient(180deg, #f8f9fa 0%, #edf2f7 100%);
        }

        /* Personnalisation des boutons */
        .btn-yako-green {
            background-color: var(--yako-primary);
            color: #ffffff;
            border: 2px solid var(--yako-primary);
            transition: all 0.25s ease;
        }
        .btn-yako-green:hover {
            background-color: var(--yako-primary-hover);
            color: #ffffff;
            transform: translateY(-1px);
        }
        .btn-outline-yako {
            color: var(--yako-primary);
            border: 2px solid var(--yako-primary);
            background-color: transparent;
            transition: all 0.25s ease;
        }
        .btn-outline-yako:hover:not(.disabled) {
            background-color: var(--yako-primary);
            color: #ffffff;
        }
        .btn-outline-yako.disabled {
            border-color: #dee2e6;
            color: #6c757d;
            opacity: 0.65;
            pointer-events: none;
        }

        /* Switch customisé */
        .custom-switch:checked {
            background-color: var(--yako-primary) !important;
            border-color: var(--yako-primary) !important;
        }
        .custom-switch {
            width: 2.8em !important;
            height: 1.4em !important;
            cursor: pointer;
        }

        /* Personnalisation Sliders (Curseurs en vert) */
        .form-range::-webkit-slider-thumb { background: var(--yako-primary); }
        .form-range::-moz-range-thumb { background: var(--yako-primary); }
        .form-range::-ms-thumb { background: var(--yako-primary); }
        .form-range::-webkit-slider-thumb:active { background: var(--yako-primary-hover); }

        /* Effets de cartes */
        .card { transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1); }
        .card-body .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.05) !important;
        }

        /* Design du Ruban */
        .ribbon {
            width: 140px; height: 140px;
            overflow: hidden; position: absolute;
            top: -8px; right: -8px; z-index: 2;
        }
        .ribbon span {
            position: absolute; display: block; width: 200px; padding: 6px 0;
            background-color: #e5a93b; color: #fff;
            font-size: 12px; font-weight: 800; text-align: center;
            text-transform: uppercase; transform: rotate(45deg);
            right: -30px; top: 35px; box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            letter-spacing: 1px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const montantInput = document.getElementById('loanMontant');
            const montantRange = document.getElementById('montantRange');
            const montantFormatte = document.getElementById('montantFormatte');
            
            const dureeInput = document.getElementById('loanDuration');
            const dureeRange = document.getElementById('dureeRange');
            const dureeFormatte = document.getElementById('dureeFormatte');

            // Fonction utilitaire de formatage monétaire (Espaces pour les milliers)
            function formatNumber(value) {
                if(!value) return "0";
                return new Intl.NumberFormat('fr-FR').format(value);
            }

            // Met à jour les badges et valeurs textuelles
            function updateMontantUI(value) {
                montantFormatte.textContent = formatNumber(value) + " FCFA";
            }

            function updateDureeUI(value) {
                dureeFormatte.textContent = value + " mois";
            }

            // Initialisation des valeurs par défaut
            montantRange.value = 500000;
            montantInput.value = 500000;
            updateMontantUI(500000);

            dureeRange.value = 12;
            dureeInput.value = 12;
            updateDureeUI(12);

            // Événements pour le Montant
            montantInput.addEventListener('input', function() {
                let val = this.value;
                if(val > 30000000) val = 30000000;
                montantRange.value = val;
                updateMontantUI(val);
            });

            montantRange.addEventListener('input', function() {
                montantInput.value = this.value;
                updateMontantUI(this.value);
            });

            // Événements pour la Durée
            dureeInput.addEventListener('input', function() {
                let val = this.value;
                if(val > 60) val = 60;
                dureeRange.value = val;
                updateDureeUI(val);
            });

            dureeRange.addEventListener('input', function() {
                dureeInput.value = this.value;
                updateDureeUI(this.value);
            });

            // Activation des tooltips Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</div>
@endsection