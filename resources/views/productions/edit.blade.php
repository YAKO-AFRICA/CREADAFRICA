@extends('layouts.main')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eSouscription</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;">
                    <i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Modifier une proposition</li>
            </ol>
        </nav>
    </div>
</div>

<div class="ms-auto">
    <div class="d-flex justify-content-end my-4">
        <div class="btn-group gap-1 gap-md-2 gap-lg-3">
            @if ($contrat->etape != 2)
            <form action="{{ route('prod.transmettreContrat', $contrat->id)}}" method="post" class="submitForm">
                @csrf
                <button type="submit" class="btn btn-primary p-1 px-3 border-0 text-center"> Transmettre</button>
            </form>
            @endif
            <button class="btn btn-primary mx-4 border-0 text-center" style="font-size: 12px">
                <a class="text-decoration-none" href="{{ route('prod.generate.bulletin', $contrat->id) }}" target="_blank">
                    <i class="bx bx-download" title="Telecharger le bulletin"></i> Imprimer le Bulletin
                </a>
            </button>
            {{-- <input type=button onclick='calltouchpay("{{ $contrat->numBullettin }}")' class="btn btn-primary btn-sm text-decoration-none px-2 px-md-3" value="Payer les frais d'adhesion" /> --}}
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="col-12 col-lg-3">
        <div class="card">
            <center>
                <div class="card-header">
                    <p>
                        <strong>N° de contrat :</strong> <span>{{ $contrat->id ?? ''}}</span>
                    </p>
                    <p>
                        <strong>N° bullettin :</strong> <span>{{ $contrat->numBullettin ?? '' }}</span>
                    </p>
                    <p>
                        <center>Status :
                            @if ($contrat->etape == 0)
                                <span class="text-secondary badge rounded-pill  bg-light-secondary">Brouillon</span>
                            @elseif ($contrat->etape == 1)
                                <span class="text-info badge rounded-pill  bg-light-info">Saisie Non Transmis</span>
                            @elseif ($contrat->etape == 2)
                                <span class="text-primary badge rounded-pill  bg-light-primary">Saisie Transmis</span>
                            @elseif ($contrat->etape == 3)
                                <span class="text-success badge rounded-pill text-success bg-light-success">Accepté et Migré</span>
                            @elseif ($contrat->etape == 4)
                                <span class="text-danger badge rounded-pill bg-light-danger">Rejeté</span>
                            @endif
                        </center>
                    </p>
                </div>
            </center>

            <div class="card-body">

                <h5 class="my-3 text-center text-uppercase">Modifier les acteurs</h5>

                <div class="fm-menu">

                    <div class="list-group list-group-flush">

                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="info-contrat">

                            <i class='bx bx-folder me-2'></i><span>Detail du contrat</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-adherent">

                            <i class='bx bx-devices me-2'></i><span>Adherent</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-assurer">

                            <i class='bx bx-analyse me-2'></i><span>Assurés</span>

                        </a>
                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-sante">

                            <i class='bx bx-analyse me-2'></i><span>Etat de santé</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-1 btn" data-target="edit-beneficiaire">

                            <i class='bx bx-plug me-2'></i><span>Beneficiaire</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-0 font-weight-bold">Documents joint <span data-bs-toggle="modal"
                    data-bs-target="#add-doc"
                        class="float-end text-secondary"> <i class="bx bx-add-to-queue"></i> </span></h5>
                </p>
                <div class="mt-3"></div>

                @if (count($contrat->documents) > 0)
                    @foreach ($contrat->documents as $doc)
                    <div class="d-flex align-items-center mt-3">
                        <div class="fm-file-box bg-light-success text-success"><i
                                class='bx bxs-file-doc'></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0" style="font-size: 10px">{{ $doc->libelle ?? ''}}</h6>
                            <p class="mb-0 text-secondary">
                                {{ $doc->saisiele ?? ''}}
                            </p>
                        </div>
                        <h6 class="text-primary mb-0">
                            <a class="btn btn-sm btn-outline-secondary" data-bs-target="#view-bulletin{{$doc->id}}" data-bs-toggle="modal" title="Preview">
                                <i class="bx bx-show"></i>
                            </a>
                            {{-- <a class="btn btn-sm btn-outline-secondary" href=""> <i class="bx bx-trash"></i></a> --}}
                        </h6>
                        <div class="modal fade" id="view-bulletin{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Aperçu {{$doc->libelle ?? ''}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="x">x</button>
                                    </div>
                                    <div class="modal-body" style="width: 100%; height: 80vh">
                                        <iframe style="width: 100%; height: 100%" src="{{ url('storage/documents/' . $doc->filename) }}" frameborder="0"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('prod.destroy.document', $doc->id)}}" method="post" class="submitForm">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">
                                               Supprimer
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <section id="info-contrat" class="section-content">
                    <h5>Modifier les Détails du Contrat</h5>
                    @include('productions.components.editContrat')
                </section>
                <section id="edit-adherent" class="section-content d-none">
                    <h5>Adhérent</h5>
                    @include('productions.components.editAdherent')
                </section>
                <section id="edit-assurer" class="section-content d-none">
                    <h5>Assurés</h5>
                    @include('productions.assurer.editAssure' , ['codecontrat' => $contrat->id])
                </section>
                <section id="edit-sante" class="section-content d-none">
                    <h5>Etat de Santé</h5>
                    @include('productions.sante.editSante' , ['codecontrat' => $contrat->id])
                </section>
                <section id="edit-beneficiaire" class="section-content d-none">
                    <h5>Bénéficiaire</h5>
                    @include('productions.beneficiaires.info' , ['codecontrat' => $contrat->id])
                </section>
            </div>
        </div>
    </div>

    @include('productions.components.addDoc')



    <script>

        document.addEventListener('DOMContentLoaded', () => {

            const links = document.querySelectorAll('.list-group-item');

            const sections = document.querySelectorAll('.section-content');



            links.forEach(link => {

                link.addEventListener('click', () => {

                    const targetId = link.getAttribute('data-target');



                    // Masquer toutes les sections

                    sections.forEach(section => section.classList.add('d-none'));



                    // Afficher la section correspondante

                    const targetSection = document.getElementById(targetId);

                    if (targetSection) {

                        targetSection.classList.remove('d-none');

                    }

                });

            });

        });

    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const contratInfo = {!! json_encode($contrat) !!};

            console.log(contratInfo.adherent);

            const modeBancaire = document.getElementById('mode_bancaire');
            const modeMobile = document.getElementById('mode_mobile');
            const modeSource = document.getElementById('mode_source');
            const modeSociete = document.getElementById('mode_societe');

            if (modeBancaire) modeBancaire.style.display = 'none';
            if (modeMobile) modeMobile.style.display = 'none';
            if (modeSource) modeSource.style.display = 'none';
            if (modeSociete) modeSociete.style.display = 'none';

            document.querySelectorAll('input[name="modepaiement"]').forEach(radio => {

                radio.addEventListener('change', function () {

                    document.getElementById('mode_bancaire').style.display = 'none';
                    document.getElementById('mode_mobile').style.display = 'none';
                    document.getElementById('mode_source').style.display = 'none';
                    document.getElementById('mode_societe').style.display = 'none';

                    if (this.value === 'VIR' || this.value === 'BANK' || this.value === 'CHK') {
                        document.getElementById('mode_bancaire').style.display = 'block';
                    }

                    if (this.value === 'EBANK' || this.value === 'Mobile_money') {
                        document.getElementById('mode_mobile').style.display = 'block';
                    }

                    if (this.value === 'SOURCE') {
                        document.getElementById('mode_source').style.display = 'block';
                    }

                    if (this.value === 'SOCIETE' || this.value === 'DEF') {
                        document.getElementById('mode_defense').style.display = 'block';
                    }

                });

            });

        })
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const apiUrl = 'https://api.yakoafricassur.com/enov/villes';
    const apiProfessions = 'https://api.yakoafricassur.com/enov/professions';

    // Récupérer les valeurs stockées depuis les attributs data
    const lieuNaissanceCode = "{{ $contrat->adherent->lieunaissance ?? '' }}";
    const lieuResidenceCode = "{{ $contrat->adherent->lieuresidence ?? '' }}";
    const professionCode = "{{ $contrat->adherent->profession ?? '' }}";

    /**
     * Classe pour gérer le chargement des villes
     */
    class VilleManager {
        constructor(apiUrl, selectedValue = null) {
            this.apiUrl = apiUrl;
            this.selectedValue = selectedValue;
            this.villes = [];
        }

        async loadVilles() {
            try {
                const response = await fetch(this.apiUrl);
                const data = await response.json();
                this.villes = data;
                return this.villes;
            } catch (error) {
                console.error('Erreur lors du chargement des villes:', error);
                return [];
            }
        }

        populateSelect(selectElement, placeholder = true) {
            if (!selectElement) return;

            // Vider le select
            selectElement.innerHTML = '';

            // Ajouter un placeholder option si demandé
            if (placeholder) {
                const placeholderOption = document.createElement('option');
                placeholderOption.value = '';
                placeholderOption.textContent = 'Sélectionnez une ville';
                placeholderOption.disabled = true;
                placeholderOption.selected = !this.selectedValue;
                selectElement.appendChild(placeholderOption);
            }

            // Ajouter les options des villes
            this.villes.forEach(ville => {
                const option = document.createElement('option');
                option.value = ville.MonLibelle;
                option.textContent = ville.MonLibelle;

                // Sélectionner la valeur si elle correspond
                if (this.selectedValue && ville.MonLibelle === this.selectedValue) {
                    option.selected = true;
                }

                selectElement.appendChild(option);
            });

            // Si la valeur sélectionnée n'est pas trouvée dans la liste, l'ajouter
            if (this.selectedValue && !this.villes.some(ville => ville.MonLibelle === this.selectedValue)) {
                const customOption = document.createElement('option');
                customOption.value = this.selectedValue;
                customOption.textContent = this.selectedValue;
                customOption.selected = true;
                selectElement.appendChild(customOption);
            }
        }

        // Méthode statique pour initialiser tous les selects avec la classe 'ville'
        static async initializeAll(apiUrl, selectedValues = {}) {
            const villeManager = new VilleManager(apiUrl);
            await villeManager.loadVilles();

            const villeSelects = document.querySelectorAll('.ville');

            villeSelects.forEach(select => {
                const selectedValue = select.dataset.value || selectedValues[select.id] || '';
                const manager = new VilleManager(apiUrl, selectedValue);
                manager.populateSelect(select);
            });
        }
    }

    /**
     * Classe pour gérer le chargement des professions
     */
    class ProfessionManager {
        constructor(apiUrl, selectedValue = null) {
            this.apiUrl = apiUrl;
            this.selectedValue = selectedValue;
            this.professions = [];
        }

        async loadProfessions() {
            try {
                const response = await fetch(this.apiUrl);
                const data = await response.json();
                this.professions = data;
                return this.professions;
            } catch (error) {
                console.error('Erreur lors du chargement des professions:', error);
                return [];
            }
        }

        populateSelect(selectElement, placeholder = true) {
            if (!selectElement) return;

            // Vider le select
            selectElement.innerHTML = '';

            // Ajouter un placeholder option si demandé
            if (placeholder) {
                const placeholderOption = document.createElement('option');
                placeholderOption.value = '';
                placeholderOption.textContent = 'Sélectionnez une profession';
                placeholderOption.disabled = true;
                placeholderOption.selected = !this.selectedValue;
                selectElement.appendChild(placeholderOption);
            }

            // Ajouter les options des professions
            this.professions.forEach(profession => {
                const option = document.createElement('option');
                option.value = profession.CodeProfession;
                option.textContent = profession.MonLibelle;

                // Sélectionner la valeur si elle correspond
                if (this.selectedValue && profession.CodeProfession === this.selectedValue) {
                    option.selected = true;
                }

                selectElement.appendChild(option);
            });

            // Si la valeur sélectionnée n'est pas trouvée dans la liste, l'ajouter
            if (this.selectedValue && !this.professions.some(prof => prof.CodeProfession === this.selectedValue)) {
                const customOption = document.createElement('option');
                customOption.value = this.selectedValue;
                customOption.textContent = this.selectedValue;
                customOption.selected = true;
                selectElement.appendChild(customOption);
            }
        }

        // Méthode statique pour initialiser tous les selects avec la classe 'profession'
        static async initializeAll(apiUrl, selectedValues = {}) {
            const professionManager = new ProfessionManager(apiUrl);
            await professionManager.loadProfessions();

            const professionSelects = document.querySelectorAll('.profession');

            professionSelects.forEach(select => {
                const selectedValue = select.dataset.value || selectedValues[select.id] || '';
                const manager = new ProfessionManager(apiUrl, selectedValue);
                manager.populateSelect(select);
            });
        }
    }

    /**
     * Version simplifiée avec fonction universelle
     */
    class UniversalSelectLoader {
        constructor(apiUrl, mapping = { value: 'value', text: 'text' }) {
            this.apiUrl = apiUrl;
            this.mapping = mapping;
            this.data = [];
        }

        async loadData() {
            try {
                const response = await fetch(this.apiUrl);
                this.data = await response.json();
                return this.data;
            } catch (error) {
                console.error('Erreur lors du chargement des données:', error);
                return [];
            }
        }

        populateSelect(selectElement, selectedValue = null, placeholder = true) {
            if (!selectElement) return;

            selectElement.innerHTML = '';

            if (placeholder) {
                const placeholderOption = document.createElement('option');
                placeholderOption.value = '';
                placeholderOption.textContent = selectElement.getAttribute('data-placeholder') || 'Sélectionnez une option';
                placeholderOption.disabled = true;
                placeholderOption.selected = !selectedValue;
                selectElement.appendChild(placeholderOption);
            }

            this.data.forEach(item => {
                const option = document.createElement('option');
                const value = this.mapping.value ? item[this.mapping.value] : item;
                const text = this.mapping.text ? item[this.mapping.text] : item;

                option.value = value;
                option.textContent = text;

                if (selectedValue && value === selectedValue) {
                    option.selected = true;
                }

                selectElement.appendChild(option);
            });

            // Ajouter la valeur personnalisée si non trouvée
            if (selectedValue && !this.data.some(item => {
                const itemValue = this.mapping.value ? item[this.mapping.value] : item;
                return itemValue === selectedValue;
            })) {
                const customOption = document.createElement('option');
                customOption.value = selectedValue;
                customOption.textContent = selectedValue;
                customOption.selected = true;
                selectElement.appendChild(customOption);
            }
        }

        // Initialiser tous les selects avec une classe spécifique
        static async initializeSelects(className, apiUrl, mapping, selectedValues = {}) {
            const loader = new UniversalSelectLoader(apiUrl, mapping);
            await loader.loadData();

            const selects = document.querySelectorAll(`.${className}`);

            selects.forEach(select => {
                const selectedValue = select.dataset.value || selectedValues[select.id] || '';
                loader.populateSelect(select, selectedValue);
            });
        }
    }

    // Utilisation avec la classe UniversalSelectLoader (recommandée)
    const selectedValues = {
        'lieunaissance': lieuNaissanceCode,
        'lieuresidence': lieuResidenceCode,
        'profession': professionCode
    };

    // Initialisation des villes
    UniversalSelectLoader.initializeSelects('ville', apiUrl, { value: 'MonLibelle', text: 'MonLibelle' }, selectedValues);

    // Initialisation des professions
    UniversalSelectLoader.initializeSelects('profession', apiProfessions, { value: 'CodeProfession', text: 'MonLibelle' }, selectedValues);

    // Alternative avec les classes spécifiques si vous préférez
    // VilleManager.initializeAll(apiUrl, selectedValues);
    // ProfessionManager.initializeAll(apiProfessions, selectedValues);
});
</script>



</div>

<!--end row-->



@endsection
