<template>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-white">
      <!-- Navigation -->
      <nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg"></div>
            <span class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">EAC</span>
          </div>
          <button @click="navigateHome" class="text-slate-600 hover:text-emerald-600 transition">← Back Home</button>
        </div>
      </nav>
  
      <!-- Hero Section -->
      <section class="relative py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 opacity-50"></div>
        <div class="max-w-7xl mx-auto relative z-10">
          <div class="text-center mb-12">
            <h1 class="text-5xl sm:text-6xl font-bold text-slate-900 mb-6 text-balance">
              Our <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Project Portfolio</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto text-balance">
              Discover the transformative renewable energy investments we've powered across the globe, delivering sustainable returns and environmental impact.
            </p>
          </div>
        </div>
      </section>
  
      <!-- Filter Section -->
      <section class="py-12 px-4 sm:px-6 lg:px-8 border-b border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto">
          <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <p class="text-slate-600 font-medium">Filter by Project Type:</p>
            <div class="flex flex-wrap gap-3">
              <button
                v-for="type in projectTypes"
                :key="type"
                @click="selectedType = selectedType === type ? 'all' : type"
                :class="[
                  'px-6 py-2 rounded-full transition-all font-medium',
                  selectedType === type || (selectedType === 'all' && type === 'all')
                    ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg'
                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                ]"
              >
                {{ type === 'all' ? 'All Projects' : type }}
              </button>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Projects Grid -->
      <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto">
          <div v-if="filteredProjects.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
              v-for="(project, index) in filteredProjects"
              :key="index"
              class="group cursor-pointer"
              @mouseenter="hoveredProject = index"
              @mouseleave="hoveredProject = null"
            >
              <!-- Project Card -->
              <div class="relative h-96 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <!-- Project Image -->
                <img
                  :src="project.image"
                  :alt="project.name"
                  class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                />
                <!-- Overlay Gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
  
                <!-- Content -->
                <div class="absolute inset-0 flex flex-col justify-end p-6">
                  <!-- Badge -->
                  <div class="mb-4">
                    <span :class="[
                      'inline-block px-4 py-2 rounded-full text-sm font-bold text-white',
                      getBadgeColor(project.type)
                    ]">
                      {{ project.type }}
                    </span>
                  </div>
  
                  <!-- Title & Description -->
                  <h3 class="text-2xl font-bold text-white mb-2">{{ project.name }}</h3>
                  <p class="text-slate-200 text-sm mb-4 line-clamp-2">{{ project.description }}</p>
  
                  <!-- Stats -->
                  <div class="grid grid-cols-3 gap-3 mb-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-2">
                      <p class="text-emerald-300 text-xs font-semibold">Capacity</p>
                      <p class="text-white font-bold">{{ project.capacity }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-2">
                      <p class="text-emerald-300 text-xs font-semibold">ROI</p>
                      <p class="text-white font-bold">{{ project.roi }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-2">
                      <p class="text-emerald-300 text-xs font-semibold">Year</p>
                      <p class="text-white font-bold">{{ project.year }}</p>
                    </div>
                  </div>
  
                  <!-- View Details Button -->
                  <button
                    @click="openProjectModal(index)"
                    class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-2 rounded-lg transition-all transform group-hover:translate-y-0 translate-y-1"
                  >
                    View Details
                  </button>
                </div>
              </div>
            </div>
          </div>
  
          <!-- No Results -->
          <div v-else class="text-center py-12">
            <p class="text-xl text-slate-600">No projects found for this category.</p>
          </div>
        </div>
      </section>
  
      <!-- Project Details Modal -->
      <div
        v-if="selectedProject !== null"
        @click="selectedProject = null"
        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
      >
        <div
          @click.stop
          class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
        >
          <!-- Modal Header Image -->
          <div class="relative h-64 overflow-hidden">
            <img
              :src="projects[selectedProject].image"
              :alt="projects[selectedProject].name"
              class="w-full h-full object-cover"
            />
            <button
              @click="selectedProject = null"
              class="absolute top-4 right-4 bg-white/90 hover:bg-white p-2 rounded-full transition"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
  
          <!-- Modal Content -->
          <div class="p-8">
            <div class="mb-4">
              <span :class="[
                'inline-block px-4 py-2 rounded-full text-sm font-bold text-white mb-4',
                getBadgeColor(projects[selectedProject].type)
              ]">
                {{ projects[selectedProject].type }}
              </span>
            </div>
  
            <h2 class="text-3xl font-bold text-slate-900 mb-4">{{ projects[selectedProject].name }}</h2>
            <p class="text-lg text-slate-600 mb-8">{{ projects[selectedProject].description }}</p>
  
            <!-- Details Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
              <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 rounded-lg">
                <p class="text-emerald-600 text-xs font-semibold uppercase mb-1">Capacity</p>
                <p class="text-2xl font-bold text-slate-900">{{ projects[selectedProject].capacity }}</p>
              </div>
              <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 rounded-lg">
                <p class="text-emerald-600 text-xs font-semibold uppercase mb-1">ROI</p>
                <p class="text-2xl font-bold text-slate-900">{{ projects[selectedProject].roi }}</p>
              </div>
              <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 rounded-lg">
                <p class="text-emerald-600 text-xs font-semibold uppercase mb-1">Year</p>
                <p class="text-2xl font-bold text-slate-900">{{ projects[selectedProject].year }}</p>
              </div>
              <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 rounded-lg">
                <p class="text-emerald-600 text-xs font-semibold uppercase mb-1">Location</p>
                <p class="text-2xl font-bold text-slate-900">{{ projects[selectedProject].location }}</p>
              </div>
            </div>
  
            <!-- Full Description -->
            <div class="mb-8">
              <h3 class="text-xl font-bold text-slate-900 mb-3">Project Overview</h3>
              <p class="text-slate-600 leading-relaxed">{{ projects[selectedProject].fullDescription }}</p>
            </div>
  
            <!-- Key Metrics -->
            <div class="bg-slate-50 p-6 rounded-lg mb-8">
              <h3 class="text-xl font-bold text-slate-900 mb-4">Key Metrics</h3>
              <ul class="space-y-3">
                <li v-for="(metric, idx) in projects[selectedProject].metrics" :key="idx" class="flex items-center text-slate-700">
                  <span class="w-2 h-2 bg-emerald-600 rounded-full mr-3"></span>
                  {{ metric }}
                </li>
              </ul>
            </div>
  
            <!-- CTA -->
            <button
              @click="selectedProject = null; scrollToContact()"
              class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3 rounded-lg transition-all"
            >
              Invest in This Project
            </button>
          </div>
        </div>
      </div>
  
      <!-- Investment CTA Section -->
      <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-emerald-600 to-teal-600">
        <div class="max-w-4xl mx-auto text-center">
          <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6 text-balance">Ready to Invest in Renewable Energy?</h2>
          <p class="text-xl text-emerald-50 mb-8 text-balance">Join our network of global investors generating sustainable returns</p>
          <button
            @click="scrollToContact"
            class="inline-block px-8 py-3 bg-white text-emerald-600 font-bold rounded-lg hover:bg-emerald-50 transition-all transform hover:scale-105"
          >
            Schedule a Consultation
          </button>
        </div>
      </section>
  
      <!-- Footer -->
      <footer class="bg-slate-900 text-slate-400 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
          <div>
            <div class="flex items-center gap-2 mb-4">
              <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg"></div>
              <span class="text-lg font-bold text-white">EAC</span>
            </div>
            <p class="text-sm">Leading renewable energy investment consultancy.</p>
          </div>
          <div>
            <h4 class="font-bold text-white mb-4">Company</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-emerald-400 transition">About</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Projects</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Careers</a></li>
            </ul>
          </div>
          <div>
            <h4 class="font-bold text-white mb-4">Resources</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-emerald-400 transition">Blog</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Insights</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Contact</a></li>
            </ul>
          </div>
          <div>
            <h4 class="font-bold text-white mb-4">Legal</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-emerald-400 transition">Privacy</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Terms</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Compliance</a></li>
            </ul>
          </div>
        </div>
        <div class="border-t border-slate-800 pt-8 text-center text-sm">
          <p>&copy; 2026 EAC - Energy Advisory Consultancy. All rights reserved.</p>
        </div>
      </footer>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, computed } from 'vue'
  
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
      name: 'Mojave Solar Complex',
      type: 'Solar',
      description: 'One of North America\'s largest utility-scale solar installations delivering clean energy to 500,000+ homes.',
      fullDescription: 'The Mojave Solar Complex represents a landmark investment in utility-scale solar infrastructure. Spanning 5,600 acres, this project harnesses the California desert\'s abundant sunlight to generate 750 MW of clean, renewable electricity. The facility employs advanced tracking systems to maximize energy capture throughout the day, delivering consistent power to the grid while creating 400+ construction and permanent jobs.',
      capacity: '750 MW',
      roi: '18.5%',
      year: '2021',
      location: 'California, USA',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Eliminates 1.2M tons of CO2 annually',
        '500,000+ homes powered daily',
        'Advanced tracking technology',
        '25-year power purchase agreement'
      ]
    },
    {
      name: 'North Sea Wind Farm',
      type: 'Wind',
      description: 'Offshore wind installation generating sustainable energy for 600,000 households across Northern Europe.',
      fullDescription: 'The North Sea Wind Farm is a state-of-the-art offshore wind project featuring 120 turbines in the shallow waters off Denmark and Germany. Each turbine stands 260 meters tall and captures the consistent offshore winds, generating 1,200 MW of renewable electricity. The project demonstrates the viability and profitability of offshore wind energy in competitive markets.',
      capacity: '1,200 MW',
      roi: '22.3%',
      year: '2020',
      location: 'North Sea, Europe',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Serves 600,000 European homes',
        '120 modern turbines deployed',
        '2.5M tons CO2 reduction annually',
        '40-year operational lifespan'
      ]
    },
    {
      name: 'Alpine Hydro Cascade',
      type: 'Hydro',
      description: 'Integrated hydroelectric system across alpine valleys providing baseload renewable power to Central Europe.',
      fullDescription: 'The Alpine Hydro Cascade represents a sophisticated approach to renewable energy generation, utilizing the region\'s natural topography. Multiple dams and reservoirs create an integrated system that generates 850 MW consistently, with the ability to dispatch power rapidly to meet peak demand. This project combines environmental stewardship with reliable energy generation.',
      capacity: '850 MW',
      roi: '16.2%',
      year: '2019',
      location: 'Alps, Austria',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Baseload power generation',
        '350,000 homes powered',
        'Environmental flow protection',
        '60-year asset life'
      ]
    },
    {
      name: 'Atacama Solar Park',
      type: 'Solar',
      description: 'World\'s highest-altitude solar facility maximizing radiation capture in the Atacama Desert.',
      fullDescription: 'Located in the Atacama Desert at 2,400 meters elevation, this project benefits from the world\'s highest solar irradiance. The thin atmosphere and minimal cloud cover create ideal conditions for photovoltaic generation. With 500 MW capacity, it serves Chilean industries and grids, establishing EAC\'s leadership in frontier renewable energy markets.',
      capacity: '500 MW',
      roi: '20.1%',
      year: '2022',
      location: 'Atacama, Chile',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Highest solar irradiance location',
        'Next-generation PV technology',
        '850,000 tons CO2 offset annually',
        'Industrial energy partner'
      ]
    },
    {
      name: 'Patagonia Wind Corridor',
      type: 'Wind',
      description: 'Massive wind farm spanning 40,000 hectares capturing Patagonia\'s legendary consistent winds.',
      fullDescription: 'The Patagonia Wind Corridor leverages one of Earth\'s most consistent wind resources. This project spans multiple mountain passes where wind speeds average 12 m/s, enabling exceptional energy production. With 1,500 MW capacity, it\'s one of the largest wind installations in the Southern Hemisphere and provides Argentina with substantial renewable energy.',
      capacity: '1,500 MW',
      roi: '19.7%',
      year: '2021',
      location: 'Patagonia, Argentina',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Consistent 12 m/s wind speeds',
        '700,000 homes powered',
        '3.2M tons annual CO2 reduction',
        'Export-quality renewable power'
      ]
    },
    {
      name: 'Kenya Geothermal Complex',
      type: 'Geothermal',
      description: 'Africa\'s leading geothermal energy project tapping natural heat reservoirs for stable renewable power.',
      fullDescription: 'Built on the East African Rift Valley\'s unique geothermal potential, this 320 MW facility provides Kenya with consistent baseload power. Geothermal energy offers advantages over other renewables: 24/7 generation, minimal environmental footprint, and exceptional reliability. The project supports Kenya\'s vision of 100% renewable electricity.',
      capacity: '320 MW',
      roi: '17.4%',
      year: '2023',
      location: 'Kenya, East Africa',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        '24/7 baseload generation',
        '95%+ capacity factor',
        'Supports 1.2M people',
        'Geothermal energy innovation'
      ]
    },
    {
      name: 'Southeast Asian Solar Network',
      type: 'Solar',
      description: 'Distributed rooftop solar initiative across Singapore, Malaysia, and Indonesia bringing clean energy to millions.',
      fullDescription: 'This innovative distributed solar project deploys 50,000+ rooftop installations across Southeast Asia\'s tropical cities. By leveraging existing structures and urban real estate, it maximizes energy generation near demand centers, reducing transmission losses. The project combines micro-financing with renewable energy, empowering communities and businesses.',
      capacity: '600 MW',
      roi: '21.5%',
      year: '2023',
      location: 'Singapore, Malaysia, Indonesia',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        '50,000+ rooftop installations',
        'Community empowerment model',
        '5M tons CO2 offset over lifetime',
        'Urban renewable leadership'
      ]
    },
    {
      name: 'Australian Hybrid Complex',
      type: 'Solar',
      description: 'Australia\'s largest solar + battery storage facility enabling grid stability and renewable maximization.',
      fullDescription: 'This innovative hybrid project combines 800 MW of solar generation with 400 MWh of battery storage. During peak sun hours, excess generation charges batteries. At night or during peak demand, stored energy feeds the grid. This breakthrough model proves renewables can replace fossil fuel plants in providing dispatchable power.',
      capacity: '800 MW',
      roi: '23.6%',
      year: '2022',
      location: 'New South Wales, Australia',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Advanced battery storage',
        'Dispatchable renewable power',
        '1.3M homes powered',
        'Grid stability support'
      ]
    },
    {
      name: 'Brazilian Sugarcane Biomass',
      type: 'Wind',
      description: 'Innovative biomass-to-energy conversion utilizing Brazil\'s abundant sugarcane production.',
      fullDescription: 'This project transforms Brazil\'s sugarcane industry by converting bagasse (fibrous residue) into electricity. Generating 280 MW from agricultural waste, it provides rural communities with income while producing clean energy. The solution demonstrates circular economy principles and supports Brazil\'s renewable energy goals.',
      capacity: '280 MW',
      roi: '15.8%',
      year: '2020',
      location: 'São Paulo, Brazil',
      image: '/placeholder.svg?height=400&width=600',
      metrics: [
        'Circular economy model',
        'Agricultural waste utilization',
        '450,000 tons CO2 reduction',
        'Rural economic development'
      ]
    }
  ]
  
  const projectTypes = ['all', 'Solar', 'Wind', 'Hydro', 'Geothermal']
  const selectedType = ref<string>('all')
  const selectedProject = ref<number | null>(null)
  const hoveredProject = ref<number | null>(null)
  
  const filteredProjects = computed(() => {
    if (selectedType.value === 'all') return projects
    return projects.filter(p => p.type === selectedType.value)
  })
  
  const getBadgeColor = (type: string): string => {
    const colors: Record<string, string> = {
      'Solar': 'bg-yellow-500/90',
      'Wind': 'bg-blue-500/90',
      'Hydro': 'bg-cyan-500/90',
      'Geothermal': 'bg-red-500/90'
    }
    return colors[type] || 'bg-emerald-500/90'
  }
  
  const openProjectModal = (index: number) => {
    selectedProject.value = index
  }
  
  const navigateHome = () => {
    window.location.href = '/'
  }
  
  const scrollToContact = () => {
    const contactForm = document.querySelector('[data-contact-form]')
    if (contactForm) {
      contactForm.scrollIntoView({ behavior: 'smooth' })
    }
  }
  </script>
  
  <style scoped>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  </style>
  