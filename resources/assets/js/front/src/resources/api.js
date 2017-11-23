class Api {
  constructor() {
    this.apiLink = process.env.API_URL;
    this.client = Api.initClient();
    this.routes = this.initRoutes();
    this.init = false;
  }

  static baseUrl() {;
    return location.protocol + '//' + location.host + (location.port ? ':'+location.port: '') + '/';
  }

  static initClient() {
    return require('axios');
  }

  initRoutes() {
    return require('./routes').default;
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

    this.init = true;

    return this;
  }


}

let api = new Api();
export default api;