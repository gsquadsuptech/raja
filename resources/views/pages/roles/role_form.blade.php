<div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
    <div class="uk-width-1-1">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                {{ Form::label('name', 'Nom role *') }}
                {{ Form::text('name', old('name'),array('class'=>'md-input'.($errors->has('name') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('name', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
        <h3 class="heading_a">Permissions</h3>
        <div class="uk-grid" data-uk-grid-margin>
            @foreach($permission_categories as $permission_category)
                <div class="uk-width-medium-1-1">

                    <h3 class="heading_a">{{ $permission_category->categorie }}</h3>
                    @foreach($permissions as $permission)
                        @if($permission->categorie ===  $permission_category->categorie)
                            <span class="icheck-inline">
                                <input type="checkbox" name="permission[]" value="{{ $permission->id }}" 
                                @if(isset($role)) @if($role->permissions->contains($permission->id)) checked=checked @endif @endif id="" data-md-icheck />
                                <label for="" class="inline-label">{{ $permission->name }}</label>
                            </span>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
