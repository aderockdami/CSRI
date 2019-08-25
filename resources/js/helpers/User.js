class User{

  ResponseAfterLogin(response){
    const access_token = response.data.access_token;
    const username = response.data.user;
    if(Token.isValid(access_token)){
      Storage.store(username,access_token);
    }
  }

  isAdmin(){
    if(this.hasToken()){
      const access_token = Storage.getToken();
      return Token.isAdmin(access_token) ? true : false
    }
    return false
  }

  hasToken(){
    const StoredToken = Storage.getToken();
    if(StoredToken){
      return Token.isValid(StoredToken) ? true : false
    }
    return false;
  }

  loggedIn(){
    return this.hasToken();
  }

  logout(){
    Storage.clear();
  }

  getName(){
    if(this.loggedIn()){
      return Storage.getUser();
    }
  }

  id(){
    if(this.loggedIn()){
      const payload = Token.payload(Storage.getToken());
      return payload.sub;
    }
  }
}

export default User = new User();
