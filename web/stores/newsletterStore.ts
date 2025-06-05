import { defineStore } from 'pinia';
import { ADD_NEWSLETTER } from '@/endpoints/endpoints'

export const useNewsletterStore = defineStore('newsletterStore', {
    state: () => ({
        list: []
    }),
    getters: {

    },
    actions: {
        async storeNewsletter(payloads: any) {
            const response = await useSanctumFetch(ADD_NEWSLETTER, {
                method: 'post',
                body: payloads
            })
            const resData = response.data
            
            return resData
        },
    },
});
