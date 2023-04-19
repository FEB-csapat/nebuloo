import axios from "axios";
import router from "../router/index.js";

export class NebulooFetch{
    static baseUrl = "http://localhost:8881/api/";

    static http;
    static token;

    static initialize(token){
        NebulooFetch.token = token;
        NebulooFetch.http = axios.create({
            baseURL: this.baseUrl,
            headers: {
                'Authorization':"Bearer " + token,
                'Content-Type': 'application/json'
            }
        })
    };

    static getFeed(queries){
        const response = NebulooFetch.http.get("feed", {params: queries});
        return response;
    }

    static getAllQuestions(queries){
        const response = NebulooFetch.http.get("questions", {params: queries});
        return response;
    };
    static getAllContent(queries){
        const response = NebulooFetch.http.get("contents", {params: queries});
        return response;
    };

    static getDetailedContent(id){
        const response = NebulooFetch.http.get("contents/" + id);
        return response;
    };
    static getDetailedQuestion(id){
        const response = NebulooFetch.http.get("questions/" + id);
        return response;
    };

    static async deleteMyPost(path){
        const response = NebulooFetch.http.delete("me"+path)
        return response;
    };

    static async createQuestion(data){
        const response = NebulooFetch.http.post('me/questions',data)
        return response;
    };
    static async editQuestion(data,id){
        const response = NebulooFetch.http.put('me/questions/'+id, data)
        return response;
    }
    static async createContent(data){
        const response = NebulooFetch.http.post('me/contents',data);
        return response;
    };
    static async updateContent(data,id){
        const response = NebulooFetch.http.put('me/contents/'+id,data);
        return response;
    };
    static async getMyDatas(){
        const response = NebulooFetch.http.get("me");
        return response;
    };
    static async deleteMyProfile(){
        const response = NebulooFetch.http.delete("me")
        return response;
    };
    static async editMyDatas(data){
        const response = NebulooFetch.http.put('me',data)
        return response;
    }
    static async createTicket(data){
        const response = NebulooFetch.http.post('me/tickets',data)
        return response;
    };
    static async getUserData(id){
        const response = NebulooFetch.http.get('users/'+id)
        return response;
    };
    static async changeUserRole(id,data){
        const response = NebulooFetch.http.put('admin/user/'+id+'/role',data)
        return response;
    };
    static async banUser(id){
        const response = NebulooFetch.http.put('admin/users/'+id+'/ban')
        return response;
    };
 
    static synchronizeVote(votableId, votableType, voteState){
        if(voteState == 1){
            return NebulooFetch.http.post(votableType + '/' + votableId + '/votes', {'direction': 'up'});
        }else if(voteState == -1){
            return NebulooFetch.http.post(votableType + '/' + votableId + '/votes', {'direction': 'down'});
        }else{
            return NebulooFetch.http.delete(votableType + '/' + votableId + '/votes');
        }
    };
    static async createComment(data,path)
    {
        const response = NebulooFetch.http.post(path+'/comments',data)
        return response;
    };

    static uploadImage(file)
    {
        var http = axios.create({
            baseURL: this.baseUrl,
            headers: {
                'Authorization':"Bearer " + NebulooFetch.token,
            }
        });

        var formData = new FormData();
        formData.append("image", file);

        const response = http.post('images', formData);
        return response;
    };
}