class Api {
  constructor() {
    this.Reset();
  }

  static baseUrl() {;
    return location.protocol + '//' + location.host + (location.port ? ':'+location.port: '') + '/';
  }

  static initClient() {
    return require('axios');
  }

  Reset() {
    this.currentRoute = null;
    this.routes = Api.initRoutes();
    this.apiLink = process.env.API_URL;
    this.client = Api.initClient();
    this.init = false;
    this.url = null;

    console.log(this, 'tyt');


    return this;
  }

  static initRoutes() {
    return require('./routes').default;
  }

  getClient() {
    return this.client;
  }

  getRoute(name) {
    this.Reset();
    this.currentRoute = name in this.routes ? this.routes[name] : false;

    return this;
  }

  getUrl() {
    return this.currentRoute.url;
  }

  makeResponse(data) {
    let current = this.currentRoute;
    let client = this.getClient();
    return client[current.method](this.url, data);
  }

  prepareUrl(params) {
    if (!this.currentRoute) {
      return this;
    }

    this.url = this.currentRoute.url;

    if (params) {
      Object.keys(params).map((key) => {
        let param = params[key];

        this.url = this.currentRoute.url.replace(new RegExp('%' + key + '%', 'gi'), param);
      });
    }

    this.init = true;

    return this;
  }


}

let api = new Api();
export default api;