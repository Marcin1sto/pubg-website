import { ref } from 'vue'
import { useRuntimeConfig } from '#app'

interface Player {
  id: number;
  display_name: string;
  games: Array<{
    id: number;
    name: string;
    pivot: {
      platform: string;
      is_active: boolean;
    }
  }>;
}

interface ApiResponse {
  correct: boolean;
  data: Player | null;
  message?: string;
}

export const usePlayerApi = () => {
  const config = useRuntimeConfig()
  const player = ref<Player | null>(null)
  const loading = ref(false)
  const error = ref<string | null>(null)

  const fetchPlayer = async (id: number) => {
    loading.value = true
    error.value = null
    
    try {
      const response = await fetch(`${config.public.apiBaseUrl}/api/players/${id}`)
      const data: ApiResponse = await response.json()
      
      if (response.ok && data.correct && data.data) {
        player.value = data.data
      } else {
        error.value = data.message || 'Nie udało się pobrać danych gracza'
      }
    } catch (e) {
      error.value = 'Wystąpił błąd podczas pobierania danych'
      console.error('Error fetching player:', e)
    } finally {
      loading.value = false
    }
  }

  return {
    player,
    loading,
    error,
    fetchPlayer
  }
} 