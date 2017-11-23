export default {
  'tag': {
    url: '/api/tag/%id%',
    auth: false,
    method: 'get'
  },
  'tags': {
    url: '/api/tags',
    auth: false,
    method: 'get'
  },
  'tags.inline': {
    url: '/api/tags/inline',
    auth: false,
    method: 'get'
  },
  'new.byTag': {
    url: '/api/news/by/tag/%id%',
    auth: false,
    method: 'get'
  }
}