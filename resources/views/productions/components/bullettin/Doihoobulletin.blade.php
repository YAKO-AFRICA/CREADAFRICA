<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription Doihoo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 11px;
            color: #444444
        }

        body {
            font-family: Arial, sans-serif;
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .chechbox {
            border: 1px solid black;
            color: #fff;
            max-width: 3px !important;
            max-height: 3px !important;
            font-size: 9px;
            margin-right: 5px;
        }

        .radio {
            margin-right: 10px;
            transform: scale(1.8);
        }

        .radio1 {
            margin-right: 8px;
            transform: scale(1.3);
        }

        .input-border-bottom {
            border: none;
            border-bottom: solid 1px;
        }

        .a4-container {
            width: 100%;
            height: 1050px;
            border-left: solid 15px #368257;
            padding: 5px;
            position: relative;
        }

        .padding {
            padding: 2px;
        }

        .bloc-no-break {
            page-break-inside: avoid;
        }

        table {
            font-size: 10px;
        }

        h1, h2, h3, h4 {
            margin-bottom: 5px;
        }

        p, li {
            line-height: 1.2;
            margin-bottom: 3px;
        }

        .section-title {
            width: 50%;
            margin-bottom: 8px;
            justify-content: center;
        }

        .section-title-number {
            width: 2%;
            background-color: #747171;
            padding: 4px;
            float: left;
            text-align: center;
            color: #fff;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-title-text {
            width: auto;
            background-color: #747171;
            padding: 4px 10px;
            border-radius: 0 7px 7px 0;
            margin-left: 20px;
            color: #fff;
            font-weight: bold;
            height: 20px;
            display: flex;
            align-items: center;
        }

        .clear {
            clear: both;
        }

        .page-footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 0 25px;
        }

        .page-number {
            position: absolute;
            bottom: 5px;
            right: 20px;
            font-size: 10px;
            font-weight: bold;
            color: #444;
        }

        .form-group {
            margin-bottom: 6px;
        }
    </style>
</head>

