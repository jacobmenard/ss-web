import { defineStore } from 'pinia';
import { api } from '@/composables/useApi'
import { CSRF_COOKIE, LOGIN_URL, USER_URL, USER_UPLOAD_IMAGE, CHANGE_USER_PASSWORD, FORGOT_PASSWORD, RESET_PASSWORD } from '@/endpoints/endpoints'

const api = useApi()

export const useUserStore  = defineStore('user', {
    state: () => {
        return {
            user: {},
            isLoginOpen: false
        }
    },
    getters: {
        getUser(state) {
            return state.user
        }
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
            this.$state.user = resData.data

            return resData
        },

        async uploadImage(payloads: any) {
            
            const response = await useSanctumFetch(USER_UPLOAD_IMAGE, {
                body: payloads,
                method: 'post'
            })
            const resData = response.data.value
            this.$state.user = resData.data
            
            useNuxtApp().$toast(resData.message, {type: resData.status});

            return resData
        },

        async changeUserPassword(payloads: any) {
            const response = await useSanctumFetch(CHANGE_USER_PASSWORD, {
                body: payloads,
                method: 'post'
            })
            const resData = response.data.value
            this.$state.user = resData.data
            
            useNuxtApp().$toast(resData.message, {type: resData.status});

            return resData

        },

        async forgotPassword(payloads: any) {
            const response = await useSanctumFetch(FORGOT_PASSWORD, {
                body: payloads,
                method: 'post'
            })
            const resData = response.data.value
            
            useNuxtApp().$toast(resData.message, {type: resData.status});

            return resData
        },
        
        async resetPassword(payloads: any) {
            const response = await useSanctumFetch(RESET_PASSWORD, {
                body: payloads,
                method: 'post'
            })
            const resData = response.data.value
            
            useNuxtApp().$toast(resData.message, {type: resData.status});

            return resData
        }
        
    },
});

