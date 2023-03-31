import axios from "axios";
import router from "../router/index.js";

export class NebulooFetch{
    static baseUrl = "http://localhost:8881/api/";

    static http;

    static initialize(token){
        NebulooFetch.http = axios.create({
            baseURL: this.baseUrl,
            headers: {
                'Authorization':"Bearer " + token,
                'Content-Type': 'application/json'
            }
        })
    };

    static getAllQuestions(){
        const response = NebulooFetch.http.get("questions");
        return response;
    };
    static getAllContent(){
        const response = NebulooFetch.http.get("contents");
        return response;
    };
    static createQuestion(data){
        const response = NebulooFetch.http.post('me/questions',data)
        .then(()=>{
            alert("Sikeres létrehozás!");
            router.push('/myprofile');
        });
    };
    static getMyDatas(){
        const response = NebulooFetch.http.get("me");
        return response;
    };

}