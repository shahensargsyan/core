@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>{{ Route::currentRouteNamed('services_add') ? 'Add' : 'Edit' }} Service</a></li>
    </ul>
</div>

<div class="inner-container" style="max-width: 400px;">  
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
    <!-- Content place     -->
    <div class="form-container">
        <form class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('services_add') ? '/services/add' : '/services/edit' }}" autocomplete="off">
            <input type="hidden" name="id" value="{{ $edit_id or '' }}">
            <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('service_add') ? 'POST' : 'PUT' }}">

            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-input" name="name" value="{{ !is_null(old('name')) ? old('name') : (isset($service) ? $service->name : '') }}" />
            </div>
            
            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-input" name="description" rows="5" style="resize: none">{{ !is_null(old('description')) ? old('description') : (isset($service) ? $service->description : '') }}</textarea>
            </div>

            
            <div style="height:10px; "></div>
            <div class="form-group" style="text-align:right">
                <label class="control-label" style="display: inline; margin-right: 15px;">Active</label>
                <input name="active" value="1" type="checkbox" {{ !is_null(old('active')) && old('active') == 1 ? 'checked' : ((isset($service) && $service->active == 0) ? '' : 'checked') }} />
            </div>
            <div style="height:10px; "></div>

            <div class="form-group">
                <label class="control-label">Upload Image</label>

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
                                @if(isset($service) && $service->image)
                                    <img src="/images/services/{{ $service->image }}?{{ time() }}" alt=""/>
                                @endif
                               <input type="file" name="file" class="ip-file"  />
                               <input type = "hidden" name = "image" id = "image">
                               <input type = "hidden" name = "image_name" value="{{ $name }}">
                        </div>
                </div>
            </div>

            <div style="height:20px; "></div>
            <div class="form-group" style="text-align:right">
                <div class="">
                    <button type="submit" class="action-btn" style="margin-right: 10px;">
                        Submit
                    </button>
                    <a href="/services" class="action-btn btn-cancel"> Cancel  </a>
                </div>
            </div>
            <div style="height:20px; "></div>
        </form>
    </div>
</div>
@endsection
