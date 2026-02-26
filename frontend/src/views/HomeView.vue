<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Navigation Header -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <!-- Logo -->
          <div class="flex items-center space-x-2">
            <div
              class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-600 to-purple-600"
            >
              <svg
                class="h-6 w-6 text-white"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
              </svg>
            </div>
            <span
              class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"
            >SmartATS</span>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:flex items-center space-x-8">
            <a
              href="#features"
              class="text-gray-700 hover:text-blue-600 transition-colors font-medium"
            >Features</a>
            <a
              href="#benefits"
              class="text-gray-700 hover:text-blue-600 transition-colors font-medium"
            >Benefits</a>
            <a
              href="#pricing"
              class="text-gray-700 hover:text-blue-600 transition-colors font-medium"
            >Pricing</a>
            <a
              href="#contact"
              class="text-gray-700 hover:text-blue-600 transition-colors font-medium"
            >Contact</a>
            <button
              @click="handleLogin"
              class="rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200"
            >Login</button>
          </div>

          <!-- Mobile Menu Button -->
          <button
            @click="toggleMobileMenu"
            class="md:hidden rounded-lg p-2 text-gray-700 hover:bg-gray-100"
          >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                v-if="!isMobileMenuOpen"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>

        <!-- Mobile Navigation -->
        <div v-if="isMobileMenuOpen" class="md:hidden py-4 space-y-3 border-t">
          <a
            href="#features"
            class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg"
          >Features</a>
          <a
            href="#benefits"
            class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg"
          >Benefits</a>
          <a
            href="#pricing"
            class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg"
          >Pricing</a>
          <a
            href="#contact"
            class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg"
          >Contact</a>
          <button
            @click="handleLogin"
            class="w-full rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-2.5 text-sm font-semibold text-white"
          >Login</button>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden px-4 py-20 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">
          <!-- Left Content -->
          <div class="space-y-8">
            <div
              class="inline-flex items-center rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700"
            >
              <span class="mr-2">🚀</span>
              Trusted by 500+ Companies Worldwide
            </div>

            <h1
              class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl"
            >
              Streamline Your
              <span
                class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"
              >Hiring Process</span>
              with Smart ATS
            </h1>

            <p class="text-lg text-gray-600 leading-relaxed">
              Transform your recruitment workflow with our intelligent Applicant Tracking System.
              Manage job postings, track applications, and hire top talent faster than ever before.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
              <button
                @click="handleLogin"
                class="flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-4 text-base font-semibold text-white shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-200"
              >
                Get Started Free
                <svg
                  class="ml-2 h-5 w-5"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 7l5 5m0 0l-5 5m5-5H6"
                  />
                </svg>
              </button>
              <button
                class="flex items-center justify-center rounded-xl border-2 border-gray-300 bg-white px-8 py-4 text-base font-semibold text-gray-700 hover:border-blue-600 hover:text-blue-600 transition-all duration-200"
              >
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
                  />
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                Watch Demo
              </button>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-6 pt-8">
              <div>
                <div class="text-3xl font-bold text-gray-900">500+</div>
                <div class="text-sm text-gray-600">Companies</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900">50K+</div>
                <div class="text-sm text-gray-600">Applications</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900">98%</div>
                <div class="text-sm text-gray-600">Satisfaction</div>
              </div>
            </div>
          </div>

          <!-- Right Image/Illustration -->
          <div class="relative">
            <div
              class="absolute -inset-4 rounded-3xl bg-gradient-to-r from-blue-200 to-purple-200 opacity-30 blur-3xl"
            ></div>
            <div class="relative rounded-2xl bg-white p-8 shadow-2xl">
              <div class="space-y-4">
                <!-- Mock Dashboard Preview -->
                <div
                  class="flex items-center justify-between rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 p-4"
                >
                  <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-blue-600"></div>
                    <div>
                      <div class="h-3 w-24 rounded bg-gray-300"></div>
                      <div class="mt-1 h-2 w-16 rounded bg-gray-200"></div>
                    </div>
                  </div>
                  <div class="h-8 w-8 rounded-lg bg-green-100"></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div class="rounded-lg bg-blue-50 p-4">
                    <div class="text-2xl font-bold text-blue-600">245</div>
                    <div class="text-xs text-gray-600">Active Jobs</div>
                  </div>
                  <div class="rounded-lg bg-purple-50 p-4">
                    <div class="text-2xl font-bold text-purple-600">1.2K</div>
                    <div class="text-xs text-gray-600">Candidates</div>
                  </div>
                </div>

                <div class="space-y-3">
                  <div
                    class="flex items-center justify-between rounded-lg border-2 border-gray-100 p-3"
                  >
                    <div class="flex items-center space-x-3">
                      <div class="h-3 w-3 rounded-full bg-green-500"></div>
                      <div class="h-3 w-32 rounded bg-gray-200"></div>
                    </div>
                    <div class="h-6 w-16 rounded bg-blue-100"></div>
                  </div>
                  <div
                    class="flex items-center justify-between rounded-lg border-2 border-gray-100 p-3"
                  >
                    <div class="flex items-center space-x-3">
                      <div class="h-3 w-3 rounded-full bg-yellow-500"></div>
                      <div class="h-3 w-28 rounded bg-gray-200"></div>
                    </div>
                    <div class="h-6 w-16 rounded bg-purple-100"></div>
                  </div>
                  <div
                    class="flex items-center justify-between rounded-lg border-2 border-gray-100 p-3"
                  >
                    <div class="flex items-center space-x-3">
                      <div class="h-3 w-3 rounded-full bg-blue-500"></div>
                      <div class="h-3 w-36 rounded bg-gray-200"></div>
                    </div>
                    <div class="h-6 w-16 rounded bg-green-100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white px-4 py-20 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="text-center mb-16">
          <h2
            class="text-3xl font-bold text-gray-900 sm:text-4xl"
          >Powerful Features for Modern Recruiting</h2>
          <p
            class="mt-4 text-lg text-gray-600"
          >Everything you need to hire the best talent efficiently</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          <div
            v-for="feature in features"
            :key="feature.title"
            class="group rounded-2xl border-2 border-gray-100 p-8 hover:border-blue-500 hover:shadow-xl transition-all duration-300"
          >
            <div
              class="mb-4 inline-flex rounded-xl bg-gradient-to-br from-blue-100 to-purple-100 p-3 group-hover:scale-110 transition-transform"
            >
              <span v-html="feature.icon" class="h-8 w-8 text-blue-600"></span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ feature.title }}</h3>
            <p class="text-gray-600">{{ feature.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Benefits Section -->
    <section
      id="benefits"
      class="bg-gradient-to-br from-blue-50 to-purple-50 px-4 py-20 sm:px-6 lg:px-8"
    >
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-2 items-center">
          <div>
            <h2
              class="text-3xl font-bold text-gray-900 sm:text-4xl mb-6"
            >Why Companies Choose SmartATS</h2>
            <div class="space-y-6">
              <div
                v-for="benefit in benefits"
                :key="benefit.title"
                class="flex items-start space-x-4"
              >
                <div class="flex-shrink-0 mt-1">
                  <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100">
                    <svg
                      class="h-5 w-5 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                      />
                    </svg>
                  </div>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">{{ benefit.title }}</h3>
                  <p class="mt-1 text-gray-600">{{ benefit.description }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="relative">
            <div class="rounded-2xl bg-white p-8 shadow-2xl">
              <div class="mb-6 text-center">
                <div
                  class="text-5xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text"
                >70%</div>
                <div class="mt-2 text-gray-600">Faster Hiring Process</div>
              </div>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <span class="text-sm text-gray-600">Time to Hire</span>
                  <span class="text-sm font-semibold text-green-600">↓ 45 days</span>
                </div>
                <div class="h-2 rounded-full bg-gray-200">
                  <div class="h-2 rounded-full bg-gradient-to-r from-green-400 to-green-600 w-3/4"></div>
                </div>
                <div class="flex items-center justify-between">
                  <span class="text-sm text-gray-600">Application Quality</span>
                  <span class="text-sm font-semibold text-blue-600">↑ 85%</span>
                </div>
                <div class="h-2 rounded-full bg-gray-200">
                  <div class="h-2 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 w-4/5"></div>
                </div>
                <div class="flex items-center justify-between">
                  <span class="text-sm text-gray-600">Cost Reduction</span>
                  <span class="text-sm font-semibold text-purple-600">↓ 60%</span>
                </div>
                <div class="h-2 rounded-full bg-gray-200">
                  <div
                    class="h-2 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 w-3/5"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 px-4 py-20 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">
        <h2 class="text-3xl font-bold text-white sm:text-4xl mb-6">Ready to Transform Your Hiring?</h2>
        <p
          class="text-xl text-blue-100 mb-8"
        >Join hundreds of companies already using SmartATS to find their perfect candidates</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button
            @click="handleLogin"
            class="inline-flex items-center justify-center rounded-xl bg-white px-8 py-4 text-base font-semibold text-blue-600 shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-200"
          >
            Start Free Trial
            <svg
              class="ml-2 h-5 w-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 7l5 5m0 0l-5 5m5-5H6"
              />
            </svg>
          </button>
          <button
            class="inline-flex items-center justify-center rounded-xl border-2 border-white bg-transparent px-8 py-4 text-base font-semibold text-white hover:bg-white hover:text-blue-600 transition-all duration-200"
          >Schedule a Demo</button>
        </div>
        <p class="mt-6 text-sm text-blue-100">No credit card required • 14-day free trial</p>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 px-4 py-12 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-8 md:grid-cols-4">
          <div class="md:col-span-1">
            <div class="flex items-center space-x-2 mb-4">
              <div
                class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-600 to-purple-600"
              >
                <svg
                  class="h-5 w-5 text-white"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
              </div>
              <span class="text-lg font-bold text-white">SmartATS</span>
            </div>
            <p
              class="text-sm text-gray-400"
            >Streamline your hiring process with intelligent automation.</p>
          </div>

          <div>
            <h4 class="text-sm font-semibold text-white mb-4">Product</h4>
            <ul class="space-y-2 text-sm text-gray-400">
              <li>
                <a href="#" class="hover:text-white transition-colors">Features</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Pricing</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Integrations</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">API</a>
              </li>
            </ul>
          </div>

          <div>
            <h4 class="text-sm font-semibold text-white mb-4">Company</h4>
            <ul class="space-y-2 text-sm text-gray-400">
              <li>
                <a href="#" class="hover:text-white transition-colors">About</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Blog</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Careers</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
              </li>
            </ul>
          </div>

          <div>
            <h4 class="text-sm font-semibold text-white mb-4">Legal</h4>
            <ul class="space-y-2 text-sm text-gray-400">
              <li>
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Terms</a>
              </li>
              <li>
                <a href="#" class="hover:text-white transition-colors">Security</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="mt-12 border-t border-gray-800 pt-8 text-center">
          <p class="text-sm text-gray-400">&copy; 2026 SmartATS. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const isMobileMenuOpen = ref(false)

const router = useRouter()

const features = ref([
  {
    title: 'Job Posting Management',
    description:
      'Create, publish, and manage job postings across multiple platforms from a single dashboard.',
    icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
  },
  {
    title: 'Candidate Tracking',
    description:
      'Track applications through every stage of the hiring pipeline with automated workflows.',
    icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
  },
  {
    title: 'Smart Filtering',
    description:
      'Use AI-powered filters to quickly identify the most qualified candidates for each position.',
    icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>',
  },
  {
    title: 'Collaboration Tools',
    description:
      'Enable seamless collaboration between hiring managers, recruiters, and team members.',
    icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
  },
  {
    title: 'Analytics & Reports',
    description:
      'Get insights into your hiring metrics with comprehensive analytics and custom reports.',
    icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
  },
  {
    title: 'Integration Ready',
    description:
      'Connect with your favorite tools including email, calendar, and HR systems seamlessly.',
    icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>',
  },
])

const benefits = ref([
  {
    title: 'Save Time & Money',
    description:
      'Reduce time-to-hire by 70% and cut recruitment costs significantly with automated workflows.',
  },
  {
    title: 'Better Candidate Experience',
    description:
      'Provide a smooth application process that keeps candidates engaged throughout their journey.',
  },
  {
    title: 'Data-Driven Decisions',
    description:
      'Make informed hiring decisions backed by comprehensive analytics and performance metrics.',
  },
  {
    title: 'Scalable Solution',
    description: 'Grow your hiring capacity without increasing overhead as your company expands.',
  },
])

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const handleLogin = () => {
  router.push('/login')
}
</script>
