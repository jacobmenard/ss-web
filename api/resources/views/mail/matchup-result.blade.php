<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .[id*='mail-wrapper'] {
        font-family: 'Montserrat', sans-serif;
    }
</style>

<div id="email-wrapper" style="font-family: 'Montserrat', sans-serif; color: #000000;">
    <!-- An unexamined life is not worth living. - Socrates -->
     

    <div>
        Dear {{$data['name']}},
    </div>
    <p>
        Thank you for attending our event and submitting your match form.
        <br>
        We've received your selections and are excited to process your matches soon!
    </p>

    <p><strong>Your matches</strong></p>
    
    <a href="{{$data['matchup_url']}}">
        Click here to view your matches
    </a>

    <p><strong>Want to make changes?</strong> You have until <strong>7:00 AM tomorrow</strong> to modify your selections. After this time, match results will already be sent out, and no further modifications can be made.
        <br>
        <strong>Friendly Reminder:</strong> If you selected "Friend" for someone who selected "Date" for you, you will still receive a Friend match. You don't need to select both options.
        <br>
        We hope you made some meaningful connections tonight!
        <br><br>
        With love,
        <br>
        Sips & Sparks
    </p>
</div>
