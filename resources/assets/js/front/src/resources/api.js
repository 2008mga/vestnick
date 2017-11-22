import routes from './routes'
import urlResolve from 'resolve-link'
class Api {
  constructor() {
    this.apiLink = process.env.API_URL;
    this.client = Api.initClient();
    this.routes = routes;
  }

  static baseUrl() {
    return location.protocol + '//' + location.host;
  }

  static initClient() {
    return require('axios');
  }

  getClient() {
    return this.client;
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
    let client = this.getClient();

    console.log(current);

    return client[current.method](current.url, data);
  }

  prepareUrl(params) {
    if (!this.currentRoute) {
      return this;
    }

    if (params) {
      Object.keys(params).map(function(key) {
        let param = object[key];

        this.currentRoute.url = this.currentRoute.url.replace(new RegExp('%' + key + '%', 'gi'), param);
      });
    }

    this.currentRoute.url = urlResolve(this.apiLink + this.currentRoute.url, Api.baseUrl() );

    return this;
  }


}

const api = new Api();
export default api;