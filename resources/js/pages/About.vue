<template>
  <div class="min-h-screen bg-white text-slate-900 font-sans selection:bg-emerald-100">
    <section class="relative pt-32 pb-20 px-6 overflow-hidden bg-slate-900">
      <div class="absolute inset-0 opacity-40">
        <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?q=80&w=2070" class="w-full h-full object-cover" alt="Energy Infrastructure" />
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-900/80 to-slate-900"></div>
      </div>
      
      <div class="max-w-7xl mx-auto relative z-10">
        <div v-reveal class="max-w-3xl">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
              <span class="text-white font-black text-2xl">E</span>
            </div>
            <h1 class="text-3xl font-black tracking-tighter text-white">EAC GROUP</h1>
          </div>
          <h2 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-[0.9] mb-8">
            Invest. Protect. <span class="text-emerald-500 italic">Prosper.</span>
          </h2>
          <p class="text-xl text-slate-400 font-medium leading-relaxed">
            A leading Special Purpose Vehicle (SPV) management and EPC consultancy based in Kitisuru, Nairobi. We specialize in the turnkey delivery of utility-scale renewable energy assets.
          </p>
        </div>
      </div>
    </section>

    <section class="py-24 px-6">
      <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-12 gap-16">
          <div class="lg:col-span-4" v-reveal>
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-emerald-600 mb-4">Scope of Work</h3>
            <h4 class="text-4xl font-black tracking-tighter mb-6">Complete Project Execution.</h4>
            <p class="text-slate-500 font-medium">From initial engineering to grid synchronization, our EPC framework ensures every asset is grid-ready and high-performing.</p>
          </div>
          
          <div class="lg:col-span-8 grid md:grid-cols-2 gap-8">
            <div v-for="item in scopeItems" :key="item.title" v-reveal class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-emerald-200 transition-colors">
              <div class="text-3xl mb-4">{{ item.icon }}</div>
              <h5 class="text-lg font-black mb-3">{{ item.title }}</h5>
              <ul class="space-y-2">
                <li v-for="point in item.points" :key="point" class="text-sm text-slate-500 flex items-start gap-2">
                  <span class="text-emerald-500 mt-1">●</span> {{ point }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 px-6 bg-slate-900 text-white rounded-[4rem] mx-4">
      <div class="max-w-7xl mx-auto">
        <div class="mb-16 text-center">
          <h3 class="text-xs font-black uppercase tracking-[0.3em] text-emerald-500 mb-4">Operational Pipeline</h3>
          <h4 class="text-5xl font-black tracking-tighter">Utility-Scale Leadership.</h4>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <div v-for="project in keyProjects" :key="project.name" v-reveal class="relative group overflow-hidden rounded-[3rem] bg-slate-800 border border-white/5">
            <div class="p-10 space-y-6">
              <div class="flex justify-between items-start">
                <div>
                  <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400">Current Engagement</span>
                  <h5 class="text-3xl font-black tracking-tighter mt-2">{{ project.name }}</h5>
                </div>
                <div class="text-right">
                  <p class="text-2xl font-black text-white">{{ project.capacity }}</p>
                  <p class="text-[10px] font-bold text-slate-500 uppercase">{{ project.location }}</p>
                </div>
              </div>
              <p class="text-slate-400 text-sm leading-relaxed">{{ project.details }}</p>
              <div class="pt-6 border-t border-white/10 flex gap-4">
                <div class="px-4 py-2 bg-white/5 rounded-xl text-[10px] font-bold uppercase tracking-widest">BESS Integrated</div>
                <div class="px-4 py-2 bg-white/5 rounded-xl text-[10px] font-bold uppercase tracking-widest">Grid Connected</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 px-6">
      <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-20">
          <h3 class="text-xs font-black uppercase tracking-[0.3em] text-emerald-600 mb-4">Technical Compliance</h3>
          <h4 class="text-4xl font-black tracking-tighter">Global Standards. Local Excellence.</h4>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
          <div v-for="group in standards" :key="group.category" v-reveal class="space-y-6">
            <h5 class="text-sm font-black uppercase tracking-widest border-b border-slate-200 pb-4">{{ group.category }}</h5>
            <ul class="space-y-4">
              <li v-for="std in group.items" :key="std.code" class="group">
                <p class="text-xs font-black text-slate-900 group-hover:text-emerald-600 transition-colors">{{ std.code }}</p>
                <p class="text-xs text-slate-500 uppercase tracking-tighter">{{ std.desc }}</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-slate-50 border-t border-slate-200 pt-20 pb-10 px-6">
      <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-12 items-end">
        <div>
          <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-4">HQ Location</p>
          <p class="text-sm font-bold text-slate-900 uppercase">Kitisuru, Kitisuru Rd</p>
          <p class="text-sm font-bold text-slate-900">Nairobi, Kenya</p>
        </div>
        <div class="text-center">
          <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-4">Direct Inquiry</p>
          <p class="text-sm font-black text-emerald-600 uppercase tracking-widest">info@eacgreengroup.co.ke</p>
        </div>
        <div class="md:text-right">
          <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-4">Registration</p>
          <p class="text-sm font-bold text-slate-900 uppercase">Registered Special Purpose Vehicle (SPV)</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
const scopeItems = [
  {
    icon: '📐',
    title: 'Engineering & Design',
    points: ['Full system layout (DC/AC)', 'Structural mounting design', 'SCADA & Data Acquisition', 'BESS layout & dispatch logic']
  },
  {
    icon: '🏗️',
    title: 'Civil & Electrical',
    points: ['Site clearance & grading', 'Substation construction', '132kV / 220kV Interconnection', 'Trenching & Inverter stations']
  },
  {
    icon: '⚡',
    title: 'Commissioning',
    points: ['Cold & Hot commissioning', 'Kenyan Grid Code validation', 'As-Built documentation', 'Staff O&M training']
  },
  {
    icon: '🛡️',
    title: 'Project Procurement',
    points: ['Tier-1 PV Module sourcing', 'MV Transformers & Switchgear', 'Importation & Logistics', 'Insurance during transit']
  }
]

const keyProjects = [
  {
    name: 'Nyakwere Solar PV',
    location: 'Homabay County',
    capacity: '40 MWp + 10 MW BESS',
    details: 'Utility-scale ground-mounted solar plant integrated with battery storage for frequency regulation and peak shifting.'
  },
  {
    name: 'Lamu Solargen Park',
    location: 'Lamu County',
    capacity: '44 MWp + 20 MWh BESS',
    details: 'A landmark USD 98.6M project featuring high-capacity storage and grid-tied solar generation.'
  }
]

const standards = [
  {
    category: 'Kenyan Regulation',
    items: [
      { code: 'Energy Act 2019', desc: 'Licensing & Interconnection' },
      { code: 'EMCA 1999', desc: 'Environmental Management' },
      { code: 'NEMA ESIA', desc: 'Compliance & Impact Assessment' }
    ]
  },
  {
    category: 'Solar & Grid Quality',
    items: [
      { code: 'IEC 61215 & 61730', desc: 'PV Module Quality & Safety' },
      { code: 'IEEE 1547', desc: 'Smart Grid Interoperability' },
      { code: 'Kenya Grid Code', desc: 'Voltage & Frequency Stability' }
    ]
  },
  {
    category: 'Storage & Safety',
    items: [
      { code: 'IEC 62933', desc: 'BESS System Safety' },
      { code: 'ISO 45001', desc: 'Occupational Safety Compliance' },
      { code: 'World Bank ESS', desc: 'Environmental & Social Standards' }
    ]
  }
]

// Intersection Observer for Scroll Reveals
const vReveal = {
  mounted: (el: HTMLElement) => {
    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-1000', 'ease-out')
    const observer = new IntersectionObserver(([entry]) => {
      if (entry.isIntersecting) {
        el.classList.remove('opacity-0', 'translate-y-8')
        el.classList.add('opacity-100', 'translate-y-0')
      }
    }, { threshold: 0.1 })
    observer.observe(el)
  }
}
</script>

<style scoped>
@keyframes slow-zoom {
  from { transform: scale(1); }
  to { transform: scale(1.1); }
}
.animate-slow-zoom {
  animation: slow-zoom 20s infinite alternate ease-in-out;
}
</style>