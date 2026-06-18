@extends('layouts.main')

@section('content')

<script>
    const ALL_CONTRATS = @json($contrats);
    const ALL_MEMBRES  = @json($allMembre);
    const ALL_PRODUITS = @json($allCodeproduit);
</script>

<div class="rp-wrapper">

    {{-- ===== BREADCRUMB + EXPORTS ===== --}}
    <div class="rp-topbar">
        <nav class="rp-breadcrumb">
            <a href="{{ route('dashboard') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Accueil
            </a>
            <span class="rp-bc-sep">›</span>
            <a href="#">Rapports</a>
            <span class="rp-bc-sep">›</span>
            <span class="rp-bc-current">Production CREDAFRICA</span>
        </nav>

        <div class="rp-export-group">
            <span class="rp-export-label">Exporter</span>
            <button class="rp-btn-export" onclick="exportCSV()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                CSV
            </button>
            <button class="rp-btn-export" onclick="exportExcel()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18"/></svg>
                Excel
            </button>
            <button class="rp-btn-export" onclick="window.print()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Imprimer
            </button>
        </div>
    </div>

    {{-- ===== TITRE PAGE ===== --}}
    <div class="rp-page-header">
        <div>
            <h1 class="rp-title">Rapport de Production</h1>
            <p class="rp-subtitle">Portefeuille CREDAFRICA — toutes branches hors COM</p>
        </div>
        <div class="rp-badge-partenaire">CREDAFRICA</div>
    </div>

    {{-- ===== BARRE DE FILTRES ===== --}}
    <div class="rp-filter-card">
        <div class="rp-filter-header">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
            Filtres
        </div>
        <div class="rp-filter-grid">

            <div class="rp-filter-field">
                <label class="rp-label" for="f-agent">Agent saisisseur</label>
                <select id="f-agent" class="rp-select" onchange="applyFilters()">
                    <option value="">Tous les agents</option>
                    @foreach($allMembre as $m)
                        <option value="{{ $m->idmembre }}">{{ $m->prenom }} {{ $m->nom }} ({{ $m->codeagent }})</option>
                    @endforeach
                </select>
            </div>

            <div class="rp-filter-field">
                <label class="rp-label" for="f-date-start">Du</label>
                <input type="date" id="f-date-start" class="rp-input" onchange="applyFilters()">
            </div>

            <div class="rp-filter-field">
                <label class="rp-label" for="f-date-end">Au</label>
                <input type="date" id="f-date-end" class="rp-input" onchange="applyFilters()">
            </div>

            <div class="rp-filter-field">
                <label class="rp-label" for="f-produit">Produit</label>
                <select id="f-produit" class="rp-select" onchange="applyFilters()">
                    <option value="">Tous les produits</option>
                    @foreach($allCodeproduit as $cp)
                        <option value="{{ $cp }}">{{ $cp }}</option>
                    @endforeach
                </select>
            </div>

            {{-- NOUVEAU : Filtre Étape --}}
            <div class="rp-filter-field">
                <label class="rp-label" for="f-etape">Étape / Statut</label>
                <select id="f-etape" class="rp-select" onchange="applyFilters()">
                    <option value="">Toutes les étapes</option>
                    <option value="1">1 — En saisie</option>
                    <option value="2">2 — Transmis</option>
                    <option value="3">3 — Accepté</option>
                    <option value="4">4 — Rejeté</option>
                </select>
            </div>

        </div>
        <div class="rp-filter-actions">
            <button class="rp-btn-reset" onclick="resetFilters()">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-4.5"/></svg>
                Réinitialiser
            </button>
            <span class="rp-result-info" id="result-count">— contrats affichés</span>
        </div>
    </div>

    {{-- ===== KPIs ===== --}}
    <div class="rp-kpi-grid">
        <div class="rp-kpi rp-kpi--total">
            <div class="rp-kpi-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div>
                <div class="rp-kpi-value" id="kpi-total">—</div>
                <div class="rp-kpi-label">Total contrats</div>
            </div>
        </div>
        <div class="rp-kpi rp-kpi--saisie" style="cursor:pointer" onclick="filterByEtape(1)">
            <div class="rp-kpi-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
            <div>
                <div class="rp-kpi-value" id="kpi-saisie">—</div>
                <div class="rp-kpi-label">En saisie <span class="rp-kpi-badge rp-badge-1">Étape 1</span></div>
            </div>
        </div>
        <div class="rp-kpi rp-kpi--transmis" style="cursor:pointer" onclick="filterByEtape(2)">
            <div class="rp-kpi-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </div>
            <div>
                <div class="rp-kpi-value" id="kpi-transmis">—</div>
                <div class="rp-kpi-label">Transmis <span class="rp-kpi-badge rp-badge-2">Étape 2</span></div>
            </div>
        </div>
        <div class="rp-kpi rp-kpi--accepte" style="cursor:pointer" onclick="filterByEtape(3)">
            <div class="rp-kpi-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div>
                <div class="rp-kpi-value" id="kpi-accepte">—</div>
                <div class="rp-kpi-label">Acceptés <span class="rp-kpi-badge rp-badge-3">Étape 3</span></div>
            </div>
        </div>
        <div class="rp-kpi rp-kpi--rejete" style="cursor:pointer" onclick="filterByEtape(4)">
            <div class="rp-kpi-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
            <div>
                <div class="rp-kpi-value" id="kpi-rejete">—</div>
                <div class="rp-kpi-label">Rejetés <span class="rp-kpi-badge rp-badge-4">Étape 4</span></div>
            </div>
        </div>
    </div>

    {{-- ===== TABLEAU ===== --}}
    <div class="rp-table-card">
        <div class="rp-table-header">
            <h2 class="rp-table-title">Liste des contrats</h2>
            <div class="rp-table-header-actions">
                <div class="rp-table-search-wrap">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="table-search" class="rp-table-search" placeholder="Rechercher…" oninput="applyFilters()">
                </div>

                {{-- NOUVEAU : Bouton Colonnes --}}
                <div class="rp-col-picker-wrap">
                    <button class="rp-btn-cols" id="btn-cols" onclick="toggleColPicker()">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        Colonnes
                        <span class="rp-col-count" id="col-count">9</span>
                    </button>
                    <div class="rp-col-picker" id="col-picker">
                        <div class="rp-col-picker-header">
                            <span>Colonnes affichées</span>
                            <div class="rp-col-picker-actions">
                                <button onclick="setAllCols(true)">Tout</button>
                                <button onclick="setAllCols(false)">Aucun</button>
                            </div>
                        </div>
                        <div class="rp-col-picker-list" id="col-picker-list">
                            {{-- Rempli par JS --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rp-table-scroll">
            <table class="rp-table" id="contrats-table">
                <thead>
                    <tr id="table-thead-row"></tr>
                </thead>
                <tbody id="contrats-tbody"></tbody>
            </table>
        </div>

        <div class="rp-table-empty" id="table-empty" style="display:none;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <p>Aucun contrat ne correspond aux filtres sélectionnés.</p>
        </div>

        <div class="rp-pagination" id="pagination"></div>
    </div>

</div>

{{-- ===== STYLES ===== --}}
<style>
:root {
    --yako-green:      #076633;
    --yako-green-dk:   #054f27;
    --yako-green-lt:   #e8f5ee;
    --yako-accent:     #0ea05a;

    --kpi-saisie:      #f59e0b;
    --kpi-saisie-lt:   #fef3c7;
    --kpi-transmis:    #3b82f6;
    --kpi-transmis-lt: #eff6ff;
    --kpi-accepte:     #10b981;
    --kpi-accepte-lt:  #ecfdf5;
    --kpi-rejete:      #ef4444;
    --kpi-rejete-lt:   #fef2f2;

    --text-main:  #1a2332;
    --text-muted: #6b7280;
    --border:     #e5e7eb;
    --bg-page:    #f4f6f9;
    --radius:     10px;
}

.rp-wrapper { padding:1.5rem 2rem; background:var(--bg-page); min-height:100vh; font-family:'Inter',system-ui,sans-serif; }

/* Topbar */
.rp-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem; flex-wrap:wrap; gap:.75rem; }
.rp-breadcrumb { display:flex; align-items:center; gap:.4rem; font-size:.85rem; color:var(--text-muted); }
.rp-breadcrumb a { color:var(--yako-green); text-decoration:none; display:flex; align-items:center; gap:.3rem; }
.rp-breadcrumb a:hover { text-decoration:underline; }
.rp-bc-sep { color:#cbd5e1; }
.rp-bc-current { color:var(--text-main); font-weight:500; }
.rp-export-group { display:flex; align-items:center; gap:.5rem; }
.rp-export-label { font-size:.8rem; color:var(--text-muted); margin-right:.25rem; }
.rp-btn-export { display:flex; align-items:center; gap:.4rem; padding:.4rem .85rem; border:1px solid var(--border); border-radius:6px; background:#fff; font-size:.8rem; color:var(--text-main); cursor:pointer; transition:all .15s; }
.rp-btn-export:hover { border-color:var(--yako-green); color:var(--yako-green); background:var(--yako-green-lt); }

/* Page header */
.rp-page-header { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:1.5rem; }
.rp-title { font-size:1.55rem; font-weight:700; color:var(--text-main); margin:0 0 .25rem; }
.rp-subtitle { font-size:.875rem; color:var(--text-muted); margin:0; }
.rp-badge-partenaire { background:var(--yako-green); color:#fff; font-size:.75rem; font-weight:700; letter-spacing:.08em; padding:.35rem .75rem; border-radius:20px; align-self:center; }

/* Filter card */
.rp-filter-card { background:#fff; border:1px solid var(--border); border-radius:var(--radius); padding:1.25rem 1.5rem; margin-bottom:1.5rem; }
.rp-filter-header { display:flex; align-items:center; gap:.5rem; font-size:.8rem; font-weight:600; color:var(--text-muted); text-transform:uppercase; letter-spacing:.06em; margin-bottom:1rem; }
.rp-filter-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(185px, 1fr)); gap:1rem; }
.rp-filter-field { display:flex; flex-direction:column; gap:.4rem; }
.rp-label { font-size:.78rem; font-weight:600; color:var(--text-muted); text-transform:uppercase; letter-spacing:.04em; }
.rp-select, .rp-input { padding:.55rem .75rem; border:1px solid var(--border); border-radius:7px; font-size:.875rem; color:var(--text-main); background:#fff; outline:none; transition:border-color .15s; width:100%; }
.rp-select:focus, .rp-input:focus { border-color:var(--yako-green); box-shadow:0 0 0 3px rgba(7,102,51,.08); }

/* Étape select highlight */
#f-etape option[value="1"] { color:var(--kpi-saisie); }
#f-etape option[value="2"] { color:var(--kpi-transmis); }
#f-etape option[value="3"] { color:var(--kpi-accepte); }
#f-etape option[value="4"] { color:var(--kpi-rejete); }

.rp-filter-actions { display:flex; align-items:center; gap:1rem; margin-top:1rem; padding-top:1rem; border-top:1px solid var(--border); }
.rp-btn-reset { display:flex; align-items:center; gap:.4rem; padding:.45rem .9rem; border:1px solid var(--border); border-radius:6px; background:#fff; font-size:.82rem; color:var(--text-muted); cursor:pointer; transition:all .15s; }
.rp-btn-reset:hover { border-color:#ef4444; color:#ef4444; }
.rp-result-info { font-size:.82rem; color:var(--text-muted); margin-left:auto; }

/* KPIs */
.rp-kpi-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:1rem; margin-bottom:1.5rem; }
.rp-kpi { background:#fff; border:1px solid var(--border); border-radius:var(--radius); padding:1.1rem 1.25rem; display:flex; align-items:center; gap:1rem; transition:box-shadow .15s, border-color .15s; }
.rp-kpi:hover { box-shadow:0 4px 12px rgba(0,0,0,.06); }
.rp-kpi[onclick]:hover { border-color:var(--yako-green); }
.rp-kpi-icon { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.rp-kpi--total  .rp-kpi-icon { background:var(--yako-green-lt); color:var(--yako-green); }
.rp-kpi--saisie .rp-kpi-icon { background:var(--kpi-saisie-lt); color:var(--kpi-saisie); }
.rp-kpi--transmis .rp-kpi-icon { background:var(--kpi-transmis-lt); color:var(--kpi-transmis); }
.rp-kpi--accepte  .rp-kpi-icon { background:var(--kpi-accepte-lt); color:var(--kpi-accepte); }
.rp-kpi--rejete   .rp-kpi-icon { background:var(--kpi-rejete-lt); color:var(--kpi-rejete); }
.rp-kpi-value { font-size:1.65rem; font-weight:700; color:var(--text-main); line-height:1; }
.rp-kpi-label { font-size:.78rem; color:var(--text-muted); margin-top:.3rem; display:flex; align-items:center; gap:.4rem; flex-wrap:wrap; }
.rp-kpi-badge { font-size:.65rem; font-weight:600; padding:.1rem .45rem; border-radius:20px; white-space:nowrap; }
.rp-badge-1 { background:var(--kpi-saisie-lt); color:var(--kpi-saisie); }
.rp-badge-2 { background:var(--kpi-transmis-lt); color:var(--kpi-transmis); }
.rp-badge-3 { background:var(--kpi-accepte-lt); color:var(--kpi-accepte); }
.rp-badge-4 { background:var(--kpi-rejete-lt); color:var(--kpi-rejete); }

/* Table card */
.rp-table-card { background:#fff; border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; }
.rp-table-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid var(--border); flex-wrap:wrap; gap:.75rem; }
.rp-table-title { font-size:1rem; font-weight:600; color:var(--text-main); margin:0; }
.rp-table-header-actions { display:flex; align-items:center; gap:.6rem; flex-wrap:wrap; }
.rp-table-search-wrap { display:flex; align-items:center; gap:.5rem; background:#f9fafb; border:1px solid var(--border); border-radius:7px; padding:.45rem .75rem; }
.rp-table-search { border:none; background:transparent; outline:none; font-size:.85rem; color:var(--text-main); width:180px; }
.rp-table-scroll { overflow-x:auto; }
.rp-table { width:100%; border-collapse:collapse; font-size:.85rem; }
.rp-table thead tr { background:var(--bg-page); }
.rp-table th { padding:.75rem 1rem; text-align:left; font-size:.75rem; font-weight:600; color:var(--text-muted); text-transform:uppercase; letter-spacing:.05em; white-space:nowrap; border-bottom:1px solid var(--border); }
.rp-table td { padding:.75rem 1rem; border-bottom:1px solid #f3f4f6; vertical-align:middle; color:var(--text-main); white-space:nowrap; }
.rp-table tbody tr:hover { background:#fafbff; }
.rp-table tbody tr:last-child td { border-bottom:none; }

/* Étape badges */
.rp-etape { display:inline-flex; align-items:center; gap:.35rem; padding:.25rem .65rem; border-radius:20px; font-size:.75rem; font-weight:600; }
.rp-etape-1 { background:var(--kpi-saisie-lt); color:var(--kpi-saisie); }
.rp-etape-2 { background:var(--kpi-transmis-lt); color:var(--kpi-transmis); }
.rp-etape-3 { background:var(--kpi-accepte-lt); color:var(--kpi-accepte); }
.rp-etape-4 { background:var(--kpi-rejete-lt); color:var(--kpi-rejete); }
.rp-etape-other { background:#f3f4f6; color:var(--text-muted); }

/* Empty */
.rp-table-empty { padding:3rem; text-align:center; color:var(--text-muted); display:flex; flex-direction:column; align-items:center; gap:.75rem; font-size:.9rem; }

/* Action btn */
.rp-action-btn { background:none; border:1px solid var(--border); border-radius:6px; padding:.3rem .6rem; cursor:pointer; color:var(--text-muted); transition:all .15s; }
.rp-action-btn:hover { border-color:var(--yako-green); color:var(--yako-green); background:var(--yako-green-lt); }

/* Pagination */
.rp-pagination { display:flex; align-items:center; justify-content:flex-end; gap:.5rem; padding:.85rem 1.25rem; border-top:1px solid var(--border); }
.rp-page-btn { padding:.35rem .65rem; border:1px solid var(--border); border-radius:6px; background:#fff; font-size:.8rem; cursor:pointer; color:var(--text-main); transition:all .15s; }
.rp-page-btn:hover { border-color:var(--yako-green); color:var(--yako-green); }
.rp-page-btn.active { background:var(--yako-green); color:#fff; border-color:var(--yako-green); }
.rp-page-btn:disabled { opacity:.4; cursor:not-allowed; }

/* ===== COLUMN PICKER ===== */
.rp-col-picker-wrap { position:relative; }
.rp-btn-cols { display:flex; align-items:center; gap:.4rem; padding:.4rem .85rem; border:1px solid var(--border); border-radius:6px; background:#fff; font-size:.8rem; color:var(--text-main); cursor:pointer; transition:all .15s; }
.rp-btn-cols:hover, .rp-btn-cols.active { border-color:var(--yako-green); color:var(--yako-green); background:var(--yako-green-lt); }
.rp-col-count { background:var(--yako-green); color:#fff; font-size:.65rem; font-weight:700; padding:.1rem .4rem; border-radius:10px; min-width:18px; text-align:center; }
.rp-col-picker { display:none; position:absolute; right:0; top:calc(100% + 6px); z-index:100; background:#fff; border:1px solid var(--border); border-radius:var(--radius); box-shadow:0 8px 24px rgba(0,0,0,.12); width:240px; }
.rp-col-picker.open { display:block; }
.rp-col-picker-header { display:flex; align-items:center; justify-content:space-between; padding:.75rem 1rem; border-bottom:1px solid var(--border); font-size:.8rem; font-weight:600; color:var(--text-main); }
.rp-col-picker-actions { display:flex; gap:.4rem; }
.rp-col-picker-actions button { font-size:.72rem; padding:.2rem .5rem; border:1px solid var(--border); border-radius:4px; background:#fff; cursor:pointer; color:var(--text-muted); transition:all .1s; }
.rp-col-picker-actions button:hover { border-color:var(--yako-green); color:var(--yako-green); }
.rp-col-picker-list { padding:.5rem .75rem; max-height:320px; overflow-y:auto; }
.rp-col-item { display:flex; align-items:center; gap:.6rem; padding:.45rem .25rem; border-radius:5px; cursor:pointer; transition:background .1s; user-select:none; }
.rp-col-item:hover { background:var(--yako-green-lt); }
.rp-col-item input[type=checkbox] { accent-color:var(--yako-green); width:15px; height:15px; flex-shrink:0; cursor:pointer; }
.rp-col-item label { font-size:.83rem; color:var(--text-main); cursor:pointer; flex:1; }
.rp-col-item-drag { color:#ccc; font-size:.7rem; cursor:grab; }
.rp-col-group-header { font-size:.7rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.06em; padding:.6rem .25rem .25rem; margin-top:.25rem; border-top:1px solid var(--border); }
.rp-col-group-header:first-child { border-top:none; margin-top:0; padding-top:.25rem; }

/* Print */
@media print {
    .rp-topbar .rp-export-group, .rp-filter-actions .rp-btn-reset, .rp-pagination, .rp-col-picker-wrap { display:none; }
    .rp-wrapper { padding:0; background:#fff; }
    .rp-table-card, .rp-filter-card, .rp-kpi { border:1px solid #ddd; box-shadow:none; }
}
@media (max-width:640px) {
    .rp-wrapper { padding:1rem; }
    .rp-kpi-grid { grid-template-columns:1fr 1fr; }
    .rp-table-search { width:120px; }
}
</style>

{{-- ===== SCRIPT ===== --}}
<script>
const PER_PAGE = 15;
let currentPage = 1;
let filtered = [];

// ===== DÉFINITION DES COLONNES =====
// Groupes pour organiser le picker
const COL_GROUPS = [
    {
        label: '📋 Identification',
        keys: ['numeropolice','codeproposition','idproposition','numBullettin','branche','partenaire','codeoperation','cleintegration','refcontratsource']
    },
    {
        label: '👤 Souscripteur',
        keys: ['nomsouscipteur','typesouscipteur','codeadherent','codeConseiller','nomagent']
    },
    {
        label: '📦 Produit',
        keys: ['codeproduit','libelleproduit','Formule','organisme']
    },
    {
        label: '👨‍💼 Saisie',
        keys: ['saisiepar','saisiele','agence']
    },
    {
        label: '💰 Finances',
        keys: ['prime','primepricipale','surprime','capital','fraisadhesion','montantrente']
    },
    {
        label: '⏱ Durée & Périodicité',
        keys: ['duree','periodicite','dateeffet','periodiciterente','dureerente']
    },
    {
        label: '🏦 Paiement & Banque',
        keys: ['modepaiement','numerocompte','codebanque','codeguichet','rib','estpaye','pretconnexe']
    },
    {
        label: '🔄 Workflow',
        keys: ['etape','transmisle','transmispar','accepterle','accepterpar','nomaccepterpar','annulerle','modifierle','modifierpar','rejeterpar','motifrejet']
    },
    {
        label: '👥 Bénéficiaires & Ressources',
        keys: ['beneficiaireauterme','beneficiaireaudeces','personneressource','contactpersonneressource','personneressource2','contactpersonneressource2']
    },
    {
        label: '🔧 Divers',
        keys: ['estMigre','details']
    },
];

const COLUMNS = [
    // --- Identification ---
    { key:'id',          label:'N° Id',               visible:true,  locked:true  },
    { key:'codeproposition',       label:'Code proposition',        visible:false, locked:false },
    { key:'idproposition',         label:'ID proposition',          visible:false, locked:false },
    { key:'numBullettin',          label:'N° Bulletin',             visible:false, locked:false },
    { key:'branche',               label:'Branche',                 visible:false, locked:false },
    { key:'partenaire',            label:'Partenaire',              visible:false, locked:false },
    { key:'codeoperation',         label:'Code opération',          visible:false, locked:false },
    { key:'cleintegration',        label:'Clé intégration',         visible:false, locked:false },
    { key:'refcontratsource',      label:'Réf. contrat source',     visible:false, locked:false },
    // --- Souscripteur ---
    { key:'nomsouscipteur',        label:'Souscripteur',            visible:true,  locked:false },
    { key:'typesouscipteur',       label:'Type souscripteur',       visible:false, locked:false },
    { key:'codeadherent',          label:'Code adhérent',           visible:false, locked:false },
    { key:'codeConseiller',        label:'Code conseiller',         visible:false, locked:false },
    { key:'nomagent',              label:'Nom agent',               visible:false, locked:false },
    // --- Produit ---
    { key:'codeproduit',           label:'Produit',                 visible:true,  locked:false },
    { key:'libelleproduit',        label:'Libellé produit',         visible:false, locked:false },
    { key:'Formule',               label:'Formule',                 visible:false, locked:false },
    { key:'organisme',             label:'Organisme',               visible:false, locked:false },
    // --- Saisie ---
    { key:'saisiepar',             label:'Agent saisisseur',        visible:true,  locked:false },
    { key:'saisiele',              label:'Date saisie',             visible:true,  locked:false },
    { key:'agence',                label:'Agence',                  visible:false, locked:false },
    // --- Finances ---
    { key:'prime',                 label:'Prime (FCFA)',             visible:true,  locked:false },
    { key:'primepricipale',        label:'Prime principale',        visible:false, locked:false },
    { key:'surprime',              label:'Surprime',                visible:false, locked:false },
    { key:'capital',               label:'Capital (FCFA)',           visible:true,  locked:false },
    { key:'fraisadhesion',         label:'Frais adhésion',          visible:false, locked:false },
    { key:'montantrente',          label:'Montant rente',           visible:false, locked:false },
    // --- Durée & Périodicité ---
    { key:'duree',                 label:'Durée',                   visible:true,  locked:false },
    { key:'periodicite',           label:'Périodicité',             visible:false, locked:false },
    { key:'dateeffet',             label:'Date effet',              visible:false, locked:false },
    { key:'periodiciterente',      label:'Périodicité rente',       visible:false, locked:false },
    { key:'dureerente',            label:'Durée rente',             visible:false, locked:false },
    // --- Paiement & Banque ---
    { key:'modepaiement',          label:'Mode paiement',           visible:false, locked:false },
    { key:'numerocompte',          label:'N° compte',               visible:false, locked:false },
    { key:'codebanque',            label:'Code banque',             visible:false, locked:false },
    { key:'codeguichet',           label:'Code guichet',            visible:false, locked:false },
    { key:'rib',                   label:'RIB',                     visible:false, locked:false },
    { key:'estpaye',               label:'Payé ?',                  visible:false, locked:false },
    { key:'pretconnexe',           label:'Prêt connexe',            visible:false, locked:false },
    // --- Workflow ---
    { key:'etape',                 label:'Étape',                   visible:true,  locked:false },
    { key:'transmisle',            label:'Date transmission',       visible:false, locked:false },
    { key:'transmispar',           label:'Transmis par',            visible:false, locked:false },
    { key:'accepterle',            label:'Date acceptation',        visible:false, locked:false },
    { key:'accepterpar',           label:'Accepté par',             visible:false, locked:false },
    { key:'nomaccepterpar',        label:'Nom acceptant',           visible:false, locked:false },
    { key:'annulerle',             label:'Date annulation',         visible:false, locked:false },
    { key:'modifierle',            label:'Date modification',       visible:false, locked:false },
    { key:'modifierpar',           label:'Modifié par',             visible:false, locked:false },
    { key:'rejeterpar',            label:'Rejeté par',              visible:false, locked:false },
    { key:'motifrejet',            label:'Motif rejet',             visible:false, locked:false },
    // --- Bénéficiaires ---
    { key:'beneficiaireauterme',   label:'Bénéficiaire au terme',   visible:false, locked:false },
    { key:'beneficiaireaudeces',   label:'Bénéficiaire au décès',   visible:false, locked:false },
    { key:'personneressource',     label:'Pers. ressource 1',       visible:false, locked:false },
    { key:'contactpersonneressource', label:'Contact PR 1',         visible:false, locked:false },
    { key:'personneressource2',    label:'Pers. ressource 2',       visible:false, locked:false },
    { key:'contactpersonneressource2', label:'Contact PR 2',        visible:false, locked:false },
    // --- Divers ---
    { key:'estMigre',              label:'Migré ?',                 visible:false, locked:false },
    { key:'details',               label:'Détails',                 visible:false, locked:false },
    // --- Actions (verrouillée) ---
    { key:'actions',               label:'Actions',                 visible:true,  locked:true  },
];

// Map idmembre -> label
const membreMap = {};
ALL_MEMBRES.forEach(m => { membreMap[m.idmembre] = `${m.prenom} ${m.nom}`; });

function etapeLabel(e) {
    return { 1:'En saisie', 2:'Transmis', 3:'Accepté', 4:'Rejeté' }[e] || `Étape ${e}`;
}
function etapeClass(e) {
    return { 1:'rp-etape-1', 2:'rp-etape-2', 3:'rp-etape-3', 4:'rp-etape-4' }[e] || 'rp-etape-other';
}
function fmt(n) { return n ? Number(n).toLocaleString('fr-FR') + ' F' : '—'; }
function fmtDate(d) { return d ? d.substring(0, 10) : '—'; }

// ===== FILTRES =====
function applyFilters() {
    const agent   = document.getElementById('f-agent').value;
    const dateS   = document.getElementById('f-date-start').value;
    const dateE   = document.getElementById('f-date-end').value;
    const produit = document.getElementById('f-produit').value;
    const etape   = document.getElementById('f-etape').value;
    const search  = document.getElementById('table-search').value.toLowerCase().trim();

    filtered = ALL_CONTRATS.filter(c => {
        if (agent   && c.saisiepar   !== agent)            return false;
        if (produit && c.codeproduit !== produit)          return false;
        if (etape   && String(c.etape) !== etape)          return false;
        if (dateS && c.saisiele && c.saisiele.substring(0,10) < dateS) return false;
        if (dateE && c.saisiele && c.saisiele.substring(0,10) > dateE) return false;
        if (search) {
            const hay = [c.numeropolice, c.nomsouscipteur, c.codeproduit, c.libelleproduit, c.agence, membreMap[c.saisiepar]||''].join(' ').toLowerCase();
            if (!hay.includes(search)) return false;
        }
        return true;
    });

    updateKPIs();
    currentPage = 1;
    renderTable();
}

// Clic sur KPI → filtre direct par étape
function filterByEtape(n) {
    const sel = document.getElementById('f-etape');
    sel.value = String(sel.value) === String(n) ? '' : String(n); // toggle
    applyFilters();
    document.querySelector('.rp-filter-card').scrollIntoView({ behavior:'smooth', block:'nearest' });
}

function updateKPIs() {
    document.getElementById('kpi-total').textContent    = filtered.length;
    document.getElementById('kpi-saisie').textContent   = filtered.filter(c => c.etape == 1).length;
    document.getElementById('kpi-transmis').textContent = filtered.filter(c => c.etape == 2).length;
    document.getElementById('kpi-accepte').textContent  = filtered.filter(c => c.etape == 3).length;
    document.getElementById('kpi-rejete').textContent   = filtered.filter(c => c.etape == 4).length;
    document.getElementById('result-count').textContent = `${filtered.length} contrat${filtered.length > 1 ? 's' : ''} affiché${filtered.length > 1 ? 's' : ''}`;
}

// ===== RENDU CELLULE par clé =====
function renderCell(c, key) {
    const nomComplet = `${c.adherent.prenom || ''} ${c.adherent.nom || ''}`.trim();
    switch(key) {
        case 'numeropolice':
            return `<span style="font-weight:600;color:var(--yako-green)">${c.id || '—'}</span>`;
        case 'nomsouscipteur':
            return nomComplet || '—';
        case 'codeproduit':
            return `<span style="font-size:.78rem;background:#f3f4f6;padding:.2rem .5rem;border-radius:5px;font-weight:600">${c.codeproduit||'—'}</span>${c.libelleproduit?`<br><span style="color:var(--text-muted);font-size:.78rem">${c.libelleproduit}</span>`:''}`;
        case 'saisiepar':
            return membreMap[c.saisiepar] || c.saisiepar || '—';
        // --- Dates ---
        case 'saisiele':     return fmtDate(c.saisiele);
        case 'transmisle':   return fmtDate(c.transmisle);
        case 'accepterle':   return fmtDate(c.accepterle);
        case 'annulerle':    return fmtDate(c.annulerle);
        case 'modifierle':   return fmtDate(c.modifierle);
        case 'dateeffet':    return fmtDate(c.dateeffet);
        // --- Montants ---
        case 'prime':          return `<span style="font-weight:600">${fmt(c.prime)}</span>`;
        case 'primepricipale': return fmt(c.primepricipale);
        case 'surprime':       return fmt(c.surprime);
        case 'capital':        return fmt(c.capital);
        case 'fraisadhesion':  return fmt(c.fraisadhesion);
        case 'montantrente':   return fmt(c.montantrente);
        // --- Durées ---
        case 'duree':          return c.duree ? c.duree + ' mois' : '—';
        case 'dureerente':     return c.dureerente ? c.dureerente + ' mois' : '—';
        // --- Textes simples ---
        case 'periodicite':    return c.periodicite || '—';
        case 'periodiciterente': return c.periodiciterente || '—';
        case 'modepaiement':   return c.modepaiement || '—';
        case 'agence':         return c.agence || '—';
        case 'organisme':      return c.organisme || '—';
        case 'branche':        return c.branche ? `<span style="font-size:.78rem;background:#f3f4f6;padding:.2rem .5rem;border-radius:5px;font-weight:600">${c.branche}</span>` : '—';
        case 'partenaire':     return c.partenaire || '—';
        case 'typesouscipteur': return c.typesouscipteur || '—';
        case 'codeadherent':   return c.codeadherent || '—';
        case 'codeConseiller': return c.codeConseiller || '—';
        case 'nomagent':       return c.nomagent || '—';
        case 'libelleproduit': return c.libelleproduit || '—';
        case 'Formule':        return c.Formule ? `<span style="font-size:.78rem;background:#eff6ff;color:#3b82f6;padding:.2rem .5rem;border-radius:5px;font-weight:600">${c.Formule}</span>` : '—';
        case 'codeproposition': return c.codeproposition || '—';
        case 'idproposition':  return c.idproposition || '—';
        case 'numBullettin':   return c.numBullettin || '—';
        case 'codeoperation':  return c.codeoperation || '—';
        case 'cleintegration': return c.cleintegration ? `<span style="font-size:.75rem;font-family:monospace;color:var(--text-muted)">${c.cleintegration}</span>` : '—';
        case 'refcontratsource': return c.refcontratsource || '—';
        case 'numerocompte':   return c.numerocompte || '—';
        case 'codebanque':     return c.codebanque || '—';
        case 'codeguichet':    return c.codeguichet || '—';
        case 'rib':            return c.rib ? `<span style="font-family:monospace;font-size:.8rem">${c.rib}</span>` : '—';
        case 'pretconnexe':    return c.pretconnexe || '—';
        case 'transmispar':    return c.transmispar || '—';
        case 'accepterpar':    return c.accepterpar || '—';
        case 'nomaccepterpar': return c.nomaccepterpar || '—';
        case 'modifierpar':    return c.modifierpar || '—';
        case 'rejeterpar':     return c.rejeterpar || '—';
        case 'beneficiaireauterme':  return c.beneficiaireauterme || '—';
        case 'beneficiaireaudeces':  return c.beneficiaireaudeces || '—';
        case 'personneressource':    return c.personneressource || '—';
        case 'contactpersonneressource': return c.contactpersonneressource || '—';
        case 'personneressource2':   return c.personneressource2 || '—';
        case 'contactpersonneressource2': return c.contactpersonneressource2 || '—';
        case 'motifrejet':     return c.motifrejet ? `<span style="color:var(--kpi-rejete);font-size:.78rem">${c.motifrejet}</span>` : '—';
        case 'details':        return c.details ? `<span style="font-size:.78rem;color:var(--text-muted);max-width:180px;display:inline-block;overflow:hidden;text-overflow:ellipsis" title="${c.details}">${c.details}</span>` : '—';
        // --- Booléens ---
        case 'estpaye':  return c.estpaye  ? '<span style="color:var(--kpi-accepte);font-weight:600;font-size:.8rem">✓ Payé</span>'  : '<span style="color:var(--text-muted);font-size:.8rem">Non payé</span>';
        case 'estMigre': return c.estMigre ? '<span style="color:var(--kpi-transmis);font-weight:600;font-size:.8rem">✓ Migré</span>' : '<span style="color:var(--text-muted);font-size:.8rem">Non migré</span>';
        // --- Étape & Actions ---
        case 'etape':
            return `<span class="rp-etape ${etapeClass(c.etape)}">${etapeLabel(c.etape)}</span>`;
        case 'actions':
            return `<button class="rp-action-btn" onclick="window.location='/production/show/${c.id}'" title="Voir le contrat">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>`;
        default:
            return c[key] !== undefined && c[key] !== null ? String(c[key]) : '—';
    }
}

// ===== RENDU TABLEAU =====
function renderTable() {
    const tbody = document.getElementById('contrats-tbody');
    const empty = document.getElementById('table-empty');
    const pag   = document.getElementById('pagination');
    const thead = document.getElementById('table-thead-row');

    const visibleCols = COLUMNS.filter(col => col.visible);

    // Header
    thead.innerHTML = visibleCols.map(col =>
        `<th>${col.label}</th>`
    ).join('');

    if (!filtered.length) {
        tbody.innerHTML = '';
        empty.style.display = 'flex';
        pag.innerHTML = '';
        return;
    }
    empty.style.display = 'none';

    const totalPages = Math.ceil(filtered.length / PER_PAGE);
    const slice = filtered.slice((currentPage - 1) * PER_PAGE, currentPage * PER_PAGE);

    tbody.innerHTML = slice.map(c =>
        `<tr>${visibleCols.map(col => `<td>${renderCell(c, col.key)}</td>`).join('')}</tr>`
    ).join('');

    // Pagination
    let pagHtml = '';
    if (totalPages > 1) {
        pagHtml += `<button class="rp-page-btn" onclick="goPage(${currentPage-1})" ${currentPage===1?'disabled':''}>‹</button>`;
        for (let p = 1; p <= totalPages; p++) {
            if (p === 1 || p === totalPages || (p >= currentPage-2 && p <= currentPage+2)) {
                pagHtml += `<button class="rp-page-btn ${p===currentPage?'active':''}" onclick="goPage(${p})">${p}</button>`;
            } else if (p === currentPage-3 || p === currentPage+3) {
                pagHtml += `<span style="color:var(--text-muted);font-size:.8rem">…</span>`;
            }
        }
        pagHtml += `<button class="rp-page-btn" onclick="goPage(${currentPage+1})" ${currentPage===totalPages?'disabled':''}>›</button>`;
    }
    pag.innerHTML = pagHtml;
}

function goPage(p) {
    currentPage = p;
    renderTable();
    document.querySelector('.rp-table-card').scrollIntoView({ behavior:'smooth', block:'start' });
}

function resetFilters() {
    ['f-agent','f-date-start','f-date-end','f-produit','f-etape','table-search'].forEach(id => {
        const el = document.getElementById(id);
        el.value = '';
    });
    applyFilters();
}

// ===== COLUMN PICKER =====
function buildColPicker() {
    const list = document.getElementById('col-picker-list');
    let html = '';
    COL_GROUPS.forEach(group => {
        // Trouver les colonnes de ce groupe avec leur index global
        const groupCols = group.keys
            .map(k => ({ idx: COLUMNS.findIndex(c => c.key === k), col: COLUMNS.find(c => c.key === k) }))
            .filter(x => x.col);
        if (!groupCols.length) return;
        html += `<div class="rp-col-group-header">${group.label}</div>`;
        groupCols.forEach(({ idx, col }) => {
            html += `
            <div class="rp-col-item" onclick="toggleCol(${idx}, event)">
                <input type="checkbox" id="col-cb-${idx}" ${col.visible?'checked':''} ${col.locked?'disabled':''} onchange="toggleCol(${idx}, event)" onclick="event.stopPropagation()">
                <label for="col-cb-${idx}">${col.label}</label>
                ${col.locked ? '<span style="font-size:.7rem;color:#ccc" title="Verrouillée">🔒</span>' : ''}
            </div>`;
        });
    });
    list.innerHTML = html;
    updateColCount();
}

function toggleCol(i, e) {
    if (COLUMNS[i].locked) return;
    COLUMNS[i].visible = !COLUMNS[i].visible;
    const cb = document.getElementById(`col-cb-${i}`);
    if (cb) cb.checked = COLUMNS[i].visible;
    updateColCount();
    renderTable();
}

function setAllCols(val) {
    COLUMNS.forEach((col, i) => {
        if (!col.locked) {
            col.visible = val;
            const cb = document.getElementById(`col-cb-${i}`);
            if (cb) cb.checked = val;
        }
    });
    updateColCount();
    renderTable();
}

function updateColCount() {
    const n = COLUMNS.filter(c => c.visible).length;
    document.getElementById('col-count').textContent = n;
}

function toggleColPicker() {
    const picker = document.getElementById('col-picker');
    const btn    = document.getElementById('btn-cols');
    picker.classList.toggle('open');
    btn.classList.toggle('active');
}

// Fermer picker si clic à l'extérieur
document.addEventListener('click', e => {
    const wrap = document.querySelector('.rp-col-picker-wrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('col-picker').classList.remove('open');
        document.getElementById('btn-cols').classList.remove('active');
    }
});

// ===== EXPORTS =====
function getVisibleExportCols() {
    return COLUMNS.filter(c => c.visible && c.key !== 'actions');
}

function exportCSV() {
    const cols = getVisibleExportCols();
    const header = cols.map(c => c.label);
    const rows = filtered.map(c => cols.map(col => {
        const v = col.key === 'saisiepar' ? (membreMap[c.saisiepar]||c.saisiepar||'')
                : col.key === 'etape'     ? etapeLabel(c.etape)
                : ['saisiele','transmisle','accepterle','annulerle'].includes(col.key) ? fmtDate(c[col.key])
                : c[col.key] || '';
        return v;
    }));
    const csv = [header, ...rows].map(r => r.map(v => `"${String(v).replace(/"/g,'""')}"`).join(';')).join('\n');
    download('\uFEFF' + csv, 'rapport_production.csv', 'text/csv;charset=utf-8');
}

function exportExcel() {
    const cols = getVisibleExportCols();
    const header = cols.map(c => `<th>${c.label}</th>`).join('');
    const rows = filtered.map(c => {
        const cells = cols.map(col => {
            const v = col.key === 'saisiepar' ? (membreMap[c.saisiepar]||c.saisiepar||'')
                    : col.key === 'etape'     ? etapeLabel(c.etape)
                    : ['saisiele','transmisle','accepterle','annulerle'].includes(col.key) ? fmtDate(c[col.key])
                    : c[col.key] || '';
            return `<td>${v}</td>`;
        }).join('');
        return `<tr>${cells}</tr>`;
    }).join('');
    const html = `<table><thead><tr>${header}</tr></thead><tbody>${rows}</tbody></table>`;
    download(html, 'rapport_production.xls', 'application/vnd.ms-excel');
}

function download(content, filename, mime) {
    const blob = new Blob([content], { type: mime });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href = url; a.download = filename; a.click();
    URL.revokeObjectURL(url);
}

// Init
buildColPicker();
applyFilters();
</script>

@endsection