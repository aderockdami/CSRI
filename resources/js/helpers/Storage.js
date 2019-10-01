class Storage {

  setToken(token){
    localStorage.setItem('token',token);
  }

  store(token){
    this.setToken(token);
  }

  clear(){
    localStorage.removeItem('token');
  }

  getToken(){
    return localStorage.getItem('token');
  }

}

export default Storage = new Storage()
