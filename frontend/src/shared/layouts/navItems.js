export const navItems = [
  {
    name: 'Dashboard',
    path: '/dashboard',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3
           m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3
           m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2
           a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
      </path>
    </svg>`,
  },
  {
    name: 'Country List',
    path: '/countries',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2
           2 2 0 012 2v2.945M8 3.935V5.5
           A2.5 2.5 0 0010.5 8h.5
           a2 2 0 012 2 2 2 0 104 0
           2 2 0 012-2h1.064M15 20.488V18
           a2 2 0 012-2h3.064M21 12
           a9 9 0 11-18 0 9 9 0 0118 0z">
      </path>
    </svg>`,
  },
  {
    name: 'Client List',
    path: '/clients',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M17 20h5v-2a3 3 0 00-5.356-1.857
           M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857
           M7 20H2v-2a3 3 0 015.356-1.857
           M7 20v-2c0-.656.126-1.283.356-1.857
           m0 0a5.002 5.002 0 019.288 0
           M15 7a3 3 0 11-6 0 3 3 0 016 0
           zm6 3a2 2 0 11-4 0 2 2 0 014 0
           zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
      </path>
    </svg>`,
  },
  {
    name: 'Demand Letter List',
    path: '/work-orders',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12h6m-6 4h6
           m2 5H7a2 2 0 01-2-2V5
           a2 2 0 012-2h5.586a1 1 0 01.707.293
           l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
      </path>
    </svg>`,
  },
  {
    name: 'Job List',
    path: '/jobs',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 13.255A23.931 23.931 0 0112 15
           c-3.183 0-6.22-.62-9-1.745M16 6V4
           a2 2 0 00-2-2h-4a2 2 0 00-2 2v2
           m4 6h.01M5 20h14a2 2 0 002-2V8
           a2 2 0 00-2-2H5a2 2 0 00-2 2v10
           a2 2 0 002 2z">
      </path>
    </svg>`,
  },
  {
    name: 'ATS',
    path: '/jobs/ats',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M9 12h6m-6 4h6M7 4h7l5 5v11
         a2 2 0 01-2 2H7
         a2 2 0 01-2-2V6
         a2 2 0 012-2z" />
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M9 17l2 2 4-4" />
  </svg>`,
  },
  {
    name: 'Worker List',
    path: '/applications',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12h6m-6 4h6
           m2 5H7a2 2 0 01-2-2V5
           a2 2 0 012-2h5.586a1 1 0 01.707.293
           l5.414 5.414a1 1 0 01.293.707V19
           a2 2 0 01-2 2z">
      </path>
    </svg>`,
  },
  {
    name: 'POS',
    path: '/applications/pos',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
    stroke-width="2">
    <rect x="3" y="4" width="18" height="14" rx="2" ry="2" />
    <path d="M7 8h10" />
    <path d="M7 12h2m2 0h2m2 0h2" />
    <path d="M5 18h14" />
  </svg>`,
  },
  {
    name: 'Transaction List',
    path: '/applications/transactions',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    stroke-width="2">
    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
    <rect x="9" y="3" width="6" height="4" rx="1" />
    <path d="M8 11h8M8 15h6" />
  </svg>`,
  },
  {
    name: 'Candidate Bills',
    path: '/applications/candidate-bills',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
    stroke-width="2">
    <rect x="3" y="4" width="18" height="14" rx="2" ry="2" />
    <path d="M8 9h8" />
    <path d="M8 13h6" />
    <path d="M8 17h4" />
    <path d="M16 7l3 3-3 3" />
  </svg>`,
  },
  {
    name: 'Client Bills',
    path: '/applications/client-bills',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    stroke-width="2">
    <path d="M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" />
    <path d="M14 2v6h6" />
    <path d="M8 11h8M8 15h6" />
    <path d="M8 19h4" />
  </svg>`,
  },
  {
    name: 'Employee List',
    path: '/employees',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
    stroke-width="2">
    <circle cx="9" cy="7" r="4" />
    <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
    <rect x="15" y="3" width="6" height="10" rx="1" />
    <path d="M15 7h6" />
  </svg>`,
  },
  {
    name: 'ATS Reports',
    path: '/ats-reports',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    stroke-width="2">
    <rect x="3" y="3" width="18" height="18" rx="2" />
    <path d="M7 14v4M12 10v8M17 6v12" />
  </svg>`,
  },
  {
    name: 'Transaction Reports',
    path: '/transaction-reports',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    stroke-width="2">
    <path d="M3 3v18h18" />
    <rect x="7" y="13" width="3" height="5" rx="1"/>
    <rect x="12" y="9" width="3" height="9" rx="1"/>
    <rect x="17" y="5" width="3" height="13" rx="1"/>
  </svg>`,
  },
  {
    name: 'Worker Reports',
    path: '/application-reports',
    icon: `<svg xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    stroke-width="2">
    <path d="M6 3h9l3 3v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z"/>
    <path d="M9 10h6M9 14h6M9 18h4"/>
    <path d="M14 6h4v4"/>
  </svg>`,
  },
]
