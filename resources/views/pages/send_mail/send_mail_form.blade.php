<div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
    <div class="uk-width-1-1">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                {{ Form::label('mail', 'Email *') }}
                {{ Form::email('mail', old('mail'),array('required','class'=>'md-input'.($errors->has('mail') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('mail', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                {{ Form::label('object', 'Object') }}
                {{ Form::text('object', old('object'),array('class'=>'md-input'.($errors->has('object') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('object', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                {{ Form::label('message', 'Message *') }}
                {{ Form::textarea('message', old('message'),array('class'=>'md-input'.($errors->has('message') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('message', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
    </div>
</div>
