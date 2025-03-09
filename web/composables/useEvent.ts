export function useEvent() {
    const es = useEventStore()
    async function getAllParticipantEvent() {
        await es.getParticipantEventList()
    }

    return {
        getAllParticipantEvent
    }
}

export function useGlobal() {

    function redirectToEventbrite(url: any) {
        window.open(`https://www.eventbrite.com/o/hartford-county-speed-dating-73343957833`, '_blank');
    }

    return {
        redirectToEventbrite
    }
}