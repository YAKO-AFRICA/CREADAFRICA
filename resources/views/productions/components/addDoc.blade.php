<div class="modal fade" id="add-doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="mb-1">Documents de souscription</h5>

                <p class="mb-4">Veuillez chargez vos documents de souscription</p>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <form action="{{ route('prod.store.document') }}" method="POST" enctype="multipart/form-data" class="submitForm">
                    @csrf

                    <input type="hidden" name="contrat" value="{{ $contrat->id }}">

                    <div class="row g-3">

                        <!-- BULLETIN -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Bulletin de souscription (PDF uniquement)</label>
                                    <input type="file" name="bulletin[]" class="form-control" accept="application/pdf" multiple>
                                </div>
                            </div>
                        </div>

                        <!-- CNI -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Pièce justificatif d'identité (CNI)</label>
                                    <input type="file" name="cni[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>

                        <!-- RIB -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">RIB</label>
                                    <input type="file" name="rib[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                        <!-- REFERENCE DE PAIEMENT -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Réference de paiement</label>
                                    <input type="file" name="reference_paiement[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>

                        <!-- SIGNATURE -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Signature</label>
                                    <input type="file" name="signature[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>

                        <!-- PHOTO -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="photo[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>

                        <!-- AUTRES -->
                        <div class="col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Autres pièces</label>
                                    <input type="file" name="autres[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-success px-4">Soumettre</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>

                </form>

            </div>




        </div>

    </div>

</div>
