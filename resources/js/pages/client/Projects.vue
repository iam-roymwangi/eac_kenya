<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

interface Project {
  id: number;
  name: string;
  current_step: string;
}

const props = defineProps({
  projects: { type: Array as PropType<Project[]>, default: () => [] },
});

import { PropType } from 'vue';
</script>

<template>
  <Head title="My Projects" />
  <AppLayout>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">My Projects</h1>

      <div v-if="projects.length === 0" class="text-slate-600">No projects found for your company.</div>

      <ul class="space-y-3">
        <li v-for="p in projects" :key="p.id" class="bg-white p-4 rounded shadow">
          <div class="flex items-center justify-between">
            <div>
              <div class="font-medium text-slate-900">{{ p.name }}</div>
              <div class="text-sm text-slate-500">Step: {{ p.current_step }}</div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </AppLayout>
</template>
