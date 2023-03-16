import { createRouter, createWebHistory } from 'vue-router'
import StartupView from '../views/StartupView.vue'
import QuestionsView from '../views/QuestionsView.vue'
import MyProfileView from '../views/MyProfileView.vue'
import EditMyProfileView from '../views/EditMyProfileView.vue'
import MaterialsView from '../views/MaterialsView.vue'

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
    }
    
  ]
})

export default router
