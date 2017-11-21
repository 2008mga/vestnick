import axios from 'axios';

export function summernoteUploader(image, selector, url) {
  const $summerObj = $(selector);
  let formData = new FormData();

  for (let i = 0; i < image.length; i++) {
    formData.append('image[' + i + ']', image[i]);
  }

  for (let pair of formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]);
  }

  axios.post(url, formData)
    .then((req) => {
      let urls = req.data.url;

      if (urls instanceof Array) {
        for (let i = 0; i < urls.length; i++) {
          let url = urls[i];

          $summerObj.summernote('insertImage', url);
        }
      }
    });
}