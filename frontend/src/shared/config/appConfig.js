const app = {
  apiUrl: import.meta.env.VITE_APP_API_URL || 'http://localhost:8000/api',
  environment: import.meta.env.VITE_APP_ENV || 'local',
  tokenKey: import.meta.env.VITE_APP_TOKEN_KEY || 'app_token',
  userRoleKey: import.meta.env.VITE_APP_USER_ROLE_KEY || 'app_user_role',
  moduleLocal: import.meta.env.VITE_APP_MODULE_LOCAL === 'true',
  name: import.meta.env.VITE_APP_NAME || 'My App',
}

export default app
