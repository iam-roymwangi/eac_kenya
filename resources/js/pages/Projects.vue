<template>
  <HomeLayout>
    <div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-100">

    <section class="relative py-24 px-6 overflow-hidden bg-slate-900 text-white rounded-b-[4rem]">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-30"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-emerald-500/20 to-transparent"></div>
      </div>
      
      <div class="max-w-4xl mx-auto relative z-10 text-center">
        <h1 v-reveal class="text-5xl md:text-7xl font-black tracking-tighter mb-8 leading-[0.9]">
          Global <span class="text-emerald-500">Infrastructure</span> Portfolio.
        </h1>
        <p v-reveal class="text-lg md:text-xl text-slate-400 font-medium leading-relaxed max-w-2xl mx-auto">
          From the Rift Valley to the North Sea, we identify and manage high-performing renewable assets that define the next decade of energy.
        </p>
      </div>
    </section>

    <section class="sticky top-[73px] z-[90] py-6 px-6 bg-slate-50/80 backdrop-blur-md border-b border-slate-200">
      <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-4">
          <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Sector Focus</span>
          <div class="flex flex-wrap gap-2">
            <button
              v-for="type in projectTypes"
              :key="type"
              @click="selectedType = type"
              :class="[
                'px-5 py-2 rounded-full text-xs font-bold uppercase tracking-widest transition-all duration-300',
                selectedType === type 
                  ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200 scale-105' 
                  : 'bg-white text-slate-500 border border-slate-200 hover:border-emerald-300'
              ]"
            >
              {{ type }}
            </button>
          </div>
        </div>
        <div class="text-xs font-bold text-slate-400 bg-slate-100 px-4 py-2 rounded-lg">
          SHOWING {{ filteredProjects.length }} KEY ASSETS
        </div>
      </div>
    </section>

    <section class="py-20 px-6">
      <div class="max-w-7xl mx-auto">
        <TransitionGroup 
          name="project-grid" 
          tag="div" 
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10"
        >
          <div
            v-for="(project, index) in filteredProjects"
            :key="project.name"
            v-reveal
            class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-3 transition-all duration-500"
          >
            <div class="relative h-72 overflow-hidden">
              <img :src="project.image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" />
              <div class="absolute top-6 left-6">
                <span :class="['px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest text-white shadow-xl', getBadgeColor(project.type)]">
                  {{ project.type }}
                </span>
              </div>
            </div>

            <div class="p-8">
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ project.name }}</h3>
                <span class="text-emerald-600 font-bold text-sm">{{ project.roi }} ROI</span>
              </div>
              <p class="text-slate-500 text-sm font-medium leading-relaxed mb-8 line-clamp-2">
                {{ project.description }}
              </p>

              <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100">
                  <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Capacity</p>
                  <p class="text-sm font-black text-slate-700">{{ project.capacity }}</p>
                </div>
                <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100">
                  <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Location</p>
                  <p class="text-sm font-black text-slate-700 truncate">{{ project.location }}</p>
                </div>
              </div>

              <button @click="openProjectModal(index)" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase tracking-[0.2em] group-hover:bg-emerald-600 transition-colors">
                Technical Data Sheet
              </button>
            </div>
          </div>
        </TransitionGroup>
      </div>
    </section>

    <Transition name="fade">
      <div v-if="selectedProjectIndex !== null" class="fixed inset-0 z-[200] flex items-center justify-center p-6 backdrop-blur-xl bg-slate-900/60" @click="selectedProjectIndex = null">
        <div @click.stop class="bg-white rounded-[3rem] max-w-5xl w-full h-[85vh] overflow-hidden shadow-2xl flex flex-col md:flex-row relative">
          <button @click="selectedProjectIndex = null" class="absolute top-8 right-8 z-10 w-12 h-12 bg-white/20 backdrop-blur-md hover:bg-white text-slate-900 rounded-full flex items-center justify-center transition-all">
            ✕
          </button>

          <div class="md:w-1/2 relative h-64 md:h-auto">
            <img :src="projects[selectedProjectIndex].image" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
            <div class="absolute bottom-10 left-10 text-white">
              <p class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-2">{{ projects[selectedProjectIndex].type }} Division</p>
              <h2 class="text-4xl font-black tracking-tighter">{{ projects[selectedProjectIndex].name }}</h2>
            </div>
          </div>

          <div class="md:w-1/2 p-12 overflow-y-auto bg-white">
            <div class="space-y-8">
              <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4">Infrastructure Overview</h4>
                <p class="text-slate-600 leading-relaxed font-medium">{{ projects[selectedProjectIndex].fullDescription }}</p>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div v-for="(val, label) in getMetricObject(projects[selectedProjectIndex])" :key="label" class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-emerald-200 transition-colors">
                  <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ label }}</p>
                  <p class="text-2xl font-black text-slate-900 tracking-tighter">{{ val }}</p>
                </div>
              </div>

              <div class="bg-emerald-50 p-8 rounded-[2rem] border border-emerald-100">
                <h5 class="text-xs font-black uppercase text-emerald-800 tracking-widest mb-4">ESG Impact Metrics</h5>
                <ul class="space-y-3">
                  <li v-for="metric in projects[selectedProjectIndex].metrics" :key="metric" class="flex items-center gap-3 text-sm text-emerald-900 font-medium">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    {{ metric }}
                  </li>
                </ul>
              </div>

              <button @click="navigateHome" class="w-full py-5 bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest hover:shadow-xl hover:shadow-emerald-200 transition-all">
                Request Investor Prospectus
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
    </div>
  </HomeLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import HomeLayout from '@/layouts/HomeLayout.vue';

