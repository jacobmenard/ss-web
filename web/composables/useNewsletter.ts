export function useNewsletter() {
    
    const ns = useNewsletterStore()

    async function storeNewsletter(payloads: any) {
        const resData = ns.storeNewsletter(payloads)

        return resData
    }
    

    return {
        storeNewsletter
    }
}