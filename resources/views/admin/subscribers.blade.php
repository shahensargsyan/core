@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a href="/subscribers">Subscribers</a></li>
    </ul>
</div>
<!-- Content place     -->
<div class="inner-container" style="max-width: 700px;">
    <a href="/subscribers/subscribersExportCsv" class="btn btn-success" title="Download">Download List (Csv)</a>
    <div class="spacer"></div>
    {{ $data->links() }}
       <table class="table">
            <thead>
            <tr>
                <th>Email</th>
                <th>Operation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->email }}</td>
                    <td id="{{$row->id}}">
                        <a href="javascript:void(0)" rel="subscribers" class="delete_new btn btn-sm btn-danger" title="Delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    {{ $data->links() }}
</div>
@endsection
