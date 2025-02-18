<script setup lang="ts">
const {getApiRoute} = useApiRoutes();

const {data, pending, error}: any = await useTheFetch(getApiRoute('players'), {
  method: 'GET',
  credentials: 'include', // Jeśli używasz autoryzacji przez ciasteczka
});
</script>

<template>
  <div>
    <h1>Players</h1>
  </div>
</template>

<style scoped lang="css">

</style>