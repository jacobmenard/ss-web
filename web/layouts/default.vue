<script lang="ts" setup>

    const us = useUserStore()

    function hideMatchResult() {
        us.setOpenMatchupResultFinal(false, null, null, null)
    }
</script>

<template>
    <div class="default-container">

        <!-- <header-main></header-main> -->

        <slot></slot>
        <b-offcanvas v-model="us.is_open_matchup_result" class="max-width-700 w-100" placement="end" title="USER MATCH INFORMATION" @hide="us.setOpenMatchupResultFinal(false, null, null)">
            <sidebar-match-result v-if="us.is_open_matchup_result" :info="us.matchup_info" :event="us.user_event" :showType="us.match_show_type"></sidebar-match-result>
        </b-offcanvas>

        <b-offcanvas v-model="us.is_open_user_information" class="w-100 max-width-1100" placement="end" title="ACCOUNT INFORMATION" @hide="us.setOpenUserInformation(false)">
            <sidebar-user-information :open="us.is_open_user_information"></sidebar-user-information>
        </b-offcanvas>
    </div>
</template>

<style lang="scss">
    .matchresult-container {
        
    }
</style>