import { defineStore } from 'pinia';
import { api } from '@/composables/useApi'
import { CSRF_COOKIE, LOGIN_URL, USER_URL } from '@/endpoints/endpoints'

const api = useApi()

export const useUserStore  = defineStore('user', {
    state: () => {
        return {
            user: {},
            isLoginOpen: false
        }
    },
    getters: {
        
    },
    actions: {
        
        async login(payload) {
            const { login, isAuthenticated } = useSanctumAuth()

            try {
                await login(payload)
            } catch (e) {
                const error = useApiError(e);
                var errorBody = ''
                if (error.code == 422) {
                    errorBody = 'These credentials do not match our records.'
                } else if (error.code == 429) {
                    errorBody = 'Too Many Attempts.'
                } else {
                    errorBody = 'Error, connection failed.'
                }

                useNuxtApp().$toast(errorBody, {type: 'error'});
                
                return
            }
        },

        async getUser() {
            // const response = await api.get(USER_URL)
            // const response = await useSanctumFetch(USER_URL)
            console.log(response.data)
            this.$state.user = response.data
            return response
        },
        
    },
});

