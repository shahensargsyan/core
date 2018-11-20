@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a href="/services">Edit custom information</a></li>
    </ul>
</div>
<!-- Content place     -->
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
        <form class="form-horizontal" role="form" method="POST" action="/custom_information/edit" autocomplete="off" enctype='multipart/form-data' file="true">
            <input type="hidden" name="id" value="{{ $edit_id or '' }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="form-group">
                <label class="control-label">Email</label>
                <input required type="text" class="form-control form-input" name="email" value="{{ !is_null(old('email')) ? old('email') : (isset($custom_information) ? $custom_information->email : '') }}" />
            </div>

            <div class="form-group">
                <label class="control-label">Phone Number</label>
                <input required type="text" class="form-control form-input" name="phone" value="{{ !is_null(old('phone')) ? old('phone') : (isset($custom_information) ? $custom_information->phone : '') }}" />
            </div>

            <div class="form-group">
                <label class="control-label">Address</label>
                <input required class="form-control form-input" name="address" value="{{ !is_null(old('address')) ? old('address') : (isset($custom_information) ? $custom_information->address : '') }}" />
            </div>

            <div class="form-group">
                <label class="control-label">About</label>
                <textarea required class="form-control form-input" name="about_text" rows="7" style="resize: none">{{ !is_null(old('about_text')) ? old('about_text') : (isset($custom_information) ? $custom_information->about_text : '') }}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Facebook Link</label>
                <input required type="text" class="form-control form-input" name="facebook_link" value="{{ !is_null(old('facebook_link')) ? old('facebook_link') : (isset($custom_information) ? $custom_information->facebook_link : '') }}" />
            </div>

            <div class="form-group">
                <label class="control-label">Twitter Link</label>
                <input required type="text" class="form-control form-input" name="twitter_link" value="{{ !is_null(old('twitter_link')) ? old('twitter_link') : (isset($custom_information) ? $custom_information->twitter_link : '') }}" />
            </div>

            <div class="form-group">
                <label class="control-label">Instagram Link</label>
                <input required type="text" class="form-control form-input" name="instagram_link" value="{{ !is_null(old('instagram_link')) ? old('instagram_link') : (isset($custom_information) ? $custom_information->instagram_link : '') }}" />
            </div>
            <div class="form-group">
                <label class="control-label">Google Plus Link</label>
                <input required type="text" class="form-control form-input" name="google_plus_link" value="{{ !is_null(old('google_plus_link')) ? old('google_plus_link') : (isset($custom_information) ? $custom_information->google_plus_link : '') }}" />
            </div>
             <div class="form-group">
                <label class="control-label">Yelp</label>
                <input required type="text" class="form-control form-input" name="yelp" value="{{ !is_null(old('yelp')) ? old('yelp') : (isset($custom_information) ? $custom_information->yelp : '') }}" />
            </div>

             <div class="form-group">
                <label class="control-label">Copyright</label>
                <textarea required  class="form-control form-input" name="copyright" rows="2" style="resize: none">{{ !is_null(old('copyright')) ? old('copyright') : (isset($custom_information) ? $custom_information->copyright : '') }}</textarea>
            </div>


            <div class="form-group">
                <label class="control-label">Meta title</label>
                <textarea required class="form-control form-input " name="meta_title" rows="7" style="resize: none">{{ !is_null(old('meta_title')) ? old('meta_title') : (isset($custom_information) ? $custom_information->meta_title : '') }}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Meta keywords</label>
                <textarea required class="form-control form-input " name="meta_keywords" rows="7" style="resize: none">{{ !is_null(old('meta_keywords')) ? old('meta_keywords') : (isset($custom_information) ? $custom_information->meta_keywords : '') }}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Meta description</label>
                <textarea required class="form-control form-input " name="meta_description" rows="7" style="resize: none">{{ !is_null(old('meta_description')) ? old('meta_description') : (isset($custom_information) ? $custom_information->meta_description : '') }}</textarea>
            </div>

            <script>
                CKEDITOR.replace('editor1');
            </script>
             <div style="height:20px; "></div>
            <div class="form-group" style="text-align:right">
                <div class="">
                    <button type="submit" class="action-btn" style="margin-right: 15px;">
                    Submit
                </button>
                    <a href="/custom_information" class="action-btn btn-cancel"> Cancel  </a>
                </div>
            </div>
            <div style="height:50px; "></div>
        </form>
        
    </div>
</div>



@endsection
