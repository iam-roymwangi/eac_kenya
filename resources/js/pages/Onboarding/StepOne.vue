<template>
  <div class="min-h-screen bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">EAC Green Group</h1>
        <h2 class="text-xl text-slate-600 mb-4">Client Onboarding - Step 1: NDA Signing</h2>
        <div class="text-sm text-slate-500">
          Project: {{ project?.name || 'Loading...' }}
        </div>
      </div>

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
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Non-Disclosure Agreement Template</h3>
          <p class="text-sm text-slate-600 mb-4">
            Please review the NDA template below. You can scroll through the document directly.
          </p>

          <div class="border border-slate-300 rounded-lg overflow-hidden mb-4 relative">

            <div class="absolute top-0 left-0 right-0 h-[50px] z-10 bg-transparent" @contextmenu.prevent></div>

            <div class="absolute top-0 right-0 bottom-0 w-[60px] z-10 bg-transparent" @contextmenu.prevent></div>

            <iframe :src="`/documents/NDA_EACGreenGroupLtd_template.pdf#toolbar=0&navpanes=0&scrollbar=1&view=FitH`"
              class="w-full h-[600px] z-0" style="border: none;"></iframe>
          </div>

          <p class="text-xs text-slate-500 italic">
            Note: If you cannot see the document, please ensure your browser's PDF viewer is enabled.
          </p>
        </div>

        <div class="mb-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Your Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Full Name *</label>
              <input v-model="form.full_name" type="text" required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none"
                placeholder="John Doe">
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Company/Organization *</label>
              <input v-model="form.company" type="text" required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none"
                placeholder="Company Ltd">
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Position/Title *</label>
              <input v-model="form.position" type="text" required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none"
                placeholder="CEO">
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Email Address *</label>
              <input v-model="form.email" type="email" required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none"
                placeholder="john@company.com">
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number *</label>
              <input v-model="form.phone" type="tel" required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none"
                placeholder="+254 700 000 000">
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Date</label>
              <input :value="currentDate" type="text" readonly
                class="w-full border border-slate-300 rounded-lg px-3 py-2 bg-slate-50 text-slate-500">
            </div>
          </div>
        </div>

        <div class="mb-8">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Digital Signature</h3>
          <div class="border-2 border-dashed border-slate-300 rounded-lg p-4 bg-slate-50">
            <canvas ref="signaturePad"
              class="w-full h-32 bg-white border border-slate-200 rounded cursor-crosshair touch-none"
              @mousedown="startSigning" @mousemove="sign" @mouseup="stopSigning" @mouseleave="stopSigning"
              @touchstart="startSigning" @touchmove="sign" @touchend="stopSigning"></canvas>
            <div class="flex justify-between items-center mt-3">
              <p class="text-xs text-slate-500">Draw your signature in the box above</p>
              <button @click="clearSignature" type="button" class="text-sm text-red-500 hover:text-red-700 font-medium">
                Clear Signature
              </button>
            </div>
          </div>
        </div>

        <div class="mb-8 p-6 bg-slate-100 rounded-lg border border-slate-200 select-none" @contextmenu.prevent>
          <h3 class="text-sm font-bold text-slate-800 uppercase mb-4 text-center">Preview of Generated Document</h3>
          <div class="bg-white p-8 shadow-sm text-[12px] leading-relaxed text-slate-700">
            <p class="mb-4">This Agreement is made on <strong>{{ currentDate }}</strong> between <strong>EAC Green Group
                Ltd</strong> and <strong>{{ form.full_name || '____' }}</strong>.</p>
            <p class="mb-4">The Receiving Party acknowledges that they will receive Confidential Information regarding
              <strong>{{ project?.name }}</strong> and agrees to maintain strict confidentiality.
            </p>

            <div class="mt-8 grid grid-cols-2 gap-8">
              <div>
                <p class="font-bold border-b border-slate-200 mb-2">Client Signature</p>
                <div class="h-12 flex items-center">
                  <img v-if="signatureDataUrl" :src="signatureDataUrl" class="max-h-full" />
                  <span v-else class="text-slate-300 italic">Pending signature...</span>
                </div>
                <p class="mt-2 text-[10px]">{{ form.full_name }}</p>
              </div>
              <div>
                <p class="font-bold border-b border-slate-200 mb-2">Company Signature</p>
                <div class="h-12 flex items-center">
                  <span class="text-slate-300 italic text-[10px]">Counter-signed on receipt</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-if="errors.signature" class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded border border-red-200">
          {{ errors.signature }}
        </div>

        <div class="flex justify-end pt-6 border-t border-slate-100">
          <button @click="submitSignature" :disabled="!hasSignature || processing || !form.full_name"
            class="bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white px-10 py-3 rounded-lg font-bold shadow-md transition-all transform active:scale-95">
            {{ processing ? 'Processing...' : 'Agree & Continue' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  project: Object,
  errors: Object
})

const signaturePad = ref(null)
const isDrawing = ref(false)
const hasSignature = ref(false)
const processing = ref(false)
const signatureDataUrl = ref(null)
let ctx = null

const form = ref({
  full_name: '',
  company: '',
  position: '',
  email: '',
  phone: ''
})

const currentDate = computed(() => {
  return new Date().toLocaleDateString('en-US', {
    year: 'numeric', month: 'long', day: 'numeric'
  })
})

onMounted(async () => {
  await nextTick()
  setupCanvas()
})

const setupCanvas = () => {
  const canvas = signaturePad.value
  if (!canvas) return

  ctx = canvas.getContext('2d')
  const rect = canvas.getBoundingClientRect()

  // Handle High DPI displays
  const dpr = window.devicePixelRatio || 1
  canvas.width = rect.width * dpr
  canvas.height = rect.height * dpr
  ctx.scale(dpr, dpr)

  ctx.strokeStyle = '#0f172a'
  ctx.lineWidth = 2
  ctx.lineCap = 'round'
  ctx.lineJoin = 'round'
}

const getEventPos = (e) => {
  const rect = signaturePad.value.getBoundingClientRect()
  const clientX = e.touches ? e.touches[0].clientX : e.clientX
  const clientY = e.touches ? e.touches[0].clientY : e.clientY
  return { x: clientX - rect.left, y: clientY - rect.top }
}

const startSigning = (e) => {
  isDrawing.value = true
  const pos = getEventPos(e)
  ctx.beginPath()
  ctx.moveTo(pos.x, pos.y)
}

const sign = (e) => {
  if (!isDrawing.value) return
  const pos = getEventPos(e)
  ctx.lineTo(pos.x, pos.y)
  ctx.stroke()
  hasSignature.value = true
  signatureDataUrl.value = signaturePad.value.toDataURL()
}

const stopSigning = () => {
  isDrawing.value = false
}

const clearSignature = () => {
  ctx.clearRect(0, 0, signaturePad.value.width, signaturePad.value.height)
  hasSignature.value = false
  signatureDataUrl.value = null
}

const submitSignature = () => {
  if (!hasSignature.value) return
  processing.value = true

  router.post(`/onboarding/${props.project.uuid}/step-one`, {
    ...form.value,
    signature: signatureDataUrl.value,
    date: new Date().toISOString().split('T')[0]
  }, {
    onFinish: () => processing.value = false
  })
}
</script>

<style scoped>
/* Specific protections instead of global ones */
.select-none {
  user-select: none;
  -webkit-user-select: none;
}

/* Hide specific elements during print instead of blocking the whole page */
@media print {
  .no-print {
    display: none;
  }

  iframe {
    display: none;
  }
}
</style>