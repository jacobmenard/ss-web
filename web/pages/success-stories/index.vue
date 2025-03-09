<template>
    <div class="success-stories-container d-flex flex-column gap-230 align-items-center">

        <header-title-one class="max-width-1100">
            <template #header>
                SUCCESS STORIES
            </template>

            <template #sub-header>
                <div class="title mt-5 mb-3">
                    <span>From Skeptics to Believers: Real Stories from Our Community</span>
                </div>
                <p>These aren't just success stories… they're reminders of what's possible when you step away from screens and into spaces designed for authentic connection. Every story began with someone deciding to try something different, to take a chance on meeting people in a new way.</p>
            </template> 
        </header-title-one>

        <card-success-stories class="ss-main-container">
            
            <template #image>
                <img src="~assets/images/romantic-connection.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #tag>
                <span class="truncate truncate--2">Alex <span class="symbol fw-bold">&</span> Jamie <span class="symbol">'</span>s Story</span>
            </template>
            
            <template #header>
                <span class="text-uppercase">An Instant Connection</span>
            </template>

            <template #content>
                <p>"I showed up to the Mix & Mini Date event with zero expectations. After months of dating app disappointments, I was honestly just going through the motions.</p>
                <p>Then Jamie sat down across from me, and something just clicked. Our short conversation felt more genuine than months of online messaging with other people. We both felt it… that rare moment of 'Oh, there you are. I've been looking for you.'</p>
                <p>Six months later, we're still together and amazed at how different this relationship feels. What sets it apart is the foundation that we met as our authentic selves from the very first moment. No carefully curated profiles, no drawn-out texting stage, just real connection from day one.</p>
                <p>To anyone hesitating about attending: someone who could become incredibly important in your life might be sitting across from you at the very next event." — Alex</p>
            </template>
        </card-success-stories>
        <card-success-stories class="ss-main-container reverse">
            <template #image>
                <img src="~assets/images/friendship.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #header>
                <span class="text-uppercase">When Friendship Becomes Your Greatest Love Story</span>
            </template>

            <template #tag>
                <span class="truncate truncate--2">Danielle <span class="symbol fw-bold">'</span>s Community</span>
            </template>

            <template #content>
                <p>"I walked into a Sips & Sparks event convinced I was there to find a boyfriend. Instead, I found my people.</p>
                <p>During the halfway break, I connected with two women over our shared love of obscure 90s bands. Later that evening, we met three others who joined our conversation. By the end of the night, we had a group text and plans to meet for brunch.</p>
                <p>Six months later, our 'Singles Six' (as we call ourselves) meet weekly for everything from hiking trips to movie nights. We've supported each other through job changes, dating wins and losses, and life's ups and downs.</p>
                <p>I'm still open to finding romance, but this unexpected friendship has brought so much joy to my life. And ironically, being part of this supportive community has made me much more confident in my dating life too.</p>
                <p>Sometimes the most meaningful connection you make isn't romantic but it becomes incredibly valuable nonetheless." — Danielle</p>
            </template>
        </card-success-stories>
        
        <card-success-stories class="ss-main-container">
            <template #image>
                <img src="~assets/images/self-love.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #header>
                <span class="text-uppercase">Rediscovering Your Worth Beyond the Swipe</span>
            </template>

            <template #tag>
                <span class="">Ryan <span class="symbol">'</span>s Transformation</span>
            </template>

            <template #content>
                <p>"Dating apps had gradually eroded my self-confidence. Each unsuccessful match felt like another piece of evidence that I wasn't enough… not attractive enough, not successful enough, not interesting enough.</p>
                <p>At my first Sips & Sparks event, something shifted. In face-to-face conversations, people responded to the real me, my enthusiasm when talking about my work, my slightly dorky sense of humor, the listening skills that never translate to a dating profile.</p>
                <p>What started as a night out turned into a journey of rediscovering my worth. Through several events, I built genuine connections while rebuilding my confidence. I realized I hadn't been failing at dating… I'd just been dating in an environment that wasn't showing my true self.</p>
                <p>Three months after my first event, I met someone wonderful. But more importantly, I met myself again… the version of me that gets excited about connection rather than anxious about rejection.</p>
                <p>For anyone who's felt diminished by modern dating: there's nothing wrong with you. You might just need a different environment to shine." — Ryan</p>
            </template>
        </card-success-stories>

        <card-success-stories class="ss-main-container">
            <template #image>
                <img src="~assets/images/self-love.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #header>
                <span class="text-uppercase">Rediscovering Your Worth Beyond the Swipe</span>
            </template>

            <template #tag>
                <span class="">Mia <span class="symbol fw-bold">&</span> Sam <span class="symbol fw-bold">'</span>s Unexpected Connection</span>
            </template>

            <template #content>
                <p>"My friend literally had to bribe me with dinner to get me to attend a Sips & Sparks event. I was convinced it would be awkward and forced—the last place I expected to meet someone special.</p>
                <p>During the Mix & Mini Date rounds, I met Sam. The conversation immediately felt different… more authentic and engaging than any dating app exchange I'd had in months. We couldn't stop laughing as we discovered our shared terrible taste in 90s movies and childhood stories.</p>
                <p>Two months later, we're still getting to know each other, and it feels completely different from past connections. Meeting face-to-face revealed our authentic selves from day one… our sense of humor, our energy, our natural dynamic together.</p>
                <p>Sometimes the best connections happen when you least expect them, and often when you're on the verge of not showing up at all." — Mia</p>
            </template>
        </card-success-stories>

        <div>
            
        </div>

    </div>
</template>

<style lang="scss">
.success-stories-container {
    @include mobile-lg {
        gap: 70px !important;
    }
    .ss-main-container {
        
        &:nth-child(odd) {
            flex-direction: row-reverse;

            @include mobile-lg {
                flex-direction: unset;
            }
        }
    }
    .ss-success-stories-button {
        width: 500px;
        height: 104px;

        @include mobile-lg {
            width: 203px;
            height: 61px;

            font-size: 12px !important;
            line-height: 12px !important;

        }
    }
}
</style>