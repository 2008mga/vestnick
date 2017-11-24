import api from './api';

class TagsResource {
  constructor() {
    this.api = api;
  }

  getTags() {
    return this.api.getRoute('tags').prepareUrl().makeResponse().Reset();
  }

  getInline() {
    return this.api.getRoute('tags.inline').prepareUrl().makeResponse().Reset();
  }

  getTag(id) {
    return this.api.getRoute('tag').prepareUrl(id).makeResponse().Reset();
  }
}

const resource = new TagsResource();

export default resource;