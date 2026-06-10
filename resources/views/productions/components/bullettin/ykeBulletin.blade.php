<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription YAKO ETERNITE</title>
</head>
<body>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-size: 12px;
    }

    body {
        font-family: Arial, sans-serif;
        padding: 30px 35px;
    }

    .header {
        width: 100%;
        overflow: hidden;
    }

    .logo-left {
        float: left;
        width: 25%;
    }

    .logo-right {
        float: right;
        width: 25%;
        text-align: right;
    }

    .title-center {
        margin: 0 auto;
        width: 50%;
        text-align: center;
        background: #747171;
        color: #fff;
        height: 55px;
        line-height: 55px;
        font-weight: bold;
    }

    .logo-left img,
    .logo-right img {
        width: 100px;
    }

    .chechbox {
        border: 1px solid black;
        color: #fff;
        max-width: 3px !important;
        max-height: 3px !important;
        font-size: 9px;
        margin-right: 5px;
    }

    /* Alignement colonnes adhérent */
    .col-left,
    .col-right {
        width: 48%;
        vertical-align: top;
    }
    .col-left { float: left; }
    .col-right { float: right; }

    .field-row {
        display: table;
        width: 100%;
        margin-bottom: 6px;
    }
    .field-label {
        display: table-cell;
        white-space: nowrap;
        font-weight: bold;
        padding-right: 4px;
        vertical-align: top;
    }
    .field-value {
        display: table-cell;
        width: 100%;
        border-bottom: 1px dotted #aaa;
        vertical-align: top;
        padding-bottom: 1px;
    }

    /* Clearfix générique */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
    </style>

    <div class="a4-container">

        <!-- EN-TÊTE -->
        <section>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: middle;">
                        <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}"
                             style="width: 100px;">
                    </td>
                    <td style="width: 50%; text-align: center; background: #747171; color: #fff; font-weight: bold; vertical-align: middle; padding: 10px 5px;">
                        <h2 style="font-size: 13px; text-transform: uppercase; margin: 0; padding: 0;">
                            BULLETIN DE SOUSCRIPTION CRED'YAKO ETERNITE
                        </h2>
                    </td>
                    <td style="width: 25%; text-align: right; vertical-align: middle;">
                        <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('logos/CREADAFRICA.png'))) }}"
                             style="width: 100px;">
                    </td>
                </tr>
            </table>
        </section>

        <!-- NUMÉRO BULLETIN -->
        <section style="margin-top: 8px;">
            <p style="text-align: center;"><strong>N° : YAKO AFRICA ASSURANCE-YKE-{{ $contrat->numBullettin ?? "" }}</strong></p>
        </section>

        <!-- PRODUIT / CONSEILLER / AGENCE -->
        <section style="width: 100%; margin-top: 10px;" class="clearfix">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 33%;"><strong>Produit</strong> : <span style="text-transform: uppercase;">CRED'YAKO ETERNITE</span></td>
                    <td style="width: 33%; text-align: center;"><strong>Conseiller</strong> : {{ $contrat->nomagent ?? ""}}</td>
                    <td style="width: 33%; text-align: right;"><strong>Agence</strong> : {{ $contrat->user->membre->nomagence ?? ""}}</td>
                </tr>
            </table>
        </section>

        <!-- SECTION 1 : ADHÉRENT -->
        <section style="margin-top: 10px; font-family: Arial, sans-serif;">

            <div style="background-color: #747171; padding: 4px 6px; margin-bottom: 4px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">1. ADHERENT :</h4>
            </div>

            <div class="clearfix" style="padding-top: 6px">

                <!-- Colonne gauche -->
                <div class="col-left">

                    <div class="field-row">
                        <span class="field-label">Nom :</span>
                        <span class="field-value">{{ $contrat->adherent->civilite ?? ""}} .{{ $contrat->adherent->nom ?? ""}}</span>
                    </div>

                    <div class="field-row">
                        <span class="field-label">Prénom :</span>
                        <span class="field-value">{{ $contrat->adherent->prenom ?? ""}}</span>
                    </div>

                    <div class="field-row">
                        <span class="field-label">Date de naissance :</span>
                        <span class="field-value">{{ Carbon\Carbon::parse($contrat->adherent->datedenaissance)->format('d/m/Y') ?? ""}}</span>
                    </div>

                    

                    {{-- <div class="field-row">
                        <span class="field-label">Profession :</span>
                        <span class="field-value">{{ $contrat->adherent->profession ?? ""}}</span>
                    </div> --}}

                    <div class="field-row">
                        <span class="field-label">CNI/Passport/Attestation :</span>
                        <span class="field-value">{{ $contrat->adherent->numeropiece ?? ""}}</span>
                    </div>

                    {{-- <div class="field-row">
                        <span class="field-label">Genre :</span>
                        <span class="field-value">{{ $contrat->adherent->civilite ?? ""}}</span>
                    </div> --}}

                </div>

                <!-- Colonne droite -->
                <div class="col-right">

                    <div class="field-row">
                        <span class="field-label">Lieu de naissance :</span>
                        <span class="field-value">{{ $contrat->adherent->lieunaissance ?? ""}}</span>
                    </div>

                    <div class="field-row">
                        <span class="field-label">Domicile :</span>
                        <span class="field-value">{{ $contrat->adherent->lieuresidence ?? ""}}</span>
                    </div>

                    {{-- <div class="field-row">
                        <span class="field-label">Email :</span>
                        <span class="field-value">{{ $contrat->adherent->email ?? ""}}</span>
                    </div>

                    <div class="field-row">
                        <span class="field-label">Employeur :</span>
                        <span class="field-value">{{ $contrat->adherent->employeur ?? ""}}</span>
                    </div> --}}

                    <div class="field-row">
                        <span class="field-label">Téléphone / Cell :</span>
                        <span class="field-value">{{ $contrat->adherent->telephone ?? ""}}</span>
                    </div>

                    <div class="field-row">
                        <span class="field-label">Situation Matrimoniale :</span>
                        <span class="field-value">
                            @if ($contrat->adherent->situationMatrimoniale == 'CELIB')
                                Célibataire
                            @elseif ($contrat->adherent->situationMatrimoniale == 'union_libre')
                                Union libre
                            @elseif ($contrat->adherent->situationMatrimoniale == 'MARIE')
                                Marié(e)
                            @elseif ($contrat->adherent->situationMatrimoniale == 'DIVOR')
                                Divorcé(e)
                            @elseif ($contrat->adherent->situationMatrimoniale == 'VEUVE')
                                Veuf(ve)
                            @else
                                Non defini
                            @endif
                        </span>
                    </div>

                </div>

            </div><!-- /clearfix -->

        </section>

        <!-- SECTION 2a : ASSURÉS -->
        <section style="margin-top: 12px;">

            <div style="background-color: #747171; padding: 4px 6px; margin-bottom: 10px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">2. ASSURES :</h4>
            </div>

            <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="text-align: center; padding: 5px;">Nom</th>
                        <th style="text-align: center; padding: 5px;">Filiation</th>
                        <th style="text-align: center; padding: 5px;">Né(e) le</th>
                        <th style="text-align: center; padding: 5px;">Lieu naissance</th>
                        <th style="text-align: center; padding: 5px;">Résidence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contrat->assures as $assure)
                    <tr>
                        <td style="text-align: center; padding: 5px;">{{ $assure->nom }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $assure->prenom }}</td>
                        <td style="text-align: center; padding: 5px;">{{ Carbon\Carbon::parse($assure->datenaissance)->format('d/m/Y') }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $assure->lieunaissance }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $assure->lieuresidence }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </section>

        <!-- SECTION 2b : BÉNÉFICIAIRES -->
        <section style="margin-top: 15px;">

            <div style="background-color: #747171; padding: 4px 6px; margin-bottom: 10px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">2. BENEFICIAIRES :</h4>
            </div>

            <!-- Bénéficiaires au terme / au décès -->
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px;">
                <tr>
                    <td style="width: 48%; border: 1px solid #000; padding: 5 5 5 8px; vertical-align: top;">
                        <u>Au terme du contrat :</u>&nbsp;{{ $contrat->beneficiaireauterme ?? "Adherent" }}
                    </td>
                    <td style="width: 4%;"></td>
                    <td style="width: 48%; border: 1px solid #000; padding: 5 5 5 8px; vertical-align: top; text-transform: capitalize;">
                        <u>En cas de décès avant le terme du contrat :</u>&nbsp;{{ $contrat->beneficiaireaudeces ?? "" }}
                    </td>
                </tr>
            </table>

            <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="text-align: center; padding: 5px;">Nom</th>
                        <th style="text-align: center; padding: 5px;">Filiation</th>
                        <th style="text-align: center; padding: 5px;">Né(e) le</th>
                        <th style="text-align: center; padding: 5px;">Lieu naissance</th>
                        <th style="text-align: center; padding: 5px;">Telephone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contrat->beneficiaires as $item)
                    <tr>
                        <td style="text-align: center; padding: 5px;">{{ $item->nom ?? "" }} {{ $item->prenom ?? "" }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $item->filiation ?? "" }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $item->datenaissance ?? "" }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $item->lieunaissance ?? "" }}</td>
                        <td style="text-align: center; padding: 5px;">{{ $item->mobile ?? "" }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </section>

        <!-- SECTION 3 : GARANTIES & PRIMES -->
        <section style="margin-top: 15px;">

            <div style="background-color: #747171; padding: 4px 6px; margin-bottom: 10px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">3. GARANTIE &amp; PRIMES :</h4>
            </div>

            <div style="padding: 6px; border: 1px solid #ddd;">

                <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th style="text-align: left; padding: 6px;">Garantie</th>
                            <th style="text-align: center; padding: 6px;">Option/Capital</th>
                            <th style="text-align: center; padding: 6px;">Prime</th>
                            <th style="text-align: center; padding: 6px;">Périodicité</th>
                            <th style="text-align: center; padding: 6px;">Total Primes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrat->assures as $assure)
                            @foreach ($assure->garanties as $item)
                            <tr>
                                <td style="padding: 6px;">{{ $item->monlibelle ?? "" }}</td>
                                <td style="text-align: center; padding: 6px;">{{ $item->capitalgarantie ?? "" }}</td>
                                <td style="text-align: center; padding: 6px;">{{ $item->prime ?? "" }}</td>
                                <td style="text-align: center; padding: 6px;">{{ $contrat->periodicite ?? "" }}</td>
                                <td style="text-align: center; padding: 6px;">{{ $item->primetotal ?? "" }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #e0e0e0; font-weight: bold;">
                            <td colspan="4" style="text-align: right; padding: 6px;">TOTAL PRIME (FcFA) :</td>
                            <td style="text-align: center; padding: 6px;">{{ $contrat->prime ?? "" }}</td>
                        </tr>
                    </tfoot>
                </table>

                <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 6px;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th style="text-align: center; padding: 6px;">Capital souscrit</th>
                            <th style="text-align: center; padding: 6px;">Date effet</th>
                            <th style="text-align: center; padding: 6px;">Durée de cotisation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; padding: 6px;">{{ number_format($contrat->capital, 0, ',', ' ') ?? "" }}</td>
                            <td style="text-align: center; padding: 6px;">{{ Carbon\Carbon::parse($contrat->dateeffet)->format('d/m/Y') ?? "" }}</td>
                            <td style="text-align: center; padding: 6px;">5 ans</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </section>

        <!-- SECTION 4 : PAIEMENT DES PRIMES -->
        <section style="margin-top: 12px;">

            <div style="background-color: #747171; padding: 4px 6px; margin-bottom: 4px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">4. PAIEMENT DES PRIMES :</h4>
            </div>

            <div style="padding: 6px; border: 1px solid #ddd;">
                <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th style="text-align: left; padding: 6px;">Mode de paiement</th>
                            <th style="text-align: center; padding: 6px;">Guichet</th>
                            <th style="text-align: center; padding: 6px;">Organisme</th>
                            <th style="text-align: center; padding: 6px;">N° Compte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 6px;">{{ $contrat->modepaiement ?? "" }}</td>
                            <td style="text-align: center; padding: 6px;">{{ $contrat->codeguichet ?? "" }}</td>
                            <td style="text-align: center; padding: 6px;">{{ $contrat->organisme ?? "CREADAFRICA" }}</td>
                            <td style="text-align: center; padding: 6px;">{{ $contrat->numerocompte ?? "" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

        <!-- SIGNATURES -->
        <section style="margin-top: 20px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <!-- Signature YAKO -->
                    <td style="width: 48%; border: 1px solid #000; padding: 8px; vertical-align: middle;">
                        <div style="margin-bottom: 4px;">Reservé à YAKO AFRICA Assurances Vie</div>
                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 200px;">
                        </div>
                    </td>

                    <td style="width: 4%;"></td>

                    <!-- Signature conseiller / souscripteur -->
                    <td style="width: 48%; min-height: 127px; border: 1px solid #000; padding: 8px; vertical-align: top;">

                        <div style="margin-bottom: 6px;">
                            <strong>Nom du conseiller :</strong>&nbsp;{{ Auth::user()->membre->nom ?? ""}} {{ Auth::user()->membre->prenom ?? ""}}
                        </div>

                        <div style="margin-bottom: 8px;">Signature du Souscripteur</div>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 50%; text-align: center; vertical-align: middle;">
                                    <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 60px; height: 60px;">
                                </td>
                                <td style="width: 50%; text-align: center; vertical-align: middle;">
                                    @if ($imageSrc != null)
                                        <img src="{{ $imageSrc }}" alt="Signature" style="width: 55px; height: 55px;">
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
        </section>

    </div>

</body>
</html>