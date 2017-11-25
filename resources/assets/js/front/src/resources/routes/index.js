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
  },
  'new.byUser': {
    url: '/api/news/by/user/%id%',
    auth: false,
    method: 'get'
  },
  'new': {
    url: '/api/news/by/id/%id%',
    auth: false,
    method: 'get'
  },
  'user': {
    url: '/api/user/%id%',
    auth: false,
    method: 'get'
  },
  'auth.signIn': {
    url: '/api/oauth/token',
    auth: false,
    method: 'post'
  },
  'auth.me': {
    url: '/api/me',
    auth: true,
    method: 'post'
  },
  'auth.signOut': {
    url: '/api/signOut',
    auth: true,
    method: 'post'
  }
}