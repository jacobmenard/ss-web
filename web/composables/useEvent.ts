export function useEvent() {
    const es = useEventStore()
    const router = useRouter()

    async function getAllParticipantEvent() {
        await es.getParticipantEventList()
    }

    async function goToThankyouPage() {

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
            if (resData.data.isFirstSend) {

                var data = {
                    sendEmail: true,
                    user_id: payloads.user_id,
                    eid: payloads.eid,
                    email: payloads.email,
                    name: payloads.name
                }
                // await es.matchupResult(data)


            } else {
                // useNuxtApp().$toast(resData.data.message, {type: 'success'});
            }
            
        }
        return resData
    }

    async function getFeedback(payloads: any) {
        const resData = await es.getEventFeedback(payloads)
        
        return resData
    }
    
    async function getMatchupResult(payloads: any) {
        const resData = await es.matchupResult(payloads)

        return resData
    }

    return {
        getAllParticipantEvent, setParticipantStatus, getSelectEvent, updateVenueStatus,
        sendFeedback, getFeedback, getMatchupResult
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