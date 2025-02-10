<script setup lang="ts">
import type { NuxtError } from '#app'

const props = defineProps({
  error: Object as () => NuxtError
})

const router = useRouter()
clearError({ redirect: '/error', query: { ...router.currentRoute.value.query }})

const handleError = () => clearError({ redirect: '/' })
</script>

<template>
  <div>
    <h2>{{ error.statusCode }}</h2>
<!--    <button @click="handleError">Clear errors</button>-->
  </div>
</template>
