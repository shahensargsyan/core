@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>{{ Route::currentRouteNamed('fuel_types_add') ? 'Add' : 'Edit' }} Fuel type</a></li>
    </ul>
</div>

<div class="inner-container" style="max-width: 400px;">
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
        <form class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('fuel_types_add') ? '/fuel_types/add' : '/fuel_types/edit' }}" autocomplete="off">
            <input type="hidden" name="id" value="{{ $edit_id or '' }}">
            <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('service_add') ? 'POST' : 'PUT' }}">

            {{ csrf_field() }}


            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ !is_null(old('name')) ? old('name') : (isset($data) ? $data->name : '') }}" />
            </div>



            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" rows="5" style="resize: none">{{ !is_null(old('description')) ? old('description') : (isset($data) ? $data->description : '') }}</textarea>
            </div>

            <div style="height:20px; "></div>
            <div class="form-group" style="text-align:right">
                <label class="control-label" style="display: inline; margin-right: 15px;">Active</label>
                <input name="active" value="1" type="checkbox" {{ !is_null(old('active')) && old('active') == 1 ? 'checked' : ((isset($data) && $data->active == 0) ? '' : 'checked') }} />
            </div>

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
                                    @if(isset($data) && $data->image)
                                        <img src="/images/fuel_types/{{ $data->image }}?{{ time() }}" alt=""/>
                                    @endif
                                   <input type="file" name="file" class="ip-file"  />
                                   <input type = "hidden" name = "image" id = "image">
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
                    <a href="/fuel_types" class="action-btn btn-cancel"> Cancel  </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
