<div class="form-group {{ $errors->has('category_name') ? 'has-error' : ''}}">
    <label for="category_id" class="control-label">{{ 'select Category' }}</label>
    <select name="category_id" class="form-control" id="category_id" >
    @foreach ($category as $cat)
        <option value="{{ $cat->id }}" >{{ $cat->category_name }}</option>
    @endforeach
</select>
   
</div>
<div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    <label for="product_name" class="control-label">{{ 'Product Name' }}</label>
    <input class="form-control" name="product_name" type="text" id="product_name" value="{{ isset($product->name) ? $product->name : old('product_name')}}" >
    {!! $errors->first('product_name', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_code') ? 'has-error' : ''}}">
    <label for="product_code" class="control-label">{{ 'Product Code' }}</label>
    <input class="form-control" name="product_code" type="text" id="product_code" value="{{ isset($product->code) ? $product->code : old('product_code')}}" >
    {!! $errors->first('product_code', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_color') ? 'has-error' : ''}}">
    <label for="product_color" class="control-label">{{ 'Product Colour' }}</label>
    <input class="form-control" name="product_color" type="text" id="product_color" value="{{ isset($product->colour) ? $product->colour : old('product_color')}}" >
    {!! $errors->first('product_color', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_description') ? 'has-error' : ''}}">
    <label for="product_description" class="control-label">{{ 'Product Description' }}</label>
    <textarea class="form-control" rows="5" name="product_description" type="textarea" id="product_description">{{ isset($product->description) ? $product->description : old('product_description')}}</textarea>
    {!! $errors->first('product_description', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
    <label for="product_price" class="control-label">{{ 'Product Price' }}</label>
    <input class="form-control" name="product_price" type="text" id="product_price" value="{{ isset($product->price) ? $product->price : old('product_price')}}" >
    {!! $errors->first('product_price', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('file') ? 'has-error' : ''}}">
    <label for="file" class="control-label">{{ 'Upload Product Image' }}</label>
    <input type="file" name="image" class="form-control">
    <input name="image_old" type="hidden" value="{{ isset($product->image) ? $product->image : old('image')}}">
    {!! $errors->first('image', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($product) && 1 == $product->status) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($product)) {{ (0 == $product->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('status', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
