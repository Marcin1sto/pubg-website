import printJS from "print-js-updated";

const useDownload = () => {
  let bodyParams = {}
  const download = async (url: string, fileName: string, method = 'GET', isApi = false, bodyParams = null) => {
    const config = useRuntimeConfig();

    if (isApi) {
      url = config.public.apiBaseUrl + url;
    }

    try {
      let options = {
        method: method,
        headers: {
          'Authorization': 'Bearer ' + useCookie('token').value
        }
      };

      if (method === 'POST') {
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(bodyParams);
      }

      let responseFileName = '';
      await fetch(url, options).then(async res => {
        const contentType = res.headers.get('Content-Type');
        if (contentType && contentType.includes('application/json')) {
          const jsonResponse = await res.json();
          if (jsonResponse.success === false) {
            alert(jsonResponse.message || 'Wystąpił błąd.');
          }
        }

        const disposition = res.headers.get('Content-Disposition');
        if (disposition) {
          responseFileName = disposition.split(/;(.+)/)[1].split(/=(.+)/)[1];
          if (responseFileName.toLowerCase().startsWith("utf-8''"))
            responseFileName = decodeURIComponent(responseFileName.replace(/utf-8''/i, ''));
          else
            responseFileName = responseFileName.replace(/['"]/g, '');
        }

        return res.blob();
      }).then(blob => {
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.setAttribute('download', responseFileName);
        document.body.appendChild(link);
        link.click();
        link.remove();
      });

    } catch (error) {
      console.error('Wystąpił błąd podczas pobierania pliku: ', error);
    }
  }

  const print = async (url: string, fileName: string, method = 'GET', isApi = false, bodyParams = null) => {
    const config = useRuntimeConfig();

    if (isApi) {
      url = config.public.apiBaseUrl + url;
    }

    try {
      let options = {
        method: method,
        headers: {
          'Authorization': 'Bearer ' + useCookie('token').value
        }
      };

      if (method === 'POST') {
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(bodyParams);
      }

      let responseFileName = '';
      await fetch(url, options).then(res => {
        const disposition = res.headers.get('Content-Disposition');
        if (disposition) {
          responseFileName = disposition.split(/;(.+)/)[1].split(/=(.+)/)[1];
          if (responseFileName.toLowerCase().startsWith("utf-8''"))
            responseFileName = decodeURIComponent(responseFileName.replace(/utf-8''/i, ''));
          else
            responseFileName = responseFileName.replace(/['"]/g, '');
        }

        return res.blob();
      }).then(blob => {

        const objectUrl = URL.createObjectURL(blob);
        printJS(objectUrl, 'pdf');
      });

    } catch (error) {
      console.error('Wystąpił błąd podczas pobierania pliku: ', error);
    }
  }

  return {
    print,
    download,
    bodyParams
  }
}

export default useDownload;