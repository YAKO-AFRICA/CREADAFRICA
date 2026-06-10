@extends('layouts.main')

@section('content')

 <!--breadcrumb-->
 <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page">Productions</li>
                <li class="breadcrumb-item active" aria-current="page">Sélection de produit</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
    </div>
</div>
<!--end breadcrumb-->

    <div class="row mb-2">
        <div class="col-4">
            <input type="text" id="searchProduct" class="form-control" placeholder="Rechercher un produit...">
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3" id="productList">
        @foreach($products as $product)
            @php
                $infoProduit = App\Models\Product::where('codeproduit', $product->codeproduit)->first();
            @endphp

            <div class="col product-item">
                <div class="card">
                    <div class="card-header">
                        @if ($product->codeproduit == 'LPREVO')
                            <h6 class="text-center text-capitalize">  {{ strtoupper('YAKO SOUTRA') }} </h6>
                        @elseif($product->codeproduit == 'YKE_2018')
                            <h6 class="text-center text-capitalize">  {{ strtoupper('CRED’YAKO ETERNITE') }} </h6>
                        @else
                            <h6 class="text-center text-capitalize">  {{ strtoupper($product->libelleproduit ?? 'N/A') }} </h6>
                        @endif
                    </div>
                    <div class="card-body py-1">
                        <p class="card-text">
                            <dl class="row">
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Code Formule</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $product->codeproduitformule ?? 'N/A' }}</dd>
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Age min</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $infoProduit->AgeMiniAdh?? 'N/A' }}</dd>
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Age max</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $infoProduit->AgeMaxiAdh?? 'N/A' }}</dd>
                            </dl>
                        </p>
                    </div>
                    @can('Demarrer une souscription')
                    <div class="card-footer text-center">
                        <a href="{{ route('prod.createYke', $product->codeproduit) }}"
                        class="btn-prime btn-prime-two d-block">Souscrire</a>
                    </div>
                    @else
                    <div class="card-footer text-center">
                        <a href="#" class="btn-prime btn-prime-two d-block text-danger">Vous n'etes pas autorisé</a>
                    </div>
                    @endcan

                </div>
            </div>

            {{-- @include('productions.components.gestionnairePRoposition') --}}
        @endforeach
    </div>

    {{-- <a href="{{ route('bullettin.test') }}" class="btn btn-primary" target="_blank"> bulletin</a> --}}





    <script>
        document.addEventListener('DOMContentLoaded', function() {
            sessionStorage.removeItem('simulationData');
            sessionStorage.removeItem("contacts");
            var searchInput = document.getElementById('searchProduct');
            var productItems = document.querySelectorAll('.product-item');

            searchInput.addEventListener('keyup', function() {
                var filter = searchInput.value.toLowerCase();

                productItems.forEach(function(item) {
                    var productName = item.querySelector('h6').textContent.toLowerCase();

                    if (productName.includes(filter)) {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    </script>

@endsection
