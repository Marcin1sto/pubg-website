type UseTheFetch = typeof useFetch;

export const useTheFetch: UseTheFetch = (path: string, options = {}) => {
  const config = useRuntimeConfig();

  const baseOptions = {
    // watch: false,
    baseURL: config.public.apiBaseUrl,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    onRequest({ request, options }){
      //
    },
    onResponse({ request, response, options }){
      // if (response.status === 403) {
      //
      // }
    },
    ...options
  };

  return useFetch(path, baseOptions);
};