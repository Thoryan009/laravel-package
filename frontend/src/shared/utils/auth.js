import app from '@/shared/config/appConfig'


export const getToken = () => localStorage.getItem(app.tokenKey)
export const getUserRole = () => localStorage.getItem(app.userRoleKey)
