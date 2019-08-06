export default class Gate{

    constructor(user){
        this.user = user;
    }
    userId(){
        return this.user.id;
    }

   isAdmin(){
        return this.user.type==='admin'
   }
    isUser(){
        return this.user.type==='user'
    }

    isAdminOrAuthor(){
        if(this.user.type==='author' || this.user.type==='admin'){
            return true;
        }
    }


}