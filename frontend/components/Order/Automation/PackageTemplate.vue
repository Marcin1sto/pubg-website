<script setup lang="ts">
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const { fetchPackageTemplate, updateFormValues, fetchSelectOptions } = usePackageTemplateStore();
const { packageTemplatesSelectOptions, templateId } = storeToRefs(usePackageTemplateStore());
const { form } = storeToRefs(useOrderFormV2Store());
const selectedPackageForm = ref(null)
const fullFillFormFromPackage = async () => {
  if (!selectedPackageForm.value) return;

  let result = await fetchPackageTemplate(selectedPackageForm.value)
  updateFormValues(form.value, result.PackageTemplate);
}

watch(() => selectedPackageForm.value, (newValue) => {
  if (newValue) {
    fullFillFormFromPackage();
  }
})

onMounted(() => {
  fetchSelectOptions();

  //Templates
  if (templateId.value) {
    selectedPackageForm.value = templateId.value;
  }
})
</script>

<template>
  <div class="row">
    <div v-if="packageTemplatesSelectOptions.length > 0" style="display: flex; justify-content: center; width: 300px">
      <InputFilterSelect
          :options="packageTemplatesSelectOptions"
          label="Wybierz szablon"
          v-model="selectedPackageForm"
          :base-value="selectedPackageForm"
      />
    </div>
  </div>
</template>

<style scoped>

</style>