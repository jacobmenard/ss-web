<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .[id*='mail-wrapper'] {
        font-family: 'Montserrat', sans-serif;
    }
</style>

<div id="email-wrapper" style="font-family: 'Montserrat', sans-serif; color: #000000;">
    <!-- An unexamined life is not worth living. - Socrates -->
     

    <div>
        Dear <strong>{{$data['name']}}</strong>
    </div>
    <p>
        Thank you for attending our event and submitting your match form.
        <br>
        We've received your selections and are excited to process your matches soon!
    </p>

    <p><strong>Your Selections</strong></p>
    
    <a href="{{$data['matchup_url']}}">
        Click here to view the summary of the selections you made
    </a>
    <br><br>
    <p>
        With love,
        <br>
        Sips & Sparks
    </p>
</div>
