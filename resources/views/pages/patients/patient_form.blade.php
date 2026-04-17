<div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
    <div class="uk-width-1-1">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3">
                {{ Form::label('prenom', 'Prénom(s) *') }}
                {{ Form::text('prenom', old('prenom'), array('class'=>' md-input'.($errors->has('prenom') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('prenom', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-3">
                {{ Form::label('nom', 'Nom *') }}
                {{ Form::text('nom', old('nom'), array('class'=>' md-input'.($errors->has('nom') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('nom', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    {{ Form::label('date_naissance', 'Date de naissance') }}
                    {{ Form::text('date_naissance', old('date_naissance'),array('data-uk-datepicker'=>"{format:'DD/MM/YYYY'}",'class'=>'md-input'.($errors->has('date_naissance') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('date_naissance', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3">
                {{ Form::label('sexe', 'Sexe *') }}
                {{ Form::select('sexe', [null => '- Sexe -', 'M' => 'Masculin', 'F' => 'Féminin'], old('sexe'),array('data-md-selectize', 'data-md-selectize-bottom','class'=>'md-input'.($errors->has('sexe') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('sexe', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-3">
                {{ Form::label('telephone', 'Téléphone *') }}
                {{ Form::text('telephone', old('telephone'),array('class'=>'md-input'.($errors->has('telephone') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('telephone', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-3">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', old('email'),array('class'=>'md-input'.($errors->has('email') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('email', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                {{ Form::label('adresse', 'Adresse') }}
                {{ Form::textarea('adresse', old('adresse'),array('rows'=>'3', 'class'=>'md-input'.($errors->has('adresse') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('adresse', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
    </div>
</div>