<body>
    <!-- PAGE 1 -->
    <div class="a4-container page_1">
        <section style="height: 60px">
            <div style="width: 100%">
                <div style="width: 25%; float: left">
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}"
                        alt="Logo" style="width: 100px">
                </div>
                <div style="width: 75%; font-size: 11px; font-weight: bold; height: 25px; display: flex; justify-content: center; align-items: center; float: right">
                    <h2 style="font-size: 11px; display: flex; flex-direction: column; justify-content: center; align-items: center"></h2>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        
        <section style="margin-top: 10px">
            <div>
                <CENTER>
                    <h1><i style="font-size: 22px">BULLETIN DE SOUSCRIPTION</i></h1>
                </CENTER>
            </div>
        </section>
        
        <section style="margin-top: 10px; width: 100%;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center;">
                        <div style="display: inline-block; width: 500px; border: 1px solid #444; padding: 5px; border-radius: 7px;">
                            <strong style="font-size: 13px">N° BULLETIN :</strong>
                            <span style="color: red; font-size: 15px">
                                {{ $contrat->numBullettin ?? '....' }}
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
        </section>
        
        <section style="margin-top: 15px; margin-bottom: 5px; padding: 5px;">
            <div>
                <h1 style="text-align: center; font-size: 90px; color: #368257; line-height: 0.8">Doiho<span style="color: #F8B133; font-size: 135px">o</span></h1>
                <p style="text-align: center; font-size: 34px; color: #368257; line-height: 0.8; text-transform: uppercase">épargne à tirage</p>
            </div>
        </section>
        
        <section style="margin-top: 20px; margin-bottom: 25px; padding: 15px; margin: 0 auto">
            <div style="margin-top: 15px; text-align: justify; background-color: #444444b3; padding: 10px; border-radius: 5px">
                <p style="color: #fff">
                    Cet encadré a pour objectif d'attirer l'attention du souscripteur sur certaines dispositions essentielles de la proposition d'assurance. 
                    Il est important que le souscripteur lise intégralement la proposition d'assurance et pose les questions qu'il estime nécessaires avant de signer le contrat.
                </p>
            </div>
            <div style="clear: both;"></div>
        </section>
        
        <section style="margin-top: 0px; margin-bottom: 25px; padding: 5px; border: 1px solid #444;">
            <div style="padding: 4px; border: 1px solid #444; border-radius: 10px">
                <div style="margin: 0 auto; border: 1px solid #444; background-color: #dbdbdb22; padding: 20px 50px; border-radius: 10px">
                    <ol style="text-align: justify">
                        
                        <li>Le contrat <strong>DOIHOO</strong> est un contrat d'assurance vie individuel.</li><br>

                        <li>
                            Le contrat <strong>DOIHOO</strong> offre deux (2) garanties dénommées "<strong>INVEST</strong>" et "<strong>DOIHOO</strong>" : <br><br>
                            <ul style="text-align: justify; margin-left: 20px">
                                <li>La garantie <strong>INVEST</strong> donne droit à une prestation égale à l'épargne constituée (Provision Mathématique).</li>
                                <li>La garantie <strong>DOIHOO</strong> permet au souscripteur de bénéficier, par anticipation et à l'occasion d'un tirage au sort, d'une prestation égale à 20 % du capital à terme.</li>
                            </ul><br>
                            <p>Le capital garanti dans le contrat <strong>DOIHOO</strong> est payable en une seule fois (montant unique).</p>
                        </li>

                        <br>

                        <li>Au terme du contrat, le capital est payé dans les <strong>QUINZE (15) JOURS</strong> suivant la remise de toutes les pièces prévues au contrat.</li>

                        <br>

                        <li>
                            Chaque année, la participation aux bénéfices est déterminée à partir d'au moins 90 % des résultats techniques et 85 % des résultats financiers, conformément aux dispositions des articles 82, 83 et 84 du Code CIMA, et versée au compte « Provisions pour la participation aux bénéfices ». 
                            Les provisions constituées sont réparties entre les assurés après approbation du Conseil d'administration de l'assureur.
                        </li>

                        <br>

                        <li>
                            Le contrat <strong>DOIHOO</strong> prévoit une faculté de rachat lorsque deux (2) primes annuelles au moins ou 15 % de l'ensemble des primes prévues au contrat ont été payées. <br>
                            Les sommes demandées en cas de rachat sont versées par <strong>YAKO AFRICA</strong> dans un délai de <strong>SOIXANTE (60) JOURS</strong> suivant la date de réception de la demande de rachat. <br>
                            Les valeurs de rachat au terme de chacune des huit (8) premières années au moins, ainsi que la somme des primes versées au terme de chacune de ces mêmes années, sont indiquées dans les conditions particulières du contrat.
                            Le contrat <strong>DOIHOO</strong> prévoit également des avances dont le montant ne saurait dépasser 75 % de la provision constituée.
                        </li>

                        <br>

                        <li>
                            Les chargements prélevés au contrat sont : <br><br>
                            <ul style="text-align: justify; margin-left: 20px">
                                <li>Chargement d'acquisition : 35 % de la première prime annuelle au titre de la garantie <strong>INVEST</strong>.</li>
                                <li>Chargement d'administration et de gestion sur la garantie <strong>INVEST</strong> : 7 % de chaque prime.</li>
                                <li>Chargement d'administration et de gestion sur la garantie <strong>DOIHOO</strong> : 25 % de chaque prime.</li>
                                <li>Chargement exceptionnel : 1,5 % de chaque prime.</li>
                            </ul>
                        </li>

                    </ol>
                </div>
            </div>
        </section>

        <!-- FOOTER PAGE 1 -->
        <div class="page-footer">
            <div style="width: 100%; margin-bottom: 15px; margin-top: 5px">
                <div style="float: left; text-align:center;">
                    <p>
                        <small style="font-size: 9px">
                            Société Anonyme d'Assurance Vie au capital de 3 000 000 000 FCFA. Entreprise régie par le
                            code des Assurances CIMA Siège social : Abidjan-Plateau - Immeuble woodin Center 4ème étage
                            - Avenue Noguès 01 BP 11885 Abidjan 01
                        </small>
                    </p>
                    <p>
                        <small style="font-size: 9px"><strong>Tél.: (225) 27 20 22 94 64 / 27 20 33 15 00 - Fax : (225) 27 20 22 95 92 - RCC : CI-ABJ-03-2022-M-22882 </strong></small>
                    </p>
                    <p>
                        <small style="font-size: 9px; color: #656565">Email : infos@yakoafricassur.com - Site Web : www.yakoafricassur.com</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-number">1/3</div>
    </div>

    <!-- PAGE 2 -->
    <div class="a4-container">
        <div class="bloc-no-break">
            <!-- SECTION I: SOUSCRIPTEUR -->
            <section style="margin-bottom: 12px;">
                <div class="section-title">
                    <div class="section-title-number">I</div>
                    <div class="section-title-text">SOUSCRIPTEUR</div>
                </div>
                <div class="clear"></div>
                
                <div style="padding: 5px;">
                    <div class="form-group" style="width: 30%; margin-bottom: 5px; border: 1px solid #444; padding: 4px; border-radius: 7px">
                        <div style="width: 100%; text-align: center;">
                            <div style="width: 33%; float: left;">
                                <input type="radio" class="radio1" name="civilite" 
                                    @if(isset($contrat->adherent->civilite) && strtolower($contrat->adherent->civilite) === 'madame') checked @endif>
                                <span>Mme</span>
                            </div>
                            <div style="width: 33%; float: left;">
                                <input type="radio" class="radio1" name="civilite" 
                                    @if(isset($contrat->adherent->civilite) && strtolower($contrat->adherent->civilite) === 'mademoiselle') checked @endif>
                                <span>Mlle</span>
                            </div>
                            <div style="width: 33%; float: left;">
                                <input type="radio" class="radio1" name="civilite" 
                                    @if(isset($contrat->adherent->civilite) && strtolower($contrat->adherent->civilite) === 'monsieur') checked @endif>
                                <span>M</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="form-group" style="width: 100%; margin-bottom: 8px; padding: 5px;">
                        <div style="width: 100%;">
                            <div style="width: 18%; float: left;">
                                <input type="radio" class="radio1" name="naturepiece" 
                                    @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'passport') checked @endif>
                                <span>Passeport</span>
                            </div>
                            <div style="width: 12%; float: left;">
                                <input type="radio" class="radio1" name="naturepiece" 
                                    @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'cni') checked @endif>
                                <span>CNI</span>
                            </div>
                            <div style="width: 10%; float: left;">
                                <input type="radio" class="radio1" name="naturepiece" 
                                    @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'at') checked @endif>
                                <span>AT</span>
                            </div>
                            <div style="width: 10%; float: left;">
                                <input type="radio" class="radio1" name="naturepiece" 
                                    @if(isset($contrat->adherent->naturepiece) && strtolower($contrat->adherent->naturepiece) === 'cc') checked @endif>
                                <span>CC</span>
                            </div>
                            <div style="width: 50%; float: left;">
                                <span>N°</span> 
                                <input type="text" style="width: 90%; padding: 2px;" 
                                    value="{{ $contrat->adherent->numeropiece ?? '' }}">
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="form-group" style="width: 100%; margin-bottom: 6px;">
                        <div style="width: 50%; float: left;">
                            <label><strong>Nom : </strong><span>{{ $contrat->adherent->nom ?? '....' }}</span></label>
                        </div>
                        <div style="width: 50%; float: right;">
                            <label><strong>Prénoms : </strong><span>{{ $contrat->adherent->prenom ?? '....' }}</span></label>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="form-group" style="width: 100%; margin-bottom: 6px;">
                        <div style="width: 50%; float: left;">
                            <label><strong>Né(e) le : </strong><span>{{ $contrat->adherent->datenaissance ?? '....' }}</span></label>
                        </div>
                        <div style="width: 50%; float: left;">
                            <label><strong>à </strong><span>{{ $contrat->adherent->lieunaissance ?? '....' }}</span></label>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="form-group" style="width: 80%; margin-bottom: 6px;">
                        <div style="width: 100%;">
                            <div style="width: 45%; float: left; padding-top: 2px;"><strong>Situation Matrimoniale :</strong></div>
                            <div style="width: 18%; float: left;">
                                <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'CELIB') checked @endif>
                                <span>Célibataire</span>
                            </div>
                            <div style="width: 18%; float: left;">
                                <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'MARIE') checked @endif>
                                <span>Marié(e)</span>
                            </div>
                            <div style="width: 18%; float: left;">
                                <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'DIVOR') checked @endif>
                                <span>Divorcé(e)</span>
                            </div>
                            <div style="width: 18%; float: left;">
                                <input type="radio" class="radio1" @if($contrat->adherent->situationMatrimoniale == 'VEUVE') checked @endif>
                                <span>Veuf(ve)</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="form-group" style="width: 100%; margin-bottom: 6px;">
                        <div style="width: 50%; float: left;">
                            <label><strong>Profession : </strong><span>{{ $contrat->adherent->profession ?? '....' }}</span></label>
                        </div>
                        <div style="width: 50%; float: right;">
                            <label><strong>Employeur : </strong><span>{{ $contrat->adherent->employeur ?? '....' }}</span></label>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="form-group" style="width: 100%; margin-bottom: 6px;">
                        <div style="width: 50%; float: left;">
                            <label><strong>Adresse : </strong><span>{{ $contrat->adherent->telephone1 ?? '....' }}</span></label>
                        </div>
                        <div style="width: 50%; float: left;">
                            <label><strong>E-mail : </strong><span>{{ $contrat->adherent->email ?? '....' }}</span></label>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="form-group" style="width: 100%; margin-bottom: 0px;">
                        <div style="width: 33%; float: left;">
                            <label><strong>Lieu de résidence : </strong><span>{{ $contrat->adherent->lieuresidence ?? '....' }}</span></label>
                        </div>
                        <div style="width: 33%; float: left;">
                            <label><strong>Téléphone courant : </strong><span>{{ $contrat->adherent->mobile ?? '....' }}</span></label>
                        </div>
                        <div style="width: 33%; float: right;">
                            <label><strong>N° Whatsapp : </strong><span>{{ $contrat->adherent->telephone ?? '....' }}</span></label>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>

            <!-- SECTION II: GARANTIE -->
            <section style="margin-bottom: 12px; border-bottom: 1px dotted #444;">
                <div class="section-title">
                    <div class="section-title-number">II</div>
                    <div class="section-title-text">GARANTIE</div>
                </div>
                <div class="clear"></div>
                
                <div style="padding: 8px;">
                    <table border="1" cellpadding="4" cellspacing="0" width="100%">
                        @foreach ($contrat->garanties as $garantie)
                        <tr>
                            <td class="padding">{{ $garantie->monlibelle ?? '' }}</td>
                            <td class="padding">{{ $garantie->prime ?? '' }}</td> 
                        </tr>
                        @endforeach
                    </table>
                    
                    <div style="width: 100%; margin-top: 8px;">
                        <div style="width: 30%; float: left;">
                            <strong>Durée : <i>{{ $contrat->duree ?? '' }} ans</i></strong>
                        </div>
                        <div style="width: 30%; float: left;">
                            <strong>Frais d'adhesions : <i>{{ $contrat->fraisadhesion ?? "2 500" }}</i> FCFA</strong>
                        </div>
                        <div style="width: 30%; float: right;">
                            <strong>Date d'effet : <i>{{ $contrat->dateeffet ?? '' }}</i></strong>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>

            <!-- SECTION III: PAIEMENT DES PRIMES -->
            <section style="margin-bottom: 12px; border-bottom: 1px dotted #444;">
                <div class="section-title">
                    <div class="section-title-number">III</div>
                    <div class="section-title-text">PAIEMENT DES PRIMES</div>
                </div>
                <div class="clear"></div>
                {{-- <div>
                    <span>Le montant total des primes et cotisations d'assurance est payée par :</span>
                </div> --}}
                
                <div style="padding: 8px;">
                    <label style="margin-top: 3px; margin-left:15px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat" 
                            @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'VIR') checked @endif>
                        Prélèvement bancaire sur mon compte (<small><i>Joindre l'attestation de prélèvement et un relevé d'identité bancaire</i></small>)
                    </label>
                    
                    <label style="margin-top: 3px; margin-left:15px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                            @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'SOURCE') checked @endif>
                        Retenue sur salaire auprès de mon employeur (<small><i>Joindre l'autorisation de retenue à la source</i></small>)
                    </label>
                    
                    <label style="margin-top: 3px; margin-left:15px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                            @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'CHK') checked @endif>
                        Chèque (<small><i>à l'ordre exclusif de <strong>YAKO AFRICA Assurances Vie</strong></i></small>)
                    </label>
                    
                    <label style="margin-top: 3px; margin-left:15px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                            @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'ESP') checked @endif>
                        Espèces (<small><i>exclusivement aux guichets de <strong>YAKO AFRICA Assurances Vie</strong> ou auprès des mandataires autorisés</i></small>)
                    </label>
                    
                    <label style="margin-top: 3px; margin-left:15px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                            @if(isset($contrat->modepaiement) && $contrat->modepaiement == 'Mobile_money') checked @endif>
                        Mobile money ou Internet
                    </label>
                    
                    <label style="margin-top: 3px; margin-left:15px; display:block">
                        <input type="radio" class="radio1" name="modepaiement_etat"
                            @if(isset($contrat->modepaiement) && !in_array($contrat->modepaiement, ['VIR', 'SOURCE', 'CHK', 'ESP', 'Mobile_money'])) checked @endif>
                        Autres, préciser : &nbsp; 
                        <b>
                            @if(isset($contrat->modepaiement) && !in_array($contrat->modepaiement, ['VIR', 'SOURCE', 'CHK', 'ESP', 'Mobile_money']))
                                {{ $contrat->modepaiement }}
                            @else
                                ...................................................................................
                            @endif
                        </b>
                    </label>              
                </div>
            </section>

            <!-- SECTION IV: BENEFICIAIRES -->
            <section style="margin-bottom: 12px; border-bottom: 1px dotted #444;">
                <div class="section-title">
                    <div class="section-title-number">IV</div>
                    <div class="section-title-text " style="text-transform: uppercase ">clause bénéficiaire </div>
                </div>
                <div class="clear"></div>
                
                <div style="padding: 8px;">
                    <div style="width: 15%; background-color: #7471718b; padding: 4px; margin: 6px 0; border-radius: 15px; text-align: center">
                        <strong><i style="font-size: 10px">1. En cas de vie</i></strong>
                    </div>
                    <div style="width: 43%; float: left; margin-bottom: 8px;">
                        <input type="radio" checked class="radio1"><span>Le Souscripteur</span>
                    </div>
                    <div class="clear"></div>
                    
                    <div style="width: 16%; background-color: #7471718b; padding: 4px; margin: 6px 0; border-radius: 15px; text-align: center">
                        <strong><i style="font-size: 10px">2. En cas de décès</i></strong>
                    </div>
                    
                    <div style="width: 97%; margin: 5px 0; padding: 5px;">
                        <div style="width: 100%;">
                            <div style="width: 43%; float: left;">
                                <input type="radio" class="radio1" @if(isset($contrat->beneficiaireaudeces) && $contrat->beneficiaireaudeces == 'Conjoint' || $contrat->beneficiaireaudeces == 'conjoint') checked @endif>
                                <span>Le Conjoint non séparé de corps, ni divorcé</span>
                            </div>
                            <div style="width: 33%; float: left;">
                                <input type="radio" class="radio1" @if(isset($contrat->beneficiaireaudeces) && $contrat->beneficiaireaudeces == 'Enfants nés et à naitre' || $contrat->beneficiaireaudeces == 'enfants') checked @endif>
                                <span>Les enfants nés et à naître</span>
                            </div>
                            <div style="width: 18%; float: left;">
                                <input type="radio" class="radio1" @if(isset($contrat->beneficiaireaudeces) && $contrat->beneficiaireaudeces == 'autre') checked @endif>
                                <span>Autres</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <table border="1" cellpadding="4" cellspacing="0" width="100%" style="font-size: 9px">
                        <tr>
                            <th>Nom complet</th>
                            <th>filliation</th>
                            <th>Né(e) le</th>
                            <th>Téléphone</th>
                            <th>Résidence</th>
                        </tr>
                        @foreach ($contrat->beneficiaires as $item)
                        <tr>
                            <td>{{ $item->nom ?? '' }} {{ $item->prenom ?? '' }}</td>
                            <td>{{ $item->filiation ?? '' }}</td>
                            <td>{{ $item->datenaissance ?? '' }}</td>
                            <td>{{ $item->mobile ?? '' }}</td>
                            <td>{{ $item->lieuresidence ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </section>
        </div>
        <!-- SECTION V: FRAIS D'ADHESION -->
            <section style="margin-bottom: 12px; border-bottom: 1px dotted #444;">
                <div class="section-title">
                    <div class="section-title-number">V</div>
                    <div class="section-title-text">FRAIS UNIQUE D'ADHESION</div>
                </div>
                <div class="clear"></div>
                
                <div style="padding: 8px;">
                    <label><span>Frais unique d'Adhésion : </span><b>{{ $contrat->fraisadhesion ?? ''}} </b></label> 
                    <br><br>
                    
                    <div style="width: 90%; margin-bottom: 7px;">
                        <div style="width: 100%;">
                            <div style="width: 38%; float: left;">
                                <span>Adhésion aux services en ligne Y-Nov : </span>
                            </div>
                            <div style="width: 35%; float: left;">
                                <input type="radio" class="radio1"><strong>Abonnement mensuel: 500 FCFA</strong>
                            </div>
                            <div style="width: 35%; float: left;">
                                <input type="radio" class="radio1"><strong>Abonnement annuelle: 6000 FCFA</strong>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>

        <!-- FOOTER PAGE 2 -->
        <div class="page-footer">
            <div style="width: 100%; margin-bottom: 15px; margin-top: 5px">
                <div style="float: left; text-align:center;">
                    <p>
                        <small style="font-size: 9px">
                            Société Anonyme d'Assurance Vie au capital de 3 000 000 000 FCFA. Entreprise régie par le
                            code des Assurances CIMA Siège social : Abidjan-Plateau - Immeuble woodin Center 4ème étage
                            - Avenue Noguès 01 BP 11885 Abidjan 01
                        </small>
                    </p>
                    <p>
                        <small style="font-size: 9px"><strong>Tél.: (225) 27 20 22 94 64 / 27 20 33 15 00 - Fax : (225) 27 20 22 95 92 - RCC : CI-ABJ-03-2022-M-22882 </strong></small>
                    </p>
                    <p>
                        <small style="font-size: 9px; color: #656565">Email : infos@yakoafricassur.com - Site Web : www.yakoafricassur.com</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-number">2/3</div>
    </div>

    <!-- PAGE 3 -->
    <div class="a4-container">
        <div class="bloc-no-break">
            

            <!-- SECTION VI: PROTECTION DES DONNEES -->
            <section style="margin-bottom: 12px; border-bottom: 1px dotted #444;">
                <div class="section-title">
                    <div class="section-title-number">VI</div>
                    <div class="section-title-text">PROTECTION DES DONNEES À CARACTERE PERSONNEL</div>
                </div>
                <div class="clear"></div>
                
                <div style="padding: 8px;">
                    <div style="padding: 4px; border: 1px solid #444; background-color: #dbdbdb22; border-radius: 10px">
                        <div style="padding: 10px 30px; border-radius: 10px">
                            <ol style="text-align: justify; font-size: 10px">
                                <li>Les informations collectées sur ce bulletin feront l'objet d'un traitement destiné à établir et gérer exclusivement le contrat <strong>DOIHOO</strong>.</li>
                                <li>Ces données seront conservées pour une duree de 10 années après l'échéance du contrat, nécessaires au respect des délais de participation. Les destinataires de ces données sont les services de <strong>YAKO AFRICA</strong>.</li>
                                <li>Conformement à la loi N° 2013-450 du 19 Juin 2013, vous bénéficiez d'un droit d'accès et de rectification des informations qui vous concernent.</li>
                                <li>Si vous souhaitez exercer ce droit et obtenir une communication des informations vous concernant, veuillez adresser un courrier à dpo@yakoafricassur.com accompagné de tout moyen permettant d'établir l'identité de la personne.</li>
                                <li>En signant dans la rubrique, signature, vous consentez de façon expresse et éclairée aux traitements de vos données par les services concernés.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION VII: PARTIE YAKO AFRICA -->
            <section style="margin-bottom: 12px; border-bottom: 1px dotted #444;">
                <div class="section-title">
                    <div class="section-title-number">VII</div>
                    <div class="section-title-text">Partie reservée à YAKO AFRICA</div>
                </div>
                <div class="clear"></div>
                
                <div style="padding: 8px;">
                    <div style="border: 1px solid #444; border-radius: 7px; background-color: #dbdbdb22; padding: 10px">
                        <div style="width: 54%; float: left; padding: 5px;">
                            <div style="margin-bottom: 8px;">
                                <label><strong>Conseiller : </strong><input type="text" class="input-border-bottom" style="width: 81%" value="{{ $contrat->nomagent ?? ''}}"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>Unit Manager : </strong><input type="text" class="input-border-bottom" style="width: 76%" value="----"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>Assistant Manager : </strong><input type="text" class="input-border-bottom" style="width: 67%" value="----"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>Manager : </strong><input type="text" class="input-border-bottom" style="width: 83%" value="----"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>Réseau : </strong><input type="text" class="input-border-bottom" style="width: 85%" value="SIFCOM"> </label>
                            </div>
                        </div>
                        
                        <div style="width: 42%; float: right; padding: 5px;">
                            <div style="margin-bottom: 8px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom" style="width: 81%" value="{{ $contrat->codeConseiller ?? "" }}"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom" style="width: 81%" value="----"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom" style="width: 81%" value="----"> </label>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label><strong>code : </strong><input type="text" class="input-border-bottom" style="width: 81%" value="----"> </label>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>

            <!-- PERSONNE À CONTACTER -->
            <div style="width: 40%; background-color: #7471718b; padding: 4px; border-radius: 15px; text-align: center; margin: 5px 0 10px 0;">
                <strong><strong style="font-size: 10px">Personne à contacter en cas d'urgence</strong></strong>
            </div>

            <table style="width: 100%; border-collapse: collapse; margin-top: 5px;">
                <!-- PERSONNE 1 -->
                <tr>
                    <td style="width: 50%; padding: 5px;">
                        <strong>Nom et prénoms :</strong>
                        <span>{{ $contrat->personneressource ?? '....' }}</span>
                    </td>
                    <td style="width: 50%; padding: 5px;">
                        <strong>Contact :</strong>
                        <span>{{ $contrat->contactpersonneressource ?? '....' }}</span>
                    </td>
                </tr>

                <!-- PERSONNE 2 -->
                <tr>
                    <td style="width: 50%; padding: 5px;">
                        <strong>Nom et prénoms :</strong>
                        <span>{{ $contrat->personneressource2 ?? '....' }}</span>
                    </td>
                    <td style="width: 50%; padding: 5px;">
                        <strong>Contact :</strong>
                        <span>{{ $contrat->contactpersonneressource2 ?? '....' }}</span>
                    </td>
                </tr>
            </table>
            
            <!-- SIGNATURES -->
            <section style="width: 100%; margin-top: 20px;">
                <div style="width: 100%; margin-bottom: 15px;">
                    <label>Fait à : <strong> .................  </strong> le <strong> {{ \Carbon\Carbon::parse($contrat->saisiele)->format('d/m/Y à H:i:s') ?? '' }} </strong></label>
                </div>
                
                <div style="width: 100%; text-align: center;">
                    <div style="width: 45%; float: left;">
                        <strong style="font-size: 11px">Signature du souscripteur</strong>
                        <div>
                            @if ($imageSrc != null)
                                <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 50px; height: 50px;">
                            @endif
                        </div>
                        {{-- <img src="{{ $qrCodeBase64 }}" alt="QR Code de vérification" style="width: 55px; height: 55px;"> --}}
                    </div>
                    
                    <div style="width: 45%; float: right;">
                        <strong style="font-size: 11px">Signature de l'Assuré</strong>
                        <p><i style="font-size: 9px !important">(précédée de la mention "LU et APPROUVE")</i></p>
                        <div>
                            @if ($imageSrc != null)
                                <img src="{{ $imageSrc }}" alt="QR Code de vérification" style="width: 50px; height: 50px;">
                            @endif
                        </div>
                    </div> 
                </div>
                <div class="clear"></div>
            </section>

            <!-- FOOTER -->
            {{-- <section style="border-bottom: 3px solid #ccc; margin-top: 25px">
                <div style="width: 100%;">
                    <div style="float: left;">
                        <small style="font-size: 9px">Produit conçu et testé par la cellule Recherche & Développement de YAKO AFRICA Assurances Vie</small>
                    </div>
                </div>
                <div class="clear"></div>
            </section> --}}
        </div>

        <!-- FOOTER PAGE 3 -->
        <div class="page-footer">
            <div style="width: 100%; margin-bottom: 15px; margin-top: 5px">
                <div style="float: left; text-align:center;">
                    <p>
                        <small style="font-size: 9px">
                            Société Anonyme d'Assurance Vie au capital de 3 000 000 000 FCFA. Entreprise régie par le
                            code des Assurances CIMA Siège social : Abidjan-Plateau - Immeuble woodin Center 4ème étage
                            - Avenue Noguès 01 BP 11885 Abidjan 01
                        </small>
                    </p>
                    <p>
                        <small style="font-size: 9px"><strong>Tél.: (225) 27 20 22 94 64 / 27 20 33 15 00 - Fax : (225) 27 20 22 95 92 - RCC : CI-ABJ-03-2022-M-22882 </strong></small>
                    </p>
                    <p>
                        <small style="font-size: 9px; color: #656565">Email : infos@yakoafricassur.com - Site Web : www.yakoafricassur.com</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-number">3/3</div>
    </div>
</body>
</html>