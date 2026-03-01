<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        Project Management
                    </h1>
                    <p class="text-slate-600">
                        Manage onboarding projects and generate QR codes
                    </p>
                </div>
                <a
                    :href="admin.projects.create.url()"
                    class="rounded-lg bg-emerald-600 px-4 py-2 font-medium text-white transition-colors hover:bg-emerald-700"
                >
                    Create New Project
                </a>
            </div>

            <!-- Projects Table -->
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                Project
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                Type & Capacity
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                Current Step
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                Engagement
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                QR Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                Created
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium tracking-wider text-slate-500 uppercase"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <tr
                            v-for="project in projects.data"
                            :key="project.id"
                            class="hover:bg-slate-50"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div
                                        class="text-sm font-medium text-slate-900"
                                    >
                                        {{ project.name }}
                                    </div>
                                    <div class="text-sm text-slate-500">
                                        {{ project.location }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">
                                    {{
                                        formatProjectType(project.project_type)
                                    }}
                                </div>
                                <div
                                    v-if="project.capacity_mw"
                                    class="text-sm text-slate-500"
                                >
                                    {{ project.capacity_mw }} MW
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                    :class="
                                        getStepBadgeClass(project.current_step)
                                    "
                                >
                                    Step {{ project.current_step }}:
                                    {{ getStepName(project.current_step) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center gap-1"
                                        :title="`${project.interests_count} interests`"
                                    >
                                        <svg
                                            class="h-4 w-4 text-emerald-600"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            ></path>
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-slate-700"
                                            >{{
                                                project.interests_count || 0
                                            }}</span
                                        >
                                    </div>
                                    <div
                                        class="flex items-center gap-1"
                                        :title="`${project.questions_count} questions`"
                                    >
                                        <svg
                                            class="h-4 w-4 text-blue-600"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-slate-700"
                                            >{{
                                                project.questions_count || 0
                                            }}</span
                                        >
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    v-if="isQrExpired(project.qr_expires_at)"
                                    class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800"
                                >
                                    Expired
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800"
                                >
                                    Active
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-slate-500"
                            >
                                {{ formatDate(project.created_at) }}
                            </td>
                            <td
                                class="px-6 py-4 text-right text-sm font-medium whitespace-nowrap"
                            >
                                <a
                                    :href="admin.projects.show.url(project.id)"
                                    class="mr-4 text-emerald-600 hover:text-emerald-900"
                                >
                                    View Details
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div
                    v-if="projects.links"
                    class="border-t border-slate-200 bg-white px-4 py-3 sm:px-6"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a
                                v-if="projects.prev_page_url"
                                :href="projects.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                            >
                                Previous
                            </a>
                            <a
                                v-if="projects.next_page_url"
                                :href="projects.next_page_url"
                                class="relative ml-3 inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                            >
                                Next
                            </a>
                        </div>
                        <div
                            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                        >
                            <div>
                                <p class="text-sm text-slate-700">
                                    Showing {{ projects.from }} to
                                    {{ projects.to }} of
                                    {{ projects.total }} results
                                </p>
                            </div>
                            <div>
                                <nav
                                    class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
                                >
                                    <template
                                        v-for="link in projects.links"
                                        :key="link.label"
                                    >
                                        <a
                                            v-if="link.url"
                                            :href="link.url"
                                            class="relative inline-flex items-center border px-2 py-2 text-sm font-medium"
                                            :class="
                                                link.active
                                                    ? 'z-10 border-emerald-500 bg-emerald-50 text-emerald-600'
                                                    : 'border-slate-300 bg-white text-slate-500 hover:bg-slate-50'
                                            "
                                            v-html="link.label"
                                        >
                                        </a>
                                        <span
                                            v-else
                                            class="relative inline-flex items-center border border-slate-300 bg-white px-2 py-2 text-sm font-medium text-slate-300"
                                            v-html="link.label"
                                        >
                                        </span>
                                    </template>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import admin from '@/routes/admin';

const props = defineProps({
    projects: Object,
});

const breadcrumbs = [
    { title: 'Admin', href: admin.projects.index.url() },
    { title: 'Projects', href: admin.projects.index.url() },
];

const formatProjectType = (type) => {
    const types = {
        SOLAR: 'Solar PV',
        BESS: 'Battery Storage',
        SOLAR_BESS: 'Solar + BESS',
        OTHER: 'Other',
    };
    return types[type] || type;
};

const getStepName = (step) => {
    const names = {
        1: 'Inception Meeting',
        2: 'NDA Signing',
        3: 'RFQ & Documentation',
        4: 'Proposal Development',
        5: 'Contract Negotiation',
        6: 'Project Execution',
        7: 'Project Completion',
    };
    return names[step] || 'Unknown';
};

const getStepBadgeClass = (step) => {
    if (step <= 3) return 'bg-blue-100 text-blue-800';
    if (step <= 5) return 'bg-yellow-100 text-yellow-800';
    return 'bg-green-100 text-green-800';
};

const isQrExpired = (expiresAt) => {
    if (!expiresAt) return true;
    return new Date(expiresAt) < new Date();
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
    });
};
</script>
