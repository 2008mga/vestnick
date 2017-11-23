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
      .makeResponse();
  }
}

const resource = new NewsResource();

export default resource;