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
        Great news! We've finished processing all match selections from our recent event, and your results are ready.
        <br>
    </p>
    
    <a href="{{$data['matchup_url']}}">
        Click here to view your matches!
    </a>
    <br><br>

    <p>So What Happens Next?</p>
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
    <p>If you had a fun time and want to help us spread the word, we'd be so appreciative if you could take a moment to leave us a 5-star review on <a href="https://www.facebook.com/sipsandsparks/reviews">Facebook</a> or <a href="https://g.page/r/CanCEGrfvuRWEAE/review">Google</a>. As a thank you, we'll send you a 20% off promo code for your next event!.
        <p>Think we can still improve and haven't yet earned that 5-star rating from you? Please email us privately and let us know how, and we'll still send you the same discount code for helping us make our future events even better!</p>
        <p>Thank you for participating in our event and trusting us with your connections. We hope the matches we've provided lead to meaningful relationships, whether romantic or platonic.</p>
        <p>Didn't quite find what you were looking for? Check out some of our other upcoming events:</p>
        <br>
        <!-- <div style="display: flex; gap: 10px; align-items: center;">
            <a href="https://www.eventbrite.com/o/sips-sparks-73343957833" style="display: flex; margin: 0px 10px;">
                <img src="https://sipsandsparks-fileupload.s3.us-east-2.amazonaws.com/eventbrite.png" height="30" alt="">
            </a>
            <br>
            <a href="https://sipsandsparks.com" style="display: flex; margin: 0px 10px;">
                <img src="https://sipsandsparks-fileupload.s3.us-east-2.amazonaws.com/rectangle_logos.png" height="50" alt="">
            </a>
            <br>
            <a href="https://linktr.ee/sipsandsparks" style="display: flex; margin: 0px 10px;">
                <img src="https://sipsandsparks-fileupload.s3.us-east-2.amazonaws.com/Linktree_logo.svg.png" height="30" alt="">
            </a>
        </div> -->
        <div style="display: flex; gap: 16px; align-items: center;">
            <a href="https://www.eventbrite.com/o/sips-sparks-73343957833">Eventbrite</a>&nbsp;&nbsp;&nbsp;
            <a href="https://sipsandsparks.com">Sipsandsparks website</a>&nbsp;&nbsp;&nbsp;
            <a href="https://linktr.ee/sipsandsparks">Linktree</a>&nbsp;&nbsp;&nbsp;
        </div>
        

    </p>
    <br>
    <p>
        Wishing you the best,
        <br>
        Sips & Sparks
    </p>
</div>
