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

              <button @click="openProjectModal(index)" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase tracking-[0.2em] group-hover:bg-emerald-600 transition-colors mb-3">
                {{ project.isDatabase ? 'View Details' : 'Technical Data Sheet' }}
              </button>
              
              <button @click="openInterestModal(project)" class="w-full py-3 border-2 border-emerald-600 text-emerald-600 rounded-2xl font-bold text-xs uppercase tracking-[0.2em] hover:bg-emerald-600 hover:text-white transition-colors">
                Express Interest
              </button>
            </div>
          </div>
        </TransitionGroup>
      </div>
    </section>

    <Transition name="fade">
      <div v-if="selectedProjectIndex !== null && !filteredProjects[selectedProjectIndex]?.isDatabase" class="fixed inset-0 z-[200] flex items-center justify-center p-6 backdrop-blur-xl bg-slate-900/60" @click="selectedProjectIndex = null">
        <div @click.stop class="bg-white rounded-[3rem] max-w-5xl w-full h-[85vh] overflow-hidden shadow-2xl flex flex-col md:flex-row relative">
          <button @click="selectedProjectIndex = null" class="absolute top-8 right-8 z-10 w-12 h-12 bg-white/20 backdrop-blur-md hover:bg-white text-slate-900 rounded-full flex items-center justify-center transition-all">
            ✕
          </button>

          <div class="md:w-1/2 relative h-64 md:h-auto">
            <img :src="filteredProjects[selectedProjectIndex]?.image" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
            <div class="absolute bottom-10 left-10 text-white">
              <p class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-2">{{ filteredProjects[selectedProjectIndex]?.type }} Division</p>
              <h2 class="text-4xl font-black tracking-tighter">{{ filteredProjects[selectedProjectIndex]?.name }}</h2>
            </div>
          </div>

          <div class="md:w-1/2 p-12 overflow-y-auto bg-white">
            <div class="space-y-8">
              <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4">Infrastructure Overview</h4>
                <p class="text-slate-600 leading-relaxed font-medium">{{ filteredProjects[selectedProjectIndex]?.fullDescription }}</p>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div v-for="(val, label) in getMetricObject(filteredProjects[selectedProjectIndex])" :key="label" class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-emerald-200 transition-colors">
                  <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ label }}</p>
                  <p class="text-2xl font-black text-slate-900 tracking-tighter">{{ val }}</p>
                </div>
              </div>

              <div class="bg-emerald-50 p-8 rounded-[2rem] border border-emerald-100">
                <h5 class="text-xs font-black uppercase text-emerald-800 tracking-widest mb-4">ESG Impact Metrics</h5>
                <ul class="space-y-3">
                  <li v-for="metric in filteredProjects[selectedProjectIndex]?.metrics" :key="metric" class="flex items-center gap-3 text-sm text-emerald-900 font-medium">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    {{ metric }}
                  </li>
                </ul>
              </div>

              <!-- Action Buttons -->
              <div class="space-y-3">
                <button @click="openInterestModalFromDetail(filteredProjects[selectedProjectIndex])" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase tracking-widest hover:shadow-xl hover:shadow-emerald-200 transition-all">
                  Express Interest
                </button>
                <button @click="openQuestionModal(filteredProjects[selectedProjectIndex])" class="w-full py-4 border-2 border-slate-900 text-slate-900 rounded-2xl font-bold uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all">
                  Ask a Question
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Transition>

    <!-- Interest Modal -->
    <Transition name="fade">
      <div v-if="showInterestModal" class="fixed inset-0 z-[250] flex items-center justify-center p-6 backdrop-blur-xl bg-slate-900/60" @click="closeInterestModal">
        <div @click.stop class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
          <div class="sticky top-0 bg-white border-b border-slate-200 p-8 flex justify-between items-center rounded-t-3xl">
            <div>
              <h3 class="text-3xl font-black text-slate-900">Express Interest</h3>
              <p class="text-sm text-slate-500 mt-1">{{ selectedProject?.name }}</p>
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
                <input
                  v-model="interestForm.company_name"
                  type="text"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="Your Company Ltd"
                >
              </div>

              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Contact Person *</label>
                <input
                  v-model="interestForm.contact_person"
                  type="text"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="John Doe"
                >
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Email Address *</label>
                <input
                  v-model="interestForm.email"
                  type="email"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="john@company.com"
                >
              </div>

              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number *</label>
                <input
                  v-model="interestForm.phone"
                  type="tel"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="+254 700 000 000"
                >
              </div>
            </div>

            <div>
              <label class="block text-sm font-bold text-slate-700 mb-2">Interest Type *</label>
              <select
                v-model="interestForm.interest_type"
                required
                class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
              >
                <option value="general">General Interest</option>
                <option value="investor">Investment Opportunity</option>
                <option value="partner">Partnership Inquiry</option>
                <option value="other">Other</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-bold text-slate-700 mb-2">Message (Optional)</label>
              <textarea
                v-model="interestForm.message"
                rows="4"
                class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"
                placeholder="Tell us more about your interest..."
              ></textarea>
            </div>

            <div class="flex gap-4 pt-4">
              <button
                type="button"
                @click="closeInterestModal"
                class="flex-1 px-6 py-4 border-2 border-slate-300 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="isSubmittingInterest"
                class="flex-1 px-6 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors"
              >
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
              <p class="text-sm text-slate-500 mt-1">{{ selectedProject?.name }}</p>
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
                <input
                  v-model="questionForm.company_name"
                  type="text"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="Your Company Ltd"
                >
              </div>

              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Contact Person *</label>
                <input
                  v-model="questionForm.contact_person"
                  type="text"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="John Doe"
                >
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Email Address *</label>
                <input
                  v-model="questionForm.email"
                  type="email"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="john@company.com"
                >
              </div>

              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number *</label>
                <input
                  v-model="questionForm.phone"
                  type="tel"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="+254 700 000 000"
                >
              </div>
            </div>

            <div>
              <label class="block text-sm font-bold text-slate-700 mb-2">Your Question *</label>
              <textarea
                v-model="questionForm.question"
                rows="5"
                required
                class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"
                placeholder="What would you like to know about this project?"
              ></textarea>
            </div>

            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm text-emerald-800">After submitting your question, you can initiate an inception meeting to discuss the project in detail.</p>
              </div>
            </div>

            <div class="flex gap-4 pt-4">
              <button
                type="button"
                @click="closeQuestionModal"
                class="flex-1 px-6 py-4 border-2 border-slate-300 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="isSubmittingQuestion"
                class="flex-1 px-6 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors"
              >
                <span v-if="isSubmittingQuestion">Submitting...</span>
                <span v-else>Submit Question</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </Transition>

    <!-- Inception Meeting Modal (after question submission) -->
    <Transition name="fade">
      <div v-if="showInceptionModal" class="fixed inset-0 z-[260] flex items-center justify-center p-6 backdrop-blur-xl bg-slate-900/60" @click="closeInceptionModal">
        <div @click.stop class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
          <div class="sticky top-0 bg-white border-b border-slate-200 p-8 flex justify-between items-center rounded-t-3xl">
            <div>
              <h3 class="text-3xl font-black text-slate-900">Initiate Inception Meeting</h3>
              <p class="text-sm text-slate-500 mt-1">{{ selectedProject?.name }}</p>
            </div>
            <button @click="closeInceptionModal" class="text-slate-400 hover:text-slate-600 transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <div class="p-8">
            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 mb-6">
              <h4 class="font-bold text-emerald-900 mb-2">What happens next?</h4>
              <ul class="space-y-2 text-sm text-emerald-800">
                <li class="flex items-start gap-2">
                  <span class="text-emerald-600 font-bold">1.</span>
                  <span>You'll receive a QR code to start the onboarding process</span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="text-emerald-600 font-bold">2.</span>
                  <span>Sign the NDA to protect confidential information</span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="text-emerald-600 font-bold">3.</span>
                  <span>Complete the inception meeting documentation</span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="text-emerald-600 font-bold">4.</span>
                  <span>Submit your RFQ package with project details</span>
                </li>
              </ul>
            </div>

            <form @submit.prevent="submitInceptionMeeting" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Company Name *</label>
                  <input
                    v-model="inceptionForm.company_name"
                    type="text"
                    required
                    class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                    placeholder="Your Company Ltd"
                  >
                </div>

                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Contact Person *</label>
                  <input
                    v-model="inceptionForm.contact_person"
                    type="text"
                    required
                    class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                    placeholder="John Doe"
                  >
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Email Address *</label>
                  <input
                    v-model="inceptionForm.email"
                    type="email"
                    required
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                    placeholder="john@company.com"
                  >
                </div>

                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number *</label>
                  <input
                    v-model="inceptionForm.phone"
                    type="tel"
                    required
                    class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                    placeholder="+254 700 000 000"
                  >
                </div>
              </div>

              <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Project Name *</label>
                <input
                  v-model="inceptionForm.project_name"
                  type="text"
                  required
                  class="w-full text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  placeholder="Solar Farm Project"
                >
              </div>

              <div>
                <label class="block text-sm font-bold text-slate-700 mb-3">Questions for the Meeting (Optional)</label>
                <div class="space-y-3">
                  <div v-for="(question, index) in inceptionForm.questions" :key="index" class="flex gap-2">
                    <input
                      v-model="inceptionForm.questions[index]"
                      type="text"
                      class="flex-1 text-black border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                      :placeholder="'Question ' + (index + 1)"
                    >
                    <button
                      v-if="inceptionForm.questions.length > 1"
                      type="button"
                      @click="removeQuestion(index)"
                      class="px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-colors"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                  <button
                    v-if="inceptionForm.questions.length < 5"
                    type="button"
                    @click="addQuestion"
                    class="w-full px-4 py-3 border-2 border-dashed border-slate-300 text-slate-600 rounded-xl font-medium hover:border-emerald-500 hover:text-emerald-600 transition-colors"
                  >
                    + Add Another Question
                  </button>
                </div>
              </div>

              <div class="flex gap-4 pt-4">
                <button
                  type="button"
                  @click="closeInceptionModal"
                  class="flex-1 px-6 py-4 border-2 border-slate-300 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  :disabled="isSubmittingInception"
                  class="flex-1 px-6 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors"
                >
                  <span v-if="isSubmittingInception">Processing...</span>
                  <span v-else>Generate QR Code</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </Transition>
    </div>
  </HomeLayout>
