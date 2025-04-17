import { defineStore } from 'pinia';
import { api } from '@/composables/useApi'
import { CSRF_COOKIE, LOGIN_URL, USER_URL, USER_UPLOAD_IMAGE, CHANGE_USER_PASSWORD, FORGOT_PASSWORD, RESET_PASSWORD, LOGOUT_URL, USER_UPDATE } from '@/endpoints/endpoints'

const api = useApi()

export const useUserStore  = defineStore('user', {
    state: () => {
        return {
            user: {},
            isLoginOpen: false,
            isOpenMatchupResult: false,
            matchupInfo: {},
            userEvent: {},
            isOpenUserInformation: false
        }
    },
    getters: {
        getUser(state) {
            return state.user
        },
        is_open_matchup_result(state) {
            return state.isOpenMatchupResult
        },
        is_open_user_information(state) {
            return state.isOpenUserInformation
        },
        matchup_info(state) {
            return state.matchupInfo
        },
        user_event(state) {
            return state.userEvent
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
                } else if (error.code == 401) {
                    errorBody = 'Invalid login details, please try again'
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

        async setOpenMatchupResultFinal(isOpen: boolean, user_event: any, data: any) {
            this.$state.isOpenMatchupResult = isOpen
            this.$state.userEvent = user_event
            this.$state.matchupInfo = data
        },

        async setOpenUserInformation(isOpen: boolean) {
            this.$state.isOpenUserInformation = isOpen
        },

        async updateUser(payloads: any) {
            const response = await useSanctumFetch(`${USER_UPDATE}/${payloads.id}`, {
                body: payloads,
                method: 'put'
            })
            const resData = response.data.value
            useNuxtApp().$toast(resData.message, {type: 'success'});
        }
        
    },
});

