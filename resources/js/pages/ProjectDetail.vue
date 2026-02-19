<template>
  <HomeLayout>
    <div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-100">
      <!-- Hero Section -->
      <section class="relative py-32 px-6 overflow-hidden bg-slate-900 text-white">
        <div class="absolute inset-0 opacity-20">
          <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-30"></div>
          <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-emerald-500/20 to-transparent"></div>
        </div>
        
        <div class="max-w-6xl mx-auto relative z-10">
          <div class="flex items-center gap-3 mb-6" v-reveal>
            <a href="/projects" class="text-slate-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
            </a>
            <span class="text-slate-400">/</span>
            <span class="text-slate-400">Projects</span>
            <span class="text-slate-400">/</span>
            <span class="text-white font-bold">{{ project.name }}</span>
          </div>

          <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">
            <div class="flex-1">
              <div class="flex items-center gap-4 mb-4" v-reveal>
                <span :class="['px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest', getProjectTypeBadge()]">
                  {{ formatProjectType(project.project_type) }}
                </span>
                <span v-if="project.capacity_mw" class="px-4 py-2 rounded-full bg-white/10 text-white text-xs font-bold">
                  {{ project.capacity_mw }} MW
                </span>
              </div>
              
              <h1 v-reveal class="text-5xl md:text-7xl font-black tracking-tighter mb-6 leading-[0.9]">
                {{ project.name }}
              </h1>
              
              <p v-reveal class="text-lg md:text-xl text-slate-300 font-medium leading-relaxed max-w-3xl">
                {{ project.description || 'A cutting-edge renewable energy project designed to power sustainable growth.' }}
              </p>
            </div>

            <div v-reveal class="flex flex-col sm:flex-row gap-4">
              <button @click="openInterestModal" class="px-8 py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase tracking-widest hover:shadow-2xl hover:shadow-emerald-200 transition-all">
                Express Interest
              </button>
              <button @click="openQuestionModal" class="px-8 py-4 border-2 border-white text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-white hover:text-slate-900 transition-all">
                Ask Question
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- Quick Stats -->
      <section class="py-12 px-6 bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div v-reveal class="text-center p-6 bg-slate-50 rounded-2xl border border-slate-100">
              <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Project Type</p>
              <p class="text-2xl font-black text-slate-900">{{ formatProjectType(project.project_type) }}</p>
            </div>
            
            <div v-reveal class="text-center p-6 bg-slate-50 rounded-2xl border border-slate-100">
              <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Capacity</p>
              <p class="text-2xl font-black text-slate-900">{{ project.capacity_mw || 'TBD' }} <span v-if="project.capacity_mw" class="text-base">MW</span></p>
            </div>
            
            <div v-reveal class="text-center p-6 bg-slate-50 rounded-2xl border border-slate-100">
              <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Location</p>
              <p class="text-xl font-black text-slate-900">{{ project.location || 'Kenya' }}</p>
            </div>
            
            <div v-reveal class="text-center p-6 bg-slate-50 rounded-2xl border border-slate-100">
              <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Status</p>
              <p class="text-xl font-black text-emerald-600">{{ getProjectStatus() }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Main Content -->
      <section class="py-20 px-6">
        <div class="max-w-6xl mx-auto">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-12">
              <!-- Project Overview -->
              <div v-reveal class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-6">Project Overview</h2>
                <div class="prose prose-slate max-w-none">
                  <p class="text-slate-600 leading-relaxed text-lg">
                    {{ project.description || 'This renewable energy project represents a significant investment in sustainable infrastructure, designed to deliver clean, reliable power while supporting local economic development and environmental stewardship.' }}
                  </p>
                </div>
              </div>

              <!-- Technical Specifications -->
              <div v-reveal class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-8">Technical Specifications</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Project ID</p>
                    <p class="text-lg font-black text-slate-900 font-mono">{{ project.uuid.substring(0, 8) }}</p>
                  </div>
                  
                  <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Technology</p>
                    <p class="text-lg font-black text-slate-900">{{ getTechnologyType() }}</p>
                  </div>
                  
                  <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Capacity</p>
                    <p class="text-lg font-black text-slate-900">{{ project.capacity_mw || 'To Be Determined' }} {{ project.capacity_mw ? 'MW' : '' }}</p>
                  </div>
                  
                  <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Location</p>
                    <p class="text-lg font-black text-slate-900">{{ project.location || 'Kenya' }}</p>
                  </div>
                </div>
              </div>

              <!-- Project Timeline -->
              <div v-reveal class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-8">Project Timeline</h2>
                <div class="space-y-6">
                  <div v-for="(step, index) in projectSteps" :key="index" class="flex gap-6">
                    <div class="flex flex-col items-center">
                      <div :class="['w-12 h-12 rounded-full flex items-center justify-center font-black text-sm transition-all', 
                        step.completed ? 'bg-emerald-600 text-white' : 
                        step.current ? 'bg-emerald-100 text-emerald-600 ring-4 ring-emerald-200' : 
                        'bg-slate-100 text-slate-400']">
                        {{ index + 1 }}
                      </div>
                      <div v-if="index < projectSteps.length - 1" :class="['w-0.5 flex-1 mt-2', step.completed ? 'bg-emerald-600' : 'bg-slate-200']"></div>
                    </div>
                    <div class="flex-1 pb-8">
                      <h3 :class="['text-lg font-black mb-2', step.completed || step.current ? 'text-slate-900' : 'text-slate-400']">
                        {{ step.title }}
                      </h3>
                      <p :class="['text-sm', step.completed || step.current ? 'text-slate-600' : 'text-slate-400']">
                        {{ step.description }}
                      </p>
                      <p v-if="step.completedAt" class="text-xs text-emerald-600 font-bold mt-2">
                        Completed: {{ formatDate(step.completedAt) }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Client Company Info (if available) -->
              <div v-if="project.client_company" v-reveal class="bg-emerald-50 rounded-[3rem] p-10 border border-emerald-100">
                <h2 class="text-3xl font-black text-emerald-900 tracking-tighter mb-6">Client Information</h2>
                <div class="space-y-4">
                  <div>
                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-1">Company Name</p>
                    <p class="text-xl font-black text-emerald-900">{{ project.client_company.name }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-8">
              <!-- CTA Card -->
              <div v-reveal class="bg-slate-900 rounded-[3rem] p-8 text-white sticky top-24">
                <h3 class="text-2xl font-black tracking-tighter mb-4">Interested in this project?</h3>
                <p class="text-slate-300 text-sm mb-6 leading-relaxed">
                  Get in touch with our team to learn more about investment opportunities, technical specifications, and partnership options.
                </p>
                
                <div class="space-y-3">
                  <button @click="openInterestModal" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-emerald-700 transition-all">
                    Express Interest
                  </button>
                  <button @click="openQuestionModal" class="w-full py-4 border-2 border-white text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-white hover:text-slate-900 transition-all">
                    Ask a Question
                  </button>
                  <button @click="initiateInception" class="w-full py-4 bg-white/10 text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-white/20 transition-all">
                    Start Onboarding
                  </button>
                </div>

                <div class="mt-8 pt-8 border-t border-white/10">
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Contact Information</p>
                  <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-3">
                      <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                      </svg>
                      <span>+254 794 833 868</span>
                    </div>
                    <div class="flex items-center gap-3">
                      <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      </svg>
                      <span>Kitisuru, Nairobi</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Key Benefits -->
              <div v-reveal class="bg-white rounded-[3rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
                <h3 class="text-xl font-black text-slate-900 tracking-tighter mb-6">Key Benefits</h3>
                <ul class="space-y-4">
                  <li class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                      <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                    <span class="text-sm text-slate-600">Clean, renewable energy generation</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                      <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                    <span class="text-sm text-slate-600">Significant carbon footprint reduction</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                      <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                    <span class="text-sm text-slate-600">Local job creation and economic growth</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                      <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                    <span class="text-sm text-slate-600">Long-term sustainable returns</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Interest Modal -->
      <Transition name="fade">
        <div v-if="showInterestModal" class="fixed inset-0 z-[250] flex items-center justify-center p-6 backdrop-blur-xl bg-slate-900/60" @click="closeInterestModal">
          <div @click.stop class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
            <div class="sticky top-0 bg-white border-b border-slate-200 p-8 flex justify-between items-center rounded-t-3xl">
              <div>
                <h3 class="text-3xl font-black text-slate-900">Express Interest</h3>
                <p class="text-sm text-slate-500 mt-1">{{ project.name }}</p>
              </div>
              <button @click="closeInterestModal" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>

            <form @submit.prevent="submitInterest" class="p-8 space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Company Name *</label>
                  <input v-model="interestForm.company_name" type="text" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="Your Company Ltd">
                </div>
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Contact Person *</label>
                  <input v-model="interestForm.contact_person" type="text" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="John Doe">
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Email Address *</label>
                  <input v-model="interestForm.email" type="email" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="john@company.com">
                </div>
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number *</label>
                  <input v-model="interestForm.phone" type="tel" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="+254 700 000 000">
                </div>
              </div>
              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Interest Type *</label>
                <select v-model="interestForm.interest_type" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                  <option value="general">General Interest</option>
                  <option value="investor">Investment Opportunity</option>
                  <option value="partner">Partnership Inquiry</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Message (Optional)</label>
                <textarea v-model="interestForm.message" rows="4" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none" placeholder="Tell us more about your interest..."></textarea>
              </div>
              <div class="flex gap-4 pt-4">
                <button type="button" @click="closeInterestModal" class="flex-1 px-6 py-4 border-2 border-slate-300 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors">Cancel</button>
                <button type="submit" :disabled="isSubmittingInterest" class="flex-1 px-6 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors">
                  <span v-if="isSubmittingInterest">Submitting...</span>
                  <span v-else>Submit Interest</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </Transition>

      <!-- Question Modal -->
      <Transition name="fade">
        <div v-if="showQuestionModal" class="fixed inset-0 z-[250] flex items-center justify-center p-6 backdrop-blur-xl bg-slate-900/60" @click="closeQuestionModal">
          <div @click.stop class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
            <div class="sticky top-0 bg-white border-b border-slate-200 p-8 flex justify-between items-center rounded-t-3xl">
              <div>
                <h3 class="text-3xl font-black text-slate-900">Ask a Question</h3>
                <p class="text-sm text-slate-500 mt-1">{{ project.name }}</p>
              </div>
              <button @click="closeQuestionModal" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>

            <form @submit.prevent="submitQuestion" class="p-8 space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Company Name *</label>
                  <input v-model="questionForm.company_name" type="text" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="Your Company Ltd">
                </div>
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Contact Person *</label>
                  <input v-model="questionForm.contact_person" type="text" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="John Doe">
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Email Address *</label>
                  <input v-model="questionForm.email" type="email" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="john@company.com">
                </div>
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number *</label>
                  <input v-model="questionForm.phone" type="tel" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" placeholder="+254 700 000 000">
                </div>
              </div>
              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Your Question *</label>
                <textarea v-model="questionForm.question" rows="5" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none" placeholder="What would you like to know about this project?"></textarea>
              </div>
              <div class="flex gap-4 pt-4">
                <button type="button" @click="closeQuestionModal" class="flex-1 px-6 py-4 border-2 border-slate-300 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors">Cancel</button>
                <button type="submit" :disabled="isSubmittingQuestion" class="flex-1 px-6 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors">
                  <span v-if="isSubmittingQuestion">Submitting...</span>
                  <span v-else>Submit Question</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </Transition>
    </div>
  </HomeLayout>
</template>

<script setup lang="ts">
import { ref, computed, reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import HomeLayout from '@/layouts/HomeLayout.vue'

interface Project {
  id: number
  uuid: string
  name: string
  description: string | null
  project_type: 'SOLAR' | 'BESS' | 'SOLAR_BESS' | 'OTHER'
  capacity_mw: number | null
  location: string | null
  current_step: number
  nda_signed_at: string | null
  inception_completed_at: string | null
  rfq_completed_at: string | null
  created_at: string
  client_company?: {
    name: string
  }
}

const props = defineProps<{
  project: Project
}>()

// Modal states
const showInterestModal = ref(false)
const showQuestionModal = ref(false)
const isSubmittingInterest = ref(false)
const isSubmittingQuestion = ref(false)

// Forms
const interestForm = reactive({
  project_name: props.project.name,
  company_name: '',
  contact_person: '',
  email: '',
  phone: '',
  interest_type: 'general',
  message: ''
})

const questionForm = reactive({
  project_name: props.project.name,
  company_name: '',
  contact_person: '',
  email: '',
  phone: '',
  question: ''
})

const projectSteps = computed(() => [
  {
    title: 'Inception Meeting',
    description: 'Initial project discussion and alignment',
    completed: props.project.current_step > 1,
    current: props.project.current_step === 1,
    completedAt: props.project.inception_completed_at
  },
  {
    title: 'NDA Signing',
    description: 'Confidentiality agreement execution',
    completed: props.project.current_step > 2,
    current: props.project.current_step === 2,
    completedAt: props.project.nda_signed_at
  },
  {
    title: 'RFQ & Documentation',
    description: 'Technical and financial documentation',
    completed: props.project.current_step > 3,
    current: props.project.current_step === 3,
    completedAt: props.project.rfq_completed_at
  },
  {
    title: 'Site Visit',
    description: 'Physical assessment and validation',
    completed: props.project.current_step > 4,
    current: props.project.current_step === 4,
    completedAt: null
  },
  {
    title: 'Compliance Review',
    description: 'Regulatory and legal compliance',
    completed: props.project.current_step > 5,
    current: props.project.current_step === 5,
    completedAt: null
  },
  {
    title: 'Contract Signing',
    description: 'Formal agreement execution',
    completed: props.project.current_step > 6,
    current: props.project.current_step === 6,
    completedAt: null
  },
  {
    title: 'Implementation',
    description: 'Project execution and delivery',
    completed: props.project.current_step > 7,
    current: props.project.current_step === 7,
    completedAt: null
  }
])

const getProjectTypeBadge = () => {
  const badges: Record<string, string> = {
    'SOLAR': 'bg-amber-500 text-white',
    'BESS': 'bg-blue-500 text-white',
    'SOLAR_BESS': 'bg-purple-500 text-white',
    'OTHER': 'bg-slate-500 text-white'
  }
  return badges[props.project.project_type] || badges.OTHER
}

const formatProjectType = (type: string) => {
  const types: Record<string, string> = {
    'SOLAR': 'Solar PV',
    'BESS': 'Battery Storage',
    'SOLAR_BESS': 'Solar + BESS',
    'OTHER': 'Renewable Energy'
  }
  return types[type] || type
}

const getTechnologyType = () => {
  const tech: Record<string, string> = {
    'SOLAR': 'Photovoltaic Solar Panels',
    'BESS': 'Battery Energy Storage System',
    'SOLAR_BESS': 'Hybrid Solar + Storage',
    'OTHER': 'Renewable Energy Technology'
  }
  return tech[props.project.project_type] || 'Renewable Energy'
}

const getProjectStatus = () => {
  if (props.project.current_step === 1) return 'Initiating'
  if (props.project.current_step <= 3) return 'Planning'
  if (props.project.current_step <= 5) return 'In Progress'
  if (props.project.current_step === 6) return 'Contracting'
  return 'Active'
}

const formatDate = (date: string | null) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  })
}

