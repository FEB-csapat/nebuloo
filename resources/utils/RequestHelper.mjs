import axios from "axios";

export class RequestHelper {
    static baseUrl = "http://localhost:8881/api/";

    static http;
    static token;

    static initialize(token){
        RequestHelper.token = token;
        RequestHelper.http = axios.create({
            baseURL: this.baseUrl,
            headers: {
                'Authorization':"Bearer " + token,
                'Content-Type': 'application/json'
            }
        })
    };

    static getFeed(queries){
        const response = RequestHelper.http.get("feed", {params: queries});
        return response;
    }

    static getAllQuestions(queries){
        const response = RequestHelper.http.get("questions", {params: queries});
        return response;
    };
    static getAllContent(queries){
        const response = RequestHelper.http.get("contents", {params: queries});
        return response;
    };

    static getDetailedContent(id){
        const response = RequestHelper.http.get("contents/" + id);
        return response;
    };
    static async getDetailedQuestion(id){
        const response = RequestHelper.http.get("questions/" + id);
        return response;
    };

    static async deleteMyPost(path){
        const response = RequestHelper.http.delete("me"+path)
        return response;
    };

    static async createQuestion(title, body, subjectId, topicId){
        var data = {
            title: title,
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };

        const response = RequestHelper.http.post('questions',data)
        return response;
    };
    static async updateQuestion(editedQuestionId, title, body, subjectId, topicId){
        var data = {
            title: title,
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };

        const response = RequestHelper.http.put('questions/'+editedQuestionId, data)
        return response;
    }
    static async createContent(body, subjectId, topicId){

        var data = {
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };

        const response = RequestHelper.http.post('contents', data);
        return response;
    };
    static async updateContent(editedContentId, body, subjectId, topicId){
        var data = {
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };
        const response = RequestHelper.http.put('contents/'+editedContentId, data);
        return response;
    };
    static async getMyDatas(){
        const response = RequestHelper.http.get("me");
        return response;
    };
    static async deleteMyProfile(){
        const response = RequestHelper.http.delete("me")
        return response;
    };
    static async editMyDatas(data){
        const response = RequestHelper.http.put('me',data)
        return response;
    };
    static async editUserData(data,id){
        const response = RequestHelper.http.put('users/'+id,data)
        return response;
    };
    static async createTicket(data){
        const response = RequestHelper.http.post('tickets',data)
        return response;
    };
    static async getUserData(id){
        const response = RequestHelper.http.get('users/'+id)
        return response;
    };
    static async changeUserRole(id,data){
        const response = RequestHelper.http.put('user/'+id+'/role',data)
        return response;
    };
    static async banUser(id){
        const response = RequestHelper.http.put('users/'+id+'/ban')
        return response;
    };
    static async deleteUser(id){
        const response = RequestHelper.http.delete('users/'+id)
        return response;
    }
 
    static synchronizeVote(votableId, votableType, voteState){
        if(voteState == 1){
            return RequestHelper.http.post(votableType + '/' + votableId + '/votes', {'direction': 'up'});
        }else if(voteState == -1){
            return RequestHelper.http.post(votableType + '/' + votableId + '/votes', {'direction': 'down'});
        }else{
            return RequestHelper.http.delete(votableType + '/' + votableId + '/votes');
        }
    };
    static async createComment(message, commentableType, commentableId)
    {
        var data = {
            message: message,
        };
        const response = RequestHelper.http.post(commentableType+ '/' + commentableId+ '/comments', data)
        return response;
    };
    static async editComment(data,id){
        const response = RequestHelper.http.put('comments/'+id, data)
        return response;
    };
    static async deleteMyComment(id){
        const response = RequestHelper.http.delete('comments/'+id)
        return response;
    };

    static uploadImage(file)
    {
        var http = axios.create({
            baseURL: this.baseUrl,
            headers: {
                'Authorization':"Bearer " + RequestHelper.token,
            }
        });

        var formData = new FormData();
        formData.append("image", file);

        const response = http.post('images', formData);
        return response;
    };

    static async getSubjects(){
        const response = RequestHelper.http.get('subjects')
        return response;
    };
}