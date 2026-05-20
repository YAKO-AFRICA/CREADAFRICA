 <!-- Modal -->
    <div class="modal fade" id="dowloadBullModal" tabindex="-1" aria-labelledby="dowloadBullModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title text-white" id="dowloadBullModalLabel">
                        <i class="bi bi-briefcase-fill me-2"></i>
                        Téléchargement de bulletin vierge
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
                                        <i class="bi bi-download text-white fs-3"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Bulletin YKE et CGU</h5>
                                    <p class="card-text text-muted">
                                        Clickez sur télécharger pour obtenir votre bulletin YAKO ETERNITE et CGU.
                                    </p>
                                    <a href="{{ route('prod.dowloadYkeBulletinEtCGU', 'YKE_2018') }}" target="_blank" class="btn-prime btn-prime-two d-block">
                                        <button type="button" class="btn btn-outline-success mt-2">
                                            <i class="bi bi-download me-1"></i>
                                            Télécharger ici
                                        </button>  
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Widget 2: Ancienne Affaire -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="bg-warning bg-gradient rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px;">
                                        <i class="bi bi-download text-white fs-3"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Bulletin DOIHOO et CGU</h5>
                                    <p class="card-text text-muted">
                                        Téléchargez votre bulletin DOIHOO et CGU. 
                                        Clickez sur Demarrer pour commencer le traitement.
                                    </p>
                                    <a href="{{ route('prod.dowloadYkeBulletinEtCGU', 'DOIHOO') }}" target="_blank" class="btn-prime btn-prime-two d-block">
                                        <button type="button" class="btn btn-outline-warning mt-2" >
                                            <i class="bi bi-download me-1"></i>
                                            Télécharger ici
                                        </button>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
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

