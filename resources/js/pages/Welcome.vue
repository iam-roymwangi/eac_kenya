<template>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">
      <!-- Navigation -->
      <nav class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
              <span class="text-white font-bold text-lg">E</span>
            </div>
            <span class="text-xl font-bold text-slate-900">EAC</span>
          </div>
          <div class="hidden md:flex items-center gap-8">
            <a href="#about" class="text-slate-700 hover:text-emerald-600 transition">About</a>
            <a href="#projects" class="text-slate-700 hover:text-emerald-600 transition">Projects</a>
            <a href="#offices" class="text-slate-700 hover:text-emerald-600 transition">Offices</a>
            <a href="#contact" class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-full hover:shadow-lg transition transform hover:scale-105">Contact</a>
          </div>
        </div>
      </nav>
  
      <!-- Hero Section -->
      <section class="pt-32 pb-20 px-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-teal-50/50"></div>
        <div class="max-w-6xl mx-auto relative z-10">
          <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
              <div class="inline-block mb-4 px-4 py-2 bg-emerald-100 rounded-full">
                <span class="text-emerald-700 text-sm font-semibold">🌍 Sustainable Energy Leadership</span>
              </div>
              <h1 class="text-5xl md:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Invest in the Future</span>
                <br />of Renewable Energy
              </h1>
              <p class="text-xl text-slate-600 mb-8 leading-relaxed">
                EAC connects institutional investors with high-yield renewable energy and solar investment opportunities. Our expert consultancy guides strategic investments in sustainable growth.
              </p>
              <div class="flex gap-4 flex-wrap">
                <button @click="scrollTo('contact')" class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg font-semibold hover:shadow-xl transition transform hover:scale-105">
                  Get Started
                </button>
                <button class="px-8 py-4 border-2 border-emerald-500 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">
                  Learn More
                </button>
              </div>
            </div>
            <div class="relative h-96 md:h-full">
              <img 
                src="https://images.unsplash.com/photo-1509391366360-2e938aa1ef14?w=600&h=600&fit=crop" 
                alt="Solar panels" 
                class="w-full h-full object-cover rounded-2xl shadow-2xl hover:shadow-3xl transition"
              />
              <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl opacity-20 blur-2xl"></div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Stats Section -->
      <section class="py-16 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
          <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center p-6">
              <div class="text-4xl font-bold text-emerald-600 mb-2">$2.3B+</div>
              <p class="text-slate-600">Assets Under Management</p>
            </div>
            <div class="text-center p-6">
              <div class="text-4xl font-bold text-teal-600 mb-2">450+</div>
              <p class="text-slate-600">Active Projects</p>
            </div>
            <div class="text-center p-6">
              <div class="text-4xl font-bold text-emerald-600 mb-2">15 Years</div>
              <p class="text-slate-600">Industry Experience</p>
            </div>
            <div class="text-center p-6">
              <div class="text-4xl font-bold text-teal-600 mb-2">24.5%</div>
              <p class="text-slate-600">Average Annual ROI</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- About Section -->
      <section id="about" class="py-20 px-6 bg-gradient-to-b from-slate-50 to-slate-100">
        <div class="max-w-6xl mx-auto">
          <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
              <img 
                src="https://images.unsplash.com/photo-1497440991051-6da3b08ba192?w=600&h=600&fit=crop" 
                alt="Wind turbines" 
                class="w-full rounded-2xl shadow-2xl"
              />
            </div>
            <div>
              <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Why Choose EAC?</h2>
              <div class="space-y-6">
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-2xl">📊</span>
                  </div>
                  <div>
                    <h3 class="font-bold text-lg text-slate-900">Expert Analysis</h3>
                    <p class="text-slate-600">Deep-dive market research and due diligence on every opportunity</p>
                  </div>
                </div>
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-2xl">🌱</span>
                  </div>
                  <div>
                    <h3 class="font-bold text-lg text-slate-900">Sustainable Growth</h3>
                    <p class="text-slate-600">Investments aligned with global sustainability goals</p>
                  </div>
                </div>
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-2xl">🔒</span>
                  </div>
                  <div>
                    <h3 class="font-bold text-lg text-slate-900">Secure Returns</h3>
                    <p class="text-slate-600">Risk management strategies protecting your capital</p>
                  </div>
                </div>
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-2xl">🤝</span>
                  </div>
                  <div>
                    <h3 class="font-bold text-lg text-slate-900">Dedicated Support</h3>
                    <p class="text-slate-600">Personal account managers for institutional clients</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Projects Portfolio -->
      <section id="projects" class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">Featured Projects</h2>
            <p class="text-xl text-slate-600">Landmark investments showcasing our expertise across the renewable sector</p>
          </div>
          
          <div class="grid md:grid-cols-3 gap-8">
            <!-- Project 1 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition">
              <img 
                src="https://images.unsplash.com/photo-1508720527620-ce4560e64412?w=500&h=500&fit=crop" 
                alt="Solar Farm" 
                class="w-full h-80 object-cover group-hover:scale-110 transition duration-300"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                <h3 class="text-2xl font-bold text-white mb-2">Saharan Solar Complex</h3>
                <p class="text-emerald-100">850MW capacity | $420M invested | 24.8% ROI</p>
              </div>
            </div>
  
            <!-- Project 2 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition">
              <img 
                src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=500&h=500&fit=crop" 
                alt="Wind Farm" 
                class="w-full h-80 object-cover group-hover:scale-110 transition duration-300"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                <h3 class="text-2xl font-bold text-white mb-2">North Atlantic Wind Park</h3>
                <p class="text-emerald-100">620MW capacity | $580M invested | 23.2% ROI</p>
              </div>
            </div>
  
            <!-- Project 3 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition">
              <img 
                src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=500&h=500&fit=crop" 
                alt="Hydro Plant" 
                class="w-full h-80 object-cover group-hover:scale-110 transition duration-300"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                <h3 class="text-2xl font-bold text-white mb-2">Alpine Hydroelectric Hub</h3>
                <p class="text-emerald-100">340MW capacity | $295M invested | 25.1% ROI</p>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Services Section -->
      <section class="py-20 px-6 bg-gradient-to-b from-emerald-50 to-teal-50">
        <div class="max-w-6xl mx-auto">
          <h2 class="text-4xl md:text-5xl font-bold text-center text-slate-900 mb-16">Our Services</h2>
          
          <div class="grid md:grid-cols-2 gap-12">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
              <div class="text-4xl mb-4">💼</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Investment Consulting</h3>
              <p class="text-slate-600 mb-6">Custom portfolio strategies aligned with your investment goals and risk tolerance in renewable energy markets.</p>
              <ul class="space-y-3 text-slate-700">
                <li class="flex items-center gap-2">
                  <span class="text-emerald-500">✓</span> Market analysis & due diligence
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-emerald-500">✓</span> Risk assessment frameworks
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-emerald-500">✓</span> Portfolio optimization
                </li>
              </ul>
            </div>
  
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
              <div class="text-4xl mb-4">🏗️</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Project Development</h3>
              <p class="text-slate-600 mb-6">End-to-end support from feasibility studies to operational management of renewable energy projects.</p>
              <ul class="space-y-3 text-slate-700">
                <li class="flex items-center gap-2">
                  <span class="text-teal-500">✓</span> Site assessment & engineering
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-teal-500">✓</span> Regulatory compliance
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-teal-500">✓</span> Operations management
                </li>
              </ul>
            </div>
  
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
              <div class="text-4xl mb-4">📈</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Performance Tracking</h3>
              <p class="text-slate-600 mb-6">Real-time analytics and reporting dashboards for monitoring investment performance and returns.</p>
              <ul class="space-y-3 text-slate-700">
                <li class="flex items-center gap-2">
                  <span class="text-emerald-500">✓</span> Monthly performance reports
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-emerald-500">✓</span> Live dashboard access
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-emerald-500">✓</span> Impact metrics reporting
                </li>
              </ul>
            </div>
  
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
              <div class="text-4xl mb-4">🌍</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Sustainability Impact</h3>
              <p class="text-slate-600 mb-6">Comprehensive ESG reporting and impact measurement aligned with global sustainability standards.</p>
              <ul class="space-y-3 text-slate-700">
                <li class="flex items-center gap-2">
                  <span class="text-teal-500">✓</span> Carbon offset tracking
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-teal-500">✓</span> ESG compliance reporting
                </li>
                <li class="flex items-center gap-2">
                  <span class="text-teal-500">✓</span> Impact certification
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Office Locations -->
      <section id="offices" class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">Global Presence</h2>
            <p class="text-xl text-slate-600">Connected across continents, closer to your opportunities</p>
          </div>
  
          <div class="grid md:grid-cols-3 gap-8">
            <!-- New York -->
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-8 rounded-2xl border-2 border-emerald-200">
              <div class="text-3xl mb-4">🗽</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">North America</h3>
              <div class="space-y-4">
                <div>
                  <h4 class="font-bold text-slate-900">New York (HQ)</h4>
                  <p class="text-slate-600">350 Fifth Avenue, Suite 2500</p>
                  <p class="text-slate-600">New York, NY 10118</p>
                  <p class="text-emerald-600 font-semibold">+1 (212) 555-0142</p>
                </div>
                <div>
                  <h4 class="font-bold text-slate-900">San Francisco</h4>
                  <p class="text-slate-600">101 California Street, Suite 1800</p>
                  <p class="text-slate-600">San Francisco, CA 94111</p>
                  <p class="text-emerald-600 font-semibold">+1 (415) 555-0184</p>
                </div>
              </div>
            </div>
  
            <!-- London -->
            <div class="bg-gradient-to-br from-teal-50 to-emerald-50 p-8 rounded-2xl border-2 border-teal-200">
              <div class="text-3xl mb-4">🇬🇧</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Europe</h3>
              <div class="space-y-4">
                <div>
                  <h4 class="font-bold text-slate-900">London</h4>
                  <p class="text-slate-600">30 St Mary Axe</p>
                  <p class="text-slate-600">London, EC3A 8EP, UK</p>
                  <p class="text-teal-600 font-semibold">+44 (20) 7946 0958</p>
                </div>
                <div>
                  <h4 class="font-bold text-slate-900">Copenhagen</h4>
                  <p class="text-slate-600">Nørregade 21, 4th Floor</p>
                  <p class="text-slate-600">Copenhagen, 1165, Denmark</p>
                  <p class="text-teal-600 font-semibold">+45 3312 2300</p>
                </div>
              </div>
            </div>
  
            <!-- Singapore -->
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-8 rounded-2xl border-2 border-emerald-200">
              <div class="text-3xl mb-4">🏙️</div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Asia Pacific</h3>
              <div class="space-y-4">
                <div>
                  <h4 class="font-bold text-slate-900">Singapore</h4>
                  <p class="text-slate-600">71 Robinson Road, #16-04</p>
                  <p class="text-slate-600">Singapore 068895</p>
                  <p class="text-emerald-600 font-semibold">+65 6415 2200</p>
                </div>
                <div>
                  <h4 class="font-bold text-slate-900">Melbourne</h4>
                  <p class="text-slate-600">Level 3, 477 Collins Street</p>
                  <p class="text-slate-600">Melbourne, VIC 3000, AU</p>
                  <p class="text-emerald-600 font-semibold">+61 (3) 9650 2800</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Contact CTA Section -->
      <section id="contact" class="py-20 px-6 bg-gradient-to-br from-slate-900 to-slate-800 text-white">
        <div class="max-w-4xl mx-auto">
          <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Ready to Invest?</h2>
            <p class="text-xl text-slate-300">Connect with our investment specialists to explore opportunities</p>
          </div>
  
          <form @submit.prevent="submitForm" class="space-y-6 bg-slate-800/50 p-8 rounded-2xl backdrop-blur-sm">
            <div class="grid md:grid-cols-2 gap-6">
              <input 
                v-model="form.name"
                type="text" 
                placeholder="Full Name" 
                class="px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500"
                required
              />
              <input 
                v-model="form.email"
                type="email" 
                placeholder="Email Address" 
                class="px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500"
                required
              />
            </div>
  
            <div class="grid md:grid-cols-2 gap-6">
              <input 
                v-model="form.company"
                type="text" 
                placeholder="Company Name" 
                class="px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500"
              />
              <input 
                v-model="form.investmentAmount"
                type="text" 
                placeholder="Investment Range (e.g., $5M - $20M)" 
                class="px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500"
              />
            </div>
  
            <textarea 
              v-model="form.message"
              placeholder="Tell us about your investment goals..." 
              rows="5"
              class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500"
            ></textarea>
  
            <button 
              type="submit"
              class="w-full px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg font-bold text-lg hover:shadow-xl transition transform hover:scale-105"
            >
              Schedule Consultation
            </button>
  
            <p v-if="submitted" class="text-emerald-300 text-center">
              ✓ Thank you! We'll contact you within 24 hours.
            </p>
          </form>
  
          <div class="mt-12 grid md:grid-cols-3 gap-8 text-center">
            <div>
              <p class="text-slate-400 mb-2">Email</p>
              <p class="text-emerald-400 font-semibold">investors@eac-energy.com</p>
            </div>
            <div>
              <p class="text-slate-400 mb-2">Phone</p>
              <p class="text-teal-400 font-semibold">+1 (212) 555-0142</p>
            </div>
            <div>
              <p class="text-slate-400 mb-2">Response Time</p>
              <p class="text-emerald-400 font-semibold">Within 24 hours</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Footer -->
      <footer class="py-12 px-6 bg-slate-950 text-slate-400 border-t border-slate-800">
        <div class="max-w-6xl mx-auto">
          <div class="grid md:grid-cols-4 gap-8 mb-8">
            <div>
              <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                  <span class="text-white font-bold">E</span>
                </div>
                <span class="font-bold text-white">EAC</span>
              </div>
              <p class="text-sm">Leading renewable energy investment consultancy</p>
            </div>
            <div>
              <h4 class="font-semibold text-white mb-4">Quick Links</h4>
              <ul class="space-y-2 text-sm">
                <li><a href="#about" class="hover:text-emerald-400 transition">About Us</a></li>
                <li><a href="#projects" class="hover:text-emerald-400 transition">Projects</a></li>
                <li><a href="#offices" class="hover:text-emerald-400 transition">Offices</a></li>
              </ul>
            </div>
            <div>
              <h4 class="font-semibold text-white mb-4">Services</h4>
              <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-teal-400 transition">Investment Consulting</a></li>
                <li><a href="#" class="hover:text-teal-400 transition">Project Development</a></li>
                <li><a href="#" class="hover:text-teal-400 transition">Performance Tracking</a></li>
              </ul>
            </div>
            <div>
              <h4 class="font-semibold text-white mb-4">Legal</h4>
              <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-emerald-400 transition">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-emerald-400 transition">Terms of Service</a></li>
                <li><a href="#" class="hover:text-emerald-400 transition">Disclosures</a></li>
              </ul>
            </div>
          </div>
          <div class="border-t border-slate-800 pt-8 text-center text-sm">
            <p>&copy; 2026 EAC Energy Consultancy. All rights reserved. | Committed to sustainable energy investment worldwide</p>
          </div>
        </div>
      </footer>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  
  const form = ref({
    name: '',
    email: '',
    company: '',
    investmentAmount: '',
    message: ''
  })
  
  const submitted = ref(false)
  
  const submitForm = () => {
    console.log('Form submitted:', form.value)
    submitted.value = true
    setTimeout(() => {
      form.value = { name: '', email: '', company: '', investmentAmount: '', message: '' }
      submitted.value = false
    }, 3000)
  }
  
  const scrollTo = (id: string) => {
    const element = document.getElementById(id)
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' })
    }
  }
  </script>
  
  <style scoped>
  ::-webkit-scrollbar {
    width: 8px;
  }
  
  ::-webkit-scrollbar-track {
    background: #f1f5f9;
  }
  
  ::-webkit-scrollbar-thumb {
    background: #10b981;
    border-radius: 4px;
  }
  
  ::-webkit-scrollbar-thumb:hover {
    background: #059669;
  }
  </style>