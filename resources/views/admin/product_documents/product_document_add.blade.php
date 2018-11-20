@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>Add Work Image</a></li>
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
        <form class="form-horizontal" role="form" method="POST" action="{{ Route::currentRouteNamed('product_document_add') ? '/product_documents/add' : '/product_documents/edit' }}" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $edit_id or '' }}">
            <input type="hidden" name="_method" value="{{ Route::currentRouteNamed('product_document_add') ? 'POST' : 'PUT' }}">
            {{ csrf_field() }}

            <input type="hidden" name="product_id" value="{{ $product_id or '' }}">
            
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-input" name="name" value="" />
            </div>
            
            <div class="form-group">
                <label class="control-label">Add File</label>
                <input type="file" class="form-input" name="file" accept="application/pdf" />
            </div>


            <div style="height:20px; "></div>
            <div class="form-group" style="text-align:right">
                <div class="">
                    <button type="submit" class="action-btn" style="margin-right: 10px;">
                        Submit
                    </button>
                    <a href="/product_documents" class="action-btn btn-cancel"> Cancel  </a>
                </div>
            </div>
            <div style="height:20px; "></div>
        </form>
    </div>
</div>
@endsection
