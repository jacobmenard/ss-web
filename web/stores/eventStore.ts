 import { defineStore } from 'pinia';
import { EVENT_LIST, EVENT_PARTICIPANTS, EVENT_PARTICIPANT, PARTICIPANT_EVENT_LIST, ADD_STATUS, SELECTED_EVENT, UPDATE_STATUS  } from '@/endpoints/endpoints'

import { Response } from '@/types/endpoints'

const api = useApi()
export const useEventStore = defineStore('event', {
    state: () => {
        return {
            events: [],
            list: {},
            user: {},
            participantEvents: [],
            selectedEvent: {}
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
             
        },

        getSelectedEvent(state) {
            return state.selectedEvent
        }
    },
    actions: {
        async getEventList(payloads: any) {
            const response = await api.get(EVENT_LIST, payloads)

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
            const response = await useSanctumFetch(`${EVENT_PARTICIPANT}/${payloads.id}/${payloads.eventId}`)
            const resData = response.data.value
            this.$state.user = resData.data
            return resData
        },

        async getParticipantEventList() {
            const response = await useSanctumFetch(PARTICIPANT_EVENT_LIST)
            const resData = response.data
            this.$state.participantEvents = resData

            return resData
        },

        async participantStatus(payloads: any) {
            // const response = await useSanctumFetch(ADD_STATUS, {
            //     method: 'POST',
            //     body: payloads
            // })
            // const resData = response.data.value

            const response = await useLazySanctumFetch<Response>(ADD_STATUS, {
                method: 'POST',
                body: payloads
            })

            const resData = response.data.value

            return resData
        },

        async selectEvent(payloads: any) {

            const response = await useLazySanctumFetch<Response>(SELECTED_EVENT, {
                params: payloads
            })
            
            const resData = response.data.value

            this.$state.selectedEvent = resData.data

            return resData.data
        },

        async updateStatus(payloads: any) {
            const response = await useLazySanctumFetch<Response>(UPDATE_STATUS, {
                method: 'POST',
                body: payloads
            })

            const resData = response.data.value
            
            this.$state.selectedEvent = resData.data

            return resData.data
        }
    },
});
