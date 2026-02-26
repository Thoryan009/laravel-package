const recruiter = [
  'Dashboard',
  'Country List',
  'Client List',
  'Demand Letter List',
  'Demand Letter Details List',
  'Order Details Category List',
  'Order Details Head List',
  'Job List',
  'ATS',
  'Job ATS',
  'Worker List',
  'Process List',
  'Acknowledgement Doc',
  'Setting',
  'ATS Reports',
  'Transaction Reports',
  'Worker Reports',
]

const accountant = [
  'Dashboard',
  'POS',
  'Transaction List',
  'Candidate Bills',
  'Client Bills',
  'Print Invoice',
  'Setting',
]

const admin = [...recruiter, 'Employee List', 'Designation List']

const super_admin = [...recruiter, ...admin, ...accountant]

const roleBasedNavItems = {
  recruiter,
  admin,
  accountant,
  super_admin,
}

export default roleBasedNavItems
