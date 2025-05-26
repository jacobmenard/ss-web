export function useFeedback() {
    
    const fs = useFeedbackStore()

    async function userFeedback(payloads: any) {
        const resData = await fs.userFeedback(payloads)

        return resData
    }

    return {
        userFeedback
    }
} 