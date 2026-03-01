<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const breadcrumbs = [{ title: 'Financer', href: '/financer' }];
</script>

<template>
    <Head title="Financer Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <h1 class="text-2xl font-bold">Financer Portal</h1>
            <p class="text-slate-600">
                View projects open for financing, upload pledge documents, and
                participate in site visits.
            </p>

            <div class="mt-6">
                <a href="/financer/projects" class="text-emerald-600 underline"
                    >Projects for Financing</a
                >
            </div>
        </div>
    </AppLayout>
</template>
