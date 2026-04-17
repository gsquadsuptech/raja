<form action="{{ url('users') }}" method="POST" class="uk-form-stacked">
    @csrf
    @foreach($fields as $field)
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="fullname">Prénom<span class="req">*</span></label>
                    <input type="text" name="firstname"  class="md-input {{ $errors->has('firstname') ? 'md-input-danger' : '' }}" value="{{ old('firstanme') }}" />
                    {!! $errors->first('firstname', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="email">Nom<span class="req">*</span></label>
                    <input type="text" name="lastname"   class="md-input {{ $errors->has('lastname') ? 'md-input-danger' : '' }}" value="{{ old('lastname') }}" />
                    {!! $errors->first('lastname', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="email">Email<span class="req">*</span></label>
                    <input type="email" name="email"   class="md-input {{ $errors->has('email') ? 'md-input-danger' : '' }}" value="{{ old('email') }}" />
                    {!! $errors->first('email', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="parsley-row">
                    <label for="val_birth">Mot de passe<span class="req">*</span></label>
                    <input type="password" name="password"  class="md-input {{ $errors->has('password') ? 'md-input-danger' : '' }}" value="{{ old('password') }}" />
                    {!! $errors->first('password', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                </div>
            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <label for="val_select" class="uk-form-label">Role*</label>
                <div class="parsley-row">
                    <select class="md-input {{ $errors->has('role_id') ? 'md-input-danger' : '' }}" value="{{ old('role_id') }}" name="role_id" >
                        <option value="">Choose..</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('role_id', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <label for="val_select" class="uk-form-label">Active*</label>
                <div class="parsley-row">
                    <select class="md-input" name="is_active" >
                        <option value="0">Inactive</option>
                        <option value="1" selected>Active</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <a href="{{ url('users') }}" class="md-btn md-btn-default">Annuler</a>
                <button type="submit" class="md-btn md-btn-primary">Ajouter</button>
            </div>
        </div>
    @endforeach
</form>