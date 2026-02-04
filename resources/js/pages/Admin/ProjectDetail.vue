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
          <div class="bg-white rounded-lg shadow p-6">
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
          </div>

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
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import admin from '@/routes/admin'

const props = defineProps({
  project: Object,
  qr_url: String,
  step_names: Object
})

const breadcrumbs = [
  { title: 'Admin', href: admin.projects.index.url() },
  { title: 'Projects', href: admin.projects.index.url() },
  { title: props.project.name, href: admin.projects.show.url(props.project.id) }
]

const qrProcessing = ref(false)
const stepProcessing = ref(false)

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

const resetStep = () => {
  stepProcessing.value = true
  
  router.post(admin.projects.resetStep.url(props.project.id), stepForm, {
    onFinish: () => {
      stepProcessing.value = false
    }
  })
}
</script>