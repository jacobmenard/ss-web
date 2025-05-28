export function useEvents() {

    const es = useEventStore()
    
    const { $swal } = useNuxtApp()

    async function getList(payloads: any) {
        await es.getEventBriteEvents(payloads)

    }

    async function getEventBriteEventsParticipantsList(payloads: any) {
        await es.getEventBriteEventsParticipants(payloads)
    }

    async function getEventBriteEvent(payload: any) {
        await es.getEventBriteEventObject(payload)
    }

    async function getEventAttendees(payloads: any) {
        await es.eventAttendees(payloads)
    }

    async function getEventAddAttendee(payloads: any) {
        const resData = await es.eventAddAttendee(payloads)
        
        return resData
    }

    async function getAttendeesDataList(payloads: any) {
        const resData = await es.attendeesDataList(payloads)
    }

    async function searchAttendeesDataList(payloads: any) {
        const resData = await es.searchAttendeesList(payloads)

    }

    async function attendeeAddToEvent(payloads: any) {
        const resData = await es.addToEvent(payloads)

        $swal.fire({
            title: `${resData.status}`,
            text: `${resData.message}`,
            icon: `${resData.status}`
        });
    }

    async function getMatchupResult(payloads: any) {
        const resData = await es.matchupResult(payloads)

        return resData
    }

    async function changeCheckInStatus(userId: any, payloads: any) {
        const resData = await es.checkinUser(userId, payloads)

        return resData
    }

    async function sendSelectionEmail(payloads: any) {
        const resData = await es.sendSelectionEmail(payloads)
        console.log(resData)
        return resData
    }

    async function getAllMatchParticipants(payloads: any) {
        const resData = await es.getAllMatchParticipants(payloads)
        return resData
    }

    async function updateSelection(payloads: any) {
        const resData = await es.updateSelection(payloads)

        
        if (resData.status == 'error') {
            useNuxtApp().$toast(resData.message, {type: 'error'});
        } 
        useNuxtApp().$toast(resData.message, {type: 'success'});
        
        return resData
    }

    async function getIndividualResult(payloads: any) {
        const resData = await es.getIndividualResult(payloads)

        $swal.fire({
            title: `${resData.status}`,
            text: `${resData.message}`,
            icon: `${resData.status}`,
            confirmButtonColor: "#4E0113",
        });
        
        return resData
    }

    return {
        getList, getEventBriteEventsParticipantsList, getEventBriteEvent, getEventAttendees,
        getEventAddAttendee, getAttendeesDataList, searchAttendeesDataList, attendeeAddToEvent,
        getMatchupResult, changeCheckInStatus, sendSelectionEmail, getAllMatchParticipants, updateSelection,
        getIndividualResult
    }
}