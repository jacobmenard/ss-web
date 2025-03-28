export function useContactus() {

    const { $swal } = useNuxtApp()
    const cs = useContactusStore()

    async function saveContactus(payloads:any) {
        const resData = await cs.save(payloads)
        
        if (resData.status == 'success') {
            $swal.fire({
                title: 'submitted!',
                text: 'Thank you for contacting us! We’ll be in touch soon.',
                icon: 'success',
                confirmButtonText: 'OKAY',
                confirmButtonColor: "#4D0011",
            })
        } else {
            $swal.fire({
                title: 'Failed to submit!',
                text: 'Error on submitting filled form',
                icon: 'error',
                confirmButtonText: 'OKAY',
                confirmButtonColor: "#4D0011",
            })
        }
        
        
        return resData
        
    }

    return {
        saveContactus
    }
}