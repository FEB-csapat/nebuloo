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

    static deleteMyPost(path){
        const response = NebulooFetch.http.delete("me"+path)
        .then(()=>{
            alert("Sikeres törlés!");
            router.push('/myprofile');
        })
    };

    static createQuestion(data){
        const response = NebulooFetch.http.post('me/questions',data)
        .then(()=>{
            alert("Sikeres létrehozás!");
            router.push('/myprofile');
        });
    };
    static async createContent(data){
        const response = NebulooFetch.http.post('me/contents',data);
        return response;
    };
    static getMyDatas(){
        const response = NebulooFetch.http.get("me");
        return response;
    };
    static deleteMe(){
        const response = NebulooFetch.http.delete("me")
        .then(()=>{
            alert("Sikeres törlés!");
            router.push('/');
        })
    };
    static editMyDatas(data){
        const response = NebulooFetch.http.put('me',data)
        .then(()=>{
            alert("Sikeres változtatás");
            router.push('/myprofile');
        });
    }

    static createTicket(data){
        const response = NebulooFetch.http.post('me/tickets',data)
        .then(()=>{
            alert("Sikeres küldés!");
            router.push('/myprofile');
        });
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
    static createComment(data,path)
    {
        const response = NebulooFetch.http.post(path+'/comments',data)
        .then(()=>{
            alert("Sikeres komment!");
            window.location.reload();
        });
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