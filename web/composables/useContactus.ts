export function useContactus() {

    const cs = useContactusStore()

    async function saveContactus(payloads:any) {
        await cs.save(payloads)
    }

    return {
        saveContactus
    }
}