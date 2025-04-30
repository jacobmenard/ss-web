 import { defineStore } from 'pinia';
import { EVENT_LIST, EVENT_PARTICIPANTS, EVENT_PARTICIPANT, EVENT_PARTICIPANTS_LIST, EVENT_OBJECT, EVENT_ATTENDEES,
    EVENT_ADD_ATTENDEE, GET_ATTENDEES, ADD_TO_EVENT, MATCHUP_RESULT, CHECKIN, SEND_SELECTION  
 } from '@/endpoints/endpoints'
import { api } from '@/composables/useApi'
const api = useApi()
export const useEventStore = defineStore('event', {
    state: () => {
        return {
            events: [],
            list: {},
            user: {},
            attendees: {},
            event: {},
            attendeesList: [],
            searchAttendees: [],
            selectedResult: [],
            openSidebar: false,
            selectedUser: {}
        }
    },
    getters: {
        isOpenSidebar(state) {
            return state.openSidebar
        },
        getEvents(state) {
            return state.events
        },

        participantsList(state) {
            return state.list
        },

        selectedUser(state) {
            return state.user
        },

        getAttendees(state) {
            return state.attendees
        },

        getEvent(state) {
            return state.event
        },

        getSearchAttendees(state) {
            return state.searchAttendees
        },

        getSelectedResult(state) {
            return state.selectedResult
        },

        dates(state) {
            return state.selectedResult.filter((n: any) => n.matchup_status == '3')
        },

        friends(state) {
            return state.selectedResult.filter((n: any) => n.matchup_status == '2')
        },
    },
    actions: {
        setOpenSidebar(set: boolean, data: any) {
            this.$state.selectedUser = data
            this.$state.openSidebar = set
        },

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

        async getEventBriteEvents(payloads: any) {
            const response = await useSanctumFetch(EVENT_LIST, {
                params: payloads
            })
            const resData = response.data.value
            this.$state.events = resData.data.events

            return response
        },

        async getEventBriteEventsParticipants(payloads: any) {
            const response = await useSanctumFetch(EVENT_PARTICIPANTS_LIST, {
                params: payloads
            })
            const resData = response.data.value
            this.$state.attendees = resData.data
            
            return response
        },

        async getEventBriteEventObject(payloads : any) {
            const response = await useSanctumFetch(EVENT_OBJECT, {
                params: payloads
            })
            const resData = response.data.value
            this.$state.event = resData.data

            return response
        },

        async eventAttendees(payloads: any) {
            const response = await useSanctumFetch(EVENT_ATTENDEES, {
                params: payloads
            })
            const resData = response.data.value
            this.$state.attendees = resData.data
            console.log(resData.data)
            return response
        },

        async eventAddAttendee(payloads: any) {
            
            const response = await useSanctumFetch(`${EVENT_ADD_ATTENDEE}?eid=${payloads.eid}`, {
                body: payloads,
                method: 'POST'
            })

            const resData = response.data.value
            
            return resData
            
        },

        async attendeesDataList(payloads: any) {

            const response = await useSanctumFetch(GET_ATTENDEES, {
                params: payloads
            })

            const resData = response.data.value
            this.$state.attendees = resData.data
            
            return resData
        },

        async searchAttendeesList(payloads: any) {
            
            const response = await useSanctumFetch(GET_ATTENDEES, {
                params: payloads
            })

            const resData = response.data.value
            this.$state.searchAttendees = resData.data
            
            return resData
        },

        async addToEvent(payloads: any) {
            const response = await useSanctumFetch(ADD_TO_EVENT, {
                method: 'POST',
                body: payloads
            })

            const resData = response.data.value

            return resData
        },

        async matchupResult(payloads: any) {
            
            const response = await useSanctumFetch(MATCHUP_RESULT, {
                params: payloads
            })
            
            const resData = response.data.value
            this.$state.openSidebar = true
            this.$state.selectedResult = resData.data

            return resData
        },

        async checkinUser(userId: any, payloads: any) {
            const response = await useSanctumFetch(`${CHECKIN}/${userId}`, {
                method: 'POST',
                body: payloads
            })
        },

        async sendSelectionEmail(payloads: any) {
            const response = await useSanctumFetch(SEND_SELECTION, {
                params: payloads
            })
            
            const resData = response.data.value
            

            return resData
        }

    },
});
