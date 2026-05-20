@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Conversion des prêts COFINA en contrats</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="card-body">

                    <p>
                        <span class="font-weight-bold">Prêts a convertir : </span>
                        {{ $nbrPretAConvert }}
                    </p>

                    <form action="{{ route('epret.convertPretToContrat')}}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary">Migrer les prêts restants <i class="fas fa-exchange-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
