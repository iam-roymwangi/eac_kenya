<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import admin from '@/routes/admin';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">EAC Green Group Admin Dashboard</h1>
                <p class="text-slate-600">Manage renewable energy project onboarding and client workflows</p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-slate-900">3</p>
                            <p class="text-slate-600">Active Projects</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-slate-900">0</p>
                            <p class="text-slate-600">Pending NDAs</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-slate-900">0</p>
                            <p class="text-slate-600">RFQ Submissions</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a
                            :href="admin.projects.create.url()"
                            class="flex items-center p-3 rounded-lg border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 transition-colors"
                        >
                            <div class="p-2 rounded-lg bg-emerald-100 text-emerald-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Create New Project</p>
                                <p class="text-sm text-slate-600">Set up a new renewable energy project</p>
                            </div>
                        </a>

                        <a
                            :href="admin.projects.index.url()"
                            class="flex items-center p-3 rounded-lg border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition-colors"
                        >
                            <div class="p-2 rounded-lg bg-blue-100 text-blue-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Manage Projects</p>
                                <p class="text-sm text-slate-600">View and manage existing projects</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Onboarding Process</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white text-sm font-medium mr-3 mt-0.5">1</div>
                            <div>
                                <p class="font-medium text-slate-900">NDA Signing</p>
                                <p class="text-sm text-slate-600">Client scans QR code and signs digital NDA</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white text-sm font-medium mr-3 mt-0.5">2</div>
                            <div>
                                <p class="font-medium text-slate-900">Inception Meeting</p>
                                <p class="text-sm text-slate-600">Project overview and stakeholder alignment</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white text-sm font-medium mr-3 mt-0.5">3</div>
                            <div>
                                <p class="font-medium text-slate-900">RFQ & Documentation</p>
                                <p class="text-sm text-slate-600">Technical drawings and requirements collection</p>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-slate-200">
                            <p class="text-sm text-slate-500">Steps 4-7 continue with proposal development, contract negotiation, execution, and completion.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
