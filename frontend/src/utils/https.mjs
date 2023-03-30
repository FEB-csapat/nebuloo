import axios from "axios";

export class NebulooFetch{
    static baseUrl = "http://localhost:8881/api/";
    
    static http;

    static initialize(){
        NebulooFetch.http = axios.create({
            baseURL: this.baseUrl,
            headers: {
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
}