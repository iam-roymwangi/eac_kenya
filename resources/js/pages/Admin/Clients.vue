<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 space-y-6">
      <!-- Header -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-slate-900">Manage Clients</h1>
          <p class="text-slate-600 text-sm">
            View client profiles, their onboarded projects, and inception meeting schedules in one place.
          </p>
        </div>
      </div>

      <!-- Clients List -->
      <div class="space-y-6">
        <div
          v-for="client in clients"
          :key="client.id"
          class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden"
        >
          <div class="px-6 py-4 border-b border-slate-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
              <h2 class="text-lg font-semibold text-slate-900">
                <a
                  :href="`/admin/clients/${client.id}`"
                  class="hover:underline hover:text-emerald-700 transition-colors"
                >
                  {{ client.name || 'Unnamed Client' }}
                </a>
              </h2>
              <p class="text-xs uppercase tracking-widest text-slate-400 mt-1">
                {{ client.company_type || 'Client Company' }}
              </p>
            </div>
            <div class="flex flex-wrap items-center gap-3 text-sm">
              <span v-if="client.registration_number" class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-700">
                Reg: {{ client.registration_number }}
              </span>
              <span v-if="client.country" class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700">
                {{ client.country }}
              </span>
              <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-900 text-white">
                {{ client.projects?.length || 0 }} project(s)
              </span>
              <a
                :href="`/admin/clients/${client.id}`"
                class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold hover:bg-emerald-100 transition-colors"
              >
                View client
              </a>
            </div>
          </div>

          <div class="p-6">
            <div v-if="!client.projects || client.projects.length === 0" class="text-sm text-slate-500">
              No projects have been linked to this client yet.
            </div>

            <div v-else class="space-y-4">
              <div
                v-for="project in client.projects"
                :key="project.id"
                class="border border-slate-200 rounded-lg p-4 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 hover:border-emerald-300 transition-colors"
              >
                <!-- Project summary -->
                <div class="space-y-1">
                  <div class="flex items-center gap-2">
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
                </div>

                <!-- Schedule summary -->
                <div class="w-full lg:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div class="bg-slate-50 rounded-lg p-3 text-xs text-slate-700">
                    <p class="font-semibold text-slate-900 mb-1">Inception Meeting</p>
                    <p class="flex items-center gap-2 mb-1">
                      <span class="text-slate-400 uppercase tracking-widest text-[10px]">STATUS</span>
                      <span
                        :class="[
                          'inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium',
                          project.inception_meeting_scheduled_at ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600'
                        ]"
                      >
                        {{ project.inception_meeting_scheduled_at ? 'Scheduled' : 'Not Scheduled' }}
                      </span>
                    </p>
                    <p class="flex items-center gap-2" v-if="project.inception_meeting_mode">
                      <span class="text-slate-400 uppercase tracking-widest text-[10px]">MODE</span>
                      <span class="font-medium capitalize">
                        {{ project.inception_meeting_mode }}
                      </span>
                    </p>
                    <p class="flex items-center gap-2" v-if="project.inception_meeting_scheduled_at">
                      <span class="text-slate-400 uppercase tracking-widest text-[10px]">WHEN</span>
                      <span class="font-medium">
                        {{ formatDateTime(project.inception_meeting_scheduled_at) }}
                      </span>
                    </p>
                  </div>

                  <div class="bg-slate-50 rounded-lg p-3 text-xs text-slate-700 space-y-1">
                    <p class="font-semibold text-slate-900 mb-1">Meeting Details</p>
                    <p v-if="project.inception_meeting_location">
                      <span class="text-slate-400 uppercase tracking-widest text-[10px] mr-1">LOCATION</span>
                      <span class="font-medium">{{ project.inception_meeting_location }}</span>
                    </p>
                    <p v-if="project.inception_meeting_link" class="truncate">
                      <span class="text-slate-400 uppercase tracking-widest text-[10px] mr-1">LINK</span>
                      <a
                        :href="project.inception_meeting_link"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="font-medium text-emerald-700 hover:underline"
                      >
                        {{ project.inception_meeting_link }}
                      </a>
                    </p>
                    <p v-if="project.inception_meeting_notes" class="text-[11px] text-slate-600 mt-1">
                      {{ project.inception_meeting_notes }}
                    </p>
                    <p v-if="!project.inception_meeting_location && !project.inception_meeting_link && !project.inception_meeting_notes" class="text-[11px] text-slate-500">
                      No additional details recorded yet.
                    </p>
                    <div class="pt-2">
                      <a
                        :href="admin.projects.show.url(project.id)"
                        class="inline-flex items-center px-3 py-1.5 rounded-full text-[11px] font-semibold bg-slate-900 text-white hover:bg-emerald-600 transition-colors"
                      >
                        View project &amp; edit schedule
                      </a>
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
import AppLayout from '@/layouts/AppLayout.vue'
import admin from '@/routes/admin'

interface Project {
  id: number
  name: string
  project_type: string | null
  location: string | null
  current_step: number
  inception_meeting_mode?: 'online' | 'physical' | null
  inception_meeting_scheduled_at?: string | null
  inception_meeting_location?: string | null
  inception_meeting_link?: string | null
  inception_meeting_notes?: string | null
}

interface Client {
  id: number
  name: string | null
  company_type: string | null
  registration_number: string | null
  country: string | null
  projects?: Project[]
}

const props = defineProps<{
  clients: Client[]
}>()

const breadcrumbs = [
  { title: 'Admin', href: admin.projects.index.url() },
  { title: 'Manage Clients', href: '/admin/clients' }
]

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
</script>

