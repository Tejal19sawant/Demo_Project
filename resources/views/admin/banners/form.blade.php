<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($banner->name) ? $banner->name : old('name')}}" >
    {!! $errors->first('name', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('textstyle') ? 'has-error' : ''}}">
    <label for="textstyle" class="control-label">{{ 'Text Style' }}</label>
    <input class="form-control" name="textstyle" type="text" id="textstyle" value="{{ isset($banner->textstyle) ? $banner->textstyle : old('textstyle')}}" >
    {!! $errors->first('textstyle', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="content" >{{ isset($banner->content) ? $banner->content : old('content')}}</textarea>
    {!! $errors->first('content', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'Link' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{{ isset($banner->link) ? $banner->link : old('link')}}" >
    {!! $errors->first('link', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sortorder') ? 'has-error' : ''}}">
    <label for="sortorder" class="control-label">{{ 'Sort Order' }}</label>
    <input class="form-control" name="sortorder" type="text" id="sortorder" value="{{ isset($banner->sortorder) ? $banner->sortorder : old('sortorder')}}" >
    {!! $errors->first('sortorder', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bannerimage') ? 'has-error' : ''}}">
    <label for="bannerimage" class="control-label">{{ 'Banner Image' }}</label>
    <input class="form-control" name="bannerimage" type="file" id="bannerimage" value="{{ isset($banner->bannerimage) ? $banner->bannerimage : ''}}" >
    {!! $errors->first('bannerimage', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
