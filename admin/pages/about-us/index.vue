<template>
    <div class="ss-aboutus-container d-flex flex-column align-items-center gap-230">
        <header-title-one class="max-width-1100">
            <template #header>
                    <span class="small-title d-block">ABOUT</span>
                    SIPS <span class="symbol">&</span> SPARKS
            </template>

            <template #sub-header>
                At Sips & Sparks, we believe the best connections are made face-to-face, not through endless swiping. Our mission is simple: to create meaningful opportunities for people to meet, laugh, and connect in real life. We’re here to spark authentic interactions, foster genuine relationships, and make dating as exciting and refreshing as it should be.
                <br><br>
                Our events are designed to bring a modern twist to traditional speed dating. Hosted in vibrant, cozy venues, each gathering pairs curated conversations with a relaxed atmosphere—often over a sip of something delightful. Whether it’s a wine tasting, a coffee meetup, or a craft cocktail evening, our carefully crafted formats encourage real conversations and lasting impressions.
            </template>
        </header-title-one>

        <card-about-us class="max-width-1020">
            <template #image>
                <img src="~assets/images/aboutus1.svg" alt="">
            </template>
            <template #title>
                <span>
                    <span class="pink-color">FOUNDER</span>, ZOE CRAMER
                </span>
            </template>
            <template #content>
                <p>
                    Lorem ipsum dolor sit amet consectetur. In donec morbi malesuada mauris id quam. Amet mauris integer phasellus sed ut pellentesque pretium vitae. Cursus pellentesque pulvinar consequat purus quis at imperdiet pellentesque. Nulla quam duis nam in semper. At sit vulputate amet odio orci rhoncus ut. Tortor tincidunt sem auctor ornare aliquet pellentesque. Ac mattis viverra tellus fames scelerisque eget sit ipsum ullamcorper. Lacus eleifend nec tortor vitae dictum at hendrerit sed. Feugiat magna diam pretium integer elementum lectus quisque.
                </p>
            </template>
        </card-about-us>

        <card-about-us class="max-width-1020">
            <template #image>
                <img src="~assets/images/aboutus2.svg" alt="">
            </template>
            <template #title>
                <span>
                    <span class="pink-color">HOST</span>, PERSON ONE
                </span>
            </template>
            <template #content>
                <p>
                    Lorem ipsum dolor sit amet consectetur. In donec morbi malesuada mauris id quam. Amet mauris integer phasellus sed ut pellentesque pretium vitae. Cursus pellentesque pulvinar consequat purus quis at imperdiet pellentesque. Nulla quam duis nam in semper. At sit vulputate amet odio orci rhoncus ut. Tortor tincidunt sem auctor ornare aliquet pellentesque. Ac mattis viverra tellus fames scelerisque eget sit ipsum ullamcorper. Lacus eleifend nec tortor vitae dictum at hendrerit sed. Feugiat magna diam pretium integer elementum lectus quisque.
                </p>
            </template>
        </card-about-us>

        <card-about-us class="max-width-1020">
            <template #image>
                <img src="~assets/images/aboutus3.svg" alt="">
            </template>
            <template #title>
                <span>
                    <span class="pink-color">HOST</span>, PERSON TWO
                </span>
            </template>
            <template #content>
                <p>
                    Lorem ipsum dolor sit amet consectetur. In donec morbi malesuada mauris id quam. Amet mauris integer phasellus sed ut pellentesque pretium vitae. Cursus pellentesque pulvinar consequat purus quis at imperdiet pellentesque. Nulla quam duis nam in semper. At sit vulputate amet odio orci rhoncus ut. Tortor tincidunt sem auctor ornare aliquet pellentesque. Ac mattis viverra tellus fames scelerisque eget sit ipsum ullamcorper. Lacus eleifend nec tortor vitae dictum at hendrerit sed. Feugiat magna diam pretium integer elementum lectus quisque.
                </p>
            </template>
        </card-about-us>
    </div>
</template>

<style lang="scss" scoped>
    .ss-aboutus-container {
        @include mobile-lg {
            gap: 60px !important;
        }
        .small-title {
            @include bugaki-font(36px, 37.8px, 400, $red)
        }

        .symbol {
            @include font-custom(68px, 71.4px, 700, $red) {
                font-family: 'Montserrat', sans-serif !important;
                
                letter-spacing: -0.05em;
            }

            @include mobile-lg {
                
                font-size: 48px !important;
                line-height: 50.4px !important;
            }
        }
    }
</style>