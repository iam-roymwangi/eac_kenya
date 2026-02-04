<template>
  <div class="min-h-screen bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">EAC Green Group</h1>
        <h2 class="text-xl text-slate-600 mb-4">Client Onboarding - Step 1: NDA Signing</h2>
        <div class="text-sm text-slate-500">
          Project: {{ project.name }}
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="mb-8">
        <div class="flex items-center justify-between text-sm text-slate-600 mb-2">
          <span>Step 1 of 3</span>
          <span>33% Complete</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2">
          <div class="bg-emerald-600 h-2 rounded-full" style="width: 33%"></div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- NDA Text Area -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Non-Disclosure Agreement</h3>
          <div 
            class="border border-slate-300 rounded-lg p-6 h-96 overflow-y-auto bg-slate-50 text-sm leading-relaxed select-none"
            @contextmenu.prevent
            style="user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;"
          >
            <div class="whitespace-pre-line">{{ ndaText }}</div>
          </div>
          <p class="text-xs text-slate-500 mt-2">
            Please read the entire agreement before signing below.
          </p>
        </div>

        <!-- Signature Section -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Digital Signature</h3>
          <div class="border-2 border-dashed border-slate-300 rounded-lg p-4">
            <canvas
              ref="signaturePad"
              class="w-full h-32 bg-white border border-slate-200 rounded cursor-crosshair"
              @mousedown="startSigning"
              @mousemove="sign"
              @mouseup="stopSigning"
              @touchstart="startSigning"
              @touchmove="sign"
              @touchend="stopSigning"
            ></canvas>
            <div class="flex justify-between items-center mt-3">
              <p class="text-sm text-slate-600">Sign above to agree to the terms</p>
              <button
                @click="clearSignature"
                type="button"
                class="text-sm text-slate-500 hover:text-slate-700 underline"
              >
                Clear Signature
              </button>
            </div>
          </div>
        </div>

        <!-- Error Display -->
        <div v-if="errors.signature" class="mb-4">
          <p class="text-red-600 text-sm">{{ errors.signature }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
          <div></div>
          <button
            @click="submitSignature"
            :disabled="!hasSignature || processing"
            class="bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white px-8 py-3 rounded-lg font-medium transition-colors"
          >
            <span v-if="processing">Processing...</span>
            <span v-else>Sign & Continue</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  project: Object,
  ndaText: String,
  errors: {
    type: Object,
    default: () => ({})
  }
})

const signaturePad = ref(null)
const isDrawing = ref(false)
const hasSignature = ref(false)
const processing = ref(false)
let ctx = null

onMounted(async () => {
  await nextTick()
  setupCanvas()
  
  // Disable right-click and print
  document.addEventListener('contextmenu', e => e.preventDefault())
  document.addEventListener('keydown', e => {
    if (e.ctrlKey && e.key === 'p') {
      e.preventDefault()
    }
  })
})

const setupCanvas = () => {
  const canvas = signaturePad.value
  if (!canvas) return
  
  ctx = canvas.getContext('2d')
  
  // Set canvas size
  const rect = canvas.getBoundingClientRect()
  canvas.width = rect.width * 2
  canvas.height = rect.height * 2
  ctx.scale(2, 2)
  
  // Set drawing styles
  ctx.strokeStyle = '#1e293b'
  ctx.lineWidth = 2
  ctx.lineCap = 'round'
  ctx.lineJoin = 'round'
}

const getEventPos = (e) => {
  const canvas = signaturePad.value
  const rect = canvas.getBoundingClientRect()
  
  let clientX, clientY
  if (e.touches) {
    clientX = e.touches[0].clientX
    clientY = e.touches[0].clientY
  } else {
    clientX = e.clientX
    clientY = e.clientY
  }
  
  return {
    x: clientX - rect.left,
    y: clientY - rect.top
  }
}

const startSigning = (e) => {
  e.preventDefault()
  isDrawing.value = true
  const pos = getEventPos(e)
  ctx.beginPath()
  ctx.moveTo(pos.x, pos.y)
}

const sign = (e) => {
  if (!isDrawing.value) return
  e.preventDefault()
  
  const pos = getEventPos(e)
  ctx.lineTo(pos.x, pos.y)
  ctx.stroke()
  hasSignature.value = true
}

const stopSigning = (e) => {
  e.preventDefault()
  isDrawing.value = false
}

const clearSignature = () => {
  const canvas = signaturePad.value
  ctx.clearRect(0, 0, canvas.width, canvas.height)
  hasSignature.value = false
}

const submitSignature = () => {
  if (!hasSignature.value) return
  
  processing.value = true
  const canvas = signaturePad.value
  const signatureData = canvas.toDataURL('image/png')
  
  router.post(`/onboarding/${props.project.uuid}/step-one`, {
    signature: signatureData,
    uuid: props.project.uuid
  }, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>

<style scoped>
/* Disable text selection and right-click */
* {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

@media print {
  body {
    display: none !important;
  }
}
</style>