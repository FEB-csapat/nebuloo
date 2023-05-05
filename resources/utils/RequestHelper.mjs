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
        return RequestHelper.http.get("feed", {params: queries});
    }

    static getAllQuestions(queries){
        return RequestHelper.http.get("questions", {params: queries});
    };
    static getAllContent(queries){
        return RequestHelper.http.get("contents", {params: queries});
    };
    static getAllTickets(){
        return RequestHelper.http.get("tickets");
    };
    static async createTicket(data){
        return RequestHelper.http.post('tickets',data)
    };
    static async editTicket(state,id){
        var data = {
            state: state
        };
        return RequestHelper.http.put('tickets/'+id,data)
    };
    static async deleteTicket(id){
        return RequestHelper.http.delete('tickets/'+id);
    };
    static getDetailedContent(id){
        return RequestHelper.http.get("contents/" + id);
    };
    static async getDetailedQuestion(id){
        return RequestHelper.http.get("questions/" + id);
    };

    static async deleteContent(id){
        return RequestHelper.http.delete('contents/'+id);
    };

    static async deleteQuestion(id){
        return RequestHelper.http.delete('questions/'+id);
    };

    static async createQuestion(title, body, subjectId, topicId){
        var data = {
            title: title,
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };

        return RequestHelper.http.post('questions', data)
    };
    static async updateQuestion(editedQuestionId, title, body, subjectId, topicId){
        var data = {
            title: title,
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };

        return RequestHelper.http.put('questions/'+editedQuestionId, data)
    }
    static async createContent(body, subjectId, topicId){
        var data = {
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };

        return RequestHelper.http.post('contents', data);
    };
    static async updateContent(editedContentId, body, subjectId, topicId){
        var data = {
            body: body,
            subject_id: subjectId,
            topic_id: topicId,
        };
        return RequestHelper.http.put('contents/'+editedContentId, data);
        
    };
    static async getMyDatas(){
        return RequestHelper.http.get("me");
        
    };
    static async deleteMe(){
        return RequestHelper.http.delete("me")
        
    };
    static async editMyProfile(data){
        return RequestHelper.http.put('me',data)
        
    };
    static async editUserData(id, data){
        return RequestHelper.http.put('users/'+id,data)
        
    };
    static async getUserData(id){
        return RequestHelper.http.get('users/'+id)
        
    };
    static async changeUserRole(id, pickedRole){
        var data={
            role: pickedRole
        };
        return RequestHelper.http.put('users/'+id+'/role',data)
        
    };
    static async banUser(id){
        return RequestHelper.http.put('users/'+id+'/ban')
        
    };
    static async unbanUser(id){
        return RequestHelper.http.put('users/'+id+'/unban')
        
    };

    static async deleteUser(id){
        return RequestHelper.http.delete('users/'+id)
        
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

    static async createComment(message, commentableType, commentableId){
        var data = {
            message: message,
        };
        return RequestHelper.http.post(commentableType+ '/' + commentableId+ '/comments', data)
        
    };
    static async editComment(message, id){
        var data={
            message: message
        };
        return RequestHelper.http.put('comments/'+id, data)
        
    };
    static async deleteMyComment(id){
        return RequestHelper.http.delete('comments/'+id)
        
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

        return http.post('images', formData);
        
    };

    static async getSubjects(){
        return RequestHelper.http.get('subjects')
    };
}