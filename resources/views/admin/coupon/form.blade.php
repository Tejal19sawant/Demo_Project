<div class="form-group {{ $errors->has('coupon_code') ? 'has-error' : ''}}">
    <label for="coupon_code" class="control-label">{{ 'Coupon Code' }}</label>
    <input class="form-control" name="coupon_code" type="text" id="coupon_code" value="{{isset($coupon->coupon_code) ? $coupon->coupon_code : old('coupon_code')}}" >
    {!! $errors->first('coupon_code', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="text" id="amount" value="{{isset($coupon->amount) ? $coupon->amount : old('amount')}}" >
    {!! $errors->first('amount', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount_type') ? 'has-error' : ''}}">
    <label for="amount_type" class="control-label">{{ 'Amount Type' }}</label>
    <select name="amount_type" class="form-control" id="amount_type" >
   
        <option value="Percentage" {{$coupon->amount_type=='Percentage' ? 'selected' : ''}}>Percentage</option>
        <option value="Fixed" {{$coupon->amount_type=='Fixed' ? 'selected' : ''}}>Fixed</option>
        
</select>
    {!! $errors->first('amount_type', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('expiry_date') ? 'has-error' : ''}}">
    <label for="expiry_date" class="control-label">{{ 'Expiry Date' }}</label>
    <input class="form-control" type="date" id="expiry_date" name="expiry_date" value="{{isset($coupon->expiry_date) ? $coupon->expiry_date : old('expiry_date')}}">
    {!! $errors->first('expiry_date', '<p class="help-block" style="color:red;">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($coupon) && 1 == $coupon->status) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($coupon)) {{ (0 == $coupon->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
