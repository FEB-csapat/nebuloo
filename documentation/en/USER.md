# Nebuloo user documentation

Nebuloo is a educational material sharing forum that offers students the opportunity to search for educational material, share it, ask and answer questions.
Other users can comment on the created questions and study materials, and can vote on whether the given content was useful for them or not.
The votes received for a user's content are added up on the user's profile, based on which he receives a rank, thus encouraging him to be active.
If a user has any problems with the site or any of the content on the site, they can send it to the site operators in the form of a bug ticket.


## System requirements

Since the website was created using Docker, the system requirements meet the minimum requirements for using Docker Desktop:
* Windows 10 operating system
* 64-bit processor
* At least 4 GB of RAM

Required applications, settings:
* Docker Desktop, which can be downloaded from https://docs.docker.com/desktop/
* Enable use of WSL2
* Virtualization must be enabled in your computer's BIOS


## Installation:
1. The source code of the project can be downloaded by running the following command in the terminal: `git clone https://github.com/FEB-csapat/nebuloo.git`
2. Run start.sh shell script in the root directory of the project: `sh start.sh`

If running the script fails, the commands must be runned manually:
1. `copy .env.example .env` rename file “.env.example” to “.env”
2. Run `docker compose up` command to start containers
3. Run `docker compose exec app fish` command to enter the container

Inside the container:

4. Run `composer install` command to download Laravel related dependencies
5. Run `php artisan key:generate` command to generate the key required for the API
6. Run `php artisan migrate:fresh --seed` command to run database migrations and seeders
7. Run the `npm install` command to download Vue-related dependencies

Finally, to run the Vite live server, you need to run the `npm run dev` command, after which the website can be accessed at https://localhost:8881


# Operation of the website
## **For User**

### **Main page**
On the main page of the site, we can decide how we want to enter the site. We have two options for entry. You can log in with an account or as a guest, which does not require a registrated account.

![Continue Options](/documentation/demo_continue_component.png)

If we want to log in with an account, after clicking on the button labeled as "Fiókkal", the page redirects us to the login window, where we can enter our login data. After we have entered our data, by clicking on the button labeled "Bejelentkezés", the site allows us to log in and then redirects us to the "Tananyagok" page.

If you don't have a user account yet, you can create one on the login page by clicking on the button labeled "Regisztráció", which will redirect you to the registration page.

A form awaits us on the registration page, after filling it in we can create our user account by clicking on the button labeled "Regisztráció". In case of successful registration, the page redirects us to the login interface, where the user can log in with his newly created account.

### **Contents page**

![Contents Page](/documentation/demo_contents_view.png)

On this page, you can view various teaching materials uploaded by us and other users. Basically, we see the most recent documents first, but you can change this by clicking on the 'sort' drop-down list and select a different sorting aspect.
In addition, the displayed course materials can be selected by selecting the subjects and topics that we prefer, by clicking on the green 'tantárgy' drop-down list on the left, and after selecting the subject that suits us, the topic in the pop-up list. If you want to delete the applied filters, click on the text Szűrők törlése'.

The preview of each course material contains its subject and topic, the upload date, the name of the uploader, the number of lines and words of the course material, the number of comments and votes. Here, we also have the opportunity to vote for the course material, by clicking the up arrow we can rate the course material +1, while the down arrow can give a -1 rating to the course material. By clicking on the user's picture, we can view their profile.

We can view a document in more detail by clicking on its text and the page will redirect us to its detailed page.

### **Detailed Content Page**

![Detailed Content Page](/documentation/demo_detailed_content_view.png)

On the detailed content page, we have the option to vote, download the content material in markdown file format, view the creator's profile, and if we are the creators or have admin or moderator privileges, we can also edit and delete the content material.

Additionally, we can write comments under the specific course material, and the system sends an email notification to the creator about the new activity.

### **Comment Section**
![Comment Section](/documentation/demo_comment_section_component.png)

By clicking the 'Submit' button, we can submit our comment under the question or course material.

We can edit and delete existing comments if we are the creators or have admin or moderator privileges.

#### **Email Notification**
![Email Notification](/documentation/demo_email_notification.png)

The system sends an email notification to the creator of the course or question if a new comment is posted (if the creator has enabled email notifications).

To enable email notifications, the following parameters need to be configured in the `.env` file:  
![Email Notification Configuration](/documentation/demo_mail_config.png)


### **Create New Content**

![Create Content Page](/documentation/demo_create_content_view.png)

On this page, using the markdown text formatting features, we can create well-formatted content. Above the text box, we need to specify the subject and topic. Then, we can enter the text and format it as desired, and insert images as well. Finally, by clicking the 'Create' button, we can submit our created course material.

Guide for using markdown:
* Headings: `# First-level heading`, `## Second-level heading`
* *Italic*: `*italic*`
* **Bold**: `**bold**`
* ~~Strikethrough~~: `~~strikethrough~~`
* Numbered list: `1. First item`, `2. Second item`
* Bulleted list: `- First item`, `- Second item`
* Link: `[Nebuloo](http://www.localhost:8881)`
* Images: `![Nebuloo logo](/documentation/face.png)`

### **Questions Page**
![Questions Page](/documentation/demo_questions_view.png)

On this page, we can view various questions uploaded by us and other users. By default, the latest questions are displayed first, but by clicking the 'Sort' dropdown list, we can change the sorting criteria. Additionally, we can filter the displayed questions based on our preferred subjects and topics by clicking the green 'Subject' dropdown list on the left side and selecting the subject and topic from the popup list. To remove the applied filters, click the 'Clear Filters' text.

