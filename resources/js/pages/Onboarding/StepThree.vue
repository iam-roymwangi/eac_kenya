<template>
  <div class="min-h-screen bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">EAC Green Group</h1>
        <h2 class="text-xl text-slate-600 mb-4">Client Onboarding - Step 3: RFQ & Documentation</h2>
        <div class="text-sm text-slate-500">
          Project: {{ project.name }}
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="mb-8">
        <div class="flex items-center justify-between text-sm text-slate-600 mb-2">
          <span>Step 3 of 3</span>
          <span>100% Complete</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2">
          <div class="bg-emerald-600 h-2 rounded-full" style="width: 100%"></div>
        </div>
      </div>

      <form @submit.prevent="submitRfq" class="space-y-8">
        <!-- Technical Drawings Section -->
        <div class="bg-white rounded-lg shadow-lg p-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-6">Technical Drawings & Documents</h3>
          
          <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-2">
              Upload Technical Drawings
            </label>
            <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-emerald-400 transition-colors">
              <input
                ref="fileInput"
                type="file"
                multiple
                accept=".pdf,.dwg,.dxf,.jpg,.jpeg,.png"
                @change="handleFileUpload"
                class="hidden"
              >
              <svg class="w-12 h-12 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
              </svg>
              <p class="text-slate-600 mb-2">Click to upload or drag and drop</p>
              <p class="text-xs text-slate-500">PDF, DWG, DXF, JPG, PNG (max 10MB each)</p>
              <button
                type="button"
                @click="$refs.fileInput.click()"
                class="mt-4 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
              >
                Select Files
              </button>
            </div>
            
            <!-- File List -->
            <div v-if="selectedFiles.length > 0" class="mt-4">
              <h4 class="text-sm font-medium text-slate-700 mb-2">Selected Files:</h4>
              <div class="space-y-2">
                <div
                  v-for="(file, index) in selectedFiles"
                  :key="index"
                  class="flex items-center justify-between bg-slate-50 rounded-lg p-3"
                >
                  <div class="flex items-center">
                    <svg class="w-5 h-5 text-slate-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm text-slate-700">{{ file.name }}</span>
                    <span class="text-xs text-slate-500 ml-2">({{ formatFileSize(file.size) }})</span>
                  </div>
                  <button
                    type="button"
                    @click="removeFile(index)"
                    class="text-red-500 hover:text-red-700 text-sm"
                  >
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Project Requirements Section -->
        <div class="bg-white rounded-lg shadow-lg p-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-6">Project Requirements</h3>
          
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Regulatory Requirements -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Regulatory Requirements
              </label>
              <textarea
                v-model="form.regulatory_requirements"
                rows="6"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="Describe any specific regulatory requirements, permits, or compliance standards..."
              ></textarea>
            </div>

            <!-- Project Timeline -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Project Timeline Expectations
              </label>
              <textarea
                v-model="form.project_timeline"
                rows="6"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="Describe your expected project timeline, key milestones, and any critical deadlines..."
              ></textarea>
            </div>
          </div>

          <!-- Environmental Considerations -->
          <div class="mt-6">
            <label class="block text-sm font-medium text-slate-700 mb-2">
              Environmental Considerations
            </label>
            <textarea
              v-model="form.environmental_considerations"
              rows="4"
              class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Describe any environmental factors, constraints, or sustainability requirements..."
            ></textarea>
          </div>
        </div>

        <!-- Financial Assumptions Section -->
        <div class="bg-white rounded-lg shadow-lg p-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-6">Financial Assumptions</h3>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Project Budget Range (USD)
              </label>
              <select
                v-model="form.financial_assumptions.budget_range"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              >
                <option value="">Select budget range</option>
                <option value="under_1m">Under $1M</option>
                <option value="1m_5m">$1M - $5M</option>
                <option value="5m_10m">$5M - $10M</option>
                <option value="10m_25m">$10M - $25M</option>
                <option value="25m_50m">$25M - $50M</option>
                <option value="over_50m">Over $50M</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Financing Structure
              </label>
              <select
                v-model="form.financial_assumptions.financing_structure"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              >
                <option value="">Select financing structure</option>
                <option value="equity">100% Equity</option>
                <option value="debt_equity">Debt + Equity</option>
                <option value="project_finance">Project Finance</option>
                <option value="government_grants">Government Grants</option>
                <option value="other">Other</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Expected ROI Timeline
              </label>
              <select
                v-model="form.financial_assumptions.roi_timeline"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              >
                <option value="">Select ROI timeline</option>
                <option value="3_5_years">3-5 years</option>
                <option value="5_7_years">5-7 years</option>
                <option value="7_10_years">7-10 years</option>
                <option value="10_plus_years">10+ years</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Risk Tolerance
              </label>
              <select
                v-model="form.financial_assumptions.risk_tolerance"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              >
                <option value="">Select risk tolerance</option>
                <option value="conservative">Conservative</option>
                <option value="moderate">Moderate</option>
                <option value="aggressive">Aggressive</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Error Display -->
        <div v-if="Object.keys(errors).length > 0" class="bg-red-50 border border-red-200 rounded-lg p-4">
          <h4 class="text-red-800 font-medium mb-2">Please correct the following errors:</h4>
          <ul class="text-red-700 text-sm space-y-1">
            <li v-for="(error, field) in errors" :key="field">{{ error }}</li>
          </ul>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
          <button
            type="button"
            @click="goBack"
            class="text-slate-600 hover:text-slate-800 px-6 py-3 rounded-lg font-medium transition-colors"
          >
            ← Previous Step
          </button>
          <button
            type="submit"
            :disabled="processing"
            class="bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white px-8 py-3 rounded-lg font-medium transition-colors"
          >
            <span v-if="processing">Submitting...</span>
            <span v-else>Submit RFQ Package</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  project: Object,
  errors: {
    type: Object,
    default: () => ({})
  }
})

const processing = ref(false)
const selectedFiles = ref([])
const fileInput = ref(null)

const form = reactive({
  regulatory_requirements: '',
  project_timeline: '',
  environmental_considerations: '',
  financial_assumptions: {
    budget_range: '',
    financing_structure: '',
    roi_timeline: '',
    risk_tolerance: ''
  }
})

const handleFileUpload = (event) => {
  const files = Array.from(event.target.files)
  selectedFiles.value = [...selectedFiles.value, ...files]
}

const removeFile = (index) => {
  selectedFiles.value.splice(index, 1)
}

const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const goBack = () => {
  router.get(`/onboarding/${props.project.uuid}/inception`)
}

const submitRfq = () => {
  processing.value = true
  
  const formData = new FormData()
  formData.append('uuid', props.project.uuid)
  formData.append('regulatory_requirements', form.regulatory_requirements)
  formData.append('project_timeline', form.project_timeline)
  formData.append('environmental_considerations', form.environmental_considerations)
  formData.append('financial_assumptions', JSON.stringify(form.financial_assumptions))
  
  // Add files
  selectedFiles.value.forEach((file, index) => {
    formData.append(`technical_drawings[${index}]`, file)
  })
  
  router.post(`/onboarding/${props.project.uuid}/step-three`, formData, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>