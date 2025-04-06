<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .[id*='mail-wrapper'] {
        font-family: 'Montserrat', sans-serif;
    }
</style>

<div id="email-wrapper" style="font-family: 'Montserrat', sans-serif; color: #000000;">
    <!-- An unexamined life is not worth living. - Socrates -->
     

    <div>
        Dear <strong>{{$data['result'][0]['matchup_user']['first_name']}}</strong>
    </div>
    <p>
        Thank you for attending our event and submitting your match form.
        <br>
        We've received your selections and are excited to process your matches soon!
    </p>

    <p><strong>Your Selections</strong></p>
    <p>Below is a link of your summary of the selections you made:</p>
    
    <a href="{{$data['matchup_url']}}">{{$data['matchup_url']}}</a>

    <!-- @foreach ($data['result'] as $user)

    <div id="match-wrapper" >
        <div id="match-person" style="display: gap: 10px; flex; border-radius: 10px; padding: 10px; border: 1px solid #040404;">
             {{ $user->matchup_owner->first_name }}
        </div>

        <div>
            <img src="" alt="">
        </div>

        <div id="match-person" style="display: gap: 10px; flex; border-radius: 10px; padding: 10px; border: 1px solid #040404;">
             {{ $user->matchup_user->first_name }}
        </div>
    </div>

    @endforeach -->

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
