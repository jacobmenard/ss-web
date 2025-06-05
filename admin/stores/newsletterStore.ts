import { defineStore } from 'pinia';
import { GET_NEWSLETTER } from '@/endpoints/endpoints'

export const useNewsletterStore = defineStore('newsletterStore', {
    state: () => ({
        list: []
    }),
    getters: {
        newsletters(state) {
            return state.list
        }
    },
    actions: {

        async getNewsletter(payloads: any) {
            const response = await useSanctumFetch(GET_NEWSLETTER, {
                params: payloads
            })
            const resData = response.data
            this.$state.list = resData.value.data
            return resData
        }
    },
});
