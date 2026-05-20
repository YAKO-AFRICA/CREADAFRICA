@extends('layouts.main')

@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Productions</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails de la proposition</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-end gap-4">
        @can('Valider une proposition')
        <form action="{{ route('prod.traitement.proposition.valider', $contrat->id)}}" method="post" class="submitForm">
            @csrf
            <button type="submit" class="btn btn-success py-1 px-2 border-1 text-center"><i class='bx bx-check fs-4'></i>Valider</button>
        </form>
        @endcan
        
        @can('Rejeter une proposition')
            <button type="button" class="btn btn-danger py-1 px-2 border-1 text-center" data-bs-toggle="modal" data-bs-target="#rejectModal"><i class='bx bx-x' ></i>Rejeter</button>
        @endcan

        @can('Modifier une proposition')
            <button type="button" class="border-0 btn btn-primary py-1 px-2 text-center">
                <a href="{{ route('prod.proposition.edit', $contrat->id) }}" class="btn py-1 px-2 border-1 text-center"><i class='bx bx-edit' ></i>Modifier</a>
            </button>
        @endcan
    </div>
</div>

<!-- Modal de rejet -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejeter la proposition N° {{ $contrat->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prod.traitement.proposition.rejet', $contrat->id)}}" method="post" class="submitForm">
                @csrf
                <div class="modal-body">
                    <div class="col-12 form-group mt-3">
                        <label for="motifrejet" class="form-label">Observations(Motif de rejet)</label>
                        <select name="motifrejet" id="motifrejet" class="form-select">
                            <option value="">Sélectionner un motif</option>
                            @foreach ($motifs as $motif)
                                <option class="form-option" value="{{ $motif->libelle }}">{{ $motif->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Rejeter maintenant</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <!-- Colonne de navigation -->
    <div class="col-12 col-lg-2">
        <div class="card h-50">
            <div class="card-body">
                <div class="fm-menu">
                    <div class="list-group list-group-flush" style="font-size: 10px !important">
                        <a href="javascript:;" class="list-group-item py-2 btn border-0 active" data-target="info-contrat">
                            <i class='bx bx-folder me-2'></i><span class="d-none d-md-inline">Contrat</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-adherent">
                            <i class='bx bx-user me-2'></i><span class="d-none d-md-inline">Adhérent</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-assurer">
                            <i class='bx bx-group me-2'></i><span class="d-none d-md-inline">Assurés</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-questionnaire">
                            <i class='bx bx-heart me-2'></i><span>Etat de sante</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-beneficiaire">
                            <i class='bx bx-heart me-2'></i><span class="d-none d-md-inline">Bénéficiaires</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-Info-complementaire">
                            <i class='bx bx-info-circle me-2'></i><span class="d-none d-md-inline">Informations</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents joints -->
        <div class="card mt-3">
            <div class="card-header bg-light py-2">
                <h6 class="mb-0"><i class='bx bx-paperclip me-2'></i><span class="d-none d-md-inline">Documents joints</span></h6>
            </div>
            <div class="card-body p-3">
                @php
                    $documents = $contrat->getDocumentsBasedOnProduct();
                @endphp

                @if (count($documents) > 0)
                    @foreach ($documents as $doc)
                    <div class="d-flex align-items-center mb-2 p-2 rounded document-item" style="background-color: #f8f9fa; cursor: pointer;">
                        <div class="fm-file-box bg-light-primary text-primary p-1 rounded me-2">
                            <i class='bx bxs-file-doc'></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold" style="font-size: 12px;">{{ Str::limit($doc->libelle ?? '', 20) }}</h6>
                            <p class="mb-0 text-muted" style="font-size: 10px;">
                                {{ Carbon\Carbon::parse($doc->saisiele ?? '')->format('d/m/Y') }}
                            </p>
                        </div>
                        <button class="btn btn-sm btn-light view-doc-btn" 
                                data-doc-url="{{ url('storage/documents/' . $doc->filename) }}"
                                data-doc-title="{{ $doc->libelle ?? '' }}"
                                title="Voir le document">
                            <i class="bx bx-show"></i>
                        </button>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted mb-0 text-center py-2" style="font-size: 12px;">Aucun document</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Colonne principale -->
    <div class="col-12 col-lg-10">
        <!-- Conteneur principal avec layout dynamique -->
        <div id="mainContainer" class="row g-3">
            <!-- Document Viewer (caché par défaut) -->
            <div id="documentViewer" class="col-12 col-lg-6 d-none">
                <div class="card h-100">
                    <div class="card-header  text-white py-2 d-flex justify-content-between align-items-center" style="background: #076633">
                        <h6 class="mb-0"><i class='bx bx-file me-2 text-white'></i><span id="docTitle" class="text-white">Document</span></h6>
                        <button class="btn btn-sm btn-light" id="closeDocViewer">
                            <i class='bx bx-x'></i>
                        </button>
                    </div>
                    <div class="card-body p-0" style="height: 70vh;">
                        <iframe id="docFrame" class="w-100 h-100 border-0" frameborder="0"></iframe>
                    </div>
                </div>
            </div>

            <!-- Contenu des sections -->
            <div id="contentCard" class="col-12 col-lg-6 col-lg-10">
                <div class="card h-100">
                    <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                        <!-- Section Info Contrat -->
                        <section id="info-contrat" class="section-content">
                            <h6 class="border-bottom pb-2 mb-3"><i class='bx bx-folder me-2'></i>Détails du Contrat</h6>
                            
                            <div class="row g-3">
                                <!-- Colonne 1 -->
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <dl class="mb-4">
                                        <dt>ID du contrat</dt>
                                        <dd>{{ $contrat->id ?? '--' }}</dd>
                        
                                        <dt>Mode de paiement</dt>
                                        <dd>
                                            @switch($contrat->modepaiement)
                                                @case('VIR') Virement bancaire @break
                                                @case('ESP') Espèce @break
                                                @case('CHK') Chèque @break
                                                @case('Mobile_money') Mobile money @break
                                                @case('SOURCE') Prélèvement à la source @break
                                                @default --
                                            @endswitch
                                        </dd>
                        
                                        @if ($contrat->modepaiement === 'VIR' || $contrat->modepaiement === 'SOURCE')
                                            <dt>Banque / Organisme</dt>
                                            <dd>{{ $contrat->organisme ?? '--' }}</dd>
                        
                                            <dt>Agence</dt>
                                            <dd>{{ $contrat->agence ?? '--' }}</dd>
                        
                                            <dt>N° de compte (Matricule)</dt>
                                            <dd>{{ $contrat->numerocompte ?? '--' }}</dd>
                                        @endif
                        
                                        @if ($contrat->modepaiement === 'Mobile_money')
                                            <dt>N° Mobile</dt>
                                            <dd>{{ $contrat->numerocompte ?? '--' }}</dd>
                                        @endif

                                        <dt>Code Banque</dt>
                                        <dd>{{ $contrat->codebanque ?? '--' }}</dd>
                                    </dl>
                                </div>
                        
                                <!-- Colonne 2 -->
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <dl class="mb-4">
                                        <dt>Périodicité</dt>
                                        <dd>
                                            @switch($contrat->periodicite)
                                                @case('M') Mensuelle @break
                                                @case('T') Trimestrielle @break
                                                @case('S') Semestrielle @break
                                            @case('A') Annuelle @break
                                                @case('U') Versement unique @break
                                                @default --
                                            @endswitch
                                        </dd>
                        
                                        <dt>Date d'effet</dt>
                                        <dd>{{ $contrat->dateeffet ?? '--' }}</dd>
                        
                                        <dt>Capital</dt>
                                        <dd>{{ number_format($contrat->capital ?? 0, 0, ',', ' ') }} FCFA</dd>
                        
                                        <dt>Rente</dt>
                                        <dd>{{ number_format($contrat->montantrente ?? 0, 0, ',', ' ') }} Fcfa</dd>

                                        <dt>Code Guichet</dt>
                                        <dd>{{ $contrat->codeguichet ?? '--' }}</dd>
                        
                                        <dt>Conseiller client</dt>
                                        <dd>{{ $contrat->nomagent ?? ""}}</dd>

                                        
                                    </dl>
                                </div>
                        
                                <!-- Colonne 3 -->
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <dl class="mb-4">
                                        <dt>Surprime</dt>
                                        <dd>{{ number_format($contrat->surprime ?? 0, 0, ',', ' ') }} FCFA</dd>
                        
                                        <dt>Prime</dt>
                                        <dd>{{ number_format($contrat->prime ?? 0, 0, ',', ' ') }} FCFA</dd>
                        
                                        <dt>Prime principale</dt>
                                        <dd>{{ number_format($contrat->primepricipale ?? 0, 0, ',', ' ') }} FCFA</dd>

                                        <dt>Frais d'adhésion</dt>
                                        <dd>{{ number_format($contrat->fraisadhesion ?? 0, 0, ',', ' ') }} FCFA</dd>
                        
                                        
                        
                                        <dt>Clé RIB</dt>
                                        <dd>{{ $contrat->rib ?? '--' }}</dd>
                                        <dt>Code conseiller</dt>
                                        <dd>{{ $contrat->codeConseiller ?? "--" }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </section>

                        <!-- Section Adhérent -->
                        <section id="edit-adherent" class="section-content d-none">
                            <h6 class="border-bottom pb-2 mb-3"><i class='bx bx-user me-2'></i>Adhérent</h6>
                            
                            <div class=" g-3">
                                <fieldset class="border p-3">

                                    <legend class="float-none w-auto px-2"><small>Adhérent</small></legend>
                                    <div class="my-3">
                                        <strong class=""><label class="form-label">Civilité :</label></strong>
                                        <span class="">{{ $contrat->adherent->civilite ?? 'Non renseigné' }}</span>      
                                    </div>

                                    <!---end row-->

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-6">

                                            <strong><label class="form-label">Nom :</label></strong>

                                            <span>{{ $contrat->adherent->nom ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-6">

                                            <strong><label class="form-label">Prénoms :</label></strong>

                                            <span>{{ $contrat->adherent->prenom ?? 'Non renseigné' }}</span>

                                        </div>

                                    </div>

                                    <!---end row-->

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-6">

                                            <strong>
                                                <label class="form-label">Date de naissance :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->datenaissance ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-6">

                                            <strong><label class="form-label">Lieu de naissance :</label></strong>

                                            <span>{{ $contrat->adherent->lieunaissance ?? 'Non renseigné' }}</span>

                                        </div>

                                    </div>

                                    <!---end row-->

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Nature de la pièce :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->naturepiece ?? 'Non renseigné' }}</span>

                                        </div>        

                                        <div class="col-12 col-lg-4">

                                        <strong>
                                                <label class="form-label">Numéro de la pièce :</label>
                                        </strong>

                                            <span>{{ $contrat->adherent->numeropiece ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Lieu de résidence :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->lieuresidence ?? 'Non renseigné' }}</span>

                                        </div>

                                    </div>

                                    <!---end row-->

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Profession :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->profession ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Secteur d'activités :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->employeur ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Email :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->email ?? 'Non renseigné' }}</span>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Mobile :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->mobile ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Mobile 2 :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->mobile1 ?? 'Non renseigné' }}</span>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Téléphone :</label>
                                            </strong>

                                            <span>{{ $contrat->adherent->telephone ?? 'Non renseigné' }}</span>

                                        </div>

                                    </div>

                                    <!---end row-->
                                </fieldset>

                                <fieldset class="border p-3">

                                    <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoin</small></legend>

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-8">

                                            <strong>
                                                <label class="form-label">Nom et Prénoms :</label>
                                            </strong>

                                            <p>{{ $contrat->personneressource ?? 'Non renseigné' }}</p>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Contact :</label>
                                            </strong>

                                            <p>{{ $contrat->contactpersonneressource ?? 'Non renseigné' }}</p>

                                        </div>

                                    </div>

                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-8">

                                            <strong>
                                                <label class="form-label">Nom et Prénoms :</label>
                                            </strong>

                                            <p>{{ $contrat->personneressource2 ?? 'Non renseigné' }}</p>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <strong>
                                                <label class="form-label">Contact :</label>
                                            </strong>

                                            <p>{{ $contrat->contactpersonneressource2 ?? 'Non renseigné' }}</p>

                                        </div>

                                    </div>

                                </fieldset>
                            </div>
                        </section>

                        <!-- Section Assurés -->
                        <section id="edit-assurer" class="section-content d-none">
                            <h6 class="border-bottom pb-2 mb-3"><i class='bx bx-group me-2'></i>Assurés</h6>
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="small fw-semibold">Assuré(e)</th>
                                            <th class="small fw-semibold">Garanties</th>
                                            <th class="small fw-semibold" style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($contrat->assures->count() > 0)
                                            @foreach ($contrat->assures as $assure)
                                                <tr>
                                                    <td class="fw-semibold">{{ $assure->nom ?? '-' }} {{ $assure->prenom ?? '-' }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($productGarantie as $item)
                                                                <li class="small">{{ Str::limit($item->libelle, 20) }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal" class="btn btn-sm btn-outline-primary">
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('productions.assurer.show')
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">Aucun assuré trouvé</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </section>

                        {{--  section sante --}}

                        <section id="edit-questionnaire" class="section-content d-none">
                            <fieldset class="border rounded p-3">
                                <legend class="float-none w-auto px-2 text-primary fw-bold">
                                    <small><i class="bi bi-heart-pulse"></i> Questionnaire Médical</small>
                                </legend>

                                {{-- Infos physiques --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 mb-2">
                                        <strong>Taille :</strong>
                                        <span class="ms-2">{{ $contrat->santes->taille ?? '--' }} cm</span>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Poids :</strong>
                                        <span class="ms-2">{{ $contrat->santes->poids ?? '--' }} kg</span>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Tension :</strong>
                                        <span class="ms-2">
                                            {{ $contrat->santes->tensionMin ?? '--' }} /
                                            {{ $contrat->santes->tensionMax ?? '--' }} mmHg
                                        </span>
                                    </div>
                                </div>

                                @php
                                    $santeFields = [
                                        'diabetes' => "Diabète",
                                        'hypertension' => "Hypertension",
                                        'sickleCell' => "Drépanocytose",
                                        'liverCirrhosis' => "Cirrhose du foie",
                                        'lungDisease' => "Maladie pulmonaire",
                                        'cancer' => "Cancer",
                                        'anemia' => "Anémie",
                                        'kidneyFailure' => "Insuffisance rénale",
                                        'stroke' => "AVC",
                                        'smoking' => "Fumeur",
                                        'alcohol' => "Consommation d’alcool",
                                        'sport' => "Pratique sportive",
                                        'accident' => "Accident récent",
                                        'treatment' => "Traitement médical (6 derniers mois)",
                                        'transSang' => "Transfusion sanguine (6 derniers mois)",
                                        'interChirugiale' => "Intervention chirurgicale subie",
                                        'prochaineInterChirugiale' => "Prochaine intervention prévue",
                                    ];
                                @endphp

                                <div class="row">
                                    @foreach ($santeFields as $field => $label)
                                        <div class="col-md-6 mb-2 d-flex justify-content-between border-bottom pb-1">
                                            <span>{{ $label }}</span>
                                            <span class="badge {{ ($contrat->santes->$field ?? 'Non') == 'Oui' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $contrat->santes->$field ?? 'Non' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        </section>


                        <!-- Section Bénéficiaire -->
                        <section id="edit-beneficiaire" class="section-content d-none">
                            <h6 class="border-bottom pb-2 mb-3"><i class='bx bx-heart me-2'></i>Bénéficiaires</h6>
                            
                            @if ($contrat->codeproduit === "INV_2020")
                            <div class="alert alert-info py-2 mb-3">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <span class="small fw-semibold">Au terme :</span>
                                        <span class="small">{{ $contrat->beneficiaireauterme ?? '--' }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="small fw-semibold">Au décès :</span>
                                        <span class="small">{{ $contrat->beneficiaireaudeces ?? '--' }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="small fw-semibold">Nom & Prénoms</th>
                                            <th class="small fw-semibold">Naissance</th>
                                            <th class="small fw-semibold">Contact</th>
                                            <th class="small fw-semibold" style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($contrat->beneficiaires->count() > 0)
                                            @foreach ($contrat->beneficiaires as $beneficiaire)
                                                <tr>
                                                    <td class="fw-semibold">{{ Str::limit($beneficiaire->nom ?? '', 10) }} {{ Str::limit($beneficiaire->prenom ?? '', 10) }}</td>
                                                    <td class="small">{{ Carbon\Carbon::parse($beneficiaire->datenaissance)->format('d/m/Y') ?? '--' }}</td>
                                                    <td class="small">{{ $beneficiaire->mobile ?? '--' }}</td>
                                                    <td>
                                                        <a href="#" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal" class="btn btn-sm btn-outline-primary">
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('productions.beneficiaires.show')
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-3">Aucun bénéficiaire trouvé</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </section>

                        <!-- Section Informations complémentaires -->
                        <section id="edit-Info-complementaire" class="section-content d-none">
                            <h6 class="border-bottom pb-2 mb-3"><i class='bx bx-info-circle me-2'></i>Informations complémentaires</h6>
                            
                            <div class="row g-3">
                                @php
                                    $infoItems = [
                                        ['icon' => 'bx-calendar', 'label' => 'Saisi le', 'value' => Carbon\Carbon::parse($contrat->created_at)->format('d/m/Y H:i') ?? '--'],
                                        ['icon' => 'bx-user', 'label' => 'Saisi par', 'value' => $contrat->nomagent ?? '--'],
                                        ['icon' => 'bx-id-card', 'label' => 'Code Agent', 'value' => $contrat->codeConseiller ?? '--'],
                                        ['icon' => 'bx-edit', 'label' => 'Modifié le', 'value' => $contrat->modifierle ?? '--'],
                                        ['icon' => 'bx-user-edit', 'label' => 'Modifié par', 'value' => $contrat->modifierpar ?? '--'],
                                        ['icon' => 'bx-send', 'label' => 'Transmis le', 'value' => $contrat->transmisle ?? '--'],
                                        ['icon' => 'bx-user-check', 'label' => 'Transmis par', 'value' => $contrat->transmisPar->nom ?? '--'],
                                        ['icon' => 'bx-check-circle', 'label' => 'Accepté le', 'value' => $contrat->accepterle ?? '--'],
                                        ['icon' => 'bx-user-plus', 'label' => 'Accepté par', 'value' => $contrat->accepterpar ?? '--'],
                                        ['icon' => 'bx-x-circle', 'label' => 'Rejeté le', 'value' => $contrat->annulerle ?? '--'],
                                        ['icon' => 'bx-user-x', 'label' => 'Rejeté par', 'value' => $contrat->rejeterpar ?? '--'],
                                        ['icon' => 'bx-transfer', 'label' => 'Est migré', 'value' => $contrat->estMigre ? '<span class="badge bg-success">Oui</span>' : '<span class="badge bg-secondary">Non</span>'],
                                    ];
                                @endphp
                                
                                @foreach ($infoItems as $item)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="bg-light p-2 rounded h-100">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class='bx {{ $item['icon'] }} me-1 text-primary'></i>
                                            <small class="text-muted">{{ $item['label'] }}</small>
                                        </div>
                                        <div class="fw-semibold small">{!! $item['value'] !!}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles pour l'affichage parallèle */
    .document-item:hover {
        background-color: #e9ecef !important;
        transform: translateX(2px);
        transition: all 0.2s ease;
    }

    .list-group-item.active {
        background-color: #076633 !important;
        color: white !important;
        border-color: #076633 !important;
    }

    .list-group-item:hover:not(.active) {
        background-color: #f8f9fa;
    }

    #documentViewer {
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Amélioration des cartes */
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Hauteurs fixes pour un affichage cohérent */
    #mainContainer .card {
        min-height: 70vh;
    }
    
    #mainContainer .card-body {
        max-height: 68vh;
        overflow-y: auto;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        #contentCard.col-lg-10 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        #documentViewer.col-lg-6 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 1rem;
        }
        
        #mainContainer .card {
            min-height: 60vh;
        }
    }
    
    @media (max-width: 768px) {
        .col-lg-2 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 1rem;
        }
        
        .col-lg-10 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .list-group-item span.d-none.d-md-inline {
            display: inline !important;
        }
        
        .card-header h6 .d-none.d-md-inline {
            display: inline !important;
        }
    }
    
    /* Scrollbar personnalisée */
    .card-body::-webkit-scrollbar {
        width: 6px;
    }
    
    .card-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .card-body::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .card-body::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.list-group-item');
        const sections = document.querySelectorAll('.section-content');
        const viewDocBtns = document.querySelectorAll('.view-doc-btn');
        const documentViewer = document.getElementById('documentViewer');
        const docFrame = document.getElementById('docFrame');
        const docTitle = document.getElementById('docTitle');
        const closeDocViewer = document.getElementById('closeDocViewer');
        const contentCard = document.getElementById('contentCard');
        const mainContainer = document.getElementById('mainContainer');

        // Navigation entre les sections
        links.forEach(link => {
            link.addEventListener('click', () => {
                const targetId = link.getAttribute('data-target');

                // Retirer la classe active de tous les liens
                links.forEach(l => l.classList.remove('active'));
                
                // Ajouter la classe active au lien cliqué
                link.classList.add('active');

                // Masquer toutes les sections
                sections.forEach(section => section.classList.add('d-none'));

                // Afficher la section correspondante
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.remove('d-none');
                    
                    // Scroll vers le haut de la section des détails
                    const detailsCard = targetSection.closest('.card-body');
                    if (detailsCard) {
                        detailsCard.scrollTop = 0;
                    }
                }
            });
        });

        // Afficher le premier onglet par défaut
        if (links.length > 0) {
            links[0].classList.add('active');
        }

        // Affichage des documents en parallèle
        viewDocBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const docUrl = btn.getAttribute('data-doc-url');
                const docTitleText = btn.getAttribute('data-doc-title');

                // Afficher le visualiseur
                documentViewer.classList.remove('d-none');
                docFrame.src = docUrl;
                docTitle.textContent = docTitleText;

                // Changer la largeur de la carte de contenu
                contentCard.classList.remove('col-lg-10');
                contentCard.classList.add('col-lg-6');

                // Sur mobile, on scroll vers le visualiseur
                if (window.innerWidth < 992) {
                    documentViewer.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Fermer le visualiseur
        closeDocViewer.addEventListener('click', () => {
            documentViewer.classList.add('d-none');
            docFrame.src = '';
            
            // Restaurer la largeur d'origine
            contentCard.classList.remove('col-lg-6');
            contentCard.classList.add('col-lg-10');
        });

        // Gérer le redimensionnement de la fenêtre
        window.addEventListener('resize', () => {
            if (window.innerWidth < 992) {
                // Sur tablette/mobile, forcer l'affichage en colonne
                contentCard.classList.remove('col-lg-6', 'col-lg-10');
                contentCard.classList.add('col-12');
            } else {
                // Sur desktop, restaurer les classes selon l'état
                if (!documentViewer.classList.contains('d-none')) {
                    contentCard.classList.remove('col-12');
                    contentCard.classList.add('col-lg-6');
                } else {
                    contentCard.classList.remove('col-12', 'col-lg-6');
                    contentCard.classList.add('col-lg-10');
                }
            }
        });

        // Initialiser l'état responsive
        window.dispatchEvent(new Event('resize'));
    });
</script>

@endsection