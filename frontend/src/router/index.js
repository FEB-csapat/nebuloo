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
import SupportTicketView from '../views/SupportTicketView.vue'
import TicketsView from '../views/TicketsView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/welcome',
      name: 'welcome',
      component: WelcomeView
    },
    {
      path: '/questions',
      name: 'questions',
      component: QuestionsView
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
      path: '/contents',
      name: 'contents',
      component: ContentsView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
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
