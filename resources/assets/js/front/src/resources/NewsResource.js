import api from './api';

class NewsResource {
  constructor() {
    this.api = new api();
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

export default NewsResource;