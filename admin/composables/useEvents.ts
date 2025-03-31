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

    return {
        getList, getEventBriteEventsParticipantsList, getEventBriteEvent, getEventAttendees,
        getEventAddAttendee, getAttendeesDataList, searchAttendeesDataList, attendeeAddToEvent,
        getMatchupResult
    }
}