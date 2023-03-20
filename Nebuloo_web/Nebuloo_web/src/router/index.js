import { createRouter, createWebHistory } from 'vue-router'
import StartupView from '../views/StartupView.vue'
import QuestionsView from '../views/QuestionsView.vue'
import MyProfileView from '../views/MyProfileView.vue'
import EditMyProfileView from '../views/EditMyProfileView.vue'
import MaterialsView from '../views/MaterialsView.vue'
import LoginView from '../views/LoginView.vue'
import ASZF from '../views/ASZF.vue'
import About from '../views/About.vue'
import NewQuestionView from '../views/NewQuestionView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: StartupView
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
      path: '/materials',
      name: 'materials',
      component: MaterialsView
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
      path: '/new/question',
      name: 'NewQuestion',
      component: NewQuestionView
    }
    
  ]
})

export default router
