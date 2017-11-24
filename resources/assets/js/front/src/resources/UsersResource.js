import api from './api';

class UsersResource {
  constructor() {
    this.api = api;
  }

  getAnket(id) {
    return this.api
      .getRoute('user')
      .prepareUrl(id)
      .makeResponse()
      .Reset();
  }
}

const resource = new UsersResource();

export default resource;