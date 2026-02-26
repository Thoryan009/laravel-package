import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import UnauthorizedPage from '@/shared/pages/UnauthorizedPage.vue'
import { guestGuard, authGuard, multiRoleGuard } from './guards/authGuard'

// 1. Glob all routes files inside modules
const routeFiles = import.meta.glob('../modules/**/routes.js', { eager: true })

// 2. Collect all routes
const moduleRoutes = Object.values(routeFiles).flatMap((mod) => {
  // mod may have named exports like { countryRoutes }, we extract all arrays
  return Object.values(mod).flat()
})

const routes = [
  ...moduleRoutes,
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
  path: '/unauthorized',
  name: 'unauthorized',
  component: UnauthorizedPage,
},
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

// 3. Global guards
router.beforeEach((to, from, next) => {
  // Guest pages
  if (to.meta.guest) return guestGuard(to, from, next)

  // Needs login
  if (to.meta.requiresAuth) {
    authGuard(to, from, () => {
      // 🔥 ROLE CHECK HERE
      if (to.meta.roles) {
        const guard = multiRoleGuard(to.meta.roles)
        return guard(to, from, next)
      }
      next()
    })
  } else {
    next()
  }
})

export default router
