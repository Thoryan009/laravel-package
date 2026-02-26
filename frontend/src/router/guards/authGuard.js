import { getToken, getUserRole } from '@/shared/utils/auth'

export function guestGuard(to, from, next) {
  const token = getToken()

  // If user already logged in → redirect to dashboard
  if (token) {
    return next({ name: 'Dashboard' })
  }

  next()
}

export function authGuard(to, from, next) {
  const token = getToken()

  if (!token) {
    return next({ name: 'Login' })
  }

  next()
}

// 🔥 ROLE GUARD FACTORY (Reusable)
const roleGuard = (allowedRoles = []) => {
  return (to, from, next) => {
    const token = getToken()
    const role = getUserRole()

    if (!token) return next({ name: 'Login' })

    if (!allowedRoles.includes(role)) {
      return next({ name: 'unauthorized' }) // create this page
    }

    next()
  }
}


// Specific guards
export const superAdminGuard = roleGuard(['super_admin'])
export const adminGuard = roleGuard(['admin'])
export const accountantGuard = roleGuard(['accountant'])
export const recruiterGuard = roleGuard(['recruiter'])

// Multiple role guard
export const multiRoleGuard = roleGuard
