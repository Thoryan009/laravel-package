import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'
import TransactionReportPrintPage from './pages/TransactionReportPrintPage.vue'
import TransactionReportsPage from './pages/TransactionReportsPage.vue'
import TransactionReportPage from './pages/TransactionReportPage.vue'

export default [
  {
    path: '/transaction-reports',
    component: DashboardLayout,
    meta: { requiresAuth: true, roles: ['super_admin', 'admin', 'recruiter'] },
    children: [
      {
        path: '',
        name: 'Transaction Reports',
        component: TransactionReportsPage,
      },
      {
        path: ':type',
        name: 'Transaction Report',
        component: TransactionReportPage,
      },
    ],
  },
  {
    path: '/transaction-reports/:type/print',
    name: 'Transaction Report Print',
    component: TransactionReportPrintPage,
    meta: { requiresAuth: true, roles: ['super_admin', 'admin', 'recruiter'] },
  },
]
