@extends('layouts.new')

@section('content')
<div class="breadcrub-container">
    <ul class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li><a>Custom information</a></li>
    </ul>
</div>
<div class="inner-container" style="max-width: 700px;">
    <div class="admin-toolbar">
        <a href="/custom_information/edit/{{$custom_information->id}}" class="action-btn" title="Save" style="margin-right: 15px;">Edit</a>
    </div>
    <div class="spacer"></div>
    <!-- Content place     -->
    <table class="table services-table">
            <tbody>
                <tr>
                    @if($custom_information)
                    <tr>
                        <td>Email</td>
                        <td>{{$custom_information->email}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$custom_information->address}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$custom_information->phone}}</td>
                    </tr>
                    <tr>
                        <td>Facebook Link</td>
                        <td>{{$custom_information->facebook_link}}</td>
                    </tr>
                    <tr>
                        <td>Twitter Link</td>
                        <td>{{$custom_information->twitter_link}}</td>
                    </tr>
                    <tr>
                        <td>Instagram Link</td>
                        <td>{{$custom_information->instagram_link}}</td>
                    </tr>
                    <tr>
                        <td>Google Plus Link</td>
                        <td>{{$custom_information->google_plus_link}}</td>
                    </tr>
                    <tr>
                        <td>Copyright</td>
                        <td>{{$custom_information->copyright}}</td>
                    </tr>
                    <tr>
                        <td>Yelp</td>
                        <td>{{$custom_information->yelp}}</td>
                    </tr>                                        
                    <tr>
                        <td>About</td>
                        <td>{{$custom_information->about_text}}</td>
                    </tr>                                        
                    <tr>
                        <td>Meta title</td>
                        <td>{{$custom_information->meta_title}}</td>
                    </tr>                                        
                    <tr>
                        <td>Meta  keywords</td>
                        <td>{{$custom_information->meta_keywords}}</td>
                    </tr>                                        
                    <tr>
                        <td>Meta description</td>
                        <td>{{$custom_information->meta_description}}</td>
                    </tr>                                        
                    @endif
                </tr>
            </tbody>
        </table>
</div>
@endsection
