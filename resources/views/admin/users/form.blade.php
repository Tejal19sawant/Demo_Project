<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : old('name')}}">
    {!! $errors->first('name', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    <label for="lastname" class="control-label">{{ 'Lastname' }}</label>
    <input class="form-control" name="lastname" type="text" id="lastname" value="{{ isset($user->lastname) ? $user->lastname : old('lastname')}}">
    {!! $errors->first('lastname', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : old('email')}}">
    {!! $errors->first('email', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="">
    {!! $errors->first('password', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('confirmpassword') ? 'has-error' : ''}}">
    <label for="confirmpassword" class="control-label">{{ 'Confirmpassword' }}</label>
    <input class="form-control" name="confirmpassword" type="text" id="confirmpassword" value="">
    {!! $errors->first('confirmpassword', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($user) && 1 == $user->status) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($user)) {{ (0 == $user->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('status', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'Role' }}</label>
    <select name="role" class="form-control" id="role" >
    <!-- @foreach (json_decode('{"Customer": "Customer", "Superadmin": "Superadmin", "Admin": "Admin", "Inventory Manager":"Inventory Manager", "Order Manager":"Order Manager"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($user->role) && $user->role == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach -->
    @foreach($role as $rl)
        <option value="{{$rl->id}}" {{$rl->id == $rl->name ? 'selected' : ''}}>{{$rl->name }}</option>
    @endforeach
</select>
    {!! $errors->first('role', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
