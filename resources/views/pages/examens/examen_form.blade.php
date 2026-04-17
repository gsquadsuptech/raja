@if($action == 'show')

    <style>
        .blue-logo {
            color: #25366e;
        }
        @media print {
            .blue-logo {
                color: #25366e !important;
            }
        }
    </style>

    <div class="invoice_header" style="border-bottom: 1px solid rgba(0, 0, 0, 0.12); height: unset; padding: 4px;">
        <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                        <img src="{{ asset('images/logo_rabia.jpg') }}"  alt="" style="width: 300px; float: right;">

                        <h3 class="blue-logo" style="margin: 0; font-weight: 600;">DR EL HADJI MBACKE SARR</h3>
                        <h4 class="blue-logo" style="margin: 0; font-weight: 600; text-decoration: underline;">PH Cardiologue</h4>
                        <h5 class="blue-logo" style="margin: 0; font-weight: 500;">Diu Echodoppler coeur (Bordeaux)</h5>
                        <h5 class="blue-logo" style="margin: 0; font-weight: 500;">Diu Réadaptation cardiaque (Paris Diderot)</h5>
                        <h5 class="blue-logo" style="margin: 0; font-weight: 500;">Diu Cardiologue du sport (Montpellier)</h5>
                        <h5 class="blue-logo" style="margin: 0; font-weight: 500;">Explorations fonctionnelles vasculaires (CHRU LILLE)</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
        <div class="uk-width-1-1">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1 uk-text-center">
                    <h4 style="margin-bottom: 5px; text-decoration: underline;">COMPTE RENDU D'EXAMEN - {{ $examen->date_creation }}</h4>
                    <h4 style="margin: 0; text-transform: uppercase">{{ $examen->examen_modele->nom_examen }}</h4>
                </div>
                <div class="uk-width-1-1" style="margin-top: 10px">
                    <h5 style="margin:0;text-decoration: underline;text-transform: uppercase">Identité patient</h5>
                </div>
            </div>
            <div class="uk-grid" style="margin-top: 10px">
                <div class="uk-width-1-2">
                    <h4 style="margin: 5px;">Prénom(s)</h4>
                    <p style="margin: 0;">{{ $examen->consultation->patient->prenom }}</p>
                </div>
                <div class="uk-width-1-2">
                    <h4 style="margin: 5px;">Nom</h4>
                    <p style="margin: 0;">{{ $examen->consultation->patient->nom }}</p>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin style="margin-top: 10px">
                <div class="uk-width-1-2">
                    <h4 style="margin: 5px;">Sexe</h4>
                    <p style="margin: 0;">{{ $examen->consultation->patient->sexe=='M' ? 'Masculin' : 'Féminin' }}</p>
                </div>
                <div class="uk-width-1-2">
                    <h4 style="margin: 5px;">Age</h4>
                    <p style="margin: 0;">{{ $examen->consultation->patient->age }}</p>
                </div>
            </div>
        </div>
        @if($action == 'show' && $examen->examen_modele_id)
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                    <?php $index = 0; $old_categorie = ''; ?>
                    @foreach($liste_inputs as $examinput)
                        <?php
                        if($index == 4 || $examinput->categorie != $old_categorie) {
                            $index = 0;
                            echo '</div>';
                            if($examinput->categorie != $old_categorie) {
                                $old_categorie = $examinput->categorie;
                                echo '<h3 class="heading_c uk-margin-medium-top" style="text-decoration:underline;">' . $examinput->categorie . '</h3>';
                            }
                            echo '<div class="uk-grid" style="margin-top:5px">';
                        }
                        ?>
                        <div class="uk-width-1-4">
                            <?php $unite = $examinput->unite ? ' ('.$examinput->unite.')' : ''; $valeur = isset($exam_valeurs[$examinput->id]) ? $exam_valeurs[$examinput->id] : ''; ?>

                            <h5 style="margin-bottom: 2px">{{ $examinput->libelle.$unite }} : <b>{{ $valeur }}</b></h5>
                            {{--<p style="margin: 0;">{{ $valeur }}</p>--}}
                        </div>
                        <?php $index++ ?>
                    @endforeach
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1 pmarg">
                        <h3 style="margin-bottom: 5px;text-decoration: underline">Commentaires</h3>
                        <p style="margin-top: 0">{!! $examen->commentaires !!}</p>
                    </div>
                    <div class="uk-width-1-1 pmarg">
                        <h3 style="margin-bottom: 5px;text-decoration: underline">Conclusions</h3>
                        <p style="margin-top: 0">{!! $examen->conclusions !!}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{--<div class="invoice_footer" style="margin-left: -16px; margin-right: -16px">--}}
        {{--<h4 style="margin: 5px;">Docteur El Hadji M'Backé SARR - Cardiologue</h4>--}}
        {{--<p style="margin: 0;">Tél : 33 867 17 75 / 77 635 08 15 - BP : 12080 - Email : elhadjimbackesarr@gmail.com</p>--}}
    {{--</div>--}}
    <style>
        @media print{
            @page{
                margin: 0;
            }
            .invoice_header{
                margin-top: -30px;
            }
        }
    </style>
@else
    <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
        <div class="uk-width-1-1">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">
                    {{ Form::label('examen_modele_id', 'Choisir un modèle d\'examen *') }}
                    {{ Form::select('examen_modele_id', $liste_examen_modeles, old('examen_modele_id'),
                    array('required','class'=>'md-input label-fixed'.($errors->has('examen_modele_id') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('examen_modele_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
            </div>
        </div>
        @if($action == 'edit' && $examen->examen_modele_id)
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                <?php $index = 0; $old_categorie = ''; ?>
                @foreach($liste_inputs as $examinput)
                    <?php
                        if($index == 3 || $examinput->categorie != $old_categorie) {
                            $index = 0;
                            echo '</div>';
                            if($examinput->categorie != $old_categorie) {
                                $old_categorie = $examinput->categorie;
                                echo '<h3 class="heading_c uk-margin-large-top">' . $examinput->categorie . '</h3>';
                            }
                            echo '<div class="uk-grid" data-uk-grid-margin>';
                        }
                    ?>
                    <div class="uk-width-medium-1-3">
                        <?php $unite = $examinput->unite ? ' ('.$examinput->unite.')' : ''; $valeur = isset($exam_valeurs[$examinput->id]) ? $exam_valeurs[$examinput->id] : ''; ?>
                        {{ Form::label($examinput->id, $examinput->libelle. $unite) }}
                        {{ Form::number($examinput->id, old($examinput->id,$valeur),array('step'=>'any','class'=>'md-input'.($errors->has($examinput->id) ? ' md-input-danger' : ''))) }}
                        {!! $errors->first($examinput->id, '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <?php $index++ ?>
                @endforeach
                </div>

                <h3 class="heading_c uk-margin-large-top">COMMENTAIRES ET CONCLUSIONS</h3>
                <div class="uk-grid pmarg" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <h3>Commentaires</h3>
                        <?php
                            if($examen->examen_modele_id == 1){
                                $commentaire = "Cavités cardiaques de taille normale.<br>";
                                $commentaire.= "Bonne fonction systolyque globale du VG.<br>";
                                $commentaire.= "Bonne fonction systolyque longitudinale du VD.<br>";
                                $commentaire.= "Valves fines, d'ouverture normale.<br>";
                                $commentaire.= "Parois et septa étanches.<br>";
                                $commentaire.= "Péricarde normal.";
                            }else{
                                $commentaire = '';
                            }
                        ?>
                        {{ Form::textarea('commentaires', $examen->commentaires ?? $commentaire,array('rows'=>'2','class'=>'label-fixed md-input'.($errors->has('commentaires') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('commentaires', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
                <div class="uk-grid pmarg" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <h3>Conclusions</h3>
                        <?php
                        if($examen->examen_modele_id == 1){
                            $conclusion = "ECHODOPPLER CARDIAQUE NORMAL CE JOUR POUR L'AGE.";
                        }else{
                            $conclusion = '';
                        }
                        ?>
                        {{ Form::textarea('conclusions', $examen->conclusions ?? $conclusion,array('class'=>'label-fixed md-input'.($errors->has('conclusions') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('conclusions', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif