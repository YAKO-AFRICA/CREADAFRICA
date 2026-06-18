<style>
    .section-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        border: 1px solid #eee;
        margin-bottom: 20px;
    }

    .section-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 15px;
    }

    .health-card {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 12px;
        background: #fafafa;
        transition: 0.2s;
    }

    .health-card:hover {
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .question-title {
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .radio-group {
        display: flex;
        gap: 8px;
    }

    .radio-group input {
        display: none;
    }

    .radio-btn {
        flex: 1;
        text-align: center;
        padding: 6px;
        border-radius: 8px;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 13px;
        transition: 0.2s;
    }

    .radio-group input:checked + .radio-btn {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .radio-group input[value="Oui"]:checked + .radio-btn {
        background: #dc3545;
        border-color: #dc3545;
    }

    .input-modern {
        border-radius: 10px;
        padding: 10px;
    }
</style>

<fieldset>

    <legend class="mb-3">
        <strong>Questionnaire sur l'état de santé</strong>
    </legend>

    {{-- ================= INFOS PHYSIQUES ================= --}}
    <div class="section-card">
        <div class="section-title">Informations physiques</div>

        <div class="row g-3">
            <div class="col-md-6">
                <label>Taille *</label>
                <div class="input-group">
                    <input type="number" name="taille" class="form-control input-modern"
                           value="{{ old('taille', $sante->taille ?? '') }}" required>
                    <span class="input-group-text">CM</span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Poids *</label>
                <div class="input-group">
                    <input type="number" name="poids" class="form-control input-modern"
                           value="{{ old('poids', $sante->poids ?? '') }}" required>
                    <span class="input-group-text">KG</span>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-6">
                <label>Tension min *</label>
                <input type="text" name="tensionMin" class="form-control input-modern"
                       value="{{ old('tensionMin', $sante->tensionMin ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label>Tension max *</label>
                <input type="text" name="tensionMax" class="form-control input-modern"
                       value="{{ old('tensionMax', $sante->tensionMax ?? '') }}" required>
            </div>
        </div>
    </div>

    {{-- ================= HABITUDES ================= --}}
    <div class="section-card">
        <div class="section-title">Habitudes de vie</div>

        @php
            function checked($name, $value, $sante) {
                return old($name, $sante->$name ?? '') == $value ? 'checked' : '';
            }
        @endphp

        <div class="row g-3">

            {{-- Smoking --}}
            <div class="col-md-4">
                <div class="health-card">
                    <div class="question-title">Fumez-vous ?</div>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="smoking" value="Oui" {{ checked('smoking','Oui',$sante ?? null) }}>
                            <div class="radio-btn">Oui</div>
                        </label>
                        <label>
                            <input type="radio" name="smoking" value="Non" {{ checked('smoking','Non',$sante ?? null) }}>
                            <div class="radio-btn">Non</div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Alcool --}}
            <div class="col-md-4">
                <div class="health-card">
                    <div class="question-title">Alcool</div>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="alcohol" value="Non" {{ checked('alcohol','Non',$sante ?? null) }}>
                            <div class="radio-btn">Jamais</div>
                        </label>
                        <label>
                            <input type="radio" name="alcohol" value="Partiel" {{ checked('alcohol','Partiel',$sante ?? null) }}>
                            <div class="radio-btn">Occasion</div>
                        </label>
                        <label>
                            <input type="radio" name="alcohol" value="Oui" {{ checked('alcohol','Oui',$sante ?? null) }}>
                            <div class="radio-btn">Régulier</div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Sport --}}
            <div class="col-md-4">
                <div class="health-card">
                    <div class="question-title">Faites-vous du sport ?</div>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="sport" value="Oui" {{ checked('sport','Oui',$sante ?? null) }}>
                            <div class="radio-btn">Oui</div>
                        </label>
                        <label>
                            <input type="radio" name="sport" value="Non" {{ checked('sport','Non',$sante ?? null) }}>
                            <div class="radio-btn">Non</div>
                        </label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= ANTÉCÉDENTS ================= --}}
    <div class="section-card">
        <div class="section-title">Antécédents médicaux</div>

        <div class="row g-3">

        @foreach([
            'accident' => "Accident",
            'treatment' => "Traitement",
            'transSang' => "Transfusion",
            'interChirugiale' => "Chirurgie passée",
            'prochaineInterChirugiale' => "Chirurgie prévue",
            'diabetes' => "Diabète",
            'hypertension' => "Hypertension",
            'sickleCell' => "Drépanocytose",
            'liverCirrhosis' => "Cirrhose",
            'lungDisease' => "Maladie pulmonaire",
            'cancer' => "Cancer",
            'anemia' => "Anémie",
            'kidneyFailure' => "Insuffisance rénale",
            'stroke' => "AVC"
        ] as $field => $label)

            <div class="col-6 col-md-4 col-lg-3">
                <div class="health-card">
                    <div class="question-title">{{ $label }}</div>

                    <div class="radio-group">
                        <label>
                            <input type="radio" name="{{ $field }}" value="Oui"
                                {{ checked($field,'Oui',$sante ?? null) }}>
                            <div class="radio-btn">Oui</div>
                        </label>

                        <label>
                            <input type="radio" name="{{ $field }}" value="Non"
                                {{ checked($field,'Non',$sante ?? null) }}>
                            <div class="radio-btn">Non</div>
                        </label>
                    </div>
                </div>
            </div>

        @endforeach

        </div>
    </div>

    <div class="my-3">
        <div class="form-group">
            <label for="autresAntecedents">Autres antécédents médicaux</label>
            <textarea 
            name="autresAntecedents" 
            id="autresAntecedents" 
            class="form-control 
            input-modern" rows="3"></textarea>
        </div>
    </div>

    {{-- Hidden --}}
    <input type="hidden" name="codePret" value="{{ $codePret ?? '' }}">
    <input type="hidden" name="codeContrat" value="{{ $codeContrat ?? '' }}">

</fieldset>
