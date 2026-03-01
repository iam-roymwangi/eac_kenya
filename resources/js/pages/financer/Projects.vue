<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    projects: { type: Array, default: () => [] },
});
</script>

<template>
    <Head title="Projects for Financing" />
    <AppLayout>
        <div class="p-6">
            <h1 class="mb-4 text-2xl font-bold">
                Projects Announced for Financing
            </h1>

            <div v-if="projects.length === 0" class="text-slate-600">
                No projects available for financing at the moment.
            </div>

            <ul class="space-y-3">
                <li
                    v-for="p in projects"
                    :key="p.id"
                    class="rounded bg-white p-4 shadow"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium text-slate-900">
                                {{ p.name }}
                            </div>
                            <div class="text-sm text-slate-500">
                                Step: {{ p.current_step }}
                            </div>
                        </div>
                        <div>
                            <a
                                :href="`/projects/${p.id}`"
                                class="text-blue-600 underline"
                                >Details</a
                            >
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
