class Storage {

  setToken(token){
    localStorage.setItem('token',token);
  }

  setUser(user){
    localStorage.setItem('user',user);
  }

  store(user,token,usertype){
    this.setToken(token);
    this.setUser(user);
  }

  clear(){
    localStorage.removeItem('token');
    localStorage.removeItem('user');
  }

  getToken(){
    return localStorage.getItem('token');
  }

  getUser(){
    return localStorage.getItem('user');
  }

}

export default Storage = new Storage()
