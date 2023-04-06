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

    static getAllQuestions(queries){
        const response = NebulooFetch.http.get("questions", {params: queries});
        return response;
    };
    static getAllContent(queries){
        const response = NebulooFetch.http.get("contents", {params: queries});
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