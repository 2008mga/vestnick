import api from './api';

class NewsResource {
  constructor() {
    this.api = api;
  }

  getByTag(id, page) {
    return this.api
      .getRoute('new.byTag')
      .prepareUrl(id)
      .paginate(page)
      .makeResponse()
      .Reset();
  }

  getByUser(id, page) {
    console.log(page);
    return this.api
      .getRoute('new.byUser')
      .prepareUrl(id)
      .paginate(page)
      .makeResponse()
      .Reset();
  }
}

const resource = new NewsResource();

export default resource;