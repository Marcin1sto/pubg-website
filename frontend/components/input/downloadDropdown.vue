<script setup lang="ts">

const isOpened = ref(false);

const props = defineProps({
  options: {
    type: Array,
    required: true
  }
})

const download = async (url: string, fileName: string) => {
  const config = useRuntimeConfig();

  try {
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const blob = await response.blob();

    const link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click();
    link.remove();
  } catch (error) {
    console.error('Wystąpił błąd podczas pobierania pliku: ', error);
  }
}

</script>

<template>
  <div class="downloadDropdown_container" @click="isOpened = !isOpened" v-if="options.length > 0">
    <button class="downloadDropdown" :class="isOpened ? 'downloadDropdown--open' : '' ">
    <span class="downloadDropdown_downloadIcon">
      <svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.98454 1.5659V17.1875M8.98454 17.1875L3.77734 11.286M8.98454 17.1875L14.1917 11.6332" stroke="#202020" stroke-width="1.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M1 16.4922V22.0465H16.9688V16.4922" stroke="#202020" stroke-width="1.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </span>
      <span class="downloadDropdown_text">Pobierz pliki</span>
      <span class="downloadDropdown_ButtonArrow">
        <NuxtImg v-if="!isOpened" src="icons/selectCountry/arrowDown.png" width="23px" height="23px"/>
        <NuxtImg v-if="isOpened" src="icons/selectCountry/arrowUp.png" width="23px" height="23px"/>
      </span>
    </button>
    <div class="downloadDropdown_openContent" :style="isOpened ? 'display: block' : 'display: none'">
      <div class="downloadDropdown_openContent--item" v-for="(item, index) in options" :key="index" @click.stop="download(item.url, item.fileName)">
        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8.85681 16.4279H1V1H7.85686L12.4281 5.57124V8.99967" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.85791 1V5.57124H12.4291" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12.4291 18.1425C14.9538 18.1425 17.0004 16.0959 17.0004 13.5712C17.0004 11.0466 14.9538 9 12.4291 9C9.90452 9 7.85791 11.0466 7.85791 13.5712C7.85791 16.0959 9.90452 18.1425 12.4291 18.1425Z" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12.4286 11.2812V15.8525M12.4286 15.8525L14.1428 14.1383M12.4286 15.8525L10.7144 14.1383" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="downloadDropdown_openContent--itemDownload">{{ item.name }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.downloadDropdown_container {
  min-width: 210px;
  display: flex;
  flex-direction: column;
}
.downloadDropdown_openContent {
  height: max-content;
  border-radius: 0 0 8px 8px;
  border: 2px solid #F2F2F2;
  padding: 10px 16px 5px;
  z-index: 1;

  &--item {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 5px;
    font-size: 14px;
    font-weight: 400;
    line-height: 18px;
    color: #202020;
  }

  &--itemDownload {
    cursor: pointer;
  }
}

.downloadDropdown {
  width: 100%;
  height: 40px;
  border: 2px solid #F2F2F2;
  border-radius: 8px;
  display: flex;
  align-items: stretch;
  background-color: #ffffff;

  &--open {
    border-radius: 8px 8px 0 0;
  }
}

.downloadDropdown_ButtonArrow {
  border-left: 2px solid #F2F2F2;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-left: 10px;
  min-width: 41px;
}

.downloadDropdown_downloadIcon {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 12px;
}

.downloadDropdown_text {
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-size: 14px;
  font-weight: 600;
  line-height: 18px;
  color: #202020;
  width: 100%;
}
</style>