<template>
    <div class="success-stories-container d-flex flex-column gap-230 align-items-center">

        <header-title-one class="max-width-1100">
            <template #header>
                SUCCESS STORIES
            </template>

            <template #sub-header>
                Our events have been the start of countless connections, heartfelt stories, and even a few happily-ever-afters! But don’t just take our word for it—here’s what attendees have shared about their experiences
            </template>
        </header-title-one>

        <card-success-stories class="ss-main-container">
            
            <template #image>
                <img src="~assets/images/romantic-connection.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #tag>
                <span class="truncate truncate--2">Name</span>
            </template>
            
            <template #header>
                <span>romantic connection</span>
            </template>

            <template #content>
                <p>
                    Lorem ipsum dolor sit amet consectetur. Est viverra enim nunc amet. Et sed condimentum a nascetur aliquet tincidunt ultrices. Mauris diam lorem imperdiet eget vitae facilisi velit viverra morbi. Fames suspendisse risus duis tincidunt etiam pellentesque ut dolor.
                </p>
            </template>
        </card-success-stories>
        <card-success-stories class="ss-main-container reverse">
            <template #image>
                <img src="~assets/images/friendship.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #header>
                <span>friendships</span>
            </template>

            <template #tag>
                <span class="truncate truncate--2">Name</span>
            </template>

            <template #content>
                <p>
                    Lorem ipsum dolor sit amet consectetur. Est viverra enim nunc amet. Et sed condimentum a nascetur aliquet tincidunt ultrices. Mauris diam lorem imperdiet eget vitae facilisi velit viverra morbi. Fames suspendisse risus duis tincidunt etiam pellentesque ut dolor.
                </p>
            </template>
        </card-success-stories>
        
        <card-success-stories class="ss-main-container">
            <template #image>
                <img src="~assets/images/self-love.svg" class="w-100 object-fit-contain" alt="">
            </template>

            <template #header>
                <span>self love</span>
            </template>

            <template #tag>
                <span class="truncate truncate--2">Name</span>
            </template>

            <template #content>
                <p>
                    Lorem ipsum dolor sit amet consectetur. Est viverra enim nunc amet. Et sed condimentum a nascetur aliquet tincidunt ultrices. Mauris diam lorem imperdiet eget vitae facilisi velit viverra morbi. Fames suspendisse risus duis tincidunt etiam pellentesque ut dolor.
                </p>
            </template>
        </card-success-stories>

        <b-button variant="ss-default-button ss-success-stories-button">BUY TICKETS</b-button>

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