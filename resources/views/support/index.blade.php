@extends('layouts.main')
@section('content')
    <div class="page-content">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background: #e6e9ef;
                font-family: 'Segoe UI', 'Roboto', system-ui, sans-serif;
                display: flex;
                justify-content: center;
                padding: 2.5rem 1rem;
            }

            .document {
                /* max-width: 100%; */
                width: 100%;
                background: white;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
                border-radius: 12px;
                padding: 2.5rem 2.8rem;
                line-height: 1.5;
                color: #1e2b3c;
            }

            .header_main {
                font-size: 1.9rem;
                font-weight: 600;
                letter-spacing: -0.3px;
                color: #0a1a2b;
                margin-top: 0.2rem;
                margin-bottom: 0.8rem;
                border-bottom: 3px solid #d0d9e8;
                padding-bottom: 0.6rem;
            }

            .subhead {
                font-size: 0.95rem;
                color: #2c3e50;
                background: #f2f5fc;
                padding: 0.9rem 1.2rem;
                border-radius: 10px;
                margin-bottom: 2rem;
                display: flex;
                flex-wrap: wrap;
                gap: 0.8rem 2.2rem;
                border-left: 4px solid #2b6c9e;
            }

            .subhead-item {
                display: flex;
                align-items: baseline;
                gap: 0.2rem;
            }

            .subhead-item strong {
                font-weight: 600;
                color: #0f2b44;
                margin-right: 0.3rem;
            }

            h2 {
                font-size: 1.4rem;
                font-weight: 600;
                margin-top: 2rem;
                margin-bottom: 0.75rem;
                color: #1a3857;
                border-left: 6px solid #2b6c9e;
                padding-left: 0.8rem;
            }

            h3 {
                font-size: 1.15rem;
                font-weight: 600;
                margin-top: 1.6rem;
                margin-bottom: 0.4rem;
                color: #1f3e5e;
            }

            h4 {
                font-size: 1rem;
                font-weight: 600;
                margin-top: 1.2rem;
                margin-bottom: 0.2rem;
                color: #1f3e5e;
            }

            p {
                margin-bottom: 0.75rem;
            }

            ul,
            ol {
                padding-left: 1.6rem;
                margin-bottom: 0.8rem;
            }

            li {
                margin-bottom: 0.25rem;
            }

            .table-wrap {
                overflow-x: auto;
                margin: 1.2rem 0 1.8rem 0;
                border-radius: 10px;
                border: 1px solid #dde3ed;
                background: #fbfdff;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 0.9rem;
            }

            th {
                background: #e7edf7;
                color: #0a1e30;
                font-weight: 600;
                padding: 0.7rem 0.6rem;
                border: 1px solid #cdd7e6;
                text-align: center;
            }

            td {
                padding: 0.6rem 0.5rem;
                border: 1px solid #d5dfee;
                text-align: center;
                background: white;
            }

            .table-caption {
                background: #f2f6fd;
                padding: 0.3rem 0.8rem;
                font-weight: 500;
                font-size: 0.9rem;
                border-bottom: 1px solid #d0dae9;
            }

            .highlight-box {
                background: #f4f8ff;
                border-radius: 10px;
                padding: 0.8rem 1.4rem;
                margin: 1.2rem 0;
                border-left: 4px solid #1f6390;
            }

            .badge {
                display: inline-block;
                background: #1f4b70;
                color: white;
                font-weight: 600;
                font-size: 0.8rem;
                padding: 0.1rem 0.8rem;
                border-radius: 20px;
                margin-right: 0.4rem;
                letter-spacing: 0.3px;
            }

            .inline-code {
                background: #eef3fa;
                padding: 0.1rem 0.4rem;
                border-radius: 6px;
                font-weight: 500;
                color: #0f2f4a;
            }

            .divider {
                height: 2px;
                background: linear-gradient(to right, #d0dcee, transparent);
                margin: 1.8rem 0 1.2rem 0;
            }

            .clause {
                background: #f6f9ff;
                padding: 0.8rem 1.2rem;
                border-radius: 10px;
                border: 1px solid #dce5f2;
                margin: 1.2rem 0;
            }

            .list-prestations {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0.2rem 1.5rem;
                background: #fafcff;
                padding: 0.6rem 1.2rem;
                border-radius: 12px;
                border: 1px solid #e3eaf5;
                margin: 0.5rem 0 1.2rem 0;
            }

            .list-prestations li {
                list-style-type: disc;
            }

            @media (max-width: 650px) {
                .document {
                    padding: 1.5rem 1rem;
                }

                .subhead {
                    flex-direction: column;
                    gap: 0.3rem;
                }

                .list-prestations {
                    grid-template-columns: 1fr;
                }

                h1 {
                    font-size: 1.6rem;
                }
            }

            .footer-note {
                margin-top: 2.5rem;
                font-size: 0.9rem;
                color: #3b5570;
                border-top: 1px solid #d6e0ed;
                padding-top: 1rem;
                text-align: right;
            }
        </style>
        <div class="document">

            

            <div class="row header_main" style="margin-bottom: 1.5rem;">
                <div class="col-md-6">
                    <h1>FICHE PRODUIT</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ asset('assets/root/fiche_produit_cred_eternité.pdf')}}" target="_blank" class="btn btn-primary" download>Télécharger la fiche produit</a>
                </div>
            </div>

            <div class="subhead">
                <span class="subhead-item"><strong>Dénomination :</strong> Cred’ YAKO Eternité</span>
                <span class="subhead-item"><strong>Nature :</strong> Individuelle</span>
                <span class="subhead-item"><strong>Type :</strong> Mixte</span>
                <span class="subhead-item"><strong>Mode de distribution :</strong> Réseau d’agence Credafrica</span>
                <span class="subhead-item"><strong>Date de lancement :</strong> Juin 2026</span>
            </div>

            <!-- SOMMAIRE (similaire à la table des matières du PDF) -->
            <div
                style="background:#f8faff; padding: 0.6rem 1.2rem; border-radius: 10px; margin-bottom: 1.8rem; font-size:0.95rem; border:1px solid #e0e8f2;">
                <strong style="color:#143653;">Contenu</strong><br>
                Contexte · En quoi consiste le produit · Garanties · Qui peut être assuré · Capitaux · Durée · Montant des
                primes · Périodicité · Opérations · Prestations · Procédures sinistre
            </div>

            <!-- CONTEXTE -->
            <h2>Contexte</h2>
            <p>Offrir des obsèques honorables à ses proches lorsqu'ils nous quittent, leurs faire ses adieux dans la dignité
                constitue un bel hommage qui permet aux vivants d’accepter la perte de l’être cher et de vivre son deuil
                sans culpabiliser. C’est aussi un moyen d’éviter le déshonneur et les raillies dans une société qui
                sacralise les défunts. Pour toutes ces raisons, certaines personnes n’hésitent pas à s’endetter, à se ruiner
                ou même à aliéner des projets importants pour organiser des obsèques dignes à leurs proches décédés.</p>
            <p>Prévoir le financement des obsèques apparait donc comme un acte de prévoyance et de solidarité.</p>
            <p><strong>Cred’YAKO Eternité</strong> est la solution conçue par YAKO AFRICA en partenariat avec Credafrica
                pour répondre efficacement à cette préoccupation majeure.</p>

            <!-- EN QUOI CONSISTE -->
            <h2>En quoi consiste le produit Cred’YAKO Eternité ?</h2>
            <p>Cred’Yako Eternité est un produit d’assurance obsèques qui garantit la fourniture de prestations en nature
                et/ou en numéraire en cas de décès de la personne assurée. Elle peut être souscrite par toute personne
                physique domiciliée en Côte d’Ivoire, titulaire d’un compte à Credafrica, âgée d’au moins 18 ans.</p>

            <!-- GARANTIES -->
            <h2>Quelles sont les garanties proposées ?</h2>
            <p>Le contrat d’assurance « Cred’YAKO Eternité » se compose de deux garanties de base « Hommage » et « Sureté »
                et d’une garantie accessoire « Senior ».</p>

            <h3>1. La garantie « Hommage »</h3>
            <p>La garantie « Hommage » donne droit à une prestation égale à la provision mathématique.</p>

            <h3>2. La garantie « Sureté »</h3>
            <p>Cette garantie permet aux ayants droits de bénéficier d’une prestation égale au capital souscrit, en cas de
                décès de l’assuré avant le cinquième anniversaire du contrat.</p>

            <h3>3. La garantie « Senior »</h3>
            <p>La garantie « Senior », au choix de l’Adhérent, permet de couvrir un second assuré. L’assuré « Senior » doit
                être âgé d’au moins 75 ANS révolus à la date d’effet du contrat. La garantie « Senior » engage YAKO AFRICA,
                en cas de décès de l’assuré senior, au paiement d’une prestation égale à la provision constituée.</p>

            <!-- QUI PEUT ÊTRE ASSURÉ -->
            <h2>Qui peut être assuré à Cred’YAKO Eternité ?</h2>
            <p>Les garanties de base « Hommage » et « Sureté » sont souscrites sur la tête d’une personne âgée d’au moins 12
                ANS et d’au plus 74 ANS révolus à la date d’effet du contrat.</p>

            <!-- CAPITAUX -->
            <h2>Quels sont les capitaux assurés en cas de décès ?</h2>
            <p>Le capital minimum garanti est de 300 000 FCFA. Au-delà de ce minimum, les capitaux assurés vont jusqu'à 5
                000 000 FCFA.</p>
            <div class="table-wrap">
                <div class="table-caption">CAPITAUX ASSURÉS EN F CFA</div>
                <table>
                    <tr>
                        <td>300 000</td>
                        <td>500 000</td>
                        <td>750 000</td>
                        <td>1 000 000</td>
                        <td>1 250 000</td>
                        <td>1 500 000</td>
                        <td>2 000 000</td>
                    </tr>
                </table>
            </div>

            <!-- DURÉE -->
            <h2>Quelle est la durée du contrat Cred’YAKO Eternité ?</h2>
            <p>Le contrat « Cred’YAKO Eternité » est souscrit pour une durée viagère, c’est-à-dire tant que l’assuré est en
                vie. Toutefois, la durée des cotisations est limitée à cinq (5) ans.</p>

            <!-- MONTANT PRIMES -->
            <h2>Quel est le montant des primes ?</h2>
            <p>La prime au titre de la garantie « Hommage » est calculée en fonction du capital de référence. La prime en
                couverture de la garantie « Sureté » est calculée en fonction de l’âge de l’Assuré à la souscription et du
                montant du capital de référence.</p>
            <p>Le contrat Cred’YAKO Eternité prévoit des frais d’adhésion de Trois mille 3 000 FCFA payables à la
                souscription.</p>

            <!-- PERIODICITÉ -->
            <h2>Quelle est la périodicité de paiement des cotisations ?</h2>
            <p>Cred’YAKO Eternité offre la possibilité d’épargner à son rythme selon une périodicité mensuelle,
                trimestrielle, semestrielle ou annuelle.</p>

            <!-- OPÉRATIONS -->
            <h2>Quelles sont les opérations prévues au contrat Cred’YAKO Eternité ?</h2>

            <h3>❖ Rachat Partiel</h3>
            <p>Il est possible de faire des opérations de Rachat Partiel sur le contrat Cred’YAKO Eternité à condition que
                LES CINQ (5) PRIMES ANNUELLES prévues au contrat aient été effectivement payées par l’Adhérent. Le rachat
                partiel se réalise dans les limites de la valeur du fonds alloué à cet effet (50% maximum du capital
                constitué). Plus aucun Rachat partiel n’est possible après l’atteinte de la disponibilité nette du Fonds
                alloué au Rachat (50% maximum du capital constitué). La demande de rachat partiel, en cas de non atteinte de
                la limite des fonds disponible alloués à cet effet, intervient DOUZE (12) MOIS après la dernière opération
                de rachat partiel.</p>

            <h3>❖ Rachat Total</h3>
            <p>L’Adhérent peut mettre fin au contrat Cred’YAKO Eternité à tout moment. Si la résiliation intervient avant le
                paiement effectif D’UNE (1) PRIME ANNUELLE ou de 15% de l’ensemble des primes prévues au contrat, la valeur
                de rachat est nulle.</p>
            <p>En cas de paiement effectif de 15% de l’ensemble des primes prévues au contrat ou d'UNE (1) PRIME ANNUELLE,
                la valeur de rachat est égale à la somme des montants ci-après :</p>
            <ul>
                <li>La provision mathématique de la garantie « Senior » ;</li>
                <li>La provision mathématique de la garantie « Hommage » diminuée d’une pénalité de 5%. La pénalité est de
                    0% si la demande de résiliation intervient après la CINQUIEME (5ème) ANNEE d’assurance.</li>
            </ul>

            <h3>❖ Transformation</h3>
            <p>L’Adhérent peut demander une augmentation ou une diminution de son capital de référence initial « Cred’YAKO
                Eternité ». Cette opération n’est possible qu’après le paiement d’UNE (1) PRIME ANNUELLE. Toutefois, le
                délai de carence est de six (6) mois à compter de la date de la transformation.</p>
            <p>Si le décès de l’assuré survient pendant le délai de carence, le capital payé au bénéficiaire sera celui
                d’avant la transformation.</p>
            <p>Toute transformation du contrat « Cred’YAKO Eternité » fera l’objet d’un Avenant qui précisera les
                informations suivantes :</p>
            <ul>
                <li>Le nouveau capital garanti en cas de décès ;</li>
                <li>Le délai de carence ;</li>
                <li>Le montant de la nouvelle prime.</li>
            </ul>

            <!-- NATURE PRESTATIONS -->
            <h2>Quelle est la nature des prestations Cred’YAKO Eternité ?</h2>
            <p>Le capital assuré en cas de décès est servi sous forme de prestations en nature et en numéraires. Toutefois,
                l’adhérent ou les bénéficiaires désignés peuvent dans les limites du capital assuré, demander que les
                prestations soient payées entièrement en nature. Les prestations en numéraire consistent au paiement d’un
                montant égal au capital assuré à la date du décès, diminué des coûts des prestations en nature.</p>

            <div class="clause">
                <span class="badge">Clause 740</span>
                <p style="margin-bottom:0;">Si le sinistre intervient après les cinq (5) années de cotisation, l’adhérent ou
                    les bénéficiaires désignés peuvent demander le paiement des prestations entièrement en numéraires. Cette
                    disposition s’applique automatiquement lorsque l’enterrement du défunt (personne assurée) a lieu dans
                    les 48 heures qui suivent le décès.</p>
            </div>

            <h3>1- PRESTATIONS EN NATURE</h3>
            <p>Elles portent sur :</p>
            <ul class="list-prestations">
                <li>La prise en charge de l’enlèvement du corps</li>
                <li>Les soins de conservation du corps</li>
                <li>La levée de corps</li>
                <li>La prise en charge de la couronne mortuaire</li>
                <li>L’Allocation Transport funéraire pour le transport du défunt au lieu d’inhumation</li>
                <li>L’Allocation Cercueil pour l’achat du cercueil</li>
            </ul>

            <h3>2- RÉPARTITION DES PRESTATIONS EN NATURE ET EN NUMÉRAIRE</h3>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Capital de référence (en F CFA)</th>
                            <th>Montant prestations en nature (en F CFA)</th>
                            <th>Montant prestations en numéraires (en F CFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>300 000</td>
                            <td>200 000</td>
                            <td>100 000</td>
                        </tr>
                        <tr>
                            <td>500 000</td>
                            <td>300 000</td>
                            <td>200 000</td>
                        </tr>
                        <tr>
                            <td>750 000</td>
                            <td>450 000</td>
                            <td>300 000</td>
                        </tr>
                        <tr>
                            <td>1 000 000</td>
                            <td>500 000</td>
                            <td>500 000</td>
                        </tr>
                        <tr>
                            <td>1 250 000</td>
                            <td>750 000</td>
                            <td>500 000</td>
                        </tr>
                        <tr>
                            <td>1 500 000</td>
                            <td>750 000</td>
                            <td>750 000</td>
                        </tr>
                        <tr>
                            <td>2 000 000</td>
                            <td>1 000 000</td>
                            <td>1 000 000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- PROCÉDURES SINISTRE -->
            <h2>Quelles sont les procédures en cas de sinistre ?</h2>

            <h3>1- DÉCLARATION DE SINISTRE</h3>
            <p>L’Adhérent ou les représentants désignés doivent aviser YAKO AFRICA, par l’intermédiaire de la BNI, de tout
                sinistre garanti par la convention « Cred’YAKO Eternité » dès qu’ils en ont connaissance. La déclaration du
                sinistre doit être adressée à YAKO AFRICA par lettre recommandée avec accusé de réception ou tout autre
                moyen faisant foi de la réception de la déclaration par YAKO AFRICA.</p>

            <h3>2- DÉCLARATION TARDIVE</h3>
            <p>Si la déclaration du décès est faite postérieurement aux obsèques, il est payé au bénéficiaire un montant
                égal au capital acquis à la date du sinistre.</p>

            <h3>3- LES PIÈCES À FOURNIR EN CAS DE SINISTRE</h3>
            <p>La fourniture des prestations est subordonnée à la remise des pièces suivantes :</p>
            <ul>
                <li>La fiche de déclaration de sinistre, fournie par YAKO AFRICA dûment remplie ;</li>
                <li>L’original de la police d’assurance et de ses avenants, à défaut une déclaration de perte délivrée par
                    un commissariat de police ;</li>
                <li>Une copie de la carte nationale d’identité, de la carte consulaire ou de la carte de séjour de l’Assuré,
                    à défaut la copie de l’acte de naissance ou du jugement supplétif de l’assuré ;</li>
                <li>Une copie du certificat de décès délivré par un médecin ;</li>
                <li>Une copie originale de l’acte de décès délivré par une mairie ;</li>
                <li>Les pièces d’identification du bénéficiaire consistant en l’un des documents suivants : (Copie de la
                    carte nationale d’identité ; Copie de la carte consulaire ; Acte de naissance, jugement supplétif.) ;
                </li>
                <li>Une fiche d’entrée à la morgue en cas de conservation du corps ;</li>
                <li>Une facture normalisée de la morgue (si déclaration tardive) ;</li>
                <li>Un permis d’inhumer pour les prestations en numéraire, à défaut une note rédigée par le chef du village
                    notifiant l’inhumation du corps au sein de son village (Si déclaration tardive ou enterrement 48 h au
                    plus après le décès).</li>
            </ul>

            <h3>4- DÉLAI DE TRAITEMENT DES PRESTATIONS</h3>
            <p>Dans un délai de SEPT (7) JOURS suivant la remise de toutes les pièces requises, un bon de prestations est
                remis au bénéficiaire et à la société des pompes funèbres indiquant toutes les prestations à fournir. Le
                paiement des prestations en numéraire se fait dans un délai maximum de QUINZE (15) JOURS suivant la
                réception de toutes les pièces requises. Au-delà de TRENTE (30) JOURS après la remise des pièces, les
                prestations non réglées produisent de plein droit intérêts au taux d’escompte majoré de moitié durant deux
                mois, puis à l’expiration de ce délai de deux mois, au double du taux d’escompte.</p>

            <div class="footer-note">
                Fiche produit · Cred’YAKO Eternité · YAKO AFRICA &amp; Credafrica
            </div>
        </div>
    </div>
@endsection
