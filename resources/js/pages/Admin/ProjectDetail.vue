<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6">
      <!-- Header -->
      <div class="flex justify-between items-start mb-6">
        <div>
          <h1 class="text-2xl font-bold text-slate-900">{{ project.name }}</h1>
          <p class="text-slate-600">{{ project.location }}</p>
        </div>
        <a
          :href="admin.projects.index.url()"
          class="text-slate-600 hover:text-slate-800 px-4 py-2 rounded-lg font-medium transition-colors"
        >
          ← Back to Projects
        </a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Project Details -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Basic Information -->
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Project Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <span class="text-sm text-slate-600">Project Type:</span>
                <p class="font-medium text-slate-900">{{ formatProjectType(project.project_type) }}</p>
              </div>
              <div v-if="project.capacity_mw">
                <span class="text-sm text-slate-600">Capacity:</span>
                <p class="font-medium text-slate-900">{{ project.capacity_mw }} MW</p>
              </div>
              <div>
                <span class="text-sm text-slate-600">Current Step:</span>
                <p class="font-medium text-slate-900">Step {{ project.current_step }}: {{ step_names[project.current_step] }}</p>
              </div>
              <div>
                <span class="text-sm text-slate-600">Created:</span>
                <p class="font-medium text-slate-900">{{ formatDate(project.created_at) }}</p>
              </div>
            </div>
            <div v-if="project.description" class="mt-4">
              <span class="text-sm text-slate-600">Description:</span>
              <p class="text-slate-900 mt-1">{{ project.description }}</p>
            </div>
          </div>

          <!-- Onboarding Progress -->
          <!-- <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Onboarding Progress</h3>
            <div class="space-y-4">
              <div v-for="(stepName, stepNumber) in step_names" :key="stepNumber" class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full mr-4"
                     :class="stepNumber <= project.current_step 
                       ? 'bg-emerald-600 text-white' 
                       : 'bg-slate-200 text-slate-600'">
                  <span class="text-sm font-medium">{{ stepNumber }}</span>
                </div>
                <div class="flex-1">
                  <p class="font-medium text-slate-900">{{ stepName }}</p>
                  <p v-if="getStepStatus(stepNumber)" class="text-sm text-slate-600">
                    {{ getStepStatus(stepNumber) }}
                  </p>
                </div>
                <div v-if="stepNumber <= project.current_step">
                  <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div> -->

          <!-- RFQ Data (if available) -->
          <div v-if="project.rfq_data" class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">RFQ Submission</h3>
            <div class="space-y-4">
              <div v-if="project.rfq_data.regulatory_requirements">
                <span class="text-sm text-slate-600">Regulatory Requirements:</span>
                <p class="text-slate-900 mt-1">{{ project.rfq_data.regulatory_requirements }}</p>
              </div>
              <div v-if="project.rfq_data.project_timeline">
                <span class="text-sm text-slate-600">Project Timeline:</span>
                <p class="text-slate-900 mt-1">{{ project.rfq_data.project_timeline }}</p>
              </div>
              <div v-if="project.rfq_data.environmental_considerations">
                <span class="text-sm text-slate-600">Environmental Considerations:</span>
                <p class="text-slate-900 mt-1">{{ project.rfq_data.environmental_considerations }}</p>
              </div>
              <div v-if="project.rfq_data.technical_drawings && project.rfq_data.technical_drawings.length > 0">
                <span class="text-sm text-slate-600">Technical Drawings:</span>
                <ul class="mt-1 space-y-1">
                  <li v-for="file in project.rfq_data.technical_drawings" :key="file.path" 
                      class="text-sm text-slate-900">
                    {{ file.original_name }} ({{ formatFileSize(file.size) }})
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Project Interests -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-slate-900">Project Interests</h3>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                {{ interests.length }} {{ interests.length === 1 ? 'Interest' : 'Interests' }}
              </span>
            </div>
            
            <div v-if="interests.length === 0" class="text-center py-8">
              <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
              </svg>
              <p class="mt-2 text-sm text-slate-500">No interests recorded yet</p>
            </div>

            <div v-else class="space-y-3">
              <div v-for="interest in interests" :key="interest.id" 
                   class="border border-slate-200 rounded-lg overflow-hidden hover:border-emerald-300 transition-colors">
                <button
                  @click="toggleInterest(interest.id)"
                  class="w-full px-4 py-3 flex items-center justify-between bg-slate-50 hover:bg-slate-100 transition-colors"
                >
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                      <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                      </svg>
                    </div>
                    <div class="text-left">
                      <p class="font-medium text-slate-900">{{ interest.company_name }}</p>
                      <p class="text-sm text-slate-500">{{ interest.contact_person }}</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-3">
                    <span :class="['px-2.5 py-1 rounded-full text-xs font-medium', getInterestTypeBadge(interest.interest_type)]">
                      {{ formatInterestType(interest.interest_type) }}
                    </span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform" 
                         :class="{ 'rotate-180': expandedInterests.includes(interest.id) }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                  </div>
                </button>
                
                <div v-if="expandedInterests.includes(interest.id)" class="px-4 py-4 bg-white border-t border-slate-200">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Email</span>
                      <p class="text-sm text-slate-900 mt-1">{{ interest.email }}</p>
                    </div>
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Phone</span>
                      <p class="text-sm text-slate-900 mt-1">{{ interest.phone }}</p>
                    </div>
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Interest Type</span>
                      <p class="text-sm text-slate-900 mt-1">{{ formatInterestType(interest.interest_type) }}</p>
                    </div>
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Submitted</span>
                      <p class="text-sm text-slate-900 mt-1">{{ formatDateTime(interest.created_at) }}</p>
                    </div>
                  </div>
                  <div v-if="interest.message">
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Message</span>
                    <p class="text-sm text-slate-900 mt-1 bg-slate-50 rounded-lg p-3">{{ interest.message }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project Questions -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-slate-900">Project Questions</h3>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                {{ questions.length }} {{ questions.length === 1 ? 'Question' : 'Questions' }}
              </span>
            </div>
            
            <div v-if="questions.length === 0" class="text-center py-8">
              <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p class="mt-2 text-sm text-slate-500">No questions asked yet</p>
            </div>

            <div v-else class="space-y-3">
              <div v-for="question in questions" :key="question.id" 
                   class="border border-slate-200 rounded-lg overflow-hidden hover:border-blue-300 transition-colors">
                <button
                  @click="toggleQuestion(question.id)"
                  class="w-full px-4 py-3 flex items-center justify-between bg-slate-50 hover:bg-slate-100 transition-colors"
                >
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                      <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                    <div class="text-left flex-1">
                      <p class="font-medium text-slate-900">{{ question.company_name }}</p>
                      <p class="text-sm text-slate-500 line-clamp-1">{{ question.question }}</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-3">
                    <span v-if="question.admin_response" class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      Answered
                    </span>
                    <span v-else class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                      Pending
                    </span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform" 
                         :class="{ 'rotate-180': expandedQuestions.includes(question.id) }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                  </div>
                </button>
                
                <div v-if="expandedQuestions.includes(question.id)" class="px-4 py-4 bg-white border-t border-slate-200">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Contact Person</span>
                      <p class="text-sm text-slate-900 mt-1">{{ question.contact_person }}</p>
                    </div>
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Email</span>
                      <p class="text-sm text-slate-900 mt-1">{{ question.email }}</p>
                    </div>
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Phone</span>
                      <p class="text-sm text-slate-900 mt-1">{{ question.phone }}</p>
                    </div>
                    <div>
                      <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Submitted</span>
                      <p class="text-sm text-slate-900 mt-1">{{ formatDateTime(question.created_at) }}</p>
                    </div>
                  </div>
                  <div class="mb-4">
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Question</span>
                    <p class="text-sm text-slate-900 mt-1 bg-blue-50 rounded-lg p-3">{{ question.question }}</p>
                  </div>
                  <div v-if="question.admin_response">
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Admin Response</span>
                    <p class="text-sm text-slate-900 mt-1 bg-green-50 rounded-lg p-3">{{ question.admin_response }}</p>
                    <p class="text-xs text-slate-500 mt-2">Responded: {{ formatDateTime(question.responded_at) }}</p>
                  </div>
                  <div v-else>
                    <form @submit.prevent="respondToQuestion(question.id)" class="mt-4">
                      <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                        Your Response
                      </label>
                      <textarea
                        v-model="responseForm[question.id]"
                        rows="3"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Type your response here..."
                      ></textarea>
                      <button
                        type="submit"
                        :disabled="!responseForm[question.id] || responseProcessing[question.id]"
                        class="mt-2 bg-blue-600 hover:bg-blue-700 disabled:bg-slate-300 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                      >
                        <span v-if="responseProcessing[question.id]">Submitting...</span>
                        <span v-else>Submit Response</span>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="space-y-6">
          <!-- QR Code Management -->
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">QR Code Management</h3>
            
            <div v-if="qr_url && !isQrExpired()" class="mb-4">
              <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 mb-4">
                <p class="text-emerald-800 text-sm font-medium mb-2">QR Code Active</p>
                <p class="text-emerald-700 text-sm">Expires: {{ formatDateTime(project.qr_expires_at) }}</p>
              </div>
              
              <div v-if="qrCodeDataUrl" class="mb-4 flex justify-center bg-white p-4 rounded-lg border border-slate-200">
                <img :src="qrCodeDataUrl" alt="Project QR Code" class="w-48 h-48" />
              </div>

              <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">QR Code URL:</label>
                <div class="bg-slate-50 rounded-lg p-3">
                  <code class="text-xs text-slate-700 break-all">{{ qr_url }}</code>
                </div>
                <button
                  @click="copyToClipboard(qr_url)"
                  class="mt-2 text-sm text-emerald-600 hover:text-emerald-700"
                >
                  Copy URL
                </button>
              </div>
            </div>

            <div v-else class="mb-4">
              <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <p class="text-red-800 text-sm font-medium">QR Code Expired</p>
                <p class="text-red-700 text-sm">Generate a new QR code to enable client access</p>
              </div>
            </div>

            <form @submit.prevent="generateQr" class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                  Expiration (hours)
                </label>
                <select
                  v-model="qrForm.hours"
                  class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >
                  <option value="24">24 hours</option>
                  <option value="48">48 hours (recommended)</option>
                  <option value="72">72 hours</option>
                  <option value="168">1 week</option>
                </select>
              </div>
              <button
                type="submit"
                :disabled="qrProcessing"
                class="w-full bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
              >
                <span v-if="qrProcessing">Generating...</span>
                <span v-else>Generate QR Code</span>
              </button>
            </form>
          </div>

          <!-- Step Management -->
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Step Management</h3>
            
            <form @submit.prevent="resetStep" class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                  Reset to Step
                </label>
                <select
                  v-model="stepForm.step"
                  class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >
                  <option v-for="(stepName, stepNumber) in step_names" 
                          :key="stepNumber" 
                          :value="stepNumber">
                    Step {{ stepNumber }}: {{ stepName }}
                  </option>
                </select>
              </div>
              <button
                type="submit"
                :disabled="stepProcessing"
                class="w-full bg-slate-600 hover:bg-slate-700 disabled:bg-slate-300 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
              >
                <span v-if="stepProcessing">Resetting...</span>
                <span v-else>Reset Step</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { reactive, ref, onMounted, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import admin from '@/routes/admin'
import QRCode from 'qrcode'

const props = defineProps({
  project: Object,
  qr_url: String,
  step_names: Object,
  interests: Array,
  questions: Array
})

const breadcrumbs = [
  { title: 'Admin', href: admin.projects.index.url() },
  { title: 'Projects', href: admin.projects.index.url() },
  { title: props.project.name, href: admin.projects.show.url(props.project.id) }
]

const qrProcessing = ref(false)
const stepProcessing = ref(false)
const qrCodeDataUrl = ref(null)
const expandedInterests = ref([])
const expandedQuestions = ref([])
const responseForm = reactive({})
const responseProcessing = reactive({})

const qrForm = reactive({
  hours: 48
})

const stepForm = reactive({
  step: props.project.current_step
})

const formatProjectType = (type) => {
  const types = {
    'SOLAR': 'Solar PV',
    'BESS': 'Battery Energy Storage System',
    'SOLAR_BESS': 'Solar PV + Battery Storage',
    'OTHER': 'Other Renewable Energy'
  }
  return types[type] || type
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const formatDateTime = (dateString) => {
  return new Date(dateString).toLocaleString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const isQrExpired = () => {
  if (!props.project.qr_expires_at) return true
  return new Date(props.project.qr_expires_at) < new Date()
}

const getStepStatus = (stepNumber) => {
  if (stepNumber === 1 && props.project.nda_signed_at) {
    return `Signed: ${formatDateTime(props.project.nda_signed_at)}`
  }
  if (stepNumber === 2 && props.project.inception_completed_at) {
    return `Completed: ${formatDateTime(props.project.inception_completed_at)}`
  }
  if (stepNumber === 3 && props.project.rfq_completed_at) {
    return `Submitted: ${formatDateTime(props.project.rfq_completed_at)}`
  }
  return null
}

const copyToClipboard = async (text) => {
  try {
    await navigator.clipboard.writeText(text)
    // You could add a toast notification here
  } catch (err) {
    console.error('Failed to copy: ', err)
  }
}

const generateQr = () => {
  qrProcessing.value = true
  
  router.post(admin.projects.generateQr.url(props.project.id), qrForm, {
    onFinish: () => {
      qrProcessing.value = false
    }
  })
}

const generateQrCodeImage = async () => {
  if (props.qr_url && !isQrExpired()) {
    try {
      qrCodeDataUrl.value = await QRCode.toDataURL(props.qr_url, {
        width: 200,
        margin: 2,
        color: {
          dark: '#000000',
          light: '#ffffff'
        }
      })
    } catch (err) {
      console.error(err)
    }
  } else {
    qrCodeDataUrl.value = null
  }
}

onMounted(() => {
  generateQrCodeImage()
})

watch(() => props.qr_url, () => {
  generateQrCodeImage()
})

const resetStep = () => {
  stepProcessing.value = true
  
  router.post(admin.projects.resetStep.url(props.project.id), stepForm, {
    onFinish: () => {
      stepProcessing.value = false
    }
  })
}

const toggleInterest = (id) => {
  const index = expandedInterests.value.indexOf(id)
  if (index > -1) {
    expandedInterests.value.splice(index, 1)
  } else {
    expandedInterests.value.push(id)
  }
}

const toggleQuestion = (id) => {
  const index = expandedQuestions.value.indexOf(id)
  if (index > -1) {
    expandedQuestions.value.splice(index, 1)
  } else {
    expandedQuestions.value.push(id)
  }
}

const getInterestTypeBadge = (type) => {
  const badges = {
    'general': 'bg-slate-100 text-slate-800',
    'investor': 'bg-emerald-100 text-emerald-800',
    'partner': 'bg-blue-100 text-blue-800',
    'other': 'bg-purple-100 text-purple-800'
  }
  return badges[type] || badges.general
}

const formatInterestType = (type) => {
  const types = {
    'general': 'General Interest',
    'investor': 'Investment Opportunity',
    'partner': 'Partnership Inquiry',
    'other': 'Other'
  }
  return types[type] || type
}

const respondToQuestion = (questionId) => {
  if (!responseForm[questionId]) return
  
  responseProcessing[questionId] = true
  
  router.post(admin.questions.respond.url(questionId), {
    response: responseForm[questionId]
  }, {
    onSuccess: () => {
      responseForm[questionId] = ''
    },
    onFinish: () => {
      responseProcessing[questionId] = false
    }
  })
}
</script>


<style scoped>
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
