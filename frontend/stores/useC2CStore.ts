import {defineStore} from 'pinia';

const useC2CStore = defineStore('c2c', {
    persist: true,
    state: () => ({
        isC2C: false,
    }),
});

export default useC2CStore;