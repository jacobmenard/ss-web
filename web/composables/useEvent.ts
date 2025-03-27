export function useEvent() {
    const es = useEventStore()
    async function getAllParticipantEvent() {
        await es.getParticipantEventList()
    }

    async function setParticipantStatus(payloads: any) {
        const resData = await es.participantStatus(payloads)
        
        if (resData.status == 'success') {
            useNuxtApp().$toast(resData.message, {type: 'success'});
        }

    }

    async function getSelectEvent(payloads: any) {
        const resData = await es.selectEvent(payloads)
    }

    async function updateVenueStatus(payloads: any) {
        const resData = await es.updateStatus(payloads)
    }

    async function sendFeedback(payloads: any) {
        const resData = await es.sendEventFeedback(payloads)
        if (resData.status == 'success') {
            useNuxtApp().$toast(resData.data.message, {type: 'success'});
        }
        return resData
    }

    async function getFeedback(payloads: any) {
        const resData = await es.getEventFeedback(payloads)
        
        return resData
    }

    return {
        getAllParticipantEvent, setParticipantStatus, getSelectEvent, updateVenueStatus,
        sendFeedback, getFeedback 
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