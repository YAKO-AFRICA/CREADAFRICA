@extends('layouts.main')

@section('content')


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Prospect</li>
                    <li class="breadcrumb-item active" aria-current="page">Liste</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Reglages</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#columnsModalPart">Personnaliser les colonnes</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header text-center">Mon QR Code de prospection</div>
                <div class="card-body text-center">
                    {!! QrCode::size(200)->generate(route('prospection.form', auth()->user()->idmembre)) !!}
                    <p class="mt-2">Scanner ce code avec votre smartphone</p>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('prospect.download') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fadeIn animated bx bx-download"></i> Télécharger le QR Code
                            </a>
                        </div>
                        <div class="col">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#shareLinkModal">
                                <i class="fadeIn animated bx bx-share-alt"></i> Partager le lien
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card border-0 shadow-sm radius-10">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="mb-0 text-uppercase fw-bold">Gestion des Prospections</h5>
                            <p class="text-muted small mb-0">Recherchez et gérez vos contacts facilement</p>
                        </div>
                        <div class="d-flex align-items-center bg-light-primary px-3 py-2 rounded-pill">
                            <i class='bx bxl-dropbox fs-4 text-primary me-2'></i>
                            <div class="text-end">
                                <span class="d-block fw-bold lh-1">{{ count($allPropects) }}</span>
                                <small class="text-secondary">Total</small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-25">

                    <form method="GET" action="{{ route('prospect.index') }}" class="row g-3">
                        <div class="col-md-4 col-lg-2">
                            <label class="form-label small fw-bold">Code</label>
                            <input type="text" name="code" class="form-control" placeholder="Ex: PR-001" value="{{ request('code') }}">
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <label class="form-label small fw-bold">Prénom</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Jean" value="{{ request('first_name') }}">
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <label class="form-label small fw-bold">Nom</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Dupont" value="{{ request('last_name') }}">
                        </div>
                        
                        <div class="col-md-6 col-lg-2">
                            <label class="form-label small fw-bold">Du</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="form-label small fw-bold">Au</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>

                        <div class="col-12 col-lg-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1" title="Rechercher">
                                <i class='bx bx-search-alt-2'></i>
                            </button>
                            
                            <a href="{{ route('prospect.index') }}" class="btn btn-outline-secondary" title="Réinitialiser">
                                <i class="bx bx-refresh"></i>
                            </a>

                            @if(count($allPropects) > 0)
                                <button type="submit" name="print" value="1" class="btn btn-success" title="Imprimer la liste">
                                    <i class="bx bx-printer"></i>
                                </button>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="containe mt-4">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="ms-auto">
                                @can('Demarrer une propection')
                                    <button type="button" class="btn btn-outline-secondary float-end" data-bs-target="#addnewPropect" data-bs-toggle="modal">
                                        <i class="bx bxs-plus-square"></i> Nouvelle prospection
                                    </button>
                                @endcan
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="example2">
                                    <thead>
                                        <tr>
                                            <th><span class="wd-15p">#</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Code</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Nom Complet</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Tel</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Email</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Nature</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Date</span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Prochaine Rélance </span></th>
                                            <th class="wd-lg-15p"><span class="wd-15p">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allPropects as $item)

                                        @php
                                            $today = \Carbon\Carbon::today();
                                            $nextDate = optional($item->nextFollowup)->next_followup_date;

                                            $rowClass = '';
                                            $badgeClass = 'bg-secondary';
                                            $text = 'Aucune relance';

                                            if($nextDate){
                                                $date = \Carbon\Carbon::parse($nextDate);

                                                if($date->isPast()){
                                                    $rowClass = 'table-danger';
                                                    $badgeClass = 'bg-danger';
                                                    $text = 'Relance en retard';
                                                }
                                                elseif($date->diffInDays($today) <= 2){
                                                    $rowClass = 'table-warning';
                                                    $badgeClass = 'bg-warning';
                                                    $text = 'Relance proche';
                                                }
                                                else{
                                                    $badgeClass = 'bg-success';
                                                    $text = 'Planifiée';
                                                }
                                            }
                                        @endphp
                                        <tr class="{{ $rowClass }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->code ?? "" }}</td>
                                            <td>{{ $item->first_name ?? "" }} {{ $item->last_name ?? "" }}</td>
                                            <td>{{ $item->mobile ?? "" }}</td>
                                            <td>{{ $item->email ?? "" }}</td>
                                            <td>
                                                <span class=" shadow-sm w-100">
                                                    @if ($item->natureProspect == "Suspect")
                                                        <span class="badge bg-warning text-white shadow-sm w-100">Suspect</span>
                                                    @elseif ($item->natureProspect == "Prospect")
                                                        <span class="badge bg-info text-white shadow-sm w-100">Prospect</span>
                                                    @elseif ($item->natureProspect == "Déjà client")
                                                        <span class="badge bg-info text-white shadow-sm w-100">Déjà client</span>
                                                    @else
                                                        <span class="badge bg-secondary text-white shadow-sm w-100">Inconnu</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($item->created_at)->locale('fr')->translatedFormat('d M Y') ?? "" }}</td>
                                            <td>
                                                @if($nextDate)
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ \Carbon\Carbon::parse($nextDate)->format('d M Y') }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">{{ $text }}</small>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        Aucune
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <i><a href="{{ route('prospect.show', $item->id) }}" class="btn btn-sm btn-primary"><i class="bx bx-show"></i></a></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('prospects.addNew')
    @include('prospects.shareLinkModal')

</div>
@endsection