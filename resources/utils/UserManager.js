export class UserManager{

    static setToken(token){
        return sessionStorage.setItem('userToken', token);
    }

    static getToken(){
        return sessionStorage.getItem('userToken');
    }

    static setUser(user){
        sessionStorage.setItem('Identifier', user.id);
        sessionStorage.setItem('userRole', user.role);
        sessionStorage.setItem('userRankId', user.rank.id);
        sessionStorage.setItem('userRankName', user.rank.name);
        sessionStorage.setItem('userName', user.name);
        sessionStorage.setItem('userDisplayName', user.display_name);
    }

    static getUser(){
        var id = sessionStorage.getItem('Identifier');

        if(id == null){
            return null;
        }
        return {
            role: sessionStorage.getItem('userRole'),
            id: id,
            rank: {
                id: sessionStorage.getItem('userRankId'),
                name: sessionStorage.getItem('userRankName')
            },
            name: sessionStorage.getItem('userName'),
            display_name: sessionStorage.getItem('userDisplayName')
        }
    }

    static login(token, user){
        this.setToken(token);
        this.setUser(user);
    }

    static logout(){
        sessionStorage.clear();
    }


    static isLoggedIn(){
        return this.getToken() != null;
    }

    static isAdmin(){
        return this.getUser()?.role == "admin";
    }

    static isModerator(){
        return this.getUser()?.role == "moderator";
    }

    static isUser(){
        return this.getUser()?.role == "user";
    }

    static isGuest(){
        return this.getToken() != null;
    }

}