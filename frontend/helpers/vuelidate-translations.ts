import * as validators from '@vuelidate/validators'

export const useI18nValidators =  () => {
  const { $i18n } = useNuxtApp();
  const { createI18nMessage } = validators;
  const messagePath = ({ $validator }: { $validator: string }) => `validations.${$validator}`

  const withI18nMessage = createI18nMessage({t: $i18n.t.bind($i18n), messagePath})

  const required = withI18nMessage(validators.required)

  const sameAs = withI18nMessage(validators.sameAs, { withArguments: true })

  const minLength = withI18nMessage(validators.minLength, { withArguments: true })

  return {
    required,
    sameAs,
    minLength
  }
}