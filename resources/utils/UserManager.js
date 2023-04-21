export class UserManager{
    static token(){
        return localStorage.getItem('userToken');
    }

    static userRole(){
        return localStorage.getItem('userRole')
    }
}