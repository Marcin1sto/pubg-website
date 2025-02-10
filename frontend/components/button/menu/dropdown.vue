<template>
  <button @click="toggleDropdown(parentIndex)" class="blp-button-dropdown"
          :class="itemDropdownHasActive(parentIndex) ? 'active' : ''">
    <div class="btn-content">
      <div class="left-side-button">
        <IconBase :name="item.icon" class="icon"/>
        <span v-if="openedMenu"><slot></slot></span>
      </div>
      <div class="arrow-icon" v-if="openedMenu">
        <IconArrowDown class="arrow-icon"/>
      </div>
    </div>
  </button>
  <div v-if="props.item.isOpened && openedMenu" class="dropdown-items">
    <ul class="items-list">
      <li v-for="(item, index) in props.item.items" @click="changeActiveSubItem(index, parentIndex)">
        <nuxt-link-locale :to="item.route" v-if="!isC2C">{{ item.title }}</nuxt-link-locale>
        <nuxt-link-locale :to="item.route" v-if="isC2C && item.isForC2C">{{ item.title }}</nuxt-link-locale>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import useLeftMenuStore from "~/stores/useLeftMenuStore";
import useUserStore from "~/stores/useUserStore";

const props = defineProps(
    {
      item: Object,
      required: true,
    }
);
const {menuItems, openedMenu} = storeToRefs(useLeftMenuStore());
const {changeActiveSubItem, toggleDropdown, itemDropdownHasActive} = useLeftMenuStore();
const parentIndex = menuItems.value.indexOf(props.item);

const router = useRouter();
const {userExternalData} = storeToRefs(useUserStore());
let isC2C = userExternalData.value.Broker.consumer_account;
</script>

<style scoped lang="scss">
.blp-button-dropdown:hover {
  color: rgba(66, 133, 244, 1);
  border: 2px solid rgba(66, 133, 244, 1);

  .icon {
    color: rgba(66, 133, 244, 1) !important;
  }
}

.btn-content {
  display: flex;
  justify-content: space-between;
  height: 100%;

  .left-side-button {
    display: flex;
    gap: 16px;
    align-items: center;
  }
}

.blp-button-dropdown {
  background-color: rgba(255, 255, 255, 1);
  color: rgba(38, 43, 68, 1);
  width: 100%;
  height: 40px;
  border-radius: 8px 8px 8px 8px;
  border: 2px solid #F2F2F2;
  padding-inline: 10px;
  margin-bottom: 16px;

  .arrow-icon {
    display: flex;
    justify-content: flex-end;
  }

  .icon {
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
  }

  .arrow-icon {
    height: auto;
    width: 20px;
  }
}

.active {
  color: rgba(66, 133, 244, 1);
  border: 2px solid rgba(66, 133, 244, 1);
  margin-bottom: 8px;
}

.dropdown-items {
  width: 200px;
  margin-bottom: 24px;

  .items-list {
    list-style-type: none;
    padding: 0;
    margin: 0;

    li {
      a {
        display: block;
        text-decoration: none;
        color: #262B44;
        font-size: 14px;
        line-height: 32px;
        padding: 8px 16px;
        cursor: pointer;

        &:hover {
          color: rgba(66, 133, 244, 1);
        }
      }
    }

    .router-link-active {
      color: rgba(66, 133, 244, 1);
    }
  }

  &:has(.router-link-active) {
    display: block;
  }
}
</style>