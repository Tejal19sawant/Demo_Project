<div class="form-group {{ $errors->has('constant_name') ? 'has-error' : ''}}">
    <label for="constant_name" class="control-label">{{ 'Constant Name' }}</label>
    <input class="form-control" name="constant_name" type="text" id="constant_name" value="{{ isset($configuration->constant_name) ? $configuration->constant_name : old('constant_name')}}"  >
    {!! $errors->first('constant_name', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('constant_value') ? 'has-error' : ''}}">
    <label for="constant_value" class="control-label">{{ 'Constant Value' }}</label>
    <input class="form-control" name="constant_value" type="text" id="constant_value" value="{{ isset($configuration->constant_value) ? $configuration->constant_value : old('constant_value')}}">
    {!! $errors->first('constant_value', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
