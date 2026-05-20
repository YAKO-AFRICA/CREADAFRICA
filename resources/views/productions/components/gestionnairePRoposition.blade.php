 <!-- Modal -->
    <div class="modal fade" id="gestionnairePRopositionModal{{ $product->codeproduitformule }}" tabindex="-1" aria-labelledby="gestionnairePRopositionModalLabel{{ $product->codeproduitformule }}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title text-white" id="gestionnairePRopositionModalLabel{{ $product->codeproduitformule }}">
                        <i class="bi bi-briefcase-fill me-2"></i>
                        Gestionnaire de proposition - {{ $product->libelleproduit }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Widget 1: Nouvelle Affaire -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="bg-success bg-gradient rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px;">
                                        <i class="bi bi-plus-circle-fill text-white fs-3"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Nouvelle Proposition </h5>
                                    <p class="card-text text-muted">
                                        Créez une nouvelle proposition en saisissant toutes les informations nécessaires.
                                        Cliquez sur Créer pour commencer le traitement.
                                    </p>
                                    @if ($product->codeproduit == 'YKE_2018')
                                        <a href="{{ route('prod.createYke', $product->codeproduit) }}" class="btn-prime btn-prime-two d-block">
                                            <button type="button" class="btn btn-outline-success mt-2">
                                                <i class="bi bi-plus me-1"></i>
                                                Demarrer la souscription
                                            </button>
                                        </a>

                                    @elseif (in_array($product->codeproduit, ['CAD_EDUCPLUS']))
                                        <a href="{{ route('prod.createCAD', $product->codeproduit) }}" class="btn-prime btn-prime-two d-block">
                                            <button type="button" class="btn btn-outline-success mt-2">
                                                <i class="bi bi-plus me-1"></i>
                                                Demarrer la souscription
                                            </button>
                                        </a>
                                    @elseif ($product->codeproduit == 'DOIHOO')
                                        <a href="{{ route('prod.createdoihoo', $product->codeproduit) }}" class="btn-prime btn-prime-two d-block">
                                            <button type="button" class="btn btn-outline-success mt-2">
                                                <i class="bi bi-plus me-1"></i>
                                                Demarrer la souscription
                                            </button>
                                        </a>
                                    @elseif ($product->codeproduit == 'LPREVO')
                                        <a href="{{ route('prod.createLPREVO', $product->codeproduitformule) }}" class="btn-prime btn-prime-two d-block">
                                            <button type="button" class="btn btn-outline-success mt-2">
                                                <i class="bi bi-plus me-1"></i>
                                                Demarrer la souscription
                                            </button>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn-prime btn-prime-two d-block">
                                            <button type="button" class="btn btn-outline-success mt-2">
                                                <i class="bi bi-plus me-1"></i>
                                                Demarrer la souscription
                                            </button>
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- Widget 2: Ancienne Affaire -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="bg-warning bg-gradient rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px;">
                                        <i class="bi bi-archive-fill text-white fs-3"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Saisissez un bulletin physique</h5>
                                    <p class="card-text text-muted">
                                        Saisissez les informartion contenue sur votre bulletin physique .
                                        Clickez sur Demarrer pour commencer le traitement.
                                    </p>
                                    <a href="{{ route('prod.createLibreYke', $product->codeproduit) }}" class="btn-prime btn-prime-two d-block">
                                        <button type="button" class="btn btn-outline-warning mt-2" >
                                            <i class="bi bi-pen me-1"></i>
                                            Saisissez maintenant
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <!-- Widget 3: Télécharger Bulletin -->
                        {{-- <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px;">
                                        <i class="bi bi-download text-white fs-3"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Bulletin Vierge</h5>
                                    <p class="card-text text-muted">
                                        Téléchargez un bulletin vierge au format PDF pour impression.
                                        Formulaire standard prêt à être rempli manuellement.
                                    </p>

                                    <a href="{{ route('prod.dowloadYkeBulletinEtCGU' , $product->CodeProduit) }}" target="_blank" class="btn-prime btn-prime-two d-block">
                                        <button type="button" class="btn btn-outline-primary mt-2">
                                            <i class="bi bi-file-pdf me-1"></i>
                                            Telecharger
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Sélectionnez l'action que vous souhaitez effectuer
                    </small>
                </div>
            </div>
        </div>
    </div>

