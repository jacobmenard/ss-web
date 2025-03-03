export function useLogin() {
    
    const user = useUserStore()
    const auth = useSanctumUser();

    async function loginUser(payload:any) {
        debugger
        await user.login({
            email: payload.email,
            password: payload.password
        })
    }


    return {
        loginUser
    }
}