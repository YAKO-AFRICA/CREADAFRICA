<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .header {
            background: #0b5e10;
            color: #ffff00;
            text-align: center;
            font-weight: bold;
            font-size: 22px;
            padding: 6px;
        }

        .numero {
            text-align: right;
            margin-top: 5px;
            font-size: 12px;
        }

        .section-title {
            background: #0b5e10;
            color: #fff;
            font-weight: bold;
            padding: 4px;
            width: 40%;
        }

        .line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 300px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .box {
            border: 1px solid #2e7d32;
            padding: 8px;
        }

        .coverage-table {
            width: 100%;
            border-collapse: collapse;
        }

        .coverage-table td {
            border: 1px solid #999;
            padding: 4px;
        }

        .small-note {
            color: red;
            font-size: 10px;
        }

        .exclusion {
            color: red;
            font-size: 10px;
        }

        .signature {
            margin-top: 20px;
        }

        .radio1 {
            font-size: 13px;
        }

        .border_1 {
            border: 1px solid #000;
        }

    </style>

</head>

<body>

    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <td style="width:20%; text-align:left;">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="height: 50px">
            </td>

            <td style="width:60%; text-align:center; background:#0b5e10; color:#ffff00; font-weight:bold; font-size:22px; padding:6px;">
                Formulaire de Souscription
            </td>

            <td style="width:20%; text-align:right;">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('logos/ASSURFIN.png'))) }}" alt="Logo" style="height:50px;">
            </td>
        </tr>
    </table>

    <table style="width:100%; margin-top:10px; font-size:12px;">
        <tr>

        <td style="width:33%; text-align:left;">
            Produit : <b>SOUTRA</b>
        </td>

        <td style="width:33%; text-align:center;">
            N° Bulletin : {{ $contrat->numBullettin ?? 'N/A' }} 
        </td>

        <td style="width:33%; text-align:right;">
            Code Agence : <b>{{ $contrat->agence ?? 'N/A' }}</b>
        </td>

        </tr>
    </table>

    <br>
    <div style="margin-top:5px; border:1px solid #2e7d32; padding:5px;">

        <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px; width:45%;">
            1. Informations du Souscripteur / Assuré
        </div>

        <br>

        <table style="width:100%; border-collapse:collapse; font-size:12px;">

            <tr>
                <td style="width:50%; padding-bottom:6px;">
                    <b>Nom et Prénom :</b>
                    {{ $contrat->adherent->nom ?? '....'}} {{ $contrat->adherent->prenom ?? '....' }}
                </td>

                <td style="width:50%; padding-bottom:6px;">
                    <b>Date de naissance :</b>
                    {{ Carbon\Carbon::parse($contrat->adherent->datenaissance)->format('d/m/Y') ?? '....' }}
                </td>
            </tr>

            <tr>
                <td style="padding-bottom:6px;">
                    <b>Lieu de naissance :</b>
                    {{ $contrat->adherent->lieunaissance ?? '....' }}
                </td>

                <td style="padding-bottom:6px;">
                    <b>Nationalité :</b>
                    {{ $contrat->adherent->pays ?? '....' }}
                </td>
            </tr>

            <tr>
                <td style="padding-bottom:6px;">
                    <b>Genre :</b>
                    {{ $contrat->adherent->civilite ?? '....' }}
                </td>

                <td style="padding-bottom:6px;">
                    <b>Adresse complète :</b>
                    {{ $contrat->adherent->lieuresidence ?? '....' }}
                </td>
            </tr>

            <tr>
                <td style="padding-bottom:6px;">
                    <b>Téléphone 1 :</b>
                    {{ $contrat->adherent->telephone ?? '....' }}
                </td>

                <td style="padding-bottom:6px;">
                    <b>Téléphone 2 :</b>
                    {{ $contrat->adherent->mobile ?? '....' }}
                </td>
            </tr>

            <tr>
                <td style="padding-bottom:6px;">
                    <b>WhatsApp :</b>
                    {{ $contrat->adherent->whatsapp ?? '....' }}
                </td>

                <td style="padding-bottom:6px;">
                    <b>E-mail :</b>
                    {{ $contrat->adherent->email ?? '....' }}
                </td>
            </tr>

        </table>

    </div>
    <div style="clear: both;"></div>

    <table style="width:100%; border-collapse:collapse; margin-top:5px;">
        <tr>
            <td style="width:60%; vertical-align:top; padding-right:10px;">
                <div style="border:1px solid #2e7d32; padding:5px;">
                    <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px;">
                        2. Déclaration de santé "Assuré" par le souscripteur
                    </div>
                    <table style="width:100%; margin-top:5px; font-size:12px;">
                        <tr>
                            <td colspan="2" style="font-weight:bold;">
                                <input type="checkbox"> <input type="text" value="L'assuré déclare être en bonne santé." style="width: 80%; border: none; ">
                            </td>
                        </tr>
                        <div style="clear: both;"></div>
                        <tr>
                            <td colspan="2" style="">
                                L'assuré souffre-t-il de l’une des conditions suivantes :
                            </td>
                        </tr>
                        <div style="clear: both;"></div>
                        <tr>
                            <td style="padding-top:6px;">
                                <span style="font-weight:bold;">Diabete</span> : ☐ Oui ☐ Non
                            </td>

                            <td style="padding-top:6px;">
                                <span style="font-weight:bold;">AVC</span> : ☐ Oui ☐ Non
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-top:6px;">
                                <span style="font-weight:bold;">Cancer</span> : ☐ Oui ☐ Non
                            </td>

                            <td style="padding-top:6px;">
                                <span style="font-weight:bold;">Insuff - Réna</span> : ☐ Oui ☐ Non
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:6px;">
                                <span style="font-weight:bold;">Hypertension</span> : ☐ Oui ☐ Non
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td style="width:40%; vertical-align:top;">

                <div style="border:1px solid #2e7d32; padding:5px;">

                    <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px;">3. Couverture souhaitée</div>

                    <table style="width:100%; border-collapse:collapse; margin-top:8px; font-size:12px;">

                        <tr>
                            <td style="border:1px solid #999; padding:2px;"></td>
                            <td style="border:1px solid #999; padding:2px; text-align:center;"><b>Montant (FCFA)</b></td>
                        </tr>

                        <tr>
                            <td style="border:1px solid #999; padding:2px;">Choix Capital</td>
                            <td style="border:1px solid #999; padding:2px; text-align:right;">{{ number_format($contrat->capital, 0, ',', ' ') }}</td>
                        </tr>

                        <tr>
                            <td style="border:1px solid #999; padding:2px;">Prime Principale</td>
                            <td style="border:1px solid #999; padding:2px; text-align:right;">{{ number_format($contrat->primepricipale, 0, ',', ' ') }}</td>
                        </tr>

                        <tr>
                            <td style="border:1px solid #999; padding:2px;">Surprime</td>
                            <td style="border:1px solid #999; padding:2px; text-align:right;">{{ number_format($contrat->surprime, 0, ',', ' ') }}</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #999; padding:2px;">Frais d'Adhésion</td>
                            <td style="border:1px solid #999; padding:2px; text-align:right;">{{ number_format($contrat->fraisadhesion, 0, ',', ' ') }}</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #999; padding:2px;"><b>Total Prime</b></td>
                            <td style="border:1px solid #999; padding:2px; text-align:right;">{{ number_format($contrat->primepricipale + $contrat->fraisadhesion + $contrat->surprime, 0, ',', ' ') }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div style="clear: both;"></div>
    <table style="width:100%; margin-top:8px; border-collapse:collapse;">
        <tr>
            <td style="width:33%; font-size:12px;">Durée de la couverture : <b>1 an</b></td>
            <td style="width:33%; font-size:12px;">Date de début du contrat :<span style=""> {{ date('d-m-Y', strtotime($contrat->dateeffet )) }}</span></td>
            <td style="width:33%; font-size:12px;">Modalité de paiement :<span style=""> Annuel</span></td>
        </tr>
    </table>
    <div style="clear: both;"></div>

    <div class="exclusion mt-5" style="margin-top: 10px">
        Exclusions : (Exemple : suicide, guerre, Actes criminels, Drogues et alcool, Accidents liés à des activités
        dangereuses, Actes de terrorisme, Maladies mentales, Naufrages ou accidents aériens, Radiations nucléaires,
        Catastrophes naturelles, Conflits militaires.)
    </div>

    <div style="clear: both;"></div>
    <div style="margin-top:10px; border:1px solid #2e7d32; padding:5px;">
        <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:2px; width:45%;">
            4. Bénéficiaires
        </div>
        <table style="width:100%; border-collapse:collapse; margin-top:8px; font-size:12px;">
            <tr style="background:#f2f2f2; font-weight:bold;">
                <td style="border:1px solid #999; padding:4px;">Bénéficiaire</td>
                <td style="border:1px solid #999; padding:4px;">Nom et Prénom</td>
                <td style="border:1px solid #999; padding:4px;">Téléphone</td>
                <td style="border:1px solid #999; padding:4px;">Email</td>
                <td style="border:1px solid #999; padding:4px; text-align:center;">Répartition %</td>
            </tr>

            @foreach ($contrat->beneficiaires as $benef)

                <tr>
                    <td style="border:1px solid #999; padding:4px;">
                        <input type="checkbox" @if ($contrat->beneficiaireaudeces == 'Enfants nés et à naitre') checked @endif disabled> 
                        <input type="text" value="Enfant Né(e) et à naître" style="width: 80%; border: none; ">
                    </td>
                    <td style="border:1px solid #999; padding:4px;">
                        <span style="border-bottom:1px dotted #000; display:inline-block; width:100%;">{{ $benef->nom ?? '...'}} {{ $benef->prenom ?? '...' }}</span>
                    </td>
                    <td style="border:1px solid #999; padding:4px;">
                        <span style="border-bottom:1px dotted #000; display:inline-block; width:100%;"> {{ $benef->mobile ?? '...' }}</span>
                    </td>
                    <td style="border:1px solid #999; padding:4px;">
                        <span style="border-bottom:1px dotted #000; display:inline-block; width:100%;"> {{ $benef->email ?? '...' }}</span>
                    </td>
                    <td style="border:1px solid #999; padding:4px; text-align:center;">
                        <span style="border-bottom:1px dotted #000; display:inline-block; width:50px;"> {{ $benef->part ?? '...' }}</span>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
    <div style="clear: both;"></div>
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr>
            <td style="border:1px solid #2e7d32; padding:8px; width:70%; vertical-align:top;">
                <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px;">
                    Paiement des primes
                </div>

                <div style="margin-top:6px; font-weight:bold;">
                    Le montant total des primes d'assurance est payé par :
                </div>

                <table style="width:100%; margin-top:6px; font-size:12px;">
                    <tr>
                        <td style="padding:4px;">
                            <span>.</span> Prélèvement bancaire sur mon compte  
                            <span style="font-size:10px;">
                            (Joindre l'attestation de prélèvement et un relevé d'identité bancaire)
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:4px;">
                            .Retenue sur salaire auprès de mon employeur  
                            <span style="font-size:10px;">
                                (Joindre l'autorisation de retenue à la source)
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:4px;">
                            . Chèque (à l'ordre exclusif de YAKO ASSURANCE VIE)
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:4px;">
                            . Autres, préciser : <span style="border-bottom:1px dotted #000; display:inline-block; width:250px;"></span>
                        </td>
                    </tr>

                </table>

            </td>


            <td style="border:1px solid #2e7d32; padding:8px; width:30%; vertical-align:top;">

                <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px;">
                    Conseiller client
                </div>

                <div style="margin-top:10px;">
                    <span style="font-weight: bold;">Nom du conseiller :</span>
                    <span style="">
                        {{ $contrat->nomagent ?? 'N/A' }}
                    </span>
                </div>

                <div style="margin-top:10px;">
                    <span style="font-weight: bold;">Code du conseiller :</span> <span style="">{{ $contrat->codeagent ?? 'N/A' }}</span>
                </div>
            </td>
        </tr>
    </table>
    <div style="clear: both;"></div>
    <table style="width:100%; border-collapse:collapse; margin-top:15px; font-size:12px;">

        <tr>
            <td colspan="2" style="padding-bottom:10px;">
                Fait à : 
                <span style="border-bottom:1px dotted #000; display:inline-block; width:150px;"></span>

                &nbsp;&nbsp;&nbsp;

                Le : {{ date('d-m-Y') }}
                <span style="border-bottom:1px dotted #000; display:inline-block; width:150px;"></span>
            </td>
        </tr>

        <tr>
            <td style="width:50%; vertical-align:top; padding-right:10px;">
                <div style="border:1px solid #2e7d32; padding:8px; height:130px;">
                    <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px;">
                        Signature du Souscripteur
                    </div>
                    <div style="margin-top:8px;">
                        Je soussigné(e), {{ $contrat->adherent->nom ?? '....' }} {{ $contrat->adherent->prenom ?? '....' }},
                        <span style="border-bottom:1px dotted #000; display:inline-block; width:200px;"></span>
                        certifie que les informations fournies sont exactes.
                    </div>
                    <div style="margin-top:8px;">
                        Je consens au traitement de mes données personnelles par YAKO AFRICA ASSURANCE VIE dans le cadre de cette souscription.
                    </div>
                </div>
            </td>

            <td style="width:50%; vertical-align:top; padding-left:10px;">
                <div style="border:1px solid #2e7d32; padding:8px; height:130px;">
                    <div style="background:#0b5e10; color:#fff; font-weight:bold; padding:4px;">
                        Signature de l'Assuré
                    </div>
                    <div style="text-align: center; margin-top:10px">
                        @if ($imageSrc != null)
                            <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 100px; height: 100px;">
                        @endif
                    </div>
                    {{-- <div style="margin-top:10px; text-align:center; font-style:italic;">
                        (Précédée de la mention LU et APPROUVÉ)
                    </div> --}}
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
