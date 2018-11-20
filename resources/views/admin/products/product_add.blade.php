@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>{{ Route::currentRouteNamed('products_add') ? 'Add' : 'Edit' }} Product</a></li>
    </ul>
</div>

<div class="inner-container" style="max-width: 600px;">
    <!-- Content place     -->
    <div class="form-container">
        @if(Session::has('message'))
            <div class="alert alert-info">
                <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong>։<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('products_add') ? '/products/add' : '/products/edit' }}" autocomplete="off">
            <input type="hidden" name="id" value="{{ $edit_id or '' }}">
            <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('service_add') ? 'POST' : 'PUT' }}">

            {{ csrf_field() }}


            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ !is_null(old('name')) ? old('name') : (isset($data) ? $data->name : '') }}" />
            </div>
            
            <div class="form-group">
                <label class="control-label">Product Code</label>
                <input type="text" class="form-control" name="product_code" value="{{ !is_null(old('product_code')) ? old('product_code') : (isset($data) ? $data->product_code : '') }}" />
            </div>

            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" rows="5" style="resize: none">{{ !is_null(old('description')) ? old('description') : (isset($data) ? $data->description : '') }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="control-label">Additional Product Features</label>
                <textarea class="form-control" id="editor1"  name="additional_product_features" rows="5" style="resize: none">{{ !is_null(old('additional_product_features')) ? old('additional_product_features') : (isset($data) ? $data->additional_product_features : '') }}</textarea>
            </div>
                        
            <div class="form-group ">
                <label class="control-label">Fuel Type</label>
                <select name="fuel_type_id" data-placeholder="{{'Choose Fuel Type ...'}}" class="form-input chosen-select">
                    <option value=""></option>
                    @foreach($fuelType as $type)
                    <option value="{{ $type->id }}" {{ (!is_null(old('fuel_type_id')) && isset($data) && $type->id == old('fuel_type_id')) ? 'selected' : ((isset($data) && $data->fuel_type_id == $type->id ) ? 'selected'  : '') }} >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group ">
                <label class="control-label">Fireplace Type</label>
                <select name="fireplace_type_id" data-placeholder="{{'Choose Fireplace Type ...'}}" class="form-input chosen-select">
                    <option value=""></option>
                    @foreach($fireplaceType as $type)
                    <option value="{{ $type->id }}" {{ (!is_null(old('fireplace_type_id')) && isset($data) && $type->id == old('fireplace_type_id')) ? 'selected' : ((isset($data) && $data->fireplace_type_id == $type->id ) ? 'selected'  : '') }} >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group ">
                <label class="control-label">Fireplace Size</label>
                <select name="fireplace_size_range_id" data-placeholder="{{'Choose Fireplace Size ...'}}" class="form-input chosen-select">
                    <option value=""></option>
                    @foreach($fireplaceSizeRange as $type)
                    <option value="{{ $type->id }}" {{ (!is_null(old('fireplace_size_range_id')) && isset($data) && $data->id == old('fireplace_size_range_id')) ? 'selected' : ((isset($data) && $data->fireplace_size_range_id == $type->id ) ? 'selected'  : '') }} >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group ">
                <label class="control-label">Heat Output Range</label>
                <select name="heat_output_range_id" data-placeholder="{{'Choose Fireplace Size ...'}}" class="form-input chosen-select">
                    <option value=""></option>
                    @foreach($heatOutputRange as $type)
                    <option value="{{ $type->id }}" {{ (!is_null(old('heat_output_range_id')) && isset($data) && $data->id == old('heat_output_range_id')) ? 'selected' : ((isset($data) && $data->heat_output_range_id == $type->id ) ? 'selected'  : '') }} >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group ">
                <label class="control-label">Price Range</label>
                <select name="price_range_id" data-placeholder="{{'Choose Fireplace Size ...'}}" class="form-input chosen-select">
                    <option value=""></option>
                    @foreach($priceRange as $type)
                    <option value="{{ $type->id }}" {{ (!is_null(old('price_range_id')) && isset($data) && $data->id == old('price_range_id')) ? 'selected' : ((isset($data) && $data->price_range_id == $type->id ) ? 'selected'  : '') }} >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div style="height:20px; "></div>
            <div class="form-group" style="text-align:right">
                <label class="control-label" style="display: inline; margin-right: 15px;">Active</label>
                <input name="active" value="1" type="checkbox" {{ !is_null(old('active')) && old('active') == 1 ? 'checked' : ((isset($data) && $data->active == 0) ? '' : 'checked') }} />
            </div>

            <div class="form-group">
                    <label class="control-label">Upload Image (370px x 260px)</label>


                    <div data-provides="fileinput" class="fileinput fileinput-new">
                            <div class="slim" style=";min-height:100px;min-width: 100px;"
                                    data-label="Drop your image here or click here to upload"
                                    data-fetcher="/fetch_slim_avatar"
                                    data-service="/uploadSlimAvatar"
                                    data-download="true"
                                    data-push="true"
                                    data-button-upload-title="Save"
                                    data-did-init="slimInit"
                                    data-did-load="slimLoad"
                                    data-did-save="slimSave"
                                    data-did-upload="slimUpload"
                                    data-ratio="370:260">
                                    @if(isset($data) && $data->image)
                                        <img src="/images/products/{{ $data->image }}?{{ time() }}" alt=""/>
                                    @endif
                                   <input type="file" name="file" class="ip-file"  />
                                   <input type = "hidden" name = "image" id = "image">
                                   <input type = "hidden" name = "image_name" value="{{ $image_name }}">
                            </div>
                    </div>
            </div>
            
            <div class="form-group">
                    <label class="control-label">Upload Cover Image (1170px x 540px)</label>


                    <div data-provides="fileinput" class="fileinput fileinput-new">
                            <div class="slim" style=";min-height:100px;min-width: 100px;"
                                    data-label="Drop your image here or click here to upload"
                                    data-fetcher="/fetch_slim_avatar"
                                    data-service="/uploadSlimAvatar"
                                    data-download="true"
                                    data-push="true"
                                    data-button-upload-title="Save"
                                    data-did-init="slimInit"
                                    data-did-load="slimLoad"
                                    data-did-save="slimSave"
                                    data-did-upload="slimUpload"
                                    data-ratio="1170:540">
                                    @if(isset($data) && $data->cover_image)
                                        <img src="/images/product_cover_images/{{ $data->cover_image }}?{{ time() }}" alt=""/>
                                    @endif
                                    <input type="file" name="file" class="ip-file"  />
                                    <input type = "hidden" name = "cover_image" id = "cover_image">
                                    <input type = "hidden" name = "image_name" value="{{ $image_name }}">
                            </div>
                    </div>
            </div>

            <div style="height:20px; "></div>
            <div class="form-group" style="text-align:right">
                <div class="">
                    <button type="submit" class="action-btn" style="margin-right: 10px;">
                        Submit
                    </button>
                    <a href="/products" class="action-btn btn-cancel"> Cancel  </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    CKEDITOR.replace('editor1');
</script>
@endsection
