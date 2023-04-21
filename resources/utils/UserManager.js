export class UserManager{
    static token(){
        return sessionStorage.getItem('userToken');
    }

    static userRole(){
        return sessionStorage.getItem('userRole');
    }

    static userID(){
        return sessionStorage.getItem('Identifier');
    }
}