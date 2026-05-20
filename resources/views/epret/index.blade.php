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
                    <li class="breadcrumb-item active" aria-current="page">Epret</li>
                    <li class="breadcrumb-item active" aria-current="page">Demande de prets</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                </div>
                <div class="ms-auto">
                    <a href="{{ route('epret.simulateur')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0" >
                        <i class="bx bxs-plus-square"></i>Nouvelle demande
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Adherent</th>
                            <th>N° Compte</th>
                            <th>Prime</th>
                            <th>Montant du pret</th>
                            <th>Durée</th>
                            <th>Etat</th>
                            <th>Date de saisie</th>
                            <th>Saisie par</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prets as $item)
                        <tr>
                            <td>
                               {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->id ?? ""}}</td>
                            <td>{{ $item->adherent->nom ?? ""}} {{ $item->adherent->prenom ?? ""}}</td>
                            <td>{{ $item->numerocompte ?? ""}}</td>
                            <td>{{ number_format($item->prime, 2, ',', '.') ?? 0}} F CFA</td>
                            <td>{{ number_format($item->capital, 2, ',', '.') ?? ""}}</td>
                            <td>{{ $item->duree ?? ""}}</td>
                            <td>
                                @if ($item->etape == 1)
                                    <span class="badge rounded-pill bg-info">En Saisie</span>
                                @elseif ($item->etape == 2)
                                    <span class="badge rounded-pill bg-warning">Transmis</span>
                                @elseif ($item->etape == 3)
                                    <span class="badge rounded-pill bg-success">Accepter</span>
                                @elseif ($item->etape == 4)
                                    <span class="badge rounded-pill bg-danger">Rejeté</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary">Inconnue</span>
                                @endif

                            </td>
                             <td>{{ Carbon\Carbon::parse($item->saisiele)->format('d-m-Y') ?? ""}}</td>
                             <td>{{ $item->user->membre->nom ?? ""}} {{ $item->user->membre->prenom ?? ""}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('prod.show', $item->id) }}" class="">
                                        <i class='bx bxs-show'></i>
                                    </a>

                                    @if (in_array($item->etape, [2, 3]))

                                        <a href="javascript:;" class="ms-3 text-muted" title="Vous ne pouvez pas modifier un pret transmis ou migrer">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                        <a class="ms-3 text-muted" data-uuid="{{$item->id}}" title="Vous ne pouvez pas supprimer un pret transmis ou migrer">
                                            <i class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>

                                    @else
                                        {{-- @can('Modifier le pret') --}}
                                            <a href="{{ route('prod.edit', $item->id)}}" class="ms-3"><i class='bx bxs-edit'></i></a>
                                        {{-- @endcan --}}

                                        {{-- @can('Supprimer le pret') --}}
                                        <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                            data-type="confirmation_redirect" data-placement="top"
                                            data-token="{{ csrf_token() }}"
                                            data-url="{{route('prod.destroy',$item->id)}}"
                                            data-title="Vous êtes sur le point de supprimer le pret  {{$item->id}}"
                                            data-id="{{$item->id}}" data-param="0"
                                            data-route="{{route('prod.destroy',$item->id)}}">
                                            <i class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                        {{-- @endcan --}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
