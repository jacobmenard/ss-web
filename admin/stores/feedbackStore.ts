import { defineStore } from 'pinia';
import { FEEDBACK_LIST } from '@/endpoints/endpoints'

export const useFeedbackStore = defineStore('feedbackStore', {
    state: () => ({
        list: {}
    }),
    getters: {
        feedbackList(state) {
            if (state.list) {
                return state.list.data
            }
        },

        getlink(state) {
            if (state.list) {
                return state.list.links
            }
        }
    },
    actions: {
        async userFeedback(payloads: any) { 
            const response = await useSanctumFetch(FEEDBACK_LIST, {
                params: payloads
            })

            const resData = response.data.value
            this.$state.list = resData
            return resData
        }
    },
});
