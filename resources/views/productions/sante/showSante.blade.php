<div class="medical-card" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border: 1px solid #e2e8f0; border-radius: 12px; margin: 20px auto; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); background: #fff; color: #334155;">

    <!-- HEADER -->
    <div style="padding: 20px; border-bottom: 2px solid #f1f5f9; background-color: #f8fafc; border-radius: 12px 12px 0 0;">
        <h2 style="margin: 0; font-size: 1.5rem; color: #0f172a;">Dossier Médical</h2>
        <p style="margin: 5px 0 0; color: #64748b; font-size: 0.9rem;">
            Code Contrat : <strong>{{ $sante->codeContrat ?? '-' }}</strong>
        </p>
    </div>

    <div style="padding: 25px;">

        <!-- CONSTANTES -->
        <fieldset style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
            <legend style="padding: 0 10px; font-weight: 700; color: #076603; text-transform: uppercase; font-size: 0.8rem;">
                Constantes & Habitudes
            </legend>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:15px;">
                <div>
                    <strong>Taille :</strong><br>
                    {{ $sante->taille ?? '-' }} CM
                </div>
                <div>
                    <strong>Poids :</strong><br>
                    {{ $sante->poids ?? '-' }} KG
                </div>
                <div>
                    <strong>Tension :</strong><br>
                    {{ $sante->tensionMin ?? '-' }} / {{ $sante->tensionMax ?? '-' }}
                </div>

                <div>
                    <strong>Tabac :</strong><br>
                    <span class="badge ">
                        {{ $sante->smoking ?? 'Non renseigné' }}
                    </span>
                </div>

                <div>
                    <strong>Alcool :</strong><br>
                    <span class="badge ">
                        {{ $sante->alcohol ?? 'Non renseigné' }}
                    </span>
                </div>

                <div>
                    <strong>Sport :</strong><br>
                    {{ $sante->sport ?? '-' }}
                </div>

            </div>

        </fieldset>

        <!-- PATHOLOGIES -->
        <fieldset style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
            <legend style="padding: 0 10px; font-weight: 700; color: #ef4444; text-transform: uppercase; font-size: 0.8rem;">
                Antécédents & Pathologies
            </legend>

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

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:15px;">

                @foreach($fields as $name => $label)
                <div style="padding:10px; border-radius:6px; background: #f8fafc;">
                    <strong>{{ $label }}</strong><br>
                    <span class="badge bg-{{ $sante->$name == 'Oui' ? 'danger' : 'success' }}">
                        {{ $sante->$name }}
                    </span>
                </div>
                @endforeach

            </div>

            <div style="margin-top:20px; display:grid; grid-template-columns: 1fr 1fr; gap:20px;">

                <div>
                    <strong>Traitements actuels :</strong><br>
                    <div style="padding:10px; background:#f8fafc; border-radius:6px;">
                        {{ $sante->treatment ?? '-' }}
                    </div>
                </div>

                <div>
                    <strong>Dernière chirurgie :</strong><br>
                    <div style="padding:10px; background:#f8fafc; border-radius:6px;">
                        {{ $sante->interChirugiale ?? '-' }}
                    </div>
                </div>

            </div>

        </fieldset>

    </div>
</div>