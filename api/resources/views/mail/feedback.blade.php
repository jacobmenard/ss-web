<style>
    
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    #feedback {
        font-family: 'Montserrat', sans-serif;
    }

</style>
<div id="feedback">
    <div>
        <span>From: <strong>{{$data['name']}}</strong></span>
    </div>
    <div>
        <span>Email address: <strong>{{$data['email']}}</strong></span>
    </div>
    <div>
        <span>Event: </span><a href="{{$data['event_url']}}"><strong>{{$data['event_name']}}</strong></a>
    </div>
    <br><br>

    <div>
        @if($data['host_points'] == 1)
            <strong>Host feedback ({{$data['host_points']}} point)</strong>
        @else
            <strong>Host feedback ({{$data['host_points']}} points)</strong>
        @endif
        <br>
        <p>
            {{$data['host_feedback']}}
        </p>
    </div>
    <br>
    <div>
        @if($data['venue_points'] == 1)
            <strong>Venue feedback ({{$data['venue_points']}} point)</strong>
        @else
            <strong>Venue feedback ({{$data['venue_points']}} points)</strong>
        @endif
        <br>
        <p>
            {{$data['venue_feedback']}}
        </p>
    </div>
    <br>
    <div>
        @if($data['event_points'] == 1)
            <strong>Event feedback ({{$data['event_points']}} point)</strong>
        @else
            <strong>Event feedback ({{$data['event_points']}} points)</strong>
        @endif
        <br>
        <p>
            {{$data['event_feedback']}}
        </p>
    </div>
    <br>
    <div>
        @if($data['website_points'] == 1)
            <strong>Website feedback ({{$data['website_points']}} point)</strong>
        @else
            <strong>Website feedback ({{$data['website_points']}} points)</strong>
        @endif
        <br>
        <p>
            {{$data['website_feedback']}}
        </p>
    </div>
    <br>
    <div>
        <strong>Other feedback</strong>
        <br>
        <p>
            {{$data['other_feedback']}}
        </p>
    </div>

</div>
