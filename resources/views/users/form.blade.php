
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
    <label for="company" class="col-md-2 control-label">Company</label>
    <div class="col-md-10">
        <input class="form-control" name="company" type="text" id="company" value="{{ old('company', optional($user)->company) }}" minlength="1" maxlength="255" required="true" placeholder="Enter company...">
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('rol') ? 'has-error' : '' }}">
    <label for="rol" class="col-md-2 control-label">Role</label>
    <div class="col-md-10">
        <select class="form-control select2" id="rol" name="rol">
            <option value="" style="display: none;" {{ old('rol', optional($user)->rol ?: '') == '' ? 'selected' : '' }} disabled selected>Select role</option>
            @foreach ($roles as $key => $Rol)
            <option value="{{ $key }}" {{ old('rol', optional($user)->rol) == $key ? 'selected' : '' }}>
                    {{ $Rol }}
        </option>
        @endforeach
    </select>

    {!! $errors->first('rol', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
        @if(isset($user))
        <input class="form-control" name="password" type="password" id="password" value="{{ old('password', 'nochanged') }}" minlength="1" maxlength="255" required="true" placeholder="Enter su clave...">
        @else
        <input class="form-control" name="password" type="password" id="password" value="{{ old('password') }}" minlength="1" maxlength="255" required="true" placeholder="Enter password...">
        @endif
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('password2') ? 'has-error' : '' }}">
    <label for="password2" class="col-md-2 control-label">Confirm password</label>
    <div class="col-md-10">
        @if(isset($user))
        <input class="form-control" name="password2" type="password" id="password2" value="{{ old('password2', 'nochanged') }}" minlength="4" maxlength="255" required="true" placeholder="Confirm password...">
        @else
        <input class="form-control" name="password2" type="password" id="password2" value="{{ old('password2') }}" minlength="4" maxlength="255" required="true" placeholder="Confirm password...">
        @endif
        {!! $errors->first('password2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

