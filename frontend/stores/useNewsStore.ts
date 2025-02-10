const {formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useNewsStore = defineStore('news', {
    state: () => ({
        news: [],
        singleArticle: {},
    }),
    actions: {
        async getNews() {
            const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('news.index', {}), {
                method: 'GET',
            });

            if (data.value.success) {
                this.news = data.value.data.news;
            }
        },
        async getArticleView(id: string) {
            let route = formatApiGetRoute('news.show', {});
            route = route.replace(':id', id.toString());
            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });

            if (data.value.success) {
                this.singleArticle = data.value.data.News;
            }
        },
        createArticleSlug(title: string) {
            return this.removePolishCharacters(title.replace(/ /g, '_').toLowerCase());
        },
        removePolishCharacters(text) {
            const polishToNormal = {
                'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z', 'ż': 'z',
                'Ą': 'A', 'Ć': 'C', 'Ę': 'E', 'Ł': 'L', 'Ń': 'N', 'Ó': 'O', 'Ś': 'S', 'Ź': 'Z', 'Ż': 'Z'
            };

            return text.replace(/[ąćęłńóśźżĄĆĘŁŃÓŚŹŻ]/g, match => polishToNormal[match]);
        }
    }
})

export default useNewsStore;