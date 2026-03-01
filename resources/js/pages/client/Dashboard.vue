<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const breadcrumbs = [{ title: 'Client', href: '/client' }];
</script>

<template>
    <Head title="Client Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <h1 class="text-2xl font-bold">Client Portal</h1>
            <p class="text-slate-600">
                View your projects, sign documents, and manage appointments.
            </p>

            <div class="mt-6 space-y-3">
                <a href="/client/projects" class="text-emerald-600 underline"
                    >My Projects</a
                >
            </div>
        </div>
    </AppLayout>
</template>
