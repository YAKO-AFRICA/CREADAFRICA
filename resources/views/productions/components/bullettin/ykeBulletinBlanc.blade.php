<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription YAKO ETERNITE</title>
</head>
<body>
    <style>
        input {
            font-size: 20px;
            color: #000;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
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
    </style>


    <div class="a4-container">

        <section>
            <div class="container1_1 row" style="width: 100%">

                <div class="logo col-4" style="width: 25%; float: left">
    
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px">
    
                </div>
    
                <div style="width: 75%; font-size: 12px; font-weight: bold; text-align: center; background: #747171; color: #fff; height: 55px; display: flex; justify-content: center; align-items: center; float: right">
    
                    <center class="title" style="text-align: center; align-items: center; margin-top: 15px">
    
                        <h2 class="text-uppercase" style="font-size: 15px">BULLETIN DE SOUSCRIPTION YKE</h2>
    
                    </center>
    
                </div>
    
            </div>
        </section>

        <section>
            <CENTER><strong>N° BULLETIN : {{ $contrat->numBullettin ?? "" }}</strong></CENTER>
        </section>

        <section style="width: 100%; margin-top: 15px;">
            <div style="width: 100%; text-align: center;">
                <div style="width: 33%; float: left;"><strong>Produit</strong> : YAKO ETERNITE</div>
                <div style="width: 33%; float: left;"><strong>Conseiller</strong> : {{ Auth::user()->membre->nom ?? ""}} {{ Auth::user()->membre->prenom ?? ""}}</div>
                <div style="width: 33%; float: left;"><strong>Agence</strong> : {{ Auth::user()->membre->agence ?? "........"}}</div>
            </div>
            <div style="clear: both;"></div>
        </section>

 
        <section style="margin-top: 10px; margin-bottom: 0px; padding: 5px; border: 1px solid #ccc; font-family: Arial, sans-serif;">
            <div class="container-fluid">
        
                <!-- Titre -->
                <div class="adherent" style="border: 1px solid #ccc; background-color: #747171; height: 10px; padding: 3px;">
                    <h4 style="color: #fff; font-size: 12px; margin: 0;">1. ADHERENT :</h4>
                </div>
        
                <!-- Contenu -->
                <div class="content1" style="margin-top: 0px;">
        
                    <!-- Colonne gauche -->
                    <div style="width: 48%; float: left; margin-bottom: 0;">
                        <div class="nom" style="margin-bottom: 5px;">
                            <label><strong>Nom :</strong>...................................................................</label>
                        </div>
        
                        <div class="prenom" style="margin-bottom: 5px;">
                            <label><strong>Prénom :</strong> ........................................................</label>
                        </div>
        
                        <div class="birthday" style="margin-bottom: 5px;">
                            <label><strong>Date de naissance :</strong> ..........................................</label>
                        </div>
        
                        <div class="domicile" style="margin-bottom: 5px;">
                            <label><strong>Domicile :</strong> ..........................................................</label>
                        </div>
        
                        <div class="profession" style="margin-bottom: 5px;">
                            <label><strong>Profession :</strong> .......................................................</label>
                        </div>
        
                        <div class="numeropiece" style="margin-bottom: 5px;">
                            <label><strong>CNI/Passport/Attestation :</strong>................................</label>
                        </div>
        
                        <div class="civilite" style="margin-bottom: 5px;">
                            <label><strong>Genre :</strong> ...............................................................</label>
                        </div>
                    </div>
        
                    <!-- Colonne droite -->
                    <div style="width: 48%; float: right; margin-bottom: 0;">
                        <div class="lieunaissance" style="margin-bottom: 10px;">
                            <label><strong>Lieu de naissance :</strong> ..................................................</label>
                        </div>
        
                        <div class="postal" style="margin-bottom: 10px;">
                            <label><strong>Boîte Postale :</strong> ...........................................................</label>
                        </div>
        
                        <div class="employeur" style="margin-bottom: 10px;">
                            <label><strong>Employeur :</strong> .................................................................</label>
                        </div>
        
                        <div class="telephone" style="margin-bottom: 10px;">
                            <label><strong>Téléphone / Cell :</strong> .......................................................</label>
                        </div>
        
                        <div class="situation" style="margin-bottom: 10px;">
                            <label><strong>Situation Matrimoniale :</strong> .............................................</label>
                            
                        </div>
                    </div>
        
                    <!-- Clear pour éviter les flottements -->
                    <div style="clear: both;"></div>
        
                </div>
        
            </div>
        </section>
        
        

        <section>
            <div class="adherent" style="border: 1px solid #ccc; background-color: #747171; height: 10px; padding: 3px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">2. ASSURES  :</h4>
            </div>
    
            <div class="content1">
    
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom complet</th>
                        <th>Filiation</th>
                        <th>Né(e) le</th>
                        <th>Date de naissance</th>
                        <th>Résidence</th>
                        <th>Téléphone</th>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>......................</td>
                        <td>......................</td>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>......................</td>
                        <td>......................</td>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>......................</td>
                    </tr>
                    
                </table>
                
            </div>
        </section>

        <section style="margin-top: 10px">
            <div class="adherent" style="border: 1px solid #ccc; background-color: #747171; height: 10px; padding: 3px;">
                <h4 style="color: #fff; font-size: 12px; margin: 0;">2. BENEFICIAIRES  :</h4>
            </div>
    
            <div class="content1">
                <div class="idente" style="width: 100%; display: table; margin-bottom: 10px">
    
                    <div style="width: 45%; float: left; border: 1px solid #000; display: table-cell; padding: 5px">
                        <div class="terme">...............................</span>
                        </div>
                    </div>
                
                    <div style="width: 50%; float: right; border: 1px solid #000; display: table-cell; padding: 5px">
                        <div class="terme">
                            <u>En cas de décès avant terme du contrat :</u> <span>......................................</span>
                        </div>
                    </div>
                
                </div>
                
    
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <th>Nom</th>
                        <th>Filiation</th>
                        <th>Né(e) le</th>
                        <th>Lieu naissance</th>
                        <th>Telephone</th>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.................</td>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.................</td>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.....................</td>
                        <td>.................</td>
                    </tr>
                </table>
                
                
            </div>
        </section>


        <section style="margin-top: 20px; padding: 5px; border: 1px solid #ccc; font-family: Arial, sans-serif;">
            <div class="container">
        
                <!-- Titre de la section -->
              
                <div class="adherent" style="border: 1px solid #ccc; background-color: #747171; height: 10px; padding: 3px;">
                    <h4 style="color: #fff; font-size: 12px; margin: 0;">3. GARANTIE & PRIMES :</h4>
                </div>
        
                <!-- Contenu avec le tableau -->
                <div class="content1" style="margin-top: 10px; padding: 10px; border: 1px solid #ddd;">
        
                    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th style="text-align: center; padding: 8px;">Périodicité</th>
                                <th style="text-align: center; padding: 8px;">Option/Capital</th>
                                <th style="text-align: center; padding: 8px;">Prime</th>
                                <th style="text-align: center; padding: 8px;">Total Primes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 8px;">......................</td>
                                <td style="text-align: center; padding: 8px;">...................</td>
                                <td style="text-align: center; padding: 8px;">...................</td>
                                <td style="text-align: center; padding: 8px;">.................</td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <div class="content1">
    
                        <table border="1"  width="100%">
                            <thead>
                                <tr>
                                    <th>Capital souscrit</th>
                                    <th>Date effet</th>
                                    <th>Duré</th>
                                    {{-- <th>Echeance</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>......................</td>
                                    <td>......................</td>
                                    <td>......................</td>
                                    {{-- <td>{{ $contrat->echeance ?? "" }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
        
                </div>
        
            </div>
        </section>

        <section style="margin-top: 20px; padding: 5px; border: 1px solid #ccc; font-family: Arial, sans-serif;">
            <div class="container">


                <div class="adherent" style="border: 1px solid #ccc; background-color: #747171; height: 10px; padding: 3px;">
                    <h4 style="color: #fff; font-size: 12px; margin: 0;">4. PAIEMENT DES PRIMES :</h4>
                </div>
        
                <!-- Contenu avec le tableau -->
                <div class="content1" style="margin-top: 5px; padding: 5px; border: 1px solid #ddd;">
        
                    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th style="text-align: left; padding: 8px;">Mode de paiement</th>
                                <th style="text-align: center; padding: 8px;">Agence</th>
                                <th style="text-align: center; padding: 8px;">Organisme</th>
                                <th style="text-align: center; padding: 8px;">N° Compte</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 8px;">...................</td>
                                <td style="text-align: center; padding: 8px;">....................</td>
                                <td style="text-align: center; padding: 8px;">...............................</td>
                                <td style="text-align: center; padding: 8px;">................................</td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>
        
            </div>
        </section>


        <section style="margin-top: 30px">
            <div class="identiteee" style="width: 100%">
                <div style="width: 48%; float: left; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">

                    <div class="sign-yako">

                        <span>Reservé à YAKO AFRICA Assurances Vie</span>
                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 200px">
                        </div>
                    </div>
                </div>

                <div style="width: 48%; min-height: 127px; float: right; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">

                    <div class="nom">

                        <label for="nom"><strong>Nom du conseiller :</strong> {{ Auth::user()->membre->nom ?? ""}} {{ Auth::user()->membre->prenom ?? ""}}</label>

                        <br><br>

                        <label for="prenom">Signature du Souscripteur</label>

                        <div style="width: 100%;">
                            
                        </div>
                    </div>

                </div>
            </div>
        </section>

       

    </div>

</body>

</html>