const openInterestModal = () => {
  showInterestModal.value = true
}

const closeInterestModal = () => {
  showInterestModal.value = false
}

const openQuestionModal = () => {
  showQuestionModal.value = true
}

const closeQuestionModal = () => {
  showQuestionModal.value = false
}

const submitInterest = () => {
  isSubmittingInterest.value = true
  router.post('/projects/record-interest', interestForm, {
    onSuccess: () => {
      closeInterestModal()
      alert('Thank you for your interest! We will contact you shortly.')
    },
    onError: () => {
      alert('There was an error submitting your interest. Please try again.')
    },
    onFinish: () => {
      isSubmittingInterest.value = false
    }
  })
}

const submitQuestion = () => {
  isSubmittingQuestion.value = true
  router.post('/projects/ask-question', questionForm, {
    onSuccess: () => {
      closeQuestionModal()
      alert('Your question has been submitted. We will respond shortly.')
    },
    onError: () => {
      alert('There was an error submitting your question. Please try again.')
    },
    onFinish: () => {
      isSubmittingQuestion.value = false
    }
  })
}

const initiateInception = () => {
  router.visit('/our-process')
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

<style scoped>
.fade-enter-active, .fade-leave-active { 
  transition: opacity 0.3s; 
}
.fade-enter-from, .fade-leave-to { 
  opacity: 0; 
}

.prose {
  max-width: none;
}
</style>
