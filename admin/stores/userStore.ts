import { defineStore } from 'pinia';
import { api } from '@/composables/useApi'
import { CSRF_COOKIE, LOGIN_URL, USER_URL, LOGOUT_URL } from '@/endpoints/endpoints'

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

        async get() {
            // const response = await api.get(USER_URL)
            // const response = await useSanctumFetch(USER_URL)
            const response = await useSanctumFetch(USER_URL)
            const resData = response.data.value
            console.log(resData.data)

            return resData
        },

        async logoutUser() {
            const response = await useSanctumFetch(LOGOUT_URL, {
                method: 'post'
            })
            console.log(response)
            const resData = response
            
            useNuxtApp().$toast('User successfully logout', {type: 'success'});
            await reloadNuxtApp()
            return resData
        },
        
    },
});

