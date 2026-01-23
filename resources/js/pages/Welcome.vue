<template>
  <div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-200 selection:text-emerald-900">
    <div 
      class="fixed top-0 left-0 h-1 bg-emerald-500 z-[110] transition-all duration-150" 
      :style="{ width: scrollProgress + '%' }"
    ></div>

    <nav 
      class="fixed w-full top-0 z-[100] transition-all duration-500"
      :class="[isScrolled ? 'bg-white/80 backdrop-blur-xl shadow-sm py-3' : 'bg-transparent py-6']"
    >
      <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <div class="flex items-center gap-3 group cursor-pointer" @click="scrollTo('hero')">
          <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center rotate-3 group-hover:rotate-0 transition-all shadow-lg shadow-emerald-200">
            <span class="text-white font-black text-xl">E</span>
          </div>
          <span class="text-xl font-black tracking-tighter transition-colors" :class="isScrolled ? 'text-slate-900' : 'text-white'">EAC</span>
        </div>
        
        <div class="hidden md:flex items-center gap-10">
          <a v-for="item in ['About', 'Projects', 'Offices']" :key="item" 
             :href="`#${item.toLowerCase()}`" 
             class="text-xs font-bold uppercase tracking-widest transition-colors"
             :class="isScrolled ? 'text-slate-600 hover:text-emerald-600' : 'text-white/80 hover:text-white'">
            {{ item }}
          </a>
          <button @click="scrollTo('contact')" 
                  class="px-6 py-2.5 bg-emerald-600 text-white text-xs font-bold uppercase tracking-widest rounded-full hover:bg-emerald-500 hover:shadow-xl hover:shadow-emerald-200 transition-all active:scale-95">
            Start Investing
          </button>
        </div>

        <button @click="mobileMenu = !mobileMenu" class="md:hidden text-white p-2">
          <div class="w-6 h-0.5 bg-current mb-1.5 transition-all" :class="{'rotate-45 translate-y-2': mobileMenu}"></div>
          <div class="w-6 h-0.5 bg-current mb-1.5" :class="{'opacity-0': mobileMenu}"></div>
          <div class="w-6 h-0.5 bg-current" :class="{'-rotate-45 -translate-y-2': mobileMenu}"></div>
        </button>
      </div>
    </nav>

    <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img 
          src="https://images.unsplash.com/photo-1466611653911-95282fc3656b?q=80&w=2070&auto=format&fit=crop" 
          class="w-full h-full object-cover scale-110 motion-safe:animate-slow-zoom"
          alt="Renewable Energy Landscape"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/60 to-transparent"></div>
      </div>

      <div class="max-w-7xl mx-auto px-6 relative z-10 grid lg:grid-cols-2 gap-16 items-center pt-20">
        <div v-reveal class="space-y-8 text-left">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full backdrop-blur-md">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-emerald-400 text-[10px] font-bold uppercase tracking-[0.2em]">Institutional Grade Assets</span>
          </div>
          
          <h1 class="text-6xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter">
            Invest in <br/> <span class="text-emerald-500 italic">Impact</span> <br/> Returns.
          </h1>
          
          <p class="text-lg text-slate-300 max-w-lg leading-relaxed font-medium">
            Bridging the gap between global capital and sustainable growth. We deliver risk-mitigated access to the world's most vital energy projects.
          </p>

          <div class="flex flex-col sm:flex-row gap-5">
            <button @click="scrollTo('contact')" class="group px-8 py-4 bg-white text-slate-900 rounded-xl font-bold flex items-center justify-center gap-3 hover:bg-emerald-500 hover:text-white transition-all duration-300">
              Inquire Now
              <span class="group-hover:translate-x-1 transition-transform">→</span>
            </button>
            <button class="px-8 py-4 border border-white/20 bg-white/5 backdrop-blur-md text-white rounded-xl font-bold hover:bg-white/10 transition-all">
              Our Vision
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 px-6 relative -mt-20 z-20">
      <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
        <div v-for="(stat, index) in stats" :key="index" v-reveal
             class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all">
          <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-4">{{ stat.label }}</p>
          <div class="text-4xl font-black text-slate-900 tracking-tighter mb-2 group-hover:text-emerald-600 transition-colors">
            {{ stat.value }}
          </div>
          <div class="w-8 h-1 bg-emerald-100 rounded-full group-hover:w-16 transition-all duration-500"></div>
        </div>
      </div>
    </section>

    <section id="projects" class="py-24 px-6 bg-slate-50">
      <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
          <div v-reveal>
            <h2 class="text-[10px] font-bold text-emerald-600 uppercase tracking-[0.4em] mb-4">The Portfolio</h2>
            <h3 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter">Global Projects.</h3>
          </div>
          <p class="text-slate-500 max-w-sm font-medium border-l-2 border-emerald-500 pl-6">Deploying capital across high-performing solar, wind, and hydro assets worldwide.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 h-auto md:h-[600px]">
          <div v-reveal class="md:col-span-8 group relative overflow-hidden rounded-[2.5rem] shadow-2xl h-80 md:h-full">
            <img src="https://images.unsplash.com/photo-1509391366360-2e938aa1ef14?auto=format&fit=crop&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent p-10 flex flex-col justify-end">
              <span class="text-emerald-400 font-bold uppercase tracking-widest text-[10px] mb-2">Solar Complex</span>
              <h4 class="text-3xl font-black text-white">Saharan Infrastructure</h4>
            </div>
          </div>
          <div v-reveal class="md:col-span-4 group relative overflow-hidden rounded-[2.5rem] shadow-2xl h-80 md:h-full">
            <img src="https://images.unsplash.com/photo-1497440991051-6da3b08ba192?auto=format&fit=crop&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent p-10 flex flex-col justify-end">
              <h4 class="text-2xl font-black text-white">Nordic Wind Integration</h4>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-slate-900 text-white pt-24 pb-12 rounded-t-[4rem]">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-20">
          
          <div class="md:col-span-5 space-y-8">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-black text-xl">E</span>
              </div>
              <span class="text-2xl font-black tracking-tighter">EAC</span>
            </div>
            <h5 class="text-3xl font-bold leading-tight max-w-sm">
              Ready to redefine your <span class="text-emerald-500">energy strategy?</span>
            </h5>
            <div class="flex max-w-md bg-slate-800 rounded-xl p-1.5 border border-slate-700 focus-within:border-emerald-500 transition-all">
              <input type="email" placeholder="Email address" class="bg-transparent border-none focus:ring-0 flex-1 px-4 text-sm" />
              <button class="bg-emerald-600 px-6 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-emerald-500 transition-all">Join</button>
            </div>
          </div>

          <div class="md:col-span-7 grid grid-cols-2 md:grid-cols-3 gap-8">
            <div v-for="(group, title) in footerLinks" :key="title">
              <h6 class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] mb-6">{{ title }}</h6>
              <ul class="space-y-4">
                <li v-for="link in group" :key="link.text">
                  <a :href="link.url" class="text-sm text-slate-300 hover:text-emerald-400 transition-colors">{{ link.text }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="pt-12 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-8">
          <p class="text-[11px] text-slate-500 font-medium">© 2026 EAC ENERGY CONSULTANCY. ALL RIGHTS RESERVED.</p>
          <div class="flex gap-8">
            <a v-for="social in ['LinkedIn', 'Twitter', 'Crunchbase']" :key="social" href="#" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-white transition-all">
              {{ social }}
            </a>
          </div>
        </div>
      </div>
    </footer>

    <button 
      v-show="isScrolled"
      @click="scrollTo('hero')"
      class="fixed bottom-10 right-10 w-14 h-14 bg-emerald-600 text-white rounded-full flex items-center justify-center shadow-2xl hover:-translate-y-2 transition-all z-50"
    >
      ↑
    </button>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'

const isScrolled = ref(false)
const scrollProgress = ref(0)
const mobileMenu = ref(false)

const stats = [
  { label: 'Asset Base', value: '$2.3B+' },
  { label: 'Portfolio Growth', value: '24.5%' },
  { label: 'Deployed Projects', value: '450+' },
  { label: 'Partner Networks', value: '18' }
]

const footerLinks = {
  navigation: [
    { text: 'The Firm', url: '#' },
    { text: 'Investment Portal', url: '#' },
    { text: 'ESG Report', url: '#' },
    { text: 'Case Studies', url: '#' }
  ],
  locations: [
    { text: 'London Office', url: '#' },
    { text: 'New York HQ', url: '#' },
    { text: 'Singapore Hub', url: '#' },
    { text: 'Nairobi', url: '#' }
  ],
  legal: [
    { text: 'Privacy Policy', url: '#' },
    { text: 'Terms of Service', url: '#' },
    { text: 'Risk Disclosure', url: '#' },
    { text: 'SEC Filings', url: '#' }
  ]
}

const vReveal = {
  mounted: (el: HTMLElement) => {
    el.classList.add('opacity-0', 'translate-y-12', 'transition-all', 'duration-1000', 'ease-out')
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          el.classList.remove('opacity-0', 'translate-y-12')
          el.classList.add('opacity-100', 'translate-y-0')
        }
      })
    }, { threshold: 0.1 })
    observer.observe(el)
  }
}

const handleScroll = () => {
  const winScroll = document.body.scrollTop || document.documentElement.scrollTop
  const height = document.documentElement.scrollHeight - document.documentElement.clientHeight
  scrollProgress.value = (winScroll / height) * 100
  isScrolled.value = window.scrollY > 100
}

onMounted(() => window.addEventListener('scroll', handleScroll))
onUnmounted(() => window.removeEventListener('scroll', handleScroll))

const scrollTo = (id: string) => {
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' })
}
</script>

<style>
@keyframes slow-zoom {
  from { transform: scale(1); }
  to { transform: scale(1.1); }
}

.animate-slow-zoom {
  animation: slow-zoom 20s infinite alternate ease-in-out;
}

html {
  scroll-behavior: smooth;
  scrollbar-width: none; /* Hide scrollbar Firefox */
}
::-webkit-scrollbar {
  display: none; /* Hide scrollbar Chrome/Safari */
}
</style>