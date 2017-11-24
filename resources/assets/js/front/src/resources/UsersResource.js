import api from './api';

class UsersResource {
  constructor() {
    this.api = new api();
  }

  getAnket(id) {
    return this.api
      .getRoute('user')
      .prepareUrl(id)
      .makeResponse()
      .Reset();
  }
}


export default UsersResource;