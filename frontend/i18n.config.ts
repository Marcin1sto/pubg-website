import pl from '~/i18n/pl/translations.json';

export default defineI18nConfig(() => ({
  legacy: false,
  fallbackLocale: 'pl',
  locale: 'pl',
  datetimeFormats: {
    pl: {
      long: {
        year: 'numeric',
        day: 'numeric',
        month: 'long',
      },
    },
    en: {
      long: {
        year: 'numeric',
        day: 'numeric',
        month: 'long',
      },
    },
  },
  messages: {
    pl,
  },
}));
