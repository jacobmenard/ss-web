 import { defineStore } from 'pinia';
import { EVENT_LIST, EVENT_PARTICIPANTS, EVENT_PARTICIPANT, PARTICIPANT_EVENT_LIST, ADD_STATUS, SELECTED_EVENT, UPDATE_STATUS, SEND_FEEDBACK,
    GET_FEEDBACK, MATCHUP_RESULT
  } from '@/endpoints/endpoints'

import { Response } from '@/types/endpoints'

const api = useApi()
export const useEventStore = defineStore('event', {
    state: () => {
        return {
            events: [],
            
            list: {},
            user: {},
            selectedParticipants: {},
            participantEvents: [],
            selectedEvent: {},
            feedback: {},
            selectedResult: [],
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
            return state.selectedParticipants
        },

        listEvents(state) {
            return state.participantEvents.current_future
             
        },

        listEventsPast(state) {
            return state.participantEvents.past
             
        },

        listEventsAll(state) {
            return state.participantEvents
        },

        getSelectedEvent(state) {
            return state.selectedEvent
        },
        
        getFeedback(state) {
            return state.feedback
        },

        event(state) {
            return state.selectedResult.event
        },

        user_event(state) {
            return state.selectedResult.user_event
        },
        
        user(state) {
            return state.selectedResult.user
        },

        dates(state) {
            const dateList = state.selectedResult.result
            if (dateList) {
                return dateList.filter((n: any) => n.matchup_final == '3')
            }
            
            return []
        },

        friends(state) {
            const dateList = state.selectedResult.result
            if (dateList) {
                return dateList.filter((n: any) => n.matchup_final == '2')
            }
            
            return []
        },

        noneResponse(state) {
            const dateList = state.selectedResult.result
            if (dateList) {
                return dateList.filter((n: any) => n.matchup_final == '1')
            }
            
            return []
        },

        noneList(state) {
            const dateList = state.selectedResult.noSelection
            
            return dateList
        },
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
            this.$state.selectedParticipants = null 
            const response = await useSanctumFetch(`${EVENT_PARTICIPANT}/${payloads.id}/${payloads.eventId}`)
            const resData = response.data.value
            this.$state.selectedParticipants = resData.data
            console.log(resData.data)
            return resData
        },

        async getParticipantEventList() {
            const response = await useSanctumFetch(PARTICIPANT_EVENT_LIST)
            const resData = response.data
            this.$state.participantEvents = resData.value.data
            
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

            const response = await useSanctumFetch(SELECTED_EVENT, {
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
        },

        async sendEventFeedback(payloads: any) {
            const response = await api.get(SEND_FEEDBACK, payloads)
            const resData = response.data.data
            this.$state.feedback = resData
            return response
        },

        async getEventFeedback(payloads: any) {
            const response = await api.get(GET_FEEDBACK, payloads)
            const resData = response.data.data
            this.$state.feedback = resData
            
            return response
        },

        async matchupResult(payloads: any) {
            
            const response = await useSanctumFetch(MATCHUP_RESULT, {
                params: payloads
            })
            
            const resData = response.data.value
            this.$state.selectedResult = resData.data

            return resData
        }
    },
});
