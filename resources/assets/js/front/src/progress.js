import 'nprogress/nprogress.css'
import NProgress from 'nprogress'
import axios from 'axios'

const calculatePercentage = (loaded, total) => (Math.floor(loaded * 1.0) / total)

let client = axios.create({});

function loadProgressBar(config) {

  let requestsCounter = 0;

  const setupStartProgress = () => {
    client.interceptors.request.use(config => {
      requestsCounter++;
      NProgress.start();
      return config
    })
  };

  const setupUpdateProgress = () => {
    const update = e => NProgress.inc(calculatePercentage(e.loaded, e.total));
    client.defaults.onDownloadProgress = update;
    client.defaults.onUploadProgress = update;
  };

  const setupStopProgress = () => {
    const responseFunc = response => {
      if ((--requestsCounter) === 0)
        NProgress.done();
      return response
    };

    const errorFunc = error => {
      if ((--requestsCounter) === 0)
        NProgress.done();
      return Promise.reject(error)
    };

    client.interceptors.response.use(responseFunc, errorFunc)
  };

  NProgress.configure(config);
  setupStartProgress();
  setupUpdateProgress();
  setupStopProgress();
}

loadProgressBar();

export default client;