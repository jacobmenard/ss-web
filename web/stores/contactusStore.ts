import { defineStore } from 'pinia';
import { SEND_EMAIL } from '@/endpoints/endpoints'

const api = useApi()

export const useContactusStore = defineStore('contactusStore', {
    state: () => ({
        contacts: []
    }),
    getters: {
        
    },
    actions: {
        async save(payloads: any) {
            
            // const response = await useLazySanctumFetch<Response>(SEND_EMAIL, {
            //     method: 'POST',
            //     body: payloads
            // })
            const response = await api.post(SEND_EMAIL, payloads)

            return response
        }
    },
});
