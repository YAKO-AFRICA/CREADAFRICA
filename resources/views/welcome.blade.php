@extends('layouts.main')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary-color: #076633;
        --secondary-color: #f7a400;
    }

    .active {
        color: #fff !important;
        text-decoration-color: #fff;
        background-color: var(--secondary-color) !important;
    }

    body {
        background: #f8fafc;
        font-family: 'Inter', sans-serif;
        color: #1e293b;
    }

    /* Cartes */
    .card-custom {
        background: white;
        border: none;
        border-radius: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }

    .card-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -12px rgba(0,0,0,0.1);
    }

    /* Profile Section */
    .profile-section {
        background: var(--secondary-color);
        border-radius: 24px;
        padding: 24px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .profile-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background: rgba(85, 213, 117, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        color: white;
        border: 3px solid rgba(255,255,255,0.3);
        margin-bottom: 16px;
    }

    .online-status {
        width: 14px;
        height: 14px;
        background: #10b981;
        border-radius: 50%;
        border: 2px solid white;
        position: absolute;
        bottom: 2px;
        right: 2px;
    }

    /* KPI Cards */
    .kpi-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        transition: all 0.3s;
        border: 1px solid #f1f5f9;
        margin-bottom: 20px;
    }

    .kpi-card:hover {
        border-color: #e2e8f0;
        transform: translateY(-2px);
    }

    .kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
    }

    .kpi-value {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .trend-up {
        color: #10b981;
        font-size: 13px;
        font-weight: 500;
    }

    .trend-down {
        color: #ef4444;
        font-size: 13px;
        font-weight: 500;
    }

    /* Progress Bar */
    .progress-custom {
        height: 8px;
        background: #f1f5f9;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        height: 100%;
        border-radius: 4px;
        transition: width 0.6s ease;
    }

    /* Tables et listes */
    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s;
    }

    .activity-item:hover {
        background: #fafbff;
        padding-left: 8px;
    }

    .activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-top: 6px;
    }

    .prospect-item {
        padding: 12px;
        border-radius: 12px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .prospect-item:hover {
        background: #f8fafc;
        transform: translateX(4px);
    }

    .prospect-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
    }

    .badge-urgent {
        background: #fee2e2;
        color: #ef4444;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-soon {
        background: #fef3c7;
        color: #f59e0b;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-ok {
        background: #d1fae5;
        color: #10b981;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending {
        background: #dbeafe;
        color: #3b82f6;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Boutons */
    .btn-action {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-action:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    /* Charts */
    .chart-container {
        position: relative;
        height: 260px;
        margin-top: 20px;
    }

    /* Date badge */
    .date-badge {
        background: #f1f5f9;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 13px;
        color: #475569;
        font-weight: 500;
    }

    /* Section headers */
    .section-header {
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .section-subtitle {
        color: #64748b;
        font-size: 13px;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: fadeInUp 0.5s ease forwards;
    }

    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }
    .delay-5 { animation-delay: 0.25s; }
    .delay-6 { animation-delay: 0.3s; }
</style>

<div class="container-fluid px-4 py-4">


    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 animate-in">
        <div>
            <h1 class="display-6 fw-bold mb-1">Bonjour, {{ Auth::user()->membre->nom ?? ''}} {{ Auth::user()->membre->prenom ?? ''}} 👋</h1>
            <p class="text-secondary mb-0">Voici votre tableau de bord personnel — résumé en temps réel</p>
        </div>
        <div class="date-badge">
            <i class="bi bi-calendar3 me-1"></i>
            <?php
                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
                echo strftime('%A %d %B %Y');

            ?>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="profile-section animate-in delay-1">
        <div class="row align-items-center">
            <div class="col-md-auto">
                <div class="position-relative d-inline-block">
                    <div class="profile-avatar">{{ Str::substr(Auth::user()->membre->nom, 0, 1) }} {{ Str::substr(Auth::user()->membre->prenom, 0, 1) }}</div>
                    <div class="online-status"></div>
                </div>
            </div>
            <div class="col-md-5">
                <h3 class="text-white mb-1">{{ Auth::user()->membre->nom }} {{ Auth::user()->membre->prenom}}</h3>
                <p class="text-white-50 mb-2">{{ Auth::user()->membre->profession ?? '' }}</p>
                <div class="d-flex gap-3 flex-wrap">
                    <small class="text-white-70">
                        <i class="bi bi-envelope me-1"></i> {{ Auth::user()->email ?? ''}}
                    </small>
                    <small class="text-white-70">
                        <i class="bi bi-building me-1"></i> {{ Auth::user()->membre->nomagence ?? ''}}
                    </small>
                    <small class="text-white-70">
                        <i class="bi bi-globe me-1"></i> YAKO AFRICA ASSURANCE VIE - AGENCE {{ Auth::user()->membre->codeagence ?? ''}}
                    </small>
                </div>
            </div>
            <div class="col-md-auto ms-auto">
                <div class="bg-success bg-opacity-10 rounded-3 px-3 py-2">
                    <small class="text-white-20">Code agent</small>
                    <div class="fw-bold text-white">{{ Auth::user()->membre->codeagent ?? ''}}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prime Banner -->
    <div class="card-custom animate-in delay-2">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-auto">
                    <div class="kpi-icon" style="background: #fef3c7; width: 60px; height: 60px;">
                        <i class="bi bi-cash-stack fs-2 text-warning"></i>
                    </div>
                </div>
                <div class="col-md-4">
                    <small class="text-secondary">Total primes cumulées — contrats acceptés / Année</small>
                    <h2 class="fw-bold mb-0" style="color: #f59e0b;" id="primeCumule">0</h2>
                </div>
               <div class="col-md">
                    <div class="d-flex justify-content-between small text-secondary mb-1">
                        <span>Objectif mensuel</span> - <span id="objectif" class="text-success">0</span>
                        <span id="objectifPercent" class="fw-semibold text-warning">0%</span>
                    </div>

                    <div class="progress-custom">
                        <div id="objectifBar" class="progress-fill" style="width: 0%"></div>
                    </div>

                    <small class="text-secondary mt-2 d-block" id="objectifText">
                        Objectif : 0 FCFA · Reste : 0 FCFA
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Grid -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6 animate-in delay-2">
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #eff6ff;">
                    <i class="bi bi-file-text fs-2 text-primary"></i>
                </div>
                <div class="kpi-value" id="countSaisie">0</div>
                <div class="text-secondary small">Total en saisie</div>
                <div class="trend-up mt-2">
                    <i class="bi bi-arrow-up-short"></i> <span id="coutSaisieWeek"></span>  cette semaine
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 animate-in delay-3">
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #f3e8ff;">
                    <i class="bi bi-send fs-2 text-purple"></i>
                </div>
                <div class="kpi-value" id="countContratTransmis">0</div>
                <div class="text-secondary small">Saisies transmises</div>
                <div class="trend-up mt-2">
                    <i class="bi bi-arrow-up-short"></i> + <span id="countContratTransmisActifYear">0</span> Actif en traitement
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 animate-in delay-4">
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #e8f5e9;">
                    <i class="bi bi-check-circle fs-2 text-success"></i>
                </div>
                <div class="kpi-value" id="countContratAccepteYear">0</div>
                <div class="text-secondary small">Saisies acceptées</div>
                <div class="trend-up mt-2">
                    <i class="bi bi-arrow-up-short"></i> taux <span id="tauxAcceptPercent">0</span>%
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 animate-in delay-5">
            <div class="kpi-card">
                <div class="kpi-icon" style="background: #fef2f2;">
                    <i class="bi bi-x-circle fs-2 text-danger"></i>
                </div>
                <div class="kpi-value" id="countRejetesYear">0</div>
                <div class="text-secondary small">Saisies rejetées</div>
                <div class="trend-down mt-2">
                    <i class="bi bi-arrow-down-short"></i> taux <span id="tauxRejetPercent">0</span>%
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 animate-in delay-3">
            <div class="card-custom">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="fw-bold mb-1">Activité de production</h6>
                            <small class="text-secondary"><span id="dynamiqTimeTransmis"></span> — transmise vs acceptées</small>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnMonth" class="btn btn-outline-secondary btnTransmisClick">Année</button>
                            <button id="btnWeek" class="btn btn-outline-primary btnTransmisClick active">Semaine</button>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 12px; height: 12px; background: #3b82f6; border-radius: 3px;"></div>
                            <span class="small">Transmises</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 12px; height: 12px; background: #10b981; border-radius: 3px;"></div>
                            <span class="small">Acceptées</span>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="chartActivite"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 animate-in delay-4">
            <div class="card-custom" style="min-height: 400px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="fw-bold mb-1">Produits les plus vendus</h6>
                            <small class="text-secondary">
                                <span id="prodTimeLabel">Année en cours</span>
                            </small>
                        </div>

                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnProdYear" class="btn btn-outline-primary btnProd active">Année</button>
                            <button id="btnProdMonth" class="btn btn-outline-secondary btnProd">Mois</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container" style="height: 200px;">
                                <canvas id="chartDonut"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="donutLegend" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
    // Chart: Activité ligne

    document.addEventListener('DOMContentLoaded', () => {

        const buttons = document.querySelectorAll('.btnTransmisClick');
        const label = document.getElementById('dynamiqTimeTransmis');

        // valeur par défaut (semaine active)
        label.textContent = "7 derniers jours";

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {

                // active button
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // update label
                if(btn.id === 'btnWeek'){
                    label.textContent = "7 derniers jours";
                } else if(btn.id === 'btnMonth'){
                    label.textContent = "Mois en cours";
                }

            });
        });

    });




</script>

@endsection
