import { defineStore } from 'pinia';
import { EVENT_LIST } from '@/endpoints/endpoints'
import { api } from '@/composables/useApi'
const api = useApi()
export const useEventStore = defineStore('event', {

    
    state: () => {
        return {
            events: [],
        }
    },
    getters: {
        getEvents(state) {
            return state.events
        }
    },
    actions: {
        async getEventList() {
            const response = await api.get(EVENT_LIST)

            this.$state.events = response.data.events

            return response
        }
    },
});
