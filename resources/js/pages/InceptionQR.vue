<template>
  <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl p-8">
      <!-- Success Header -->
      <div class="text-center mb-8">
        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <h1 class="text-3xl font-black text-slate-900 mb-2">QR Code Generated!</h1>
        <p class="text-slate-600">Scan the QR code below to begin your onboarding journey</p>
      </div>

      <!-- QR Code Display -->
      <div class="bg-slate-50 rounded-2xl p-8 mb-6">
        <div class="flex justify-center mb-4">
          <div ref="qrCodeContainer" class="bg-white p-4 rounded-xl shadow-lg"></div>
        </div>
        <p class="text-center text-sm text-slate-500">
          This QR code expires in 48 hours
        </p>
      </div>

      <!-- Project Information -->
      <div class="bg-emerald-50 rounded-2xl p-6 mb-6">
        <h3 class="font-bold text-slate-900 mb-3">Project Details</h3>
        <div class="space-y-2 text-sm">
          <div class="flex justify-between">
            <span class="text-slate-600">Project Name:</span>
            <span class="font-medium text-slate-900">{{ project.name }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-slate-600">Company:</span>
            <span class="font-medium text-slate-900">{{ contact_info.company_name }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-slate-600">Contact Person:</span>
            <span class="font-medium text-slate-900">{{ contact_info.contact_person }}</span>
          </div>
        </div>
      </div>

      <!-- Instructions -->
      <div class="border-t border-slate-200 pt-6">
        <h3 class="font-bold text-slate-900 mb-3">Next Steps:</h3>
        <ol class="space-y-2 text-sm text-slate-600">
          <li class="flex items-start">
            <span class="font-bold text-emerald-600 mr-2">1.</span>
            <span>Scan the QR code with your mobile device</span>
          </li>
          <li class="flex items-start">
            <span class="font-bold text-emerald-600 mr-2">2.</span>
            <span>Review and sign the Non-Disclosure Agreement</span>
          </li>
          <li class="flex items-start">
            <span class="font-bold text-emerald-600 mr-2">3.</span>
            <span>Complete the inception meeting documentation</span>
          </li>
          <li class="flex items-start">
            <span class="font-bold text-emerald-600 mr-2">4.</span>
            <span>Submit your RFQ package with project details</span>
          </li>
        </ol>
      </div>

      <!-- Actions -->
      <div class="flex gap-4 mt-8">
        <button
          @click="downloadQR"
          class="flex-1 px-6 py-3 bg-slate-900 text-white rounded-lg font-medium hover:bg-slate-800 transition-colors"
        >
          Download QR Code
        </button>
        <a
          href="/"
          class="flex-1 px-6 py-3 border-2 border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors text-center"
        >
          Back to Home
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import QRCode from 'qrcode'

const props = defineProps({
  project: Object,
  qr_url: String,
  contact_info: Object
})

const qrCodeContainer = ref(null)

onMounted(async () => {
  if (qrCodeContainer.value && props.qr_url) {
    await QRCode.toCanvas(props.qr_url, {
      width: 256,
      margin: 2,
      color: {
        dark: '#0f172a',
        light: '#ffffff'
      }
    }).then(canvas => {
      qrCodeContainer.value.appendChild(canvas)
    })
  }
})

const downloadQR = async () => {
  const canvas = document.createElement('canvas')
  await QRCode.toCanvas(canvas, props.qr_url, {
    width: 512,
    margin: 2
  })
  
  const link = document.createElement('a')
  link.download = `${props.project.name.replace(/\s+/g, '_')}_QR.png`
  link.href = canvas.toDataURL()
  link.click()
}
</script>
