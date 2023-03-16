import { createRouter, createWebHistory } from 'vue-router'
import StartupView from '../views/StartupView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: StartupView
    }
  ]
})

export default router
