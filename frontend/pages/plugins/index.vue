<script setup lang="ts">
const plugins = [
  {
    name: 'API',
    isLink: true,
    image: '/icons/blpLogoMain.png',
    link: 'plugins/api',
    isInProgress: false
  },
  {
    name: 'Allegro',
    isLink: true,
    image: '/icons/allegro.png',
    link: 'plugins/api',
    isInProgress: false
  },
  {
    name: 'IdoSell',
    isLink: true,
    image: '/icons/idosell.png',
    link: 'plugins/api',
    isInProgress: false
  },
  {
    name: 'BaseLinker',
    isLink: true,
    image: '/icons/Baselinker-logo.png',
    link: 'plugins/api',
    isInProgress: false
  },
  {
    name: 'WooCommerce',
    isLink: true,
    image: '/images/plugins/wooLogo.png',
    link: 'plugins/api',
    isInProgress: false
  },
  {
    name: 'PrestaShop',
    isLink: true,
    image: '/images/plugins/prestashop.svg',
    link: 'plugins/api',
    isInProgress: false
  },
  {
    name: 'Shopify',
    isLink: true,
    image: '/images/plugins/shopify.svg',
    link: 'plugins/api',
    isInProgress: true
  },
  {
    name: 'eBay',
    isLink: true,
    image: '/images/plugins/ebay.svg',
    link: 'plugins/api',
    isInProgress: true
  },
]
</script>

<template>
  <div class="container">
    <div class="row row--centered">
      <h1 class="plugins_header">Integracje</h1>
    </div>
    <div class="plugins_container plugins_container--wide">
      <div class="plugins_containerItems">
        <div v-for="plugin in plugins">
          <a :href="plugin.link" v-if="plugin.isLink" class="plugins_containerItem plugins_containerItem--big">
          <span class="plugins_containerContent">
            <img :src="plugin.image" :alt="plugin.name"  width="150px" style="margin-bottom: 8px"/>
            <span v-if="plugin.isInProgress" class="plugins_inProgress">Już wkrótce!</span>
          </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.plugins_container {
  padding: 32px;
  height: 100%;
}

.plugins_container--wide {
  padding: 32px 0;
}

.plugins_containerItems {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.plugins_containerItem {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 16px;
  border-radius: 8px;
  border: 2px solid #F2F2F2;
  background-color: #FFFFFF;
  width: 140px;
  height: 140px;
  font-weight: 700;
  font-size: 25px;
  text-decoration: none;
  color: #262B44;
}

.plugins_containerItem--big {
  width: 210px;
  height: 210px;
}

.plugins_containerContent {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  flex-direction: column;
  align-items: center;
  font-family: Open Sans;
  font-size: 16px;
  font-weight: 400;
  color: #262B44;
}

.plugins_containerItem--big .plugins_containerContent {
  font-size: 21px;
}

.plugins_inProgress {
  font-family: Open Sans;
  font-size: 16px;
  font-weight: 700;
  color: #00cd82;
  text-transform: uppercase;
}

.plugins_header {
  font-family: "Open Sans";
  font-size: 33px;
  font-weight: 600;
  line-height: 33px;
  color: #262B44;
  margin: 32px 0 0px;
}
</style>