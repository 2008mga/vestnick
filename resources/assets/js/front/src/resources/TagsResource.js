import api from './api';

class TagsResource {
  constructor() {
    this.api = api;
  }

  getTags() {
    return this.api.getRoute('tags').prepareUrl().makeResponse();
  }
}

const resource = new TagsResource();

export default resource;