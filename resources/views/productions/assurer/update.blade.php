<div class="modal fade" id="editAssureModal{{ $assure->id }}" tabindex="-1" aria-hidden="true">

    @php
        $datenaissance = date('Y-m-d', strtotime($assure->datenaissance));
    @endphp
    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Modifier un Assuré</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="card">

                    <div class="card-header">

                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('prod.assures.update', $assure->id) }}"  class="submitForm">

                            @csrf

                            <fieldset class="border p-3">

                                <legend class="float-none w-auto px-2"><small>Information personnelle</small></legend>

                                <div class="col-12 col-lg-6">

                                    <label for="civiliteAssur" class="form-label">Civilité <span class="star">*</span></label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="civiliteAssur" id="inlineRadio1" value="Madame" autocomplete="off" 
                                            {{ $assure->civilite == 'Madame' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="inlineRadio1">Madame</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="civiliteAssur" id="inlineRadio2" value="Mademoiselle" autocomplete="off"
                                            {{ $assure->civilite == 'Mademoiselle' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="civiliteAssur" id="inlineRadio3" value="Monsieur" autocomplete="off"
                                            {{ $assure->civilite == 'Monsieur' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio3">Monsieur</label>
                                    </div>
                                    

                                    @error('civiliteAssur')

                                        <span class="text-danger"> Veuillez remplir le champ nom</span>

                                    @enderror

                                </div>

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6">

                                        <label for="nomAssur" class="form-label">Nom de l'assuré <span class="star">*</span></label>

                                        <input type="text" name="nomAssur" class="form-control" id="nomAssur" value="{{ $assure->nom ?? ''}}"

                                            placeholder="Nom" autocomplete="off" required>

                                        @error('nomAssur')

                                            <span class="text-danger"> Veuillez remplir le champ nom</span>

                                        @enderror

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        <label for="prenomAssur" class="form-label">Prénoms de l'assuré <span class="star">*</span></label>

                                        <input type="text" name="prenomAssur" class="form-control" id="prenomAssur" value="{{ $assure->prenom ?? ''}}"

                                            placeholder="Prénoms" required>

                                        @error('prenomAssur')

                                            <span class="text-danger"> Veuillez remplir le champ prenom </span>

                                        @enderror

                                    </div>

                                </div><!---end row-->

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6">

                                        <label for="datenaissanceAssur" class="form-label">Date de naissance <span class="star">*</span></label>

                                        
                                        <input type="date" name="datenaissanceAssur" class="form-control" id="datenaissanceAssur" value="{{ $datenaissance ?? ''}}"

                                            placeholder="Date de naissance" required>

                                        

                                        @error('datenaissanceAssur')

                                            <span class="text-danger"> Veuillez remplir la date de naissance </span>

                                        @enderror

                                    </div>

                                    <div class="col-12 col-lg-6"> 

                                        <label for="lieunaissanceAssur" class="form-label">Lieu de naissance</label>

                                        <select class="form-select" name="lieunaissanceAssur" id="lieunaissanceAssur" data-placeholder="Sélectionner le lieu">

                                            <option value="{{ $assure->lieunaissance ?? ''}}">{{ $assure->lieunaissance ?? ''}}</option> <!-- Option vide pour le placeholder -->

                                            

                                            @foreach($villes as $ville)

                                                <option value="{{ $ville['MonLibelle'] }}">{{ $ville['MonLibelle'] }}</option> 

                                            @endforeach 

                                        </select>

                                    </div>

                                </div><!---end row-->

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-lg-6">
                                        <label for="" class="form-label">Nature de la pièce</label>
                                        <br> 
                                    
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="naturepieceAssur" id="CNIAssur" value="CNI"
                                                {{ $assure->naturepiece == 'CNI' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="CNIAssur">CNI</label>
                                        </div>
                                    
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="naturepieceAssur" id="AtestationAssur" value="AT"
                                                {{ $assure->naturepiece == 'AT' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="AtestationAssur">Attestation</label>
                                        </div>
                                    
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="naturepieceAssur" id="PassportAssur" value="Passport"
                                                {{ $assure->naturepiece == 'Passport' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="PassportAssur">Passport</label>
                                        </div> 
                                    </div>
                                    

                                    <div class="col-12 col-lg-6"> 

                                        <label for="numeropieceAssur" class="form-label">numéro de la pièce</label>

                                        <input type="text" name="numeropieceAssur" class="form-control" id="numeropieceAssur" value="{{ $assure->numeropiece ?? ''}}"

                                            placeholder="numero de la pièce d'identité">

                                    </div> 

                                </div><!---end row-->

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6"> 

                                        <label for="lieuresidenceAssur" class="form-label">Lieu de residence</label>

                                        <select class="form-select" name="lieuresidenceAssur" id="lieuresidenceAssur" data-placeholder="Sélectionner le lieu">

                                            <option value="{{ $assure->lieuresidence ?? ''}}">{{ $assure->lieuresidence ?? ''}}</option> <!-- Option vide pour le placeholder -->Sélectionner le lieu</option> <!-- Option vide pour le placeholder -->

                                            

                                            @foreach($villes as $ville)

                                                <option value="{{ $ville['MonLibelle'] }}">{{ $ville['MonLibelle'] }}</option> 

                                            @endforeach 

                                        </select>

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        <label for="lienParente" class="form-label">Lien de Parenté</label>

                                        <select class="form-select" name="lienParente" id="lienParente"

                                            aria-label="Default select example">

                                            <option value="{{ $assure->lienParente ?? ''}}">{{ $assure->lienParente ?? ''}}</option>

                                            @foreach ($filliations as $item)
                                                <option value="{{ $item->CodeFiliation }}">{{ $item->MonLibelle ?? ''}}</option>
                                            @endforeach

                                        </select>
                                    </div> 

                                </div>

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6">

                                        <label class="form-label">Telephone</label><br>
                                        <div class="input-group mb-3">
                                            <input type="text" name="mobileAssur" class="form-control" id="mobileAssur" value="{{ $assure->mobile ?? ''}}">
                                        </div>

                                        

                                        @error('mobileAssur') 

                                            <span class="text-danger"> Veuillez remplir votre numéro de mobile </span> 

                                        @enderror 

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        <label for="emailAssur" class="form-label">Email</label>

                                        <input type="email" name="emailAssur" class="form-control" id="emailAssur" value="{{ $assure->email ?? ''}}"

                                            placeholder="Email">

                                            

                                        @error('email')

                                        

                                            <span class="text-danger"> Veuillez remplir votre email </span>

                                        

                                        @enderror

                                    </div> 

                                </div>
                            </fieldset>
                            
                            <div class="col-12">

                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div class=""> 
                                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Retour</button>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-success px-4">Modifier</button>
                                    </div>
                                </div>

                                
                            </div> 

                        </form> 

                    </div>

                </div>

            </div> 

        </div>

    </div>

</div>