

<div class="medical-card" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border: 1px solid #e2e8f0; border-radius: 12px; margin: 20px auto; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); background: #fff; color: #334155;">

    <!-- HEADER -->
    <div style="padding: 20px; border-bottom: 2px solid #f1f5f9; background-color: #f8fafc; border-radius: 12px 12px 0 0;">
        <h2 style="margin: 0; font-size: 1.5rem; color: #0f172a;">Édition du Dossier Médical</h2>
        <p style="margin: 5px 0 0; color: #64748b; font-size: 0.9rem;">
            Code Contrat : <strong>{{ $sante->codeContrat ?? '-' }}</strong>
        </p>
    </div>

    <!-- FORM -->
    <form action="{{ route('prod.sante.update', $sante->id) }}" method="POST" style="padding: 25px;" class="submitForm">
        @csrf

        <!-- CONSTANTES -->
        <fieldset style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
            <legend style="padding: 0 10px; font-weight: 700; color: #076603; text-transform: uppercase; font-size: 0.8rem;">
                Constantes & Habitudes
            </legend>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px;">

                <div>
                    <label>Taille</label>
                    <div class="input-group">
                        <input type="number" 
                            name="taille"
                            value="{{ old('taille', $sante->taille) }}"
                            class="form-control" 
                            min="10" 
                            max="250"
                            step="1">
                        <span class="input-group-text">CM</span>
                    </div>
                </div>

                <div>
                    <label>Poids</label>
                    <div class="input-group">
                        <input type="number" 
                            name="poids"
                            value="{{ old('poids', $sante->poids) }}"
                            class="form-control"
                            min="1"
                            max="500"
                            step="0.1">
                        <span class="input-group-text">KG</span>
                    </div>
                </div>

                <div>
                    <label>Tension (Min / Max)</label>
                    <div style="display:flex; gap:5px;">
                        <input type="text" name="tensionMin"
                            value="{{ old('tensionMin', $sante->tensionMin) }}"
                            placeholder="Min" class="form-control">

                        <input type="text" name="tensionMax"
                            value="{{ old('tensionMax', $sante->tensionMax) }}"
                            placeholder="Max" class="form-control">
                    </div>
                </div>

            </div>

            <div style="margin-top:15px; display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:15px;">

                <div>
                    <label>Tabac</label>
                    <select name="smoking" class="form-control">
                        <option value="">Sélectionner...</option>
                        <option value="Oui" {{ old('smoking', $sante->smoking) == 'Oui' ? 'selected' : '' }}>Oui</option>
                        <option value="Non" {{ old('smoking', $sante->smoking) == 'Non' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>

                <div>
                    <label>Alcool</label>
                    <select name="alcohol" class="form-control">
                        <option value="">Sélectionner...</option>
                        <option value="Oui" {{ old('alcohol', $sante->alcohol) == 'Oui' ? 'selected' : '' }}>Oui</option>
                        <option value="Non" {{ old('alcohol', $sante->alcohol) == 'Non' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>

                <div>
                    <label>Sport</label>
                    <input type="text" name="sport"
                        value="{{ old('sport', $sante->sport) }}"
                        placeholder="Fréquence / Type"
                        class="form-control">
                </div>

            </div>

        </fieldset>

        <!-- PATHOLOGIES -->
        <fieldset style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
            <legend style="padding: 0 10px; font-weight: 700; color: #ef4444; text-transform: uppercase; font-size: 0.8rem;">
                Antécédents & Pathologies
            </legend>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:15px;">

                @php
                    $fields = [
                        'diabetes' => 'Diabète',
                        'hypertension' => 'Hypertension',
                        'sickleCell' => 'Drépanocytose',
                        'kidneyFailure' => 'Insuffisance rénale',
                        'stroke' => 'AVC',
                        'cancer' => 'Cancer'
                    ];
                @endphp

                @foreach($fields as $name => $label)
                <div>
                    <label>{{ $label }}</label>
                    <select name="{{ $name }}" class="form-control">
                        <option value="Non" {{ old($name, $sante->$name) == 'Non' ? 'selected' : '' }}>Non</option>
                        <option value="Oui" {{ old($name, $sante->$name) == 'Oui' ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>
                @endforeach

            </div>

            <div style="margin-top:20px; display:grid; grid-template-columns: 1fr 1fr; gap:20px;">

                <div>
                    <label>Traitements actuels</label>
                    <textarea name="treatment" class="form-control" rows="2">{{ old('treatment', $sante->treatment) }}</textarea>
                </div>

                <div>
                    <label>Dernière chirurgie</label>
                    <input type="text" name="interChirugiale"
                        value="{{ old('interChirugiale', $sante->interChirugiale) }}"
                        class="form-control">
                </div>

            </div>

        </fieldset>

        <!-- SUBMIT -->
        <div style="display:flex; justify-content:flex-end;">
            <button type="submit"
                style="padding: 10px 25px; border: none; background: #076633; color: #fff; font-weight: 600; border-radius: 6px; cursor: pointer;">
                Enregistrer
            </button>
        </div>

    </form>
</div>