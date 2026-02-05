<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Create New Project</h1>
        <p class="text-slate-600">Set up a new project for client onboarding</p>
      </div>

      <div class="max-w-2xl">
        <form @submit.prevent="submit" class="bg-white rounded-lg shadow p-6">
          <div class="space-y-6">
            <!-- Project Name -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Project Name *
              </label>
              <input
                v-model="form.name"
                type="text"
                required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="e.g., Kimuka 2 Solar Project"
              >
              <div v-if="errors.name" class="text-red-600 text-sm mt-1">{{ errors.name }}</div>
            </div>

            <!-- Project Type -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Project Type *
              </label>
              <select
                v-model="form.project_type"
                required
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              >
                <option value="">Select project type</option>
                <option value="SOLAR">Solar PV</option>
                <option value="BESS">Battery Energy Storage System</option>
                <option value="SOLAR_BESS">Solar PV + Battery Storage</option>
                <option value="OTHER">Other Renewable Energy</option>
              </select>
              <div v-if="errors.project_type" class="text-red-600 text-sm mt-1">{{ errors.project_type }}</div>
            </div>

            <!-- Capacity -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Capacity (MW)
              </label>
              <input
                v-model="form.capacity_mw"
                type="number"
                step="0.01"
                min="0"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="e.g., 40.00"
              >
              <div v-if="errors.capacity_mw" class="text-red-600 text-sm mt-1">{{ errors.capacity_mw }}</div>
            </div>

            <!-- Location -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Location
              </label>
              <input
                v-model="form.location"
                type="text"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="e.g., Kimuka, Kenya"
              >
              <div v-if="errors.location" class="text-red-600 text-sm mt-1">{{ errors.location }}</div>
            </div>

            <!-- Description -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Project Description
              </label>
              <textarea
                v-model="form.description"
                rows="4"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="Describe the project objectives, scope, and key features..."
              ></textarea>
              <div v-if="errors.description" class="text-red-600 text-sm mt-1">{{ errors.description }}</div>
            </div>
          </div>

          <!-- Actions -->
          <div class="flex justify-between mt-8">
            <a
              :href="admin.projects.index.url()"
              class="text-slate-600 hover:text-slate-800 px-6 py-2 rounded-lg font-medium transition-colors"
            >
              Cancel
            </a>
            <button
              type="submit"
              :disabled="processing"
              class="bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white px-6 py-2 rounded-lg font-medium transition-colors"
            >
              <span v-if="processing">Creating...</span>
              <span v-else>Create Project</span>
            </button>
          </div>
        </form>
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
  errors: {
    type: Object,
    default: () => ({})
  }
})

const breadcrumbs = [
  { title: 'Admin', href: admin.projects.index.url() },
  { title: 'Projects', href: admin.projects.index.url() },
  { title: 'Create', href: admin.projects.create.url() }
]

const processing = ref(false)

const form = reactive({
  name: '',
  project_type: '',
  capacity_mw: '',
  location: '',
  description: ''
})

const submit = () => {
  processing.value = true
  
  router.post(admin.projects.store.url(), form, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>