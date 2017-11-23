import api from './api';

class TagsResource {
  constructor() {
    this.api = api;
  }

  getTags() {
    return this.api.getRoute('tags').prepareUrl().makeResponse();
  }

  getInline() {
    return this.api.getRoute('tags.inline').prepareUrl().makeResponse();
  }

  getTag(id) {
    return this.api.Reset().getRoute('tag').prepareUrl(id).makeResponse();
  }
}

const resource = new TagsResource();

export default resource;