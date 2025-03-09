 import { defineStore } from 'pinia';
import { EVENT_LIST, EVENT_PARTICIPANTS, EVENT_PARTICIPANT, PARTICIPANT_EVENT_LIST } from '@/endpoints/endpoints'
import { api } from '@/composables/useApi'
const api = useApi()
export const useEventStore = defineStore('event', {
    state: () => {
        return {
            events: [],
            list: {},
            user: {},
            participantEvents: []
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
        },

        listEvents(state) {
            return state.participantEvents.data
             
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
        },

        async getParticipantEventList() {
            const response = await useSanctumFetch(PARTICIPANT_EVENT_LIST)
            const resData = response.data
            this.$state.participantEvents = resData

            return resData
        }
    },
});
