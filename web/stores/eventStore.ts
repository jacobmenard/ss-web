 import { defineStore } from 'pinia';
import { EVENT_LIST, EVENT_PARTICIPANTS, EVENT_PARTICIPANT } from '@/endpoints/endpoints'
import { api } from '@/composables/useApi'
const api = useApi()
export const useEventStore = defineStore('event', {
    state: () => {
        return {
            events: [],
            list: {},
            user: {}
        }
    },
    getters: {
        getEvents(state) {
            return state.events
        },

        participantsList(state) {
            return state.list
        },

        selectedUser(state) {
            return state.user
        }
    },
    actions: {
        async getEventList() {
            const response = await api.get(EVENT_LIST)

            this.$state.events = response.data.events

            return response
        },

        async participants(payloads: any) {
            const response = await useSanctumFetch(EVENT_PARTICIPANTS, {
                params: payloads
            })
            const resData = response.data.value

            this.$state.list = resData.data
            return resData
        },

        async getParticipant(payloads: any) {
            this.$state.user = null 
            const response = await useSanctumFetch(`${EVENT_PARTICIPANT}/${payloads.id}`)
            const resData = response.data.value
            console.log(resData.data)
            this.$state.user = resData.data
            return resData
        }
    },
});