</template>

<script setup lang="ts">
import { ref, computed, reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import HomeLayout from '@/layouts/HomeLayout.vue';

interface Project {
  id?: number
  name: string
  type: 'Solar' | 'Wind' | 'Hydro' | 'Geothermal'
  description: string
  fullDescription?: string
  capacity: string
  roi?: string
  year?: string
  location: string
  image?: string
  metrics?: string[]
  isDatabase?: boolean
}

const props = defineProps<{
  dbProjects?: Project[]
}>()

const staticProjects: Project[] = []

// Merge database projects with static projects
const projects = computed(() => {
  const dbProjs = (props.dbProjects || []).map(p => {
    // Assign image based on project name or type
    let image = 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=2070&auto=format&fit=crop' // Default solar
    
    if (p.name === 'Nyakwere Hills Solar Project') {
      image = 'https://media.licdn.com/dms/image/v2/D4D22AQEuJWEPNGrp4w/feedshare-shrink_2048_1536/B4DZniGPs5JMAw-/0/1760434919295?e=2147483647&v=beta&t=VlN__V4p_uSQc4A9x-abBzD2pWo_CYUxHTNXXDC_27o'
    } else if (p.type === 'Wind') {
      image = '/images/ol-ndanyat-wind.png'
    }
    
    return {
      ...p,
      fullDescription: p.description,
      roi: 'TBD',
      year: '2026',
      image: image,
      metrics: ['Clean Energy', 'Sustainable', 'High Impact']
    }
  })
  return [...dbProjs, ...staticProjects]
})

const projectTypes = ['all', 'Solar', 'Wind', 'Geothermal']
const selectedType = ref('all')
const selectedProjectIndex = ref<number | null>(null)
const selectedProject = ref<Project | null>(null)

// Modal states
const showInterestModal = ref(false)
const showQuestionModal = ref(false)
const showInceptionModal = ref(false)

// Submission states
const isSubmittingInterest = ref(false)
const isSubmittingQuestion = ref(false)
const isSubmittingInception = ref(false)

// Forms
const interestForm = reactive({
  project_name: '',
  company_name: '',
  contact_person: '',
  email: '',
  phone: '',
  interest_type: 'general',
  message: ''
})

const questionForm = reactive({
  project_name: '',
  company_name: '',
  contact_person: '',
  email: '',
  phone: '',
  question: ''
})

const inceptionForm = reactive({
  company_name: '',
  contact_person: '',
  email: '',
  phone: '',
  project_name: '',
  meeting_mode: 'online' as 'online' | 'physical',
  questions: ['']
})

const filteredProjects = computed(() => {
  if (selectedType.value === 'all') return projects.value
  return projects.value.filter(p => p.type === selectedType.value)
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

const openProjectModal = (i: number) => {
  const project = filteredProjects.value[i]
  // If it's a database project, navigate to detail page
  if (project.isDatabase && project.id) {
    router.visit(`/projects/${project.id}`)
  } else {
    // Otherwise show the modal for static projects
    selectedProjectIndex.value = i
  }
}

const openInterestModal = (project: Project) => {
  selectedProject.value = project
  interestForm.project_name = project.name
  showInterestModal.value = true
}

const openInterestModalFromDetail = (project: Project) => {
  selectedProjectIndex.value = null
  openInterestModal(project)
}

const closeInterestModal = () => {
  showInterestModal.value = false
  resetInterestForm()
}

const openQuestionModal = (project: Project) => {
  selectedProjectIndex.value = null
  selectedProject.value = project
  questionForm.project_name = project.name
  showQuestionModal.value = true
}

const closeQuestionModal = () => {
  showQuestionModal.value = false
  resetQuestionForm()
}

const closeInceptionModal = () => {
  showInceptionModal.value = false
  resetInceptionForm()
}

const resetInterestForm = () => {
  Object.assign(interestForm, {
    project_name: '',
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    interest_type: 'general',
    message: ''
  })
}

const resetQuestionForm = () => {
  Object.assign(questionForm, {
    project_name: '',
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    question: ''
  })
}

const resetInceptionForm = () => {
  Object.assign(inceptionForm, {
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    project_name: '',
    questions: ['']
  })
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
      // Pre-fill inception form with question form data
      inceptionForm.company_name = questionForm.company_name
      inceptionForm.contact_person = questionForm.contact_person
      inceptionForm.email = questionForm.email
      inceptionForm.phone = questionForm.phone
      inceptionForm.project_name = questionForm.project_name
      // Show inception modal
      showInceptionModal.value = true
    },
    onError: () => {
      alert('There was an error submitting your question. Please try again.')
    },
    onFinish: () => {
      isSubmittingQuestion.value = false
    }
  })
}

const submitInceptionMeeting = () => {
  isSubmittingInception.value = true
  router.post('/initiate-inception', inceptionForm, {
    onFinish: () => {
      isSubmittingInception.value = false
    }
  })
}

const addQuestion = () => {
  if (inceptionForm.questions.length < 5) {
    inceptionForm.questions.push('')
  }
}

const removeQuestion = (index: number) => {
  if (inceptionForm.questions.length > 1) {
    inceptionForm.questions.splice(index, 1)
  }
}

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
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

::-webkit-scrollbar { display: none; }
</style>