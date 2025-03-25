import type { UseFetchOptions } from "#app";

export async function useCustomFetch(url: string, options = {} as UseFetchOptions<t>, type="useFetch") {
    // let token = sessionStorage.getItem("token") ?? "";
    // let subVenueId = sessionStorage.getItem("subVenueId") ?? "";

    // const session = useCookie('peisoSession');
    // const data = session.value as ILoginData | null

    // if (data) {
    //     token = data?.token ?? "";
    //     subVenueId = data?.venueId.toString() ?? "";
    // }

    const config = useRuntimeConfig()
    const xsrfToken = useCookie('XSRF-TOKEN')
      let headers = {
          accept: 'application/json'
      }
      if (xsrfToken && xsrfToken.value !== null) {
          headers['X-XSRF-TOKEN'] = xsrfToken.value;
      }
      headers = {
          ...headers,
          referer: config.public.apiUrl
      }


    if (type == "useFetch") {
      // USE FOR SERVER SIDE RENDERING
      
      return await useFetch(config.public.apiUrl + url, {
          ...options,
          headers: {
            ...options.headers,
            ...headers
            // token: token ?? "",
            // subVenueId: subVenueId ?? "",
          }
       });

    } else if (type == "useCsrfFetch") {
      return await useCsrfFetch(config.public.apiUrl + url, {
        ...options,
        headers: {
          ...options.headers,
          ...headers
      },
    });
    } else {
      // USE FOR CLIENT SIDE RENDERING
      return await $fetch(config.public.apiUrl + url, {
          ...options,
          headers: {
            ...options.headers,
            ...headers
        },
      });

    }
   
}
