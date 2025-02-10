import { isEmptyObject} from "@intlify/shared";
import useUserStore from "~/stores/useUserStore";
import {useAuthStore} from "~/stores/useAuthStore";

type UseTheFetch = typeof useFetch;

export const useTheFetch: UseTheFetch = (path: string, options = {}) => {
    const { logout } = useAuthStore();
    const router = useRouter();
    const token = useCookie('token');
    const { authenticated, userSessionId, isSemiUser } = storeToRefs(useAuthStore());
    const { userProfile } = storeToRefs(useUserStore()); // get profile from store
    const config = useRuntimeConfig();

    const baseOptions = {
        watch: false,
        baseURL: config.public.apiBaseUrl,
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + token.value,
        },
        onRequest({ request, options }){
            //
        },
        onResponse({ request, response, options }){
            if (response.status === 403 && !isSemiUser.value) {
                authenticated.value = false;
                userSessionId.value = null;
                useUserStore().resetProfile();
                token.value = null;
                const auth = useCookie('auth');
                auth.value = null;
                const userCookie = useCookie('user');
                userCookie.value = null;
                router.push({ name: 'login'});
            }
        },
        ...options
    };

    if (userProfile.value && !isEmptyObject(userProfile.value)) {
        baseOptions.headers['Authorization'] = 'Bearer ' + token.value;
    } else {
        baseOptions.headers['Authorization'] = 'Bearer ' + token.value;
    }



    return useFetch(path, baseOptions);
};