interface Project {
  name: string
  type: 'Solar' | 'Wind' | 'Hydro' | 'Geothermal'
  description: string
  fullDescription: string
  capacity: string
  roi: string
  year: string
  location: string
  image: string
  metrics: string[]
}

const projects: Project[] = [
  {
    name: 'Kenya Rift Geothermal',
    type: 'Geothermal',
    description: 'A flagship East African project tapping high-pressure steam for 24/7 industrial baseload power.',
    fullDescription: 'Strategically located in the Olkaria region, this complex utilizes natural steam from the volcanic landscape of the Rift Valley. Unlike solar or wind, this asset provides 100% stable baseload energy, crucial for the growing manufacturing sector in Nairobi.',
    capacity: '320 MW',
    roi: '17.4%',
    year: '2023',
    location: 'Nakuru, Kenya',
    image: 'https://images.unsplash.com/photo-1544923246-77307dd654ca?q=80&w=2070&auto=format&fit=crop',
    metrics: ['95% Capacity Factor', 'Powers 1.2M citizens', 'Zero-emission steam loop']
  },
  {
    name: 'Nordic Wind Park',
    type: 'Wind',
    description: 'Offshore wind cluster featuring next-gen 15MW turbines for the European Power Grid.',
    fullDescription: 'Located in the steady-wind corridors of the North Sea, this project utilizes floating platform technology to access deep-water wind currents previously unreachable by traditional sea-bed turbines.',
    capacity: '1,200 MW',
    roi: '22.3%',
    year: '2022',
    location: 'North Sea, Denmark',
    image: 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2070&auto=format&fit=crop',
    metrics: ['80 offshore units', '2.5M tons CO2 offset', 'Advanced Hydrogen-ready grid']
  },
  {
    name: 'Atacama Solar Hub',
    type: 'Solar',
    description: 'The highest-irradiance solar field on Earth, serving high-altitude mining operations.',
    fullDescription: 'By deploying bifacial N-type cells in the high-altitude Atacama Desert, this project achieves the lowest LCOE (Levelized Cost of Energy) in the global market today.',
    capacity: '500 MW',
    roi: '20.1%',
    year: '2024',
    location: 'Atacama, Chile',
    image: 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=2070&auto=format&fit=crop',
    metrics: ['Bifacial Cell Tech', '24/7 monitoring', 'Mining grid integration']
  }
]

const projectTypes = ['all', 'Solar', 'Wind', 'Geothermal']
const selectedType = ref('all')
const selectedProjectIndex = ref<number | null>(null)

const filteredProjects = computed(() => {
  if (selectedType.value === 'all') return projects
  return projects.filter(p => p.type === selectedType.value)
})

const getBadgeColor = (type: string) => {
  const colors: any = { 'Solar': 'bg-amber-500', 'Wind': 'bg-blue-500', 'Geothermal': 'bg-red-500' }
  return colors[type] || 'bg-emerald-600'
}

const getMetricObject = (p: Project) => ({
  'Capacity': p.capacity,
  'Project ROI': p.roi,
  'Vintage': p.year,
  'Location': p.location
})

const vReveal = {
  mounted: (el: HTMLElement) => {
    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700')
    const observer = new IntersectionObserver(([entry]) => {
      if (entry.isIntersecting) {
        el.classList.remove('opacity-0', 'translate-y-8')
        el.classList.add('opacity-100', 'translate-y-0')
      }
    }, { threshold: 0.1 })
    observer.observe(el)
  }
}

const navigateHome = () => window.location.href = '/'
const openProjectModal = (i: number) => selectedProjectIndex.value = i

</script>

<style>
.project-grid-enter-active, .project-grid-leave-active {
  transition: all 0.5s ease;
}
.project-grid-enter-from, .project-grid-leave-to {
  opacity: 0;
  transform: scale(0.9);
}

.fade-enter-active, .fade-leave-active { transition: opacity 0.3s; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

::-webkit-scrollbar { display: none; }
</style>