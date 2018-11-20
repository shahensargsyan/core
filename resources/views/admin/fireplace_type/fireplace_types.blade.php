@extends('layouts.new')

@section('content')
 <div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>Fireplace types</a></li>
    </ul>
</div>
<div class="inner-container" style="max-width: 1000px;">
    <div class="admin-toolbar">
        <a href="/fireplace_types/add" class="action-btn">Add</a>
    </div>
    <div class="spacer"></div>
    <!-- Content place     -->
    {{ $data->links() }}
    <table class="table services-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
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
                <td style="text-align: center"><img src="/images/fireplace_types/{{$row->image . '?' . time() }}" style="width: 100px;"/></td>
                <td>{!! $row->active ? '<i class="material-icons">visibility</i>' : '<i class="material-icons">visibility_off</i>' !!}</td>
                <td id="{{$row->id}}"  class="table-action-btn-place" style="width:100px">
                    <a href="fireplace_types/edit/{{$row->id}}" rel="fireplace_types" title="Edit"><i class="material-icons">edit</i></a>
                    <a href="javascript:void(0)" rel="fireplace_types" class="delete_new" title="Delete"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
    
</div>
@endsection

 

