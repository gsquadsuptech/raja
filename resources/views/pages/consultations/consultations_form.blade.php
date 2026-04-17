<div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
    <div class="uk-width-1-1">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                {{ Form::label('date_consultation', 'Date de consultation *') }}
                {{ Form::text('date_consultation', $consultation->date_consultation ?? \Carbon\Carbon::now()->format('d/m/Y H:i'),array('placeholder'=>'Date de consultation','style'=>'width:100%; margin-top:5px','id'=>'date_consultation','class'=>'label-fixed md-input'.($errors->has('date_consultation') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('date_consultation', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-1">
                {{ Form::label('patient_id', 'Patient *') }}
                {{ Form::select('patient_id', $liste_patients, isset($patient_id) ? $patient_id : old('patient_id'),[isset($consultation)?'readonly':'', 'required',
                            'data-md-selectize', 'data-md-selectize-bottom', 'class'=>'md-input'.($errors->has('patient_id') ? ' md-input-danger' : '')]) }}
                {!! $errors->first('patient_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            @if(isset($consultation))
                <div class="uk-width-medium-1-3">
                    {{ Form::label('sexe', 'Sexe') }}
                    {{ Form::text('sexe', $consultation->patient->sexe=='M'?'Masculin':'Féminin',array('readonly','style'=>'','class'=>' md-input'.($errors->has('sexe') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('sexe', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
                <div class="uk-width-medium-1-3">
                    {{ Form::label('date_naissance', 'Date de naissance') }}
                    {{ Form::text('date_naissance', $consultation->patient->date_naissance,array('readonly','style'=>'','class'=>' md-input'.($errors->has('date_naissance') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('date_naissance', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
                <div class="uk-width-medium-1-3">
                    {{ Form::label('email', 'Adresse email') }}
                    {{ Form::text('email', $consultation->patient->email,array('readonly','style'=>'','class'=>' md-input'.($errors->has('email') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('email', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
            @endif
        </div>
    </div>
</div>
