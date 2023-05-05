import { createRouter, createWebHistory } from 'vue-router'
import WelcomeView from '../views/WelcomeView.vue'
import QuestionsView from '../views/QuestionsView.vue'
import ProfileView from '../views/ProfileView.vue'
import EditProfileView from '../views/EditProfileView.vue'
import ContentsView from '../views/ContentsView.vue'
import LoginView from '../views/LoginView.vue'
import ASZF from '../views/ASZF.vue'
import About from '../views/About.vue'
import CreateQuestionView from '../views/CreateQuestionView.vue'
import CreateContentView from '../views/CreateContentView.vue'
import CreateTicketView from '../views/CreateTicketView.vue'
import TicketsView from '../views/TicketsView.vue'
import DetailedContentView from '../views/DetailedContentView.vue'
import DetailedQuestionView from '../views/DetailedQuestionView.vue'
import RegistrationView from '../views/RegistrationView.vue'
import DocumentationView from '../views/DocumentationView.vue'
import EditQuestionView from '../views/EditQuestionView.vue'

import EditContentView from '../views/EditContentView.vue'

import { UserManager } from '../utils/UserManager';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  mode: 'history',
  routes: [
    
/*
|==========================================================================
| This is the default route, to welcome guests
|--------------------------------------------------------------------------
*/
    {
      path: '/',
      name: 'welcome',
      component: WelcomeView
    },
/*
|==========================================================================
|
|
|
|==========================================================================
| Routes for authentication
|--------------------------------------------------------------------------
*/
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/registration',
      name: 'registration',
      component: RegistrationView
    },
/*
|==========================================================================
*/

/*
|==========================================================================
| Routes for content actions
|--------------------------------------------------------------------------
*/
    {
      path: '/contents',
      name: 'contents',
      component: ContentsView
    },
    {
      path: '/contents/:id',
      name: 'contentById',
      component: DetailedContentView,
      props: true
    },
    
    {
      path: '/contents/:id/comments/:commentId',
      name: 'contentByIdCommentScroll',
      component: DetailedContentView,
      props: true
    },
    
    {
      path: '/contents/create',
      name: 'createContent',
      component: CreateContentView,
      meta:{requiresAuth: true}
    },
    {
      path: '/contents/:id/edit',
      name: 'editContent',
      component: EditContentView,
      props: true,
      meta:{requiresAuth: true}
    },

/*
|==========================================================================
| Routes for question actions
|--------------------------------------------------------------------------
*/
    {
      path: '/questions',
      name: 'questions',
      component: QuestionsView
    },
    {
      path: '/questions/:id',
      name: 'questionById',
      component: DetailedQuestionView,
      props: true
    },
    {
      path: '/questions/:id/comments/:commentId',
      name: 'questionByIdCommentScroll',
      component: DetailedQuestionView,
      props: true
    },
    {
      path: '/questions/create',
      name: 'createQuestion',
      component: CreateQuestionView,
      meta:{requiresAuth: true}
    },
    {
      path: '/questions/:id/edit',
      name: 'editQuestion',
      component: EditQuestionView,
      props: true,
      meta:{requiresAuth: true}
    },
/*
|==========================================================================
*/

/*
|==========================================================================
| Routes for user actions
|--------------------------------------------------------------------------
*/
    {
      path: '/me',
      name: 'myUserProfile',
      component: ProfileView,
      meta:{requiresAuth: true},
      props: true
    },
    {
      path: '/users/:id',
      name: 'userProfile',
      component: ProfileView,
      props: true
    },
    {
      path: '/users/:id/edit',
      name: 'editUserProfile',
      component: EditProfileView,
      meta:{requiresAuth: true},
      props: true
    },
/*
|==========================================================================
*/


/*
|==========================================================================
| Routes for ticket actions
|--------------------------------------------------------------------------
*/
    {
      path: '/tickets/create',
      name: 'createTicket',
      component: CreateTicketView,
      meta:{requiresAuth: true}
    },
    {
      path: '/tickets',
      name: 'tickets',
      component: TicketsView
    },
/*
|==========================================================================
*/

/*
|==========================================================================
| Routes for other actions
|--------------------------------------------------------------------------
*/
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/ASZF',
      name: 'aszf',
      component: ASZF
    },
    {
      path: '/documentation',
      name: 'documentation',
      component: DocumentationView
    },
/*
|==========================================================================
*/
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth && UserManager.getToken() === null) 
  {
    next('login');
    alert("A folytatáshoz kérlek jelentkezz be!");
  }  
  else next()
})

export default router
