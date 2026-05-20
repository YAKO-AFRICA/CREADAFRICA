<div>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h5 class="mb-1">Documents de souscription</h5>

    <p class="mb-4">Veuillez chargez vos documents de souscription</p>

    <form action="{{ route('epret.addDocDefaud') }}" method="post" class="submitForm" enctype="multipart/form-data">
        @csrf

        @php
            $docTypes = [
                'bulletin'  => 'Bulletin de souscription',
                'cni'       => 'Pièce justificatif d\'identité (CNI)',
                'rib'       => 'RIB',
                'signature' => 'Signature',
                'photo'     => 'Photo',
                'autres'    => 'Autres pièces',
            ];
        @endphp

        <div class="row g-3">
            @foreach ($docTypes as $key => $label)
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">{{ $label }}</label>
                                <div class="input-group">
                                    <input
                                        type="file"
                                        name="files[{{ $key }}][]"
                                        class="form-control"
                                        accept=".xlsx,.xls,image/*,.doc,.docx,audio/*,video/*,.ppt,.pptx,.txt,.pdf"
                                        multiple
                                        onchange="previewFiles(event, 'preview_{{ $key }}')"
                                    >
                                </div>
                                <div id="preview_{{ $key }}" class="mt-3 preview-area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-12">
                <div class="gap-3 text-end">
                    <button type="submit" class="btn btn-success px-4">Sauvegarder</button>
                </div>
            </div>
        </div>
    </form>

</div>

