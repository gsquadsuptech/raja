<div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
    <div class="uk-width-1-1">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                {{ Form::label('firstname', 'Prénom *') }}
                {{ Form::text('firstname', old('firstname'),array('required','class'=>'md-input'.($errors->has('firstname') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('firstname', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-2">
                {{ Form::label('lastname', 'Nom *') }}
                {{ Form::text('lastname', old('lastname'),array('required','class'=>'md-input'.($errors->has('lastname') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('lastname', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', old('email'),array('class'=>'md-input'.($errors->has('email') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('email', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-2">
                {{ Form::label('password', 'Password *') }}
                {{ Form::password('password',array('required','class'=>'req_telephone md-input'.($errors->has('password') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('password', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                {{ Form::label('role_id', 'Role') }}
                {{ Form::select('role_id', $roles, old('role_id'),array('id' => 'role_id', 'class'=>'md-input label-fixed'.($errors->has('role_id') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('role_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
            <div class="uk-width-medium-1-2">
                {{ Form::label('is_active', 'Active *') }}
                {{ Form::select('is_active', array('1'=>'Active','0'=>'Inactive'), old('is_active'),array('class'=>'md-input label-fixed'.($errors->has('is_active') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('is_active', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
    </div>
</div>
