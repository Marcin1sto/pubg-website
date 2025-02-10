const {formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useArticlesStore = defineStore('articles', {
    state: () => ({
        articles: [],
        categories: [],
        singleArticle: {},
    }),
    actions: {
        async getArticles(selectedCategory: string|null = null) {
            const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('articles.index', {
                category: selectedCategory
            }), {
                method: 'GET',
            });

            if (data.value.success) {
                this.articles = data.value.data.articles.map((article) => {
                    return {
                        ...article.Article,
                    };
                });
            }
        },
        async getArticleView(id: string) {
            let route = formatApiGetRoute('articles.show', {});
            route = route.replace(':id', id.toString());
            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });

            if (data.value.success) {
                this.singleArticle = data.value.data.Article;
            }
        },
        async fetchCategories() {
            const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('articles.categories', {}), {
                method: 'GET',
            });

            if (data.value.success) {
                this.categories = data.value.data;
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
    },
    getters: {
        getCategories(state) {
            if (state.categories.length === 0) {
                return [];
            }

            let categoriesKeys = Object.keys(state.categories);
            let usedCategories = [];

            categoriesKeys.forEach(category => {
                usedCategories.push({
                    name: state.categories[category],
                    slug: category
                })
            });

            if (usedCategories.length > 0) {
                return usedCategories;
            }

            return [];
        }
    }
})

export default useArticlesStore;