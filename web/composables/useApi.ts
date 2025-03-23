    
export function useApi() {
    
    async function post(url, body) {
        const response = await useCustomFetch(url, {
            body: body,
            method: 'POST',
        }, 'fetch')
        return response
    }

    async function get(url, body) {
        return await useCustomFetch(url, {
            params: body,
            method: 'GET',
        }, 'fetch')
    }

    async function put(url, body) {
        return await useCustomFetch(url, {
            body: body,
            method: 'PUT',
        }, 'fetch')
    }
    
    return {
        post, get, put
    }
}
