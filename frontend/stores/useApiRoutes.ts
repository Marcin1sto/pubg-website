const useApiRoutes = () => {
    const apiRoutes = {
        players: '/api/players',
    }

    const getApiRoute = (route: string) => {
        const keys = route.split('.');
        let result = apiRoutes;

        for (let key of keys) {
            if (result[key] !== undefined) {
                result = result[key];
            } else {
                console.error(`Ścieżka '${route}' jest niepoprawna lub nie jest zdefiniowana.`);
            }
        }

        return result;
    }

    /**
     * Formatuje ścieżkę API dla metody GET z parametrami
     * @param route
     * @param params
     */
    const formatApiGetRoute = (route: string, params: { limit: number; page: number }) => {
        const routeName= getApiRoute(route);

        if (Object.keys(params).length === 0) {
            return routeName;
        }

        let formattedRoute = routeName + '?';
        for (let key in params) {
            if (params[key] !== null && params[key] !== undefined && params[key] !== '') {
                formattedRoute += `${key}=${params[key]}&`;
            }
        }

        return formattedRoute.slice(0, -1);
    }

    return {
        apiRoutes,
        getApiRoute,
        formatApiGetRoute
    };
}

export default useApiRoutes;