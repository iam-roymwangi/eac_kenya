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
          Let's Synchronize <br/> <span class="text-emerald-500">Your Vision.</span>
        </h1>
        <p v-reveal class="text-lg md:text-xl text-slate-400 font-medium leading-relaxed max-w-2xl mx-auto">
          Whether you are an EPC contractor or an infrastructure developer, our Nairobi-based team is ready to facilitate your entry into the Kenyan energy market.
        </p>
      </div>
    </section>

    <section class="py-24 px-6 -mt-16 relative z-20">
      <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
          
          <div v-reveal class="lg:col-span-7 bg-white rounded-[3rem] shadow-2xl shadow-slate-200 border border-slate-100 p-8 md:p-12">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-8 uppercase">Project Inquiry</h2>
            
            <form @submit.prevent="submitInquiry" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Full Name</label>
                  <input type="text" v-model="form.name" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 transition-all font-medium text-slate-900" placeholder="e.g. Ira Munn" />
                </div>
                <div class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Company Email</label>
                  <input type="email" v-model="form.email" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 transition-all font-medium text-slate-900" placeholder="name@company.com" />
                </div>
              </div>

              <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Interest Area</label>
                <select v-model="form.interest" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 transition-all font-medium text-slate-900">
                  <option value="solar">Solar Energy Solutions</option>
                  <option value="bess">Battery Storage (BESS)</option>
                  <option value="regulatory">Regulatory & Compliance</option>
                  <option value="water">Water Solutions</option>
                </select>
              </div>

              <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Message</label>
                <textarea v-model="form.message" rows="5" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 transition-all font-medium text-slate-900" placeholder="Briefly describe your project requirements..."></textarea>
              </div>

              <button type="submit" class="w-full py-5 bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-emerald-500 hover:shadow-xl hover:shadow-emerald-200 transition-all active:scale-95">
                Send Inquiry
              </button>
            </form>
          </div>

          <div class="lg:col-span-5 space-y-8">
            <div v-reveal class="bg-slate-900 text-white rounded-[3rem] p-10 shadow-xl overflow-hidden relative group">
              <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
              
              <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-500 mb-8">Headquarters</h3>
              <div class="space-y-8 relative z-10">
                <div class="flex items-start gap-5">
                  <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-xl shrink-0">📍</div>
                  <div>
                    <p class="text-sm font-black uppercase tracking-tighter mb-1">Nairobi, Kenya</p>
                    <p class="text-slate-400 text-sm leading-relaxed">Block 2.5B, Kitisuru Road,<br/>Kitisuru, Nairobi [cite: 239]</p>
                  </div>
                </div>

                <div class="flex items-start gap-5">
                  <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-xl shrink-0">📞</div>
                  <div>
                    <p class="text-sm font-black uppercase tracking-tighter mb-1">Direct Line</p>
                    <p class="text-slate-400 text-sm leading-relaxed">(+254)-794-833-868 [cite: 234]</p>
                  </div>
                </div>

                <div class="flex items-start gap-5">
                  <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-xl shrink-0">✉️</div>
                  <div>
                    <p class="text-sm font-black uppercase tracking-tighter mb-1">Official Email</p>
                    <p class="text-slate-400 text-sm leading-relaxed">info.eacgreengroup.co.ke [cite: 87]</p>
                  </div>
                </div>
              </div>
            </div>

            <div v-reveal class="bg-emerald-50 border border-emerald-100 rounded-[3rem] p-10">
              <h4 class="text-emerald-900 font-black tracking-tighter text-xl mb-4">Standard Procedure [cite: 105]</h4>
              <p class="text-emerald-800/70 text-sm leading-relaxed mb-6">
                All high-level project engagements begin with the execution of a Non-Disclosure Agreement (NDA) to protect technical and commercial integrity[cite: 107, 142].
              </p>
              <a href="/our-process" class="text-emerald-600 text-xs font-black uppercase tracking-widest flex items-center gap-2 hover:gap-4 transition-all">
                Learn about our 7-step process <span>→</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section v-reveal class="max-w-7xl mx-auto px-6 mb-24">
      <div class="w-full h-96 bg-slate-200 rounded-[4rem] overflow-hidden grayscale hover:grayscale-0 transition-all duration-1000">
        <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400 font-bold uppercase tracking-widest">
          Interactive Map: Kitisuru Road, Nairobi
        </div>
      </div>
    </section>
    </div>
  </HomeLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import HomeLayout from '@/layouts/HomeLayout.vue';

const form = ref({
  name: '',
  email: '',
  interest: 'solar',
  message: ''
})

const submitInquiry = () => {
  console.log('Form Submitted:', form.value)
  alert('Thank you for your inquiry. Our technical team will reach out within 24 hours.')
}

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