 import { defineStore } from 'pinia';
import { EVENT_LIST, EVENT_PARTICIPANTS, EVENT_PARTICIPANT, EVENT_PARTICIPANTS_LIST, EVENT_OBJECT, EVENT_ATTENDEES,
    EVENT_ADD_ATTENDEE, GET_ATTENDEES, ADD_TO_EVENT, MATCHUP_RESULT, CHECKIN, SEND_SELECTION, ATTENDEE_LIST, UPDATE_SELECTION,
    USER_INDIVIDUAL_RESULT , ADD_STATUS
 } from '@/endpoints/endpoints'
import { api } from '@/composables/useApi'

import friend from '@/assets/images/friend.svg'
import date from '@/assets/images/date.svg'
import none from '@/assets/images/none.svg'
import business from '@/assets/images/business.svg'
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
            openSelectionSidebar: false,
            selectedUser: {},
            selections: {},
            loadingSelection: false,
            userId: null,

            maleList: [],
            femaleList: []
        }
    },
    getters: {
        isOpenSidebar(state) {
            return state.openSidebar
        },
        isOpenSelectionSidebar(state) {
            return state.openSelectionSidebar
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

        getAllMale(state) {
            return state.maleList
        },

        getAllFemale(state) {
            return state.femaleList
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

        isLoadingSelection(state) {
            return state.loadingSelection
        },

        getSelections(state) {
            return state.selections
        },

        selected_id(state) {
            return state.userId
        }
    },
    actions: {
        setOpenSidebar(set: boolean, data: any) {
            this.$state.selectedUser = data
            this.$state.openSidebar = set
        },

        setOpenSelectionSidebar(set: boolean, data: any) {
            this.$state.selections = data
            this.$state.openSelectionSidebar = set
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
            this.$state.femaleList = resData.data.filter((n: any) => n.user.gender == 'female')
            this.$state.maleList = resData.data.filter((n: any) => n.user.gender == 'male')
            return response
        },

        showHideAttendeeFullname(idx: any, gender: any) {
            if (gender == 'male') {
                this.$state.maleList[idx].isShow = !this.$state.maleList[idx].isShow
            } else if (gender == 'female') {
                this.$state.femaleList[idx].isShow = !this.$state.femaleList[idx].isShow
            }
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
        },
        async getAllMatchParticipants(payloads: any) {
            this.$state.openSelectionSidebar = true
            this.$state.loadingSelection = true
            this.$state.userId = payloads.user_id
            const response = await useSanctumFetch(ATTENDEE_LIST, {
                params: payloads
            })
            
            const resData = response.data.value
            
            resData.data.map((m: any) => {
                m.matchFeedbackForEdit = m.matchFeedback.map((n: any) => {
                    if (n.matchup_status == '2') {
                        n.value = 2
                        n.text = 'friend'
                        n.image = friend
                    } else if (n.matchup_status == '3') {
                        n.value = 3
                        n.text = 'date'
                        n.image = date
                    } else if (n.matchup_status == '4') {
                        n.value = 4
                        n.text = 'business'
                        n.image = business
                    }


                    return  {
                        value: n.matchup_status,
                        image: n.image,
                        text: n.text
                    }
                })
            })
            this.$state.selections = resData.data
            this.$state.loadingSelection = false

            return resData
        },

        async updateSelection(payloads: any) {
            payloads.user_id = this.$state.userId
            const response = await useSanctumFetch(UPDATE_SELECTION, {
                method: 'post',
                body: payloads
            })
            
            const resData = response.data.value

            return resData
        },

        async getIndividualResult(payloads: any) {
            const response = await useSanctumFetch(USER_INDIVIDUAL_RESULT, {
                params: payloads
            })
            
            const resData = response.data.value

            return resData
        },

        async participantStatus(payloads: any) {
            const response = await useSanctumFetch(ADD_STATUS, {
                method: 'POST',
                body: payloads
            })

            const resData = response.data.value

            return resData
        },
        

    },
});
