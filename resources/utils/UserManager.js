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
    }

    static get user() {
        return this.getUser();
    }

    static getUser(){
        var id = sessionStorage.getItem('Identifier');

        
        console.log("asdasd: " + id);


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
            name: sessionStorage.getItem('userName')
        }
    }

    static clear(){
        sessionStorage.clear();
    }
}