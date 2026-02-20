<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 space-y-6">
      <!-- Header -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-slate-900">{{ client.name || 'Client' }}</h1>
          <p class="text-slate-600 text-sm">
            {{ client.contact_person }} • {{ client.email }} • {{ client.phone }}
          </p>
        </div>
        <a
          :href="admin.clients.index.url()"
          class="text-sm text-slate-600 hover:text-slate-900"
        >
          ← Back to Manage Clients
        </a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left column: client profile & interests -->
        <div class="space-y-6 lg:col-span-1">
          <!-- Client Profile -->
          <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Client Profile</h2>
            <dl class="space-y-3 text-sm text-slate-700">
              <div>
                <dt class="text-slate-500 text-xs uppercase tracking-widest">Company</dt>
                <dd class="font-medium">{{ client.name || 'N/A' }}</dd>
              </div>
              <div>
                <dt class="text-slate-500 text-xs uppercase tracking-widest">Primary Contact</dt>
                <dd class="font-medium">{{ client.contact_person || 'N/A' }}</dd>
              </div>
              <div>
                <dt class="text-slate-500 text-xs uppercase tracking-widest">Email</dt>
                <dd class="font-medium">{{ client.email || 'N/A' }}</dd>
              </div>
              <div>
                <dt class="text-slate-500 text-xs uppercase tracking-widest">Phone</dt>
                <dd class="font-medium">{{ client.phone || 'N/A' }}</dd>
              </div>
              <div class="grid grid-cols-2 gap-3 pt-2">
                <div>
                  <dt class="text-slate-500 text-xs uppercase tracking-widest">Interests</dt>
                  <dd class="font-semibold">{{ client.interests_count }}</dd>
                </div>
                <div>
                  <dt class="text-slate-500 text-xs uppercase tracking-widest">Projects</dt>
                  <dd class="font-semibold">{{ projects.length }}</dd>
                </div>
              </div>
              <div v-if="client.first_interest_at || client.last_interest_at" class="pt-2 space-y-1">
                <div v-if="client.first_interest_at">
                  <dt class="text-slate-500 text-xs uppercase tracking-widest">First Interest</dt>
                  <dd class="font-medium">
                    {{ formatDateTime(client.first_interest_at) }}
                  </dd>
                </div>
                <div v-if="client.last_interest_at">
                  <dt class="text-slate-500 text-xs uppercase tracking-widest">Most Recent</dt>
                  <dd class="font-medium">
                    {{ formatDateTime(client.last_interest_at) }}
                  </dd>
                </div>
              </div>
            </dl>
          </div>

          <!-- Interest timeline -->
          <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-semibold text-slate-900">Interest History</h2>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                {{ interests.length }} record(s)
              </span>
            </div>

            <div v-if="interests.length === 0" class="text-sm text-slate-500">
              No interest records for this client yet.
            </div>
            <div v-else class="space-y-3 max-h-80 overflow-y-auto pr-1">
              <div
                v-for="interest in interests"
                :key="interest.id"
                class="border border-slate-200 rounded-lg p-3 text-sm hover:border-emerald-300 transition-colors"
              >
                <div class="flex items-center justify-between mb-1">
                  <p class="font-semibold text-slate-900">
                    {{ interest.project_name }}
                  </p>
                  <span class="text-[11px] text-slate-500">
                    {{ formatDateTime(interest.created_at) }}
                  </span>
                </div>
                <p class="text-xs text-slate-500 mb-1">
                  {{ formatInterestType(interest.interest_type) }}
                </p>
                <p v-if="interest.message" class="text-xs text-slate-600 line-clamp-2">
                  {{ interest.message }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right column: projects & schedules -->
        <div class="space-y-6 lg:col-span-2">
          <div class="bg-white rounded-xl shadow p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-4">
              <h2 class="text-lg font-semibold text-slate-900">Projects & Inception Schedules</h2>
              <p class="text-xs text-slate-500">
                Manage inception meeting preferences and schedules per project.
              </p>
            </div>

            <div v-if="projects.length === 0" class="text-sm text-slate-500">
              This client has not been linked to any projects yet.
            </div>

            <div v-else class="space-y-4">
              <div
                v-for="project in projects"
                :key="project.id"
                class="border border-slate-200 rounded-lg p-4 space-y-4 hover:border-emerald-300 transition-colors"
              >
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                  <!-- Project summary -->
                  <div>
                    <div class="flex items-center gap-2 mb-1">
                      <h3 class="text-sm font-semibold text-slate-900">
                        {{ project.name }}
                      </h3>
                      <span
                        v-if="project.project_type"
                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-700"
                      >
                        {{ formatProjectType(project.project_type) }}
                      </span>
                    </div>
                    <p class="text-xs text-slate-500">
                      {{ project.location || 'Location not set' }}
                    </p>
                    <p class="text-xs text-slate-500">
                      Step {{ project.current_step }} • {{ getStepName(project.current_step) }}
                    </p>
                    <a
                      :href="admin.projects.show.url(project.id)"
                      class="mt-2 inline-flex items-center text-xs font-semibold text-emerald-700 hover:text-emerald-800"
                    >
                      View project details
                    </a>
                  </div>

                  <!-- Status pill -->
                  <div class="md:text-right text-xs text-slate-600">
                    <span class="block mb-1 text-slate-400 uppercase tracking-widest text-[10px]">
                      Inception Status
                    </span>
                    <span
                      :class="[
                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium',
                        project.inception_meeting_scheduled_at ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600'
                      ]"
                    >
                      {{ project.inception_meeting_scheduled_at ? 'Scheduled' : 'Not Scheduled' }}
                    </span>
                    <p v-if="project.inception_meeting_scheduled_at" class="mt-1">
                      {{ formatDateTime(project.inception_meeting_scheduled_at) }}
                    </p>
                  </div>
                </div>

                <!-- QR Code Management Section -->
                <div class="border-t border-slate-200 pt-4 mt-4">
                  <h4 class="text-sm font-semibold text-slate-900 mb-3">QR Code Management</h4>
                  
                  <div v-if="getProjectQrUrl(project) && !isProjectQrExpired(project)" class="mb-4">
                    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-3 mb-3">
                      <p class="text-emerald-800 text-xs font-medium mb-1">QR Code Active</p>
                      <p class="text-emerald-700 text-xs">Expires: {{ formatDateTime(project.qr_expires_at) }}</p>
                    </div>
                    
                    <div v-if="qrCodeDataUrls[project.id]" class="mb-3 flex justify-center bg-white p-3 rounded-lg border border-slate-200">
                      <img :src="qrCodeDataUrls[project.id]" alt="Project QR Code" class="w-32 h-32" />
                    </div>

                    <div class="mb-3">
                      <label class="block text-xs font-medium text-slate-700 mb-1">QR Code URL:</label>
                      <div class="bg-slate-50 rounded-lg p-2">
                        <code class="text-[10px] text-slate-700 break-all">{{ getProjectQrUrl(project) }}</code>
                      </div>
                      <button
                        @click="copyToClipboard(getProjectQrUrl(project))"
                        class="mt-1 text-xs text-emerald-600 hover:text-emerald-700"
                      >
                        Copy URL
                      </button>
                    </div>
                  </div>

                  <div v-else class="mb-4">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-3">
                      <p class="text-red-800 text-xs font-medium">QR Code Expired</p>
                      <p class="text-red-700 text-xs">Generate a new QR code to enable client access</p>
                    </div>
                  </div>

                  <form @submit.prevent="generateQr(project.id)" class="space-y-3">
                    <div>
                      <label class="block text-xs font-medium text-slate-700 mb-1">
                        Expiration (hours)
                      </label>
                      <select
                        v-model="qrForms[project.id].hours"
                        class="w-full border border-slate-300 rounded-lg px-2 py-1.5 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                      >
                        <option value="24">24 hours</option>
                        <option value="48">48 hours (recommended)</option>
                        <option value="72">72 hours</option>
                        <option value="168">1 week</option>
                      </select>
                    </div>
                    <button
                      type="submit"
                      :disabled="qrProcessing[project.id]"
                      class="w-full bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors"
                    >
                      <span v-if="qrProcessing[project.id]">Generating...</span>
                      <span v-else>Generate QR Code</span>
                    </button>
                  </form>
                </div>

                <!-- Editable schedule (moved from ProjectDetail.vue) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-slate-100 mt-2 pt-4">
                  <div class="space-y-3">
                    <div>
                      <label class="block text-xs font-medium text-slate-700 mb-1">
                        Meeting Mode
                      </label>
                      <div class="grid grid-cols-2 gap-2">
                        <button
                          type="button"
                          @click="scheduleForms[project.id].inception_meeting_mode = 'online'"
                          :class="[
                            'px-3 py-2 rounded-lg text-xs font-medium border flex items-center justify-center gap-2 transition-colors',
                            scheduleForms[project.id].inception_meeting_mode === 'online'
                              ? 'bg-emerald-50 border-emerald-500 text-emerald-700'
                              : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300'
                          ]"
                        >
                          <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                          <span>Online</span>
                        </button>
                        <button
                          type="button"
                          @click="scheduleForms[project.id].inception_meeting_mode = 'physical'"
                          :class="[
                            'px-3 py-2 rounded-lg text-xs font-medium border flex items-center justify-center gap-2 transition-colors',
                            scheduleForms[project.id].inception_meeting_mode === 'physical'
                              ? 'bg-emerald-50 border-emerald-500 text-emerald-700'
                              : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300'
                          ]"
                        >
                          <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                          <span>Physical</span>
                        </button>
                      </div>
                    </div>

                    <div>
                      <label class="block text-xs font-medium text-slate-700 mb-1">
                        Scheduled Date &amp; Time
                      </label>
                      <input
                        v-model="scheduleForms[project.id].inception_meeting_scheduled_at"
                        type="datetime-local"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                      >
                    </div>
                  </div>

                  <div class="space-y-3">
                    <div v-if="scheduleForms[project.id].inception_meeting_mode === 'physical'">
                      <label class="block text-xs font-medium text-slate-700 mb-1">
                        Physical Location
                      </label>
                      <input
                        v-model="scheduleForms[project.id].inception_meeting_location"
                        type="text"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Boardroom, client office, etc."
                      >
                    </div>

                    <div v-if="scheduleForms[project.id].inception_meeting_mode === 'online'">
                      <label class="block text-xs font-medium text-slate-700 mb-1">
                        Online Meeting Link
                      </label>
                      <input
                        v-model="scheduleForms[project.id].inception_meeting_link"
                        type="text"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Zoom, Teams, Google Meet..."
                      >
                    </div>

                    <div>
                      <label class="block text-xs font-medium text-slate-700 mb-1">
                        Internal Notes (optional)
                      </label>
                      <textarea
                        v-model="scheduleForms[project.id].inception_meeting_notes"
                        rows="3"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 resize-none"
                        placeholder="Agenda, key attendees, prep requirements..."
                      ></textarea>
                    </div>

                    <div class="flex justify-end">
                      <button
                        type="button"
                        :disabled="scheduleProcessing[project.id]"
                        @click="updateSchedule(project.id)"
                        class="inline-flex items-center px-4 py-2 rounded-lg text-xs font-semibold bg-emerald-600 text-white hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed transition-colors"
                      >
                        <span v-if="scheduleProcessing[project.id]">Saving...</span>
                        <span v-else>Save Schedule</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { reactive, ref, onMounted, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import admin from '@/routes/admin'
import QRCode from 'qrcode'

interface Project {
  id: number
  uuid: string
  name: string
  project_type: string | null
  location: string | null
  current_step: number
  qr_expires_at?: string | null
  inception_meeting_mode?: 'online' | 'physical' | null
  inception_meeting_scheduled_at?: string | null
  inception_meeting_location?: string | null
  inception_meeting_link?: string | null
  inception_meeting_notes?: string | null
}

interface Client {
  id: number
  name: string | null
  contact_person: string | null
  email: string | null
  phone: string | null
  interests_count: number
  first_interest_at?: string | null
  last_interest_at?: string | null
}

interface Interest {
  id: number
  project_name: string
  company_name: string
  contact_person: string
  email: string
  phone: string
  interest_type: string
  message?: string | null
  created_at: string
}

const props = defineProps<{
  client: Client
  projects: Project[]
  interests: Interest[]
  qr_urls: Record<number, string>
}>()

const client = props.client
const projects = props.projects
const interests = props.interests

const breadcrumbs = [
  { title: 'Admin', href: admin.projects.index.url() },
  { title: 'Manage Clients', href: admin.clients.index.url() },
  { title: client.name || 'Client', href: '#' }
]

const scheduleForms = reactive<Record<number, {
  inception_meeting_mode: 'online' | 'physical' | null
  inception_meeting_scheduled_at: string
  inception_meeting_location: string
  inception_meeting_link: string
  inception_meeting_notes: string
}>>({})

const scheduleProcessing = reactive<Record<number, boolean>>({})

const qrForms = reactive<Record<number, { hours: number }>>({})
const qrProcessing = reactive<Record<number, boolean>>({})
const qrCodeDataUrls = reactive<Record<number, string>>({})

projects.forEach((project) => {
  scheduleForms[project.id] = {
    inception_meeting_mode: (project.inception_meeting_mode as 'online' | 'physical' | null) || null,
    inception_meeting_scheduled_at: project.inception_meeting_scheduled_at
      ? new Date(project.inception_meeting_scheduled_at).toISOString().slice(0, 16)
      : '',
    inception_meeting_location: project.inception_meeting_location || '',
    inception_meeting_link: project.inception_meeting_link || '',
    inception_meeting_notes: project.inception_meeting_notes || ''
  }
  scheduleProcessing[project.id] = false
  
  qrForms[project.id] = { hours: 48 }
  qrProcessing[project.id] = false
})

const formatProjectType = (type: string | null) => {
  if (!type) return 'Project'
  const map: Record<string, string> = {
    SOLAR: 'Solar PV',
    BESS: 'Battery Storage',
    SOLAR_BESS: 'Solar + BESS',
    OTHER: 'Renewable Energy'
  }
  return map[type] || type
}

const getStepName = (step: number) => {
  const names: Record<number, string> = {
    1: 'Inception Meeting',
    2: 'NDA Signing',
    3: 'RFQ & Documentation',
    4: 'Proposal Development',
    5: 'Contract Negotiation',
    6: 'Project Execution',
    7: 'Project Completion'
  }
  return names[step] || 'Unknown'
}

const formatDateTime = (dateString?: string | null) => {
  if (!dateString) return ''
  return new Date(dateString).toLocaleString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const formatInterestType = (type: string) => {
  const map: Record<string, string> = {
    general: 'General Interest',
    investor: 'Investment Opportunity',
    partner: 'Partnership Inquiry',
    other: 'Other'
  }
  return map[type] || type
}

const updateSchedule = (projectId: number) => {
  const form = scheduleForms[projectId]
  if (!form) return

  scheduleProcessing[projectId] = true

  router.post(`/admin/projects/${projectId}/schedule-inception`, form, {
    onFinish: () => {
      scheduleProcessing[projectId] = false
    }
  })
}

const getProjectQrUrl = (project: Project) => {
  return props.qr_urls[project.id] || null
}

const isProjectQrExpired = (project: Project) => {
  if (!project.qr_expires_at) return true
  return new Date(project.qr_expires_at) < new Date()
}

const copyToClipboard = async (text: string) => {
  try {
    await navigator.clipboard.writeText(text)
  } catch (err) {
    console.error('Failed to copy: ', err)
  }
}

const generateQr = (projectId: number) => {
  qrProcessing[projectId] = true
  
  router.post(`/admin/projects/${projectId}/generate-qr`, qrForms[projectId], {
    onFinish: () => {
      qrProcessing[projectId] = false
    }
  })
}

const generateQrCodeImage = async (projectId: number) => {
  const qrUrl = getProjectQrUrl(projects.find(p => p.id === projectId)!)
  if (qrUrl && !isProjectQrExpired(projects.find(p => p.id === projectId)!)) {
    try {
      qrCodeDataUrls[projectId] = await QRCode.toDataURL(qrUrl, {
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
    qrCodeDataUrls[projectId] = ''
  }
}

onMounted(() => {
  projects.forEach(project => {
    generateQrCodeImage(project.id)
  })
})

watch(() => props.qr_urls, () => {
  projects.forEach(project => {
    generateQrCodeImage(project.id)
  })
}, { deep: true })
</script>

