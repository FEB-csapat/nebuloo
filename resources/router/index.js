import { createRouter, createWebHistory } from 'vue-router'
import WelcomeView from '../views/WelcomeView.vue'
import QuestionsView from '../views/QuestionsView.vue'
import MyProfileView from '../views/MyProfileView.vue'
import EditMyProfileView from '../views/EditMyProfileView.vue'
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

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  mode: 'history',
  routes: [
    
    {
      path: '/',
      name: '',
      component: WelcomeView
    },

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
      path: '/myprofile',
      name: 'myprofile',
      component: MyProfileView,
      meta:{requiresAuth: true},
      props: true
    },
    {
      path: '/myprofile/edit',
      name: 'edit',
      component: EditMyProfileView,
      meta:{requiresAuth: true},
      props: true
    },
    
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
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/ASZF',
      name: 'ASZF',
      component: ASZF
    },
    {
      path: '/create/question',
      name: 'CreateQuestion',
      component: CreateQuestionView,
      meta:{requiresAuth: true}
    },
    {
      path: '/create/content',
      name: 'CreateContent',
      component: CreateContentView,
      meta:{requiresAuth: true}
    },
    {
      path: '/create/ticket',
      name: 'CreateTicket',
      component: CreateTicketView,
      meta:{requiresAuth: true}
    },
    {
      path: '/tickets',
      name: 'Tickets',
      component: TicketsView
    },
    {
      path: '/documentation',
      name: 'Documentation',
      component: DocumentationView
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth && sessionStorage.getItem('userToken') === null) 
  {
    next('login');
    alert("A folytatáshoz kérlek jelentkezz be!");
  }  
  else next()
})

export default router
