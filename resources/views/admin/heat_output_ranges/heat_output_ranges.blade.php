@extends('layouts.new')

@section('content')
 <div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>Testimonial</a></li>
    </ul>
</div>
<div class="inner-container" style="max-width: 1000px;">
    <div class="admin-toolbar">
        <a href="/heatOutputRanges/add" class="action-btn">Add</a>
    </div>
    <div class="spacer"></div>
    <!-- Content place     -->
    {{ $data->links() }}
    <table class="table services-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->name}}</td>
                <td>{!! $row->active ? '<i class="material-icons">visibility</i>' : '<i class="material-icons">visibility_off</i>' !!}</td>
                <td id="{{$row->id}}"  class="table-action-btn-place" style="width:100px">
                    <a href="heatOutputRanges/edit/{{$row->id}}" rel="heatOutputRanges" title="Edit"><i class="material-icons">edit</i></a>
                    <a href="javascript:void(0)" rel="heatOutputRanges" class="delete_new" title="Delete"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
    
</div>
@endsection

 

