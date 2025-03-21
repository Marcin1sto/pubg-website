import { ref } from 'vue'
import { useRuntimeConfig } from '#app'

interface PaginationMeta {
  current_page: number;
  from: number;
  last_page: number;
  per_page: number;
  to: number;
  total: number;
}

interface PaginationLinks {
  first: string;
  last: string;
  prev: string | null;
  next: string | null;
}

interface ApiResponse {
  correct: boolean;
  data: any[];
  meta: PaginationMeta;
  links: PaginationLinks;
}

export const usePlayersApi = () => {
  const config = useRuntimeConfig()
  const players = ref([])
  const loading = ref(false)
  const error = ref(null)
  const pagination = ref<PaginationMeta | null>(null)
  const links = ref<PaginationLinks | null>(null)

  const fetchPlayers = async (page: number = 1, perPage: number = 10) => {
    loading.value = true
    error.value = null
    
    try {
      const response = await fetch(`${config.public.apiBaseUrl}/api/players?page=${page}&per_page=${perPage}`)
      const data: ApiResponse = await response.json()
      
      if (data.correct) {
        players.value = data.data
        pagination.value = data.meta
        links.value = data.links
      } else {
        error.value = 'Nie udało się pobrać listy graczy'
      }
    } catch (e) {
      error.value = 'Wystąpił błąd podczas pobierania danych'
      console.error('Error fetching players:', e)
    } finally {
      loading.value = false
    }
  }

  return {
    players,
    loading,
    error,
    pagination,
    links,
    fetchPlayers
  }
} 