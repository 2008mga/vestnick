import routes from './routes';
import axios from '../progress';
import { loadProgressBar } from 'axios-progress-bar'
class Api {
  constructor() {
    this.initDefault();
  }

  initDefault() {
    this.currentRoute = null;
    this.routes = routes;
    this.init = false;
    this.load = false;
    this.url = null;
    this.response = false;
  }

  Reset() {
    if (!this.url) {
      return;
    }


    return this.response.then((req) => {;
      this.initDefault();
      return req;
    });
  }

  getRoute(name) {
    this.currentRoute = name in this.routes ? this.routes[name] : false;
    return this;
  }

  getUrl() {
    return this.currentRoute.url;
  }

  makeResponse(data) {
    let current = this.currentRoute;
    let url = this.url;
    this.response = axios[current.method](url, data);
    return this;
  }

  prepareUrl(params) {
    this.url = this.currentRoute.url;

    if (params) {
      Object.keys(params).map((key) => {
        let param = params[key];

        this.url = this.currentRoute.url.replace(new RegExp('%' + key + '%', 'gi'), param);
      });
    }

    if (this.currentRoute.url === this.url) {
      this.load = true;
    }

    this.init = true;

    return this;
  }

  paginate(page) {
    this.url += '?page=' + page;
    return this;
  }
}

export default Api;