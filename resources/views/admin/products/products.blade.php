@extends('layouts.new')

@section('content')
 <div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>Products</a></li>
    </ul>
</div>
<div class="inner-container" style="max-width: 1500px;">
    <div class="admin-toolbar">
        <a href="/products/add" class="action-btn">Add</a>
    </div>
    <div class="spacer"></div>
    <!-- Content place     -->
    {{ $data->links() }}
    <table class="table services-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Product Code</th>
            <th>Heat Output</th>
            <th>Fireplace Size</th>
            <th>Fuel Type</th>
            <th>Fireplace Type</th>
            <th>Fireplace Size Range</th>
            <th>Heat Output Range</th>
            <th>Price Range</th>
            <th>Image</th>
            <th>Active</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->name}}</td>
                <td>{{ $row->description ? $row->description : '' }}</td>
                <td>{{ $row->product_code ? $row->product_code : '' }}</td>
                <td>{{ $row->heat_output ? $row->heat_output : '' }}</td>
                <td>{{ $row->fireplace_size ? $row->fireplace_size : '' }}</td>
                <td>{{ $row->fuelType ? $row->fuelType->name : '' }}</td>
                <td>{{ $row->fireplaceType ? $row->fireplaceType->name : '' }}</td>
                <td>{{ $row->fireplaceSizeRange ? $row->fireplaceSizeRange->name : '' }}</td>
                <td>{{ $row->heatOutputRange ? $row->heatOutputRange->name : '' }}</td>
                <td>{{ $row->priceRange ? $row->priceRange->name : '' }}</td>
                <td style="text-align: center"><img src="/images/products/{{$row->image . '?' . time() }}" style="width: 100px;"/></td>
                <td>{!! $row->active ? '<i class="material-icons">visibility</i>' : '<i class="material-icons">visibility_off</i>' !!}</td>
                <td id="{{$row->id}}"  class="table-action-btn-place" style="width:150px">
                    <a href="products/edit/{{$row->id}}" rel="products" title="Edit"><i class="material-icons">edit</i></a>
                    <a href="product_documents/{{$row->id}}" rel="products" title="Add files"><i class="material-icons">add files</i></a>
                    <a href="javascript:void(0)" rel="products" class="delete_new" title="Delete"><i class="material-icons">delete</i></a>
                    <a href="options/{{$row->id}}"><i class="material-icons">build</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
    
</div>
@endsection

 

