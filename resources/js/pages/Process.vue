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
          Our <span class="text-emerald-500">Methodology</span> for Success.
        </h1>
        <p v-reveal class="text-lg md:text-xl text-slate-400 font-medium leading-relaxed max-w-2xl mx-auto">
          A structured, seven-stage workflow designed to reduce risk, align expectations, and ensure professional delivery from first engagement to project implementation.
        </p>
      </div>
    </section>

    <section class="py-24 px-6">
      <div class="max-w-7xl mx-auto">
        <div class="relative">
          <div class="hidden lg:block absolute top-[4.5rem] left-0 w-full h-0.5 bg-slate-200 z-0"></div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-12 lg:gap-4 relative z-10">
            <div 
              v-for="(step, index) in steps" 
              :key="index"
              v-reveal
              class="group flex flex-col items-center text-center"
            >
              <div 
                class="w-16 h-16 rounded-2xl bg-white shadow-xl shadow-slate-200 border border-slate-100 flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500 transform group-hover:-translate-y-2"
              >
                <span class="text-2xl font-black tracking-tighter group-hover:scale-110 transition-transform">0{{ index + 1 }}</span>
              </div>

              <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-lg shadow-slate-200/50 flex-grow hover:border-emerald-200 transition-colors">
                <h3 class="text-lg font-black text-slate-900 tracking-tighter mb-3 uppercase">{{ step.title }}</h3>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-4 text-emerald-600">{{ step.objective }}</p>
                <p class="text-slate-600 text-sm leading-relaxed">
                  {{ step.description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-20 bg-slate-900 text-white rounded-[4rem] mx-6 mb-20">
      <div class="max-w-6xl mx-auto px-6">
        <div v-for="(step, index) in steps" :key="'detail-' + index" class="mb-24 last:mb-0">
          <div :class="['flex flex-col md:flex-row items-center gap-12', index % 2 === 0 ? '' : 'md:flex-row-reverse']">
            <div class="md:w-1/2" v-reveal>
              <span class="text-emerald-500 font-black text-6xl opacity-20 block mb-4">STEP 0{{ index + 1 }}</span>
              <h2 class="text-4xl font-black tracking-tighter mb-6">{{ step.title }}</h2>
              <p class="text-slate-400 text-lg leading-relaxed mb-8">{{ step.fullDescription }}</p>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div v-for="item in step.activities" :key="item" class="bg-white/5 p-4 rounded-2xl border border-white/10">
                  <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400 mb-1">Key Activity</p>
                  <p class="text-sm font-bold">{{ item }}</p>
                </div>
              </div>
            </div>
            <div class="md:w-1/2 w-full aspect-video bg-white/5 rounded-[3rem] border border-white/10 flex items-center justify-center overflow-hidden" v-reveal>
                <div class="p-12 text-center">
                  <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-4">Phase Deliverable</p>
                  <p class="text-2xl font-black text-emerald-500 italic">{{ step.output }}</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 px-6 bg-slate-50">
      <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 v-reveal class="text-4xl font-black tracking-tighter mb-6 text-slate-900">Resource <span class="text-emerald-600">Center</span></h2>
        <p v-reveal class="text-slate-500 font-medium">Access technical templates and documentation for utility-scale solar project procurement.</p>
      </div>

      <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div v-reveal class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between items-start group">
          <div>
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
              <span class="text-white text-xl">📄</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter mb-4">RFQ Template (40MW PV + BESS)</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-8">
              A comprehensive technical and financial template for ground-mounted, grid-connected solar plants.
            </p>
          </div>
          <button class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase tracking-[0.2em] group-hover:bg-emerald-600 transition-colors">
            Download DOCX
          </button>
        </div>

        <div v-reveal class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between items-start group">
          <div>
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
              <span class="text-white text-xl">🛡️</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter mb-4">Standard NDA Template</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-8">
              Ensures confidentiality for technical and commercial project discussions.
            </p>
          </div>
          <button class="w-full py-4 border-2 border-slate-900 text-slate-900 rounded-2xl font-bold text-xs uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all">
            Download PDF
          </button>
        </div>
      </div>
    </section>

    <section class="py-24 px-6 text-center">
      <div v-reveal class="max-w-3xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-8 leading-tight">Ready to synchronize with the <span class="text-emerald-600">Kenyan Grid?</span></h2>
        <button class="px-10 py-5 bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest hover:shadow-2xl hover:shadow-emerald-200 transition-all transform hover:-translate-y-1">
          Initiate Inception Meeting
        </button>
      </div>
    </section>
    </div>
  </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';

const steps = [
  {
    title: 'NDA Signing',
    objective: 'Establish Confidentiality',
    description: 'Protecting sensitive technical and financial information shared between parties.',
    fullDescription: 'Before any detailed discussions or document exchanges, both parties sign a Non-Disclosure Agreement (NDA) to ensure strategic information remains confidential.',
    activities: ['Legal Review', 'Digital Signature', 'Strategic Alignment'],
    output: 'Signed NDA'
  },
  {
    title: 'Inception Meeting',
    objective: 'Project Alignment',
    description: 'Clarifying objectives, timelines, and stakeholder roles to confirm client needs.',
    fullDescription: 'Following NDA execution, we introduce key stakeholders and define preliminary scope, risks, and constraints.',
    activities: ['Stakeholder Intro', 'Risk Identification', 'Timeline Review'],
    output: 'Meeting Minutes'
  },
  {
    title: 'RFQ & Documentation',
    objective: 'Technical Assessment',
    description: 'Gathering detailed regulatory and commercial data for accurate project assessment.',
    fullDescription: 'Reviewing technical specifications, financial assumptions, and project drawings to define clear requirements.',
    activities: ['Technical Drawing Review', 'Financial Assumptions', 'Regulatory Scoping'],
    output: 'Completed RFQ Package'
  },
  {
    title: 'Site Visit',
    objective: 'Feasibility Validation',
    description: 'Physical or virtual assessment to reduce assumptions and mitigate implementation risks.',
    fullDescription: 'We conduct on-site inspections, measurements, and environmental assessments to confirm design feasibility.',
    activities: ['Physical Inspection', 'Grid Point Review', 'Local Briefing'],
    output: 'Site Visit Report'
  },
  {
    title: 'Compliance',
    objective: 'Standardization',
    description: 'Evaluating projects against legal, environmental, and industry governance.',
    fullDescription: 'Addressing gaps in EPRA licensing, NEMA compliance, and international IEC/IEEE standards before commitment.',
    activities: ['EPRA Licensing', 'NEMA/EMCA Review', 'Safety Checks'],
    output: 'Compliance Confirmation'
  },
  {
    title: 'Contract Signing',
    objective: 'Formal Commitment',
    description: 'Executing a formal agreement under agreed commercial and technical terms.',
    fullDescription: 'Finalizing negotiation and legal review of the EPC contract and securities like Performance Bonds.',
    activities: ['Legal Negotiation', 'Securities Execution', 'Final Review'],
    output: 'Executed Contract'
  },
  {
    title: 'Implementation',
    objective: 'Project Delivery',
    description: 'Execution according to agreed scope, quality, cost, and timeline.',
    fullDescription: 'Mobilization and monitoring using project management best practices and regular reporting.',
    activities: ['Mobilization', 'Progress Monitoring', 'KPI Validation'],
    output: 'Project Deliverables'
  }
]

// v-reveal directive for the scroll animations
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
</script>