<script setup lang="ts">
const props = defineProps({
  color: String,
})

const sectionStatuses = [
  { color: 'green', status: 'done', hex: '#23BA3B' },
  { color: 'gray', status: 'not_complete', hex: '#CDDAF4' },
  { color: 'blue', status: 'seen', hex: '#4285F4' },
  { color: 'red', status: 'error', hex: '#E22E1D' }
]

const getHexColor = (color: string) => {
  const section = sectionStatuses.find((section) => section.color === color)
  return section ? section.hex : ''
}

</script>

<template>
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="color === 'red'">
    <path d="M12 24C15.1826 24 18.2348 22.7357 20.4853 20.4853C22.7357 18.2348 24 15.1826 24 12C24 8.8174 22.7357 5.76516 20.4853 3.51472C18.2348 1.26428 15.1826 0 12 0C8.8174 0 5.76516 1.26428 3.51472 3.51472C1.26428 5.76516 0 8.8174 0 12C0 15.1826 1.26428 18.2348 3.51472 20.4853C5.76516 22.7357 8.8174 24 12 24ZM12 6C12.6234 6 13.125 6.50156 13.125 7.125V12.375C13.125 12.9984 12.6234 13.5 12 13.5C11.3766 13.5 10.875 12.9984 10.875 12.375V7.125C10.875 6.50156 11.3766 6 12 6ZM10.5 16.5C10.5 16.1022 10.658 15.7206 10.9393 15.4393C11.2206 15.158 11.6022 15 12 15C12.3978 15 12.7794 15.158 13.0607 15.4393C13.342 15.7206 13.5 16.1022 13.5 16.5C13.5 16.8978 13.342 17.2794 13.0607 17.5607C12.7794 17.842 12.3978 18 12 18C11.6022 18 11.2206 17.842 10.9393 17.5607C10.658 17.2794 10.5 16.8978 10.5 16.5Z" fill="#E22E1D"/>
  </svg>

  <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg" v-else>
    <circle cx="11.5" cy="11.5" r="11.5" :fill="getHexColor(color)"/>
    <path d="M7 11.5L10.3103 15.5312L16 8" :fill="getHexColor(color)"/>
    <path d="M7 11.5L10.3103 15.5312L16 8" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
</template>

<style scoped>

</style>