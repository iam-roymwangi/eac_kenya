<template>
  <HomeLayout>
    <div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-100">
    <section class="relative py-20 px-6 overflow-hidden bg-slate-900 text-white rounded-b-[3rem]">
      <div class="max-w-4xl mx-auto relative z-10 text-center">
        <h1 v-reveal class="text-4xl md:text-6xl font-black tracking-tighter mb-4 uppercase">
          Privacy <span class="text-emerald-500">Policy.</span>
        </h1>
        <p v-reveal class="text-slate-400 font-bold uppercase tracking-[0.2em] text-xs">
          Last Updated: February 3, 2026
        </p>
      </div>
    </section>

    <section class="py-20 px-6">
      <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-16">
        
        <aside class="lg:w-1/4">
          <div class="sticky top-32 space-y-4">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-6">Contents</p>
            <nav class="flex flex-col gap-2">
              <a v-for="section in sections" :key="section.id" :href="'#' + section.id" 
                 class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors border-l-2 border-transparent hover:border-emerald-500 pl-4">
                {{ section.title }}
              </a>
            </nav>
          </div>
        </aside>

        <div class="lg:w-3/4 bg-white rounded-[3rem] p-8 md:p-16 shadow-xl shadow-slate-200/50 border border-slate-100">
          <div class="prose prose-slate max-w-none space-y-12">
            
            <section id="introduction" v-reveal>
              <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase mb-6">1. Introduction</h2>
              <p class="text-slate-600 leading-relaxed font-medium">
                EAC Green Group Ltd ("we", "us", or "the Consultant") is committed to protecting the privacy and confidentiality of our clients, specifically EPC contractors and stakeholders involved in our renewable energy projects[cite: 140, 239]. This policy outlines how we handle data during our 7-step client handling process[cite: 102].
              </p>
            </section>

            <section id="data-collection" v-reveal>
              <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase mb-6">2. Data We Collect</h2>
              <p class="text-slate-600 leading-relaxed font-medium mb-4">
                In the course of providing consultancy services for projects such as the Kimuka 2 Solar PV plant[cite: 7], we collect:
              </p>
              <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 list-none p-0">
                <li v-for="item in dataItems" :key="item" class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-sm font-bold text-slate-700 flex items-center gap-3">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> {{ item }}
                </li>
              </ul>
            </section>

            <section id="confidentiality" v-reveal>
              <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase mb-6">3. Confidentiality & NDAs</h2>
              <div class="bg-emerald-50 border border-emerald-100 rounded-3xl p-8">
                <p class="text-emerald-900 font-bold mb-4 italic">"Technical, financial, and strategic information remains confidential." [cite: 142]</p>
                <p class="text-emerald-800/80 text-sm leading-relaxed">
                  Per our standard operating procedure, an NDA must be executed before any detailed discussions or document exchanges occur[cite: 142]. This obligation survives for one year after the termination of our consultancy agreements[cite: 318].
                </p>
              </div>
            </section>

            <section id="regulatory-sharing" v-reveal>
              <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase mb-6">4. Regulatory Disclosure</h2>
              <p class="text-slate-600 leading-relaxed font-medium">
                To facilitate project success, we may share relevant technical data with Kenyan regulatory bodies, including EPRA and NEMA, specifically for licensing and interconnection purposes[cite: 48, 49, 258].
              </p>
            </section>

            <section id="contact-privacy" v-reveal>
              <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase mb-6">5. Contact Information</h2>
              <p class="text-slate-600 leading-relaxed font-medium">
                For questions regarding data privacy, please contact our Kitisuru office at (+254)-794-833-868 or email info.eacgreengroup.co.ke[cite: 87, 235].
              </p>
            </section>

          </div>
        </div>

      </div>
    </section>
    </div>
  </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';
const sections = [
  { id: 'introduction', title: 'Introduction' },
  { id: 'data-collection', title: 'Data We Collect' },
  { id: 'confidentiality', title: 'Confidentiality' },
  { id: 'regulatory-sharing', title: 'Regulatory Disclosure' },
  { id: 'contact-privacy', title: 'Contact' }
]

const dataItems = [
  'Technical Project Layouts',
  'Company Registration Docs',
  'Personnel CVs/IDs',
  'Financial Statements',
  'Bill of Quantities (BoQ)',
  'Regulatory Permits'
]

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
</script>