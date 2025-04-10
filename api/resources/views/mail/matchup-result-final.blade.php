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
        Great news! We've finished processing all match selections from our recent event, and your results are ready.
        <br>
    </p>

    <p><strong>Your Selections</strong></p>
    
    <a href="{{$data['matchup_url']}}">
        Click here to view the summary of the selections you made
    </a>
    <br><br>

    <p>What's Next?</p>
    <ol>
        <li>
            <p>
                <strong>Reach Out:</strong> Take the initiative to contact your matches! We recommend sending a message within the next 48 hours while the connection is still fresh.
            </p>
        </li>
        <li>
            <p>
                <strong>Plan Something Fun:</strong> Whether it's coffee, drinks, or a walk in the park, suggest a casual meetup to continue your conversation.
            </p>
        </li>
        <li>
            <p>
                <strong>Share Your Success:</strong> We love hearing success stories! Tag us in your photos using #SipsAndSparks or reply to this email to let us know how your connections develop.
            </p>
        </li>
    </ol>
    <br>
    <p>Love Our Events? Share Your Experience!</p>
    <p>We'd be thrilled if you'd take a moment to leave us a 5-star review on <a href="https://www.facebook.com/sipsandsparks/reviews">Facebook</a> or <a href="https://g.page/r/CanCEGrfvuRWEAE/review">Google</a> As a thank you, we'll send you a code for 20% off your next event! Prefer to provide feedback privately? Email us with your thoughts on how we can improve to earn your future 5-star review, and we'll still send you the 20% discount.
        <p>Thank you for participating in our event and trusting us with your connections.</p>
        <p>We hope the matches we've provided lead to meaningful relationships, whether romantic or platonic.</p>
        <p>Didn't find what you were looking for? Join our upcoming events. </p>
        <br><br>
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="https://www.eventbrite.com/o/sips-sparks-73343957833" style="display: flex; margin: 0px 10px;">
                <img src="https://sipsandsparks-fileupload.s3.us-east-2.amazonaws.com/eventbrite.png" height="30" alt="">
            </a>
            <br>
            <a href="https://sipsandsparks.com" style="display: flex; margin: 0px 10px;">
                <img src="https://sipsandsparks-fileupload.s3.us-east-2.amazonaws.com/rectangle_logos.png" height="30" alt="">
            </a>
            <br>
            <a href="https://linktr.ee/sipsandsparks" style="display: flex; margin: 0px 10px;">
                <img src="https://sipsandsparks-fileupload.s3.us-east-2.amazonaws.com/Linktree_logo.svg.png" height="30" alt="">
            </a>
        </div>
    </p>
    <br>
    <p>
        With love,
        <br>
        Sips & Sparks
    </p>
</div>
