<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-6">
            <!-- Header -->
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        Manage Clients
                    </h1>
                    <p class="text-sm text-slate-600">
                        View client profiles, their onboarded projects, and
                        inception meeting schedules in one place.
                    </p>
                </div>
            </div>

            <!-- Clients List -->
            <div class="space-y-6">
                <div
                    v-for="client in clients"
                    :key="client.id"
                    class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm"
                >
                    <div
                        class="flex flex-col gap-3 border-b border-slate-200 px-6 py-4 md:flex-row md:items-center md:justify-between"
                    >
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">
                                <a
                                    :href="`/admin/clients/${client.id}`"
                                    class="transition-colors hover:text-emerald-700 hover:underline"
                                >
                                    {{ client.name || 'Unnamed Client' }}
                                </a>
                            </h2>
                            <p
                                class="mt-1 text-xs tracking-widest text-slate-400 uppercase"
                            >
                                {{ client.company_type || 'Client Company' }}
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            <span
                                v-if="client.registration_number"
                                class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-slate-700"
                            >
                                Reg: {{ client.registration_number }}
                            </span>
                            <span
                                v-if="client.country"
                                class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-emerald-700"
                            >
                                {{ client.country }}
                            </span>
                            <span
                                class="inline-flex items-center rounded-full bg-slate-900 px-3 py-1 text-white"
                            >
                                {{ client.projects?.length || 0 }} project(s)
                            </span>
                            <a
                                :href="`/admin/clients/${client.id}`"
                                class="inline-flex items-center rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 transition-colors hover:bg-emerald-100"
                            >
                                View client
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div
                            v-if="
                                !client.projects || client.projects.length === 0
                            "
                            class="text-sm text-slate-500"
                        >
                            No projects have been linked to this client yet.
                        </div>

                        <div v-else class="space-y-4">
                            <div
                                v-for="project in client.projects"
                                :key="project.id"
                                class="flex flex-col gap-4 rounded-lg border border-slate-200 p-4 transition-colors hover:border-emerald-300 lg:flex-row lg:items-start lg:justify-between"
                            >
                                <!-- Project summary -->
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <h3
                                            class="text-sm font-semibold text-slate-900"
                                        >
                                            {{ project.name }}
                                        </h3>
                                        <span
                                            v-if="project.project_type"
                                            class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-700"
                                        >
                                            {{
                                                formatProjectType(
                                                    project.project_type,
                                                )
                                            }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        {{
                                            project.location ||
                                            'Location not set'
                                        }}
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        Step {{ project.current_step }} •
                                        {{ getStepName(project.current_step) }}
                                    </p>
                                </div>

                                <!-- Schedule summary -->
                                <div
                                    class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:w-1/2"
                                >
                                    <div
                                        class="rounded-lg bg-slate-50 p-3 text-xs text-slate-700"
                                    >
                                        <p
                                            class="mb-1 font-semibold text-slate-900"
                                        >
                                            Inception Meeting
                                        </p>
                                        <p class="mb-1 flex items-center gap-2">
                                            <span
                                                class="text-[10px] tracking-widest text-slate-400 uppercase"
                                                >STATUS</span
                                            >
                                            <span
                                                :class="[
                                                    'inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-medium',
                                                    project.inception_meeting_scheduled_at
                                                        ? 'bg-emerald-100 text-emerald-800'
                                                        : 'bg-slate-100 text-slate-600',
                                                ]"
                                            >
                                                {{
                                                    project.inception_meeting_scheduled_at
                                                        ? 'Scheduled'
                                                        : 'Not Scheduled'
                                                }}
                                            </span>
                                        </p>
                                        <p
                                            class="flex items-center gap-2"
                                            v-if="
                                                project.inception_meeting_mode
                                            "
                                        >
                                            <span
                                                class="text-[10px] tracking-widest text-slate-400 uppercase"
                                                >MODE</span
                                            >
                                            <span
                                                class="font-medium capitalize"
                                            >
                                                {{
                                                    project.inception_meeting_mode
                                                }}
                                            </span>
                                        </p>
                                        <p
                                            class="flex items-center gap-2"
                                            v-if="
                                                project.inception_meeting_scheduled_at
                                            "
                                        >
                                            <span
                                                class="text-[10px] tracking-widest text-slate-400 uppercase"
                                                >WHEN</span
                                            >
                                            <span class="font-medium">
                                                {{
                                                    formatDateTime(
                                                        project.inception_meeting_scheduled_at,
                                                    )
                                                }}
                                            </span>
                                        </p>
                                    </div>

                                    <div
                                        class="space-y-1 rounded-lg bg-slate-50 p-3 text-xs text-slate-700"
                                    >
                                        <p
                                            class="mb-1 font-semibold text-slate-900"
                                        >
                                            Meeting Details
                                        </p>
                                        <p
                                            v-if="
                                                project.inception_meeting_location
                                            "
                                        >
                                            <span
                                                class="mr-1 text-[10px] tracking-widest text-slate-400 uppercase"
                                                >LOCATION</span
                                            >
                                            <span class="font-medium">{{
                                                project.inception_meeting_location
                                            }}</span>
                                        </p>
                                        <p
                                            v-if="
                                                project.inception_meeting_link
                                            "
                                            class="truncate"
                                        >
                                            <span
                                                class="mr-1 text-[10px] tracking-widest text-slate-400 uppercase"
                                                >LINK</span
                                            >
                                            <a
                                                :href="
                                                    project.inception_meeting_link
                                                "
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="font-medium text-emerald-700 hover:underline"
                                            >
                                                {{
                                                    project.inception_meeting_link
                                                }}
                                            </a>
                                        </p>
                                        <p
                                            v-if="
                                                project.inception_meeting_notes
                                            "
                                            class="mt-1 text-[11px] text-slate-600"
                                        >
                                            {{
                                                project.inception_meeting_notes
                                            }}
                                        </p>
                                        <p
                                            v-if="
                                                !project.inception_meeting_location &&
                                                !project.inception_meeting_link &&
                                                !project.inception_meeting_notes
                                            "
                                            class="text-[11px] text-slate-500"
                                        >
                                            No additional details recorded yet.
                                        </p>
                                        <div class="pt-2">
                                            <a
                                                :href="
                                                    admin.projects.show.url(
                                                        project.id,
                                                    )
                                                "
                                                class="inline-flex items-center rounded-full bg-slate-900 px-3 py-1.5 text-[11px] font-semibold text-white transition-colors hover:bg-emerald-600"
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
import AppLayout from '@/layouts/AppLayout.vue';
import admin from '@/routes/admin';

interface Project {
    id: number;
    name: string;
    project_type: string | null;
    location: string | null;
    current_step: number;
    inception_meeting_mode?: 'online' | 'physical' | null;
    inception_meeting_scheduled_at?: string | null;
    inception_meeting_location?: string | null;
    inception_meeting_link?: string | null;
    inception_meeting_notes?: string | null;
}

interface Client {
    id: number;
    name: string | null;
    company_type: string | null;
    registration_number: string | null;
    country: string | null;
    projects?: Project[];
}

const props = defineProps<{
    clients: Client[];
}>();

const breadcrumbs = [
    { title: 'Admin', href: admin.projects.index.url() },
    { title: 'Manage Clients', href: '/admin/clients' },
];

const formatProjectType = (type: string | null) => {
    if (!type) return 'Project';
    const map: Record<string, string> = {
        SOLAR: 'Solar PV',
        BESS: 'Battery Storage',
        SOLAR_BESS: 'Solar + BESS',
        OTHER: 'Renewable Energy',
    };
    return map[type] || type;
};

const getStepName = (step: number) => {
    const names: Record<number, string> = {
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

const formatDateTime = (dateString?: string | null) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};
</script>
