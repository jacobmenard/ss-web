<script setup lang="ts">

    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const router = useRouter()
    function goToListview() {
        router.push({ path: "match-form/selection" })
    }

</script>
<template>
    <div class="mf-listview d-flex flex-column align-items-center">
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
            </template>

            <template #sub-header>
                Click the name to write notes and make selections. 
            </template>
        </header-title-one>

        <div class="mf-listviiew-wrapper w-100 h-100 margin-bottom-60">

            <card-match-form>
                <template #img>
                    <img src="~assets/images/matchform/user1.svg" alt="">
                </template>
                <template #name>
                    <span>christine</span>
                </template>
            </card-match-form>

            <card-match-form>
                <template #img>
                    <img src="~assets/images/matchform/user2.svg" alt="">
                </template>
                <template #name>
                    <span>debra</span>
                </template>
            </card-match-form>

            <card-match-form>
                <template #img>
                    <img src="~assets/images/matchform/user3.svg" alt="">
                </template>
                <template #name>
                    <span>jennifer</span>
                </template>
            </card-match-form>
            
        </div>


    </div>
</template>