import api from './api';

class TagsResource {
  constructor() {
    this.api = new api();
  }

  getTags() {
    return this.api.getRoute('tags').prepareUrl().makeResponse().Reset();
  }

  getInline() {
    return this.api.getRoute('tags.inline').prepareUrl().makeResponse().Reset();
  }

  getTag(id) {
    console.log('test');
    return this.api.getRoute('tag').prepareUrl(id).makeResponse().Reset();
  }
}

export default TagsResource;