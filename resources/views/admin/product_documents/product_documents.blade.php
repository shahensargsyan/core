@extends('layouts.new')

@section('content')

<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a>Product</a>
        </li>
        <li>
            <a>Documents</a>
        </li>
    </ul>
</div>
<!-- Content place     -->
<div class="inner-container" style="max-width: 500px;">
    <div class="admin-toolbar">
        <a href="/product_documents/{{ $product_id }}/add" class="action-btn"><i class="fa fa-plus fa-fw"></i>Add</a>
    </div>
    <div class="spacer"></div>
    <!-- Content place     -->
     {{ $data->links() }}
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>File</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->name ? $row->name : '' }}</td>
                <td style="text-align: center">
                    <embed src="/documents/product_documents/{{ $row->file }}" style="width: 100px;"/>
                </td>
                <td id="{{$row->id}}">
                    <!-- <a href="product_documents/edit/{{$row->id}}" rel="product_documents" class="btn btn-sm btn-info" title="Edit">Edit</a> -->
                    <a href="javascript:void(0)" rel="product_documents" class="delete_new" title="Delete"> <i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
@endsection

 

