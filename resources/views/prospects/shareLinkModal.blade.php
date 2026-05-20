<div class="modal fade" id="shareLinkModal" tabindex="-1" aria-labelledby="shareLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="shareLinkForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="shareLinkModalLabel">Partager le lien de prospection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Saisissez le numéro de téléphone de la personne avec laquelle vous souhaitez partager le lien.</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="urlLink" id="shareLinkInput" value="{{ route('prospection.form', auth()->user()->idmembre) }}" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="tel" class="form-control" name="phone" id="shareLinkTel" value="" placeholder="Numéro de téléphone" required pattern="[0-9]{10}" minlength="10" maxlength="10">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSubmitForm" class="btn btn-secondary">
                        Partager le lien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById('shareLinkForm');
    const submitBtn = document.getElementById('btnSubmitForm');
    const modalElement = document.getElementById('shareLinkModal'); // ID de ton modal bootstrap

    submitBtn.addEventListener('click', function (event) {

        event.preventDefault();

        if (submitBtn.disabled) return;

        const formData = new FormData(form);

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Envoi en cours...';

        fetch('/api/sendSms', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {

            if (data.success) {

                Swal.fire({
                    icon: 'success',
                    title: 'Lien partagé avec succès',
                    text: data.message || "Le SMS a été envoyé avec succès.",
                    confirmButtonText: 'OK'
                });

                // Fermeture du modal Bootstrap
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();

            } else {

                toastr.error(data.message || "Une erreur est survenue lors de l'envoi du SMS.");
            }

        })
        .catch(error => {

            console.error(error);
            toastr.error("Impossible de contacter le serveur.");

        })
        .finally(() => {

            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Partager le lien';

        });

    });

});
</script>