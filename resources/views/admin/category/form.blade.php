<div class="form-group {{ $errors->has('category_name') ? 'has-error' : ''}}">
    <label for="category_name" class="control-label">{{ 'Category Name' }}</label>
    <input class="form-control" name="category_name" type="text" id="category_name" value="{{ isset($category->category_name) ? $category->category_name : old('category_name')}}" >
    {!! $errors->first('category_name', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="control-label">{{ 'Parent Category' }}</label>
    <select name="parent_id" class="form-control" id="parent_id" >
   
        <option value="0" >Parent Category</option>
        @foreach($level as $lev)
        <option value="{{$lev->id}}" >{{$lev->category_name}}</option>
        @endforeach
</select>
    {!! $errors->first('parent_id', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category_description') ? 'has-error' : ''}}">
    <label for="category_description" class="control-label">{{ 'Category Description' }}</label>
    <textarea class="form-control" rows="5" name="category_description" type="textarea" id="category_description" >{{ isset($category->category_description) ? $category->category_description : old('category_description')}}</textarea>
    {!! $errors->first('category_description', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($category) && 1 == $category->status) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($category)) {{ (0 == $category->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
