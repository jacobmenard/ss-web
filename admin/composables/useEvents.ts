export function useEvents() {

    const es = useEventStore()

    async function getList(payloads: any) {
        await es.getEventBriteEvents(payloads)

    }

    async function getEventBriteEventsParticipantsList(payloads: any) {
        await es.getEventBriteEventsParticipants(payloads)
    }

    async function getEventBriteEvent(payload: any) {
        await es.getEventBriteEventObject(payload)
    }

    return {
        getList, getEventBriteEventsParticipantsList, getEventBriteEvent
    }
}