Each question preview includes its subject, topic, upload date, uploader name, number of comments, and votes. We can also vote on the usefulness of the question by clicking the up arrow for +1 or the down arrow for -1. Clicking on the user's image allows us to view their profile.

We can examine a question in detail by clicking on its text, which redirects us to the detailed question page. Here, we can also write answers to the question.

By clicking the floating "Create New Question +" button in the bottom right corner, we can ask a question to other users.

### **Detailed Question Page**

![Detailed Question Page](/documentation/demo_detailed_question_view.png)

On the detailed question page, we can vote, view the creator's profile, and if we are the creators or have admin or moderator privileges, we can also edit and delete the question.

Additionally, we can write comments under the specific question, and the system sends an email notification to the creator about the new activity.

### **Create New Question**
![Create New Questions Page](/documentation/demo_create_question_view.png)

On this page, we can ask our question. First, we need to provide the subject, then the topic, and finally, the title of our question. In the 'Description' section, we can elaborate on our question to help other users understand it easily. After filling in the necessary information, we can click the 'Submit' button to post our question.

In our own questions, we have the ability to edit them later by clicking the 'Edit Question' button, or delete them by clicking the 'Delete Question' button.

### **Profile Page**
![Profile Page](/documentation/demo_profile_view.png)

On the profile page, we can see the information about the user, such as their name, rank, bio, and statistics. As we scroll down, we can view the user's asked questions, uploaded study materials, written comments and answers, and submitted tickets. We can click on the text of any of these items to view them in detail.

If we are viewing our own profile, we have additional options:
* By clicking the 'Edit Profile' button, we are taken to a page where we can change our display name and bio. After making the desired changes, we can click the 'Save' button to update our profile. Then we are redirected back to our profile.
* By clicking the 'Delete Account' button, we can delete our account. After clicking it, a confirmation window appears, and by clicking the 'OK' button, we can finalize the deletion.
* By clicking the 'Logout' button, we can log out of our account.

We also have the ability to edit our comments. To do this, we scroll down to the "My Comments" section, click the 'Edit' button on the right side of the comment we want to modify, make the desired changes, and click the 'Save' button. If we want to remove our comment, we can click the 'Delete' button.

### **Submit Ticket Page**
![Submit Ticket Page](/documentation/demo_create_ticket_view.png)

If we encounter any issues on the platform or come across any objectionable content, we can report it to the site administrators by submitting a ticket. We can access the submit ticket page by clicking the "Submit Ticket" link in the footer. After filling out the form, we can click the 'Submit' button to send our ticket.

Once we have submitted a ticket, we can track its status on our profile page.

## **For Administrators**

The basic functionality of the platform for administrators is the same as for regular users, but with additional features.

### **Management of Study Materials and Questions**
Administrators have the ability to edit and delete not only their own study materials and questions but also all study materials, questions, comments, and tickets on the platform. The process is the same as for regular users' actions on their own content.

### **User Management**
![Admin Panel](/documentation/demo_admin_panel.png)
When administrators view a user's profile, they see an 'Admin Panel' section (this is not visible on their own profile). Here are the available functions:
* Granting permissions to the user: Administrators can select the desired permission level from a dropdown list, such as 'Moderator' or 'User'. After selecting the appropriate option, they can click the 'Save' button to finalize the permission grant.
* Editing the profile: Administrators can change the display name and bio of the user, similar to editing their own information.
* Ban User: By clicking the 'Ban User' button, a confirmation dialog box appears to confirm the action. Clicking the 'OK' button finalizes the process. At this point, the user's account becomes inactive, and the user **cannot** log in anymore. However, their uploaded content remains visible, and their profile displays the active ban. The ban can be lifted at any time.
* Delete User: Clicking the 'Delete User' button also triggers a confirmation dialog box. Clicking 'OK' confirms the deletion. In this case, the user's account is completely removed, along with all their uploaded materials, questions, comments, and tickets.

### **Tickets Page**
![Tickets Page](/documentation/demo_tickets_view.png)

The admin user has the ability to view all tickets on the tickets page. Each ticket shows the user who submitted it and the message of the ticket. The default state of the tickets is "Pending," but if the administrator determines that the reported issue has been resolved, they can change it to "Resolved" by clicking the "Mark as: Resolved" button.

If, for any reason, a ticket needs to be reopened, the admin can do so by clicking the "Reopen Ticket" button. This reverts the ticket state back to "Pending."

Additionally, the admin can delete a ticket by clicking the "Reject" button.

## **For Moderators**
Managing the platform is the same for moderators as it is for regular users, but they have fewer privileges than admins. While an admin can ban and delete any user (including other moderators), a moderator can only manage regular users and doesn't have the ability to manage other moderators. Moderators have the same level of access as administrators when it comes to managing tickets.

Furthermore, moderators cannot assign permissions to users.

# Seeded User Data
Here are the details of some seeded users for login:

### Admin
username: lacika33  
email: admin@fakemail.com  
password: Jelszo123!

### Moderator
username: fecko123  
email: feco@fakemail.com  
password: Jelszo123!

### User
username: annakiss  
email: anna@fakemail.com  
password: Jelszo123!

For additional user data, please refer to the `UserSeeder.php` file.
