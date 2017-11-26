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

  getById(id) {
    return this.api.getRoute('new').prepareUrl(id).makeResponse().Reset();
  }

  sendComment(id, comment, token) {
    return this.api
      .getRoute('new.comment')
      .prepareUrl(id)
      .Auth(token)
      .makeResponse({ comment })
      .Reset();
  }
}

export default NewsResource;