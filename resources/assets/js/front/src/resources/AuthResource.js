import api from './api';

class AuthResource {
  constructor() {
    this.api = new api();
  }

  signIn(credentials) {
    return this.api
      .getRoute('auth.signIn')
      .prepareUrl()
      .makeResponse(credentials)
      .Reset();
  }
  Me(token) {
    return this.api
      .getRoute('auth.me')
      .prepareUrl()
      .Auth(token)
      .makeResponse()
      .Reset();
  }
}

export default AuthResource;