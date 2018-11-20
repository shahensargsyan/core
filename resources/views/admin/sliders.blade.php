@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a href="/sliders">Sliders</a></li>
    </ul>
</div>
<!-- Content place     -->
<div class="inner-container" style="max-width: 700px;">
    <div class="admin-toolbar">
        <!--<button class="action-btn">Add</button>-->
        <a href="/sliders/add" class="action-btn">Add</a>
    </div>
    <div class="spacer"></div>
    {{ $data->links() }}
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Visible</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{$row->name}}</td>
                <td>{{$row->description}}</td>
                <td style="text-align: center"><img src="/images/sliders/{{$row->image . '?' . time() }}" style="width: 100px;"/></td>
                <td>{!! $row->active ? '<i class="material-icons">visibility</i>' : '<i class="material-icons">visibility_off</i>' !!}</td>
                <td id="{{$row->id}}" class="table-action-btn-place" style="width:100px">
                    <a href="sliders/edit/{{$row->id}}" rel="sliders" title="Edit"><i class="material-icons">edit</i></a>
                    <a href="javascript:void(0)" rel="sliders" class="delete_new" title="Delete"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
    
@endsection
