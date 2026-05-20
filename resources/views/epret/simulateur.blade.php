@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Epret</li>
                    <li class="breadcrumb-item active" aria-current="page">Simulateur</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container mt-5">
        <h3 class="text-center text-uppercase">Simulateur de Prêt</h3>
        <div class="row mt-5">
            <!-- Formulaire -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-yako-green text-white text-center py-3">
                        <h4 class="mb-0 text-uppercase text-white"><i class="fas fa-calculator me-2"></i>SIMULATEUR DE PRÊT</h4>
                    </div>
                    <div class="card-body px-4 py-4">
                        <form id="loanSimulatorForm" class="row g-4 needs-validation" novalidate>
                            <!-- Date de naissance -->
                            <div class="col-sm-12 col-md-12">
                                <label for="dob" class="form-label fw-bold">Date de naissance <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fadeIn animated bx bx-calendar-event"></i></span>
                                    <input type="date" class="form-control py-2" id="dob" required>
                                    <div class="invalid-feedback">Veuillez entrer une date valide</div>
                                </div>
                            </div>

                            <!-- Montant du prêt -->
                            <div class="col-sm-12 col-md-12">
                                <label for="loanMontant" class="form-label fw-bold">Montant du prêt (FCFA) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fadeIn animated bx bx-money"></i></span>
                                    <input type="number" class="form-control py-2" id="loanMontant" placeholder="Ex: 500 000" min="50000" max="30000000" required>
                                    <div class="invalid-feedback">Veuillez entrer un montant valide</div>
                                </div>
                                <div class="mt-2">
                                    <input type="range" class="form-range" id="montantRange" min="50000" max="30000000" step="50000">
                                    <div class="d-flex justify-content-between small text-muted">
                                        <span>50 000 F</span>
                                        <span>30 000 000 F</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Durée -->
                            <div class="col-sm-12 col-md-12">
                                <label for="loanDuration" class="form-label fw-bold">Durée (mois) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fadeIn animated bx bx-timer"></i></span>
                                    <input type="number" class="form-control py-2" id="loanDuration" placeholder="Ex: 24" required>
                                    <div class="invalid-feedback">Veuillez entrer une durée valide</div>
                                </div>
                                <div class="mt-2">
                                    <input type="range" class="form-range" id="dureeRange" min="1" max="60" step="1">
                                    <div class="d-flex justify-content-between small text-muted">
                                        <span>1 mois</span>
                                        <span>60 mois</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Garantie Yako -->
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="disableYako" style="width: 3em; height: 1.3em;" value="0" readonly disabled>
                                    <label class="form-check-label fw-bold" for="disableYako">Inclure la Garantie Yako</label>
                                    <i class="fas fa-info-circle ms-2 text-primary" data-bs-toggle="tooltip" title="Protection du prêt en cas de décès ou d'invalidité"></i>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                                <button type="submit" class="btn btn-sm btn-primary  px-4 py-2 rounded-pill text-uppercase fw-bold">
                                    <i class="bs bx-chart-line me-2"></i>Calculer la Prime
                                </button>

                                <button type="button" class="btn btn-outline-primary btn-sm px-4 py-2 rounded-pill text-uppercase fw-bold" id="btnSouscrition" disabled>
                                    <a href="{{route('epret.create')}}">
                                        <i class="fas fa-play me-2"></i>Démarrer la Souscription
                                    </a>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Résultats -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-yako-green text-white text-center py-3">
                        <h4 class="mb-0 text-uppercase text-white"><i class="fas fa-chart-pie me-2"></i>RÉSULTATS</h4>
                    </div>

                    <div class="card-body p-0">
                        <div class="result-container p-4">
                            <!-- Affichage dynamique -->
                            <div class="text-center mb-4" id="resultat">
                                <div class="alert alert-info py-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span id="dynamicText">Remplissez le formulaire pour voir les résultats</span>
                                </div>
                            </div>

                            <!-- Cartes de résultats -->
                            <div class="mb-3 animate__animated animate__fadeIn d-none" id="primeObsequeCard">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title text-muted mb-1"><i class="fas fa-shield-alt me-2 text-warning"></i>Prime Yako Obsèque</h6>
                                                <p class="card-text fs-5 fw-bold"><span id="primeObseque">0</span></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 animate__animated animate__fadeIn" id="primeEmprunteurCard">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title text-muted mb-1"><i class="fas fa-user-shield me-2 text-info"></i>Prime Emprunteur</h6>
                                                <p class="card-text fs-5 fw-bold"><span id="prime">0</span></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 animate__animated animate__fadeIn" id="surprime">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title text-muted mb-1"><i class="fas fa-shield-alt me-2 text-warning"></i>Surprime</h6>
                                                <p class="card-text fs-5 fw-bold"><span id="surprime">0</span></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ribbon pour le total -->
                            <div class="position-relative mt-4 bg-yako-green animate__animated animate__fadeInUp">
                                <div class="ribbon ribbon-top-right"><span>TOTAL</span></div>
                                <div class="card border-success bg-light h-100">
                                    <div class="card-body text-center py-4">
                                        <h6 class="text-yako-green mb-2"><i class="fas fa-coins me-2"></i>Montant Total des Primes</h6>
                                        <p class="display-6 fw-bold text-yako-green mb-0"><span id="totalPremium">0</span> </p>
                                        {{-- <small class="text-muted">TTC</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Style personnalisé */

        .text-yako-green{
            color: #076633
        }
        .bg-yako-green{
            background-color: #076633 !important;
        }
        .ribbon {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: absolute;
            top: -10px;
            right: -10px;
            z-index: 1;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 8px 0;
            background-color: #28a745;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            transform: rotate(45deg);
            right: -25px;
            top: 40px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .ribbon::before, .ribbon::after {
            content: "";
            position: absolute;
            z-index: -1;
            border: 5px solid #1e7e34;
            border-top-color: transparent;
            border-right-color: transparent;
        }

        .ribbon::before {
            top: 0;
            left: 0;
        }

        .ribbon::after {
            bottom: 0;
            right: 0;
        }

        .form-range::-webkit-slider-thumb {
            background: #0d6efd;
        }

        .form-range::-moz-range-thumb {
            background: #0d6efd;
        }

        .form-range::-ms-thumb {
            background: #0d6efd;
        }

        .card {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>

    <script>
        // Script pour l'interactivité
        document.addEventListener('DOMContentLoaded', function() {
            // Synchronisation des sliders et inputs
            const montantInput = document.getElementById('loanMontant');
            const montantRange = document.getElementById('montantRange');
            const dureeInput = document.getElementById('loanDuration');
            const dureeRange = document.getElementById('dureeRange');

            // Initialisation des valeurs
            montantRange.value = 500000;
            montantInput.value = 500000;
            dureeRange.value = 12;
            dureeInput.value = 12;

            // Événements pour synchroniser
            montantInput.addEventListener('input', function() {
                montantRange.value = this.value;
            });

            montantRange.addEventListener('input', function() {
                montantInput.value = this.value;
            });

            dureeInput.addEventListener('input', function() {
                dureeRange.value = this.value;
            });

            dureeRange.addEventListener('input', function() {
                dureeInput.value = this.value;
            });

            // Activer les tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });


        });
    </script>
</div>



@endsection


