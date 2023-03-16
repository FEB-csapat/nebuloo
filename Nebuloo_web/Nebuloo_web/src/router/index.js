import { createRouter, createWebHistory } from 'vue-router'
import StartupView from '../views/StartupView.vue'
import QuestionsView from '../views/QuestionsView.vue'

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
    }
  ]
})

export default router
