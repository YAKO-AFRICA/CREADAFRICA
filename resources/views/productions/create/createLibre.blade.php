@extends('layouts.main')

@section('content')

<style>
    fieldset {
    border: 1px solid #ddd; /* Bordure grise */
    padding: 1rem; /* Espacement interne */
    margin-bottom: 1rem; /* Espacement externe */
    border-radius: 5px; /* Coins arrondis */
    }

    legend {
        font-size: 1rem;
        padding: 0 10px; /* Espacement autour du texte de la légende */
        color: #333; /* Couleur du texte */
    }

    .input-group-text select {
        width: 100px; /* Largeur ajustée pour le sélecteur */
    }
    .is-valid {
  border: 2px solid green;
  }

</style>


<div class="productions">
    <div id="stepper1{{ $product->CodeProduit }}" class="bs-stepper">
        <div class="card">
            <div class="card-header">
                <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                    <div class="step" data-target="#test-l-1">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger1" aria-controls="test-l-1"> 
                            <div class="bs-stepper-circle">1</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Adhérent</p>
                            </div> 
                        </div> 
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-2">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">2</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Assuré(e)s</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-3">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                            <div class="bs-stepper-circle">3</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Bénéficiaires</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-4">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                            <div class="bs-stepper-circle">4</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Paiement & Prériodicité</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-5">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger5" aria-controls="test-l-5">
                            <div class="bs-stepper-circle">5</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Etat de santé</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-6">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger6" aria-controls="test-l-6">
                            <div class="bs-stepper-circle">6</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Résumé</p>
                            </div>
                        </div>
                    </div>

                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-7">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger7" aria-controls="test-l-7">
                            <div class="bs-stepper-circle">7</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Documents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    
            <div class="card-body productions">
                <div class="bs-stepper-content card p-3">
                    
                    <form id="productionForm" enctype="multipart/form-data" class="submitFor form">
                        @csrf
                    
                        @include('productions.create.stepsLibre.stepAdherent', ['CodeProduit' => $product->CodeProduit])

                        @include('productions.create.stepsLibre.stepAssurer', ['CodeProduit' => $product->CodeProduit])

                        @include('productions.create.stepsLibre.stepBeneficiaire', ['CodeProduit' => $product->CodeProduit])
                    
                        <input type="hidden" id="assuresInput" name="assures">
                        <input type="hidden" id="beneficiariesInput" name="beneficiaires">
                        <input type="hidden" id="simulationDataInput" name="inputSessionData">

                        <input type="hidden" id="codeproduitvalue" name="codeproduit" value="{{ $product->CodeProduit }}">
                    
                        @include('productions.create.stepsLibre.stepPaiementPrime', ['CodeProduit' => $product->CodeProduit])

                        @include('productions.create.stepsLibre.stepSante', ['CodeProduit' => $product->CodeProduit])
                        @include('productions.create.stepsLibre.stepResume', ['CodeProduit' => $product->CodeProduit])

                    </form>
                    @include('productions.create.stepsLibre.stepDocument', ['CodeProduit' => $product->CodeProduit])
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let garantiesProduct = @json($productGarantie);
</script>




<script>
    // Récupérer les données depuis sessionStorage
    const simulationData = sessionStorage.getItem("simulationData");

    if (simulationData) {
        document.getElementById("simulationDataInput").value = simulationData;
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("productionForm");
        const btn = document.getElementById("btn-next");

        btn.addEventListener("click", function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            axios.post('{{ route("prod.storeLibre") }}', formData)
            .then(function (response) {
                if (response.data.type === "success") {


                    if (response.data.urlback) {
                        window.location.href = response.data.urlback;
                    }

                    sessionStorage.removeItem("simulationData");
                    sessionStorage.removeItem("simulationData");
                } else {
                    throw new Error(response.data.message || "Erreur lors de l'enregistrement.");
                }
            })
            .catch(function (error) {
                console.error(error);
                alert(error.response?.data?.message || "Une erreur est survenue.");
            });
        });
    });


</script>


    @include('productions.assurer.addModal', ['CodeProduit' => $product->CodeProduit])
    @include('productions.beneficiaires.add')

@endsection
