import { createRouter, createWebHistory } from 'vue-router'
import WelcomeView from '../views/WelcomeView.vue'
import QuestionsView from '../views/QuestionsView.vue'
import MyProfileView from '../views/MyProfileView.vue'
import EditMyProfileView from '../views/EditMyProfileView.vue'
import ContentsView from '../views/ContentsView.vue'
import LoginView from '../views/LoginView.vue'
import LoginCallbackView from '../views/LoginCallbackView.vue'
import ASZF from '../views/ASZF.vue'
import About from '../views/About.vue'
import CreateQuestionView from '../views/CreateQuestionView.vue'
import CreateContentView from '../views/CreateContentView.vue'
import SupportTicketView from '../views/SupportTicketView.vue'
import TicketsView from '../views/TicketsView.vue'
import DetailedContentView from '../views/DetailedContentView.vue'
import DetailedQuestionView from '../views/DetailedQuestionView.vue'

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
      props: {
        content: {
          type: Object,
          required: true
        }
      },
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
      props: {
        question: {
          type: Object,
          required: true
        }
      },
    },
    {
      path: '/myprofile',
      name: 'myprofile',
      component: MyProfileView
    },
    {
      path: '/myprofile/edit',
      name: 'edit',
      component: EditMyProfileView
    },
    
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/login/callback',
      name: 'login-callback',
      component: LoginCallbackView
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
      component: CreateQuestionView
    },
    {
      path: '/create/content',
      name: 'CreateContent',
      component: CreateContentView
    },
    {
      path: '/create/ticket',
      name: 'SupportTicket',
      component: SupportTicketView
    },
    {
      path: '/tickets',
      name: 'Tickets',
      component: TicketsView
    }
    
  ]
})

export default router
