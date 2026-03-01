<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-6">
            <!-- Header -->
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        {{ client.name || 'Client' }}
                    </h1>
                    <p class="text-sm text-slate-600">
                        {{ client.contact_person }} • {{ client.email }} •
                        {{ client.phone }}
                    </p>
                </div>
                <div class="flex flex-col items-end gap-3 md:flex-row md:items-center">
                    <button
                        v-if="!client.is_registered"
                        @click="quickRegister"
                        :disabled="isRegistering"
                        class="text-sm font-medium px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition-colors flex items-center gap-2 disabled:bg-slate-300 disabled:cursor-not-allowed"
                    >
                        <svg v-if="isRegistering" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <Users v-else class="w-4 h-4" />
                        {{ isRegistering ? 'Registering...' : 'Register Client' }}
                    </button>
                    <span
                        v-else
                        class="text-xs font-semibold px-3 py-1.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200"
                    >
                        ✓ Registered
                    </span>
                    <a
                        :href="admin.clients.index.url()"
                        class="text-sm text-slate-600 hover:text-slate-900"
                    >
                        ← Back to Manage Clients
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Left column: client profile & interests -->
                <div class="space-y-6 lg:col-span-1">
                    <!-- Client Profile -->
                    <div class="rounded-xl bg-white p-6 shadow">
                        <h2 class="mb-4 text-lg font-semibold text-slate-900">
                            Client Profile
                        </h2>
                        <dl class="space-y-3 text-sm text-slate-700">
                            <div>
                                <dt
                                    class="text-xs tracking-widest text-slate-500 uppercase"
                                >
                                    Company
                                </dt>
                                <dd class="font-medium">
                                    {{ client.name || 'N/A' }}
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs tracking-widest text-slate-500 uppercase"
                                >
                                    Primary Contact
                                </dt>
                                <dd class="font-medium">
                                    {{ client.contact_person || 'N/A' }}
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs tracking-widest text-slate-500 uppercase"
                                >
                                    Email
                                </dt>
                                <dd class="font-medium">
                                    {{ client.email || 'N/A' }}
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs tracking-widest text-slate-500 uppercase"
                                >
                                    Phone
                                </dt>
                                <dd class="font-medium">
                                    {{ client.phone || 'N/A' }}
                                </dd>
                            </div>
                            <div class="grid grid-cols-2 gap-3 pt-2">
                                <div>
                                    <dt
                                        class="text-xs tracking-widest text-slate-500 uppercase"
                                    >
                                        Interests
                                    </dt>
                                    <dd class="font-semibold">
                                        {{ client.interests_count }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-xs tracking-widest text-slate-500 uppercase"
                                    >
                                        Projects
                                    </dt>
                                    <dd class="font-semibold">
                                        {{ projects.length }}
                                    </dd>
                                </div>
                            </div>
                            <div
                                v-if="
                                    client.first_interest_at ||
                                    client.last_interest_at
                                "
                                class="space-y-1 pt-2"
                            >
                                <div v-if="client.first_interest_at">
                                    <dt
                                        class="text-xs tracking-widest text-slate-500 uppercase"
                                    >
                                        First Interest
                                    </dt>
                                    <dd class="font-medium">
                                        {{
                                            formatDateTime(
                                                client.first_interest_at,
                                            )
                                        }}
                                    </dd>
                                </div>
                                <div v-if="client.last_interest_at">
                                    <dt
                                        class="text-xs tracking-widest text-slate-500 uppercase"
                                    >
                                        Most Recent
                                    </dt>
                                    <dd class="font-medium">
                                        {{
                                            formatDateTime(
                                                client.last_interest_at,
                                            )
                                        }}
                                    </dd>
                                </div>
                            </div>
                        </dl>

                        <!-- Request Company Profile Button -->
                        <div class="mt-6 border-t border-slate-200 pt-6">
                            <button
                                @click="requestCompanyProfile"
                                :disabled="isRequestingProfile"
                                class="flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-3 font-medium text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                            >
                                <svg
                                    v-if="!isRequestingProfile"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    ></path>
                                </svg>
                                <span v-if="isRequestingProfile"
                                    >Sending...</span
                                >
                                <span v-else>Request Company Profile</span>
                            </button>
                            <p class="mt-2 text-center text-xs text-slate-500">
                                Send an email requesting company documentation
                            </p>
                        </div>
                    </div>

                    <!-- Interest timeline -->
                    <div class="rounded-xl bg-white p-6 shadow">
                        <div class="mb-4 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-slate-900">
                                Interest History
                            </h2>
                            <span
                                class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700"
                            >
                                {{ interests.length }} record(s)
                            </span>
                        </div>

                        <div
                            v-if="interests.length === 0"
                            class="text-sm text-slate-500"
                        >
                            No interest records for this client yet.
                        </div>
                        <div
                            v-else
                            class="max-h-80 space-y-3 overflow-y-auto pr-1"
                        >
                            <div
                                v-for="interest in interests"
                                :key="interest.id"
                                class="rounded-lg border border-slate-200 p-3 text-sm transition-colors hover:border-emerald-300"
                            >
                                <div
                                    class="mb-1 flex items-center justify-between"
                                >
                                    <p class="font-semibold text-slate-900">
                                        {{ interest.project_name }}
                                    </p>
                                    <span class="text-[11px] text-slate-500">
                                        {{
                                            formatDateTime(interest.created_at)
                                        }}
                                    </span>
                                </div>
                                <p class="mb-1 text-xs text-slate-500">
                                    {{
                                        formatInterestType(
                                            interest.interest_type,
                                        )
                                    }}
                                </p>
                                <p
                                    v-if="interest.message"
                                    class="line-clamp-2 text-xs text-slate-600"
                                >
                                    {{ interest.message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right column: projects & schedules -->
                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-xl bg-white p-6 shadow">
                        <div
                            class="mb-4 flex flex-col gap-2 md:flex-row md:items-center md:justify-between"
                        >
                            <h2 class="text-lg font-semibold text-slate-900">
                                Projects & Inception Schedules
                            </h2>
                            <p class="text-xs text-slate-500">
                                Manage inception meeting preferences and
                                schedules per project.
                            </p>
                        </div>

                        <div
                            v-if="projects.length === 0"
                            class="text-sm text-slate-500"
                        >
                            This client has not been linked to any projects yet.
                        </div>

                        <div v-else class="space-y-4">
                            <div
                                v-for="project in projects"
                                :key="project.id"
                                class="space-y-4 rounded-lg border border-slate-200 p-4 transition-colors hover:border-emerald-300"
                            >
                                <div
                                    class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between"
                                >
                                    <!-- Project summary -->
                                    <div>
                                        <div
                                            class="mb-1 flex items-center gap-2"
                                        >
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
                                            {{
                                                getStepName(
                                                    project.current_step,
                                                )
                                            }}
                                        </p>
                                        <a
                                            :href="
                                                admin.projects.show.url(
                                                    project.id,
                                                )
                                            "
                                            class="mt-2 inline-flex items-center text-xs font-semibold text-emerald-700 hover:text-emerald-800"
                                        >
                                            View project details
                                        </a>
                                    </div>

                                    <!-- Status pill -->
                                    <div
                                        class="text-xs text-slate-600 md:text-right"
                                    >
                                        <span
                                            class="mb-1 block text-[10px] tracking-widest text-slate-400 uppercase"
                                        >
                                            Inception Status
                                        </span>
                                        <span
                                            :class="[
                                                'inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-medium',
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
                                        <p
                                            v-if="
                                                project.inception_meeting_scheduled_at
                                            "
                                            class="mt-1"
                                        >
                                            {{
                                                formatDateTime(
                                                    project.inception_meeting_scheduled_at,
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <!-- QR Code Management Section -->
                                <div
                                    class="mt-4 border-t border-slate-200 pt-4"
                                >
                                    <h4
                                        class="mb-3 text-sm font-semibold text-slate-900"
                                    >
                                        QR Code Management
                                    </h4>

                                    <div
                                        v-if="
                                            getProjectQrUrl(project) &&
                                            !isProjectQrExpired(project)
                                        "
                                        class="mb-4"
                                    >
                                        <div
                                            class="mb-3 rounded-lg border border-emerald-200 bg-emerald-50 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs font-medium text-emerald-800"
                                            >
                                                QR Code Active
                                            </p>
                                            <p class="text-xs text-emerald-700">
                                                Expires:
                                                {{
                                                    formatDateTime(
                                                        project.qr_expires_at,
                                                    )
                                                }}
                                            </p>
                                        </div>

                                        <div
                                            v-if="qrCodeDataUrls[project.id]"
                                            class="mb-3 flex justify-center rounded-lg border border-slate-200 bg-white p-3"
                                        >
                                            <img
                                                :src="
                                                    qrCodeDataUrls[project.id]
                                                "
                                                alt="Project QR Code"
                                                class="h-32 w-32"
                                            />
                                        </div>

                                        <div class="mb-3">
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                                >QR Code URL:</label
                                            >
                                            <div
                                                class="rounded-lg bg-slate-50 p-2"
                                            >
                                                <code
                                                    class="text-[10px] break-all text-slate-700"
                                                    >{{
                                                        getProjectQrUrl(project)
                                                    }}</code
                                                >
                                            </div>
                                            <button
                                                @click="
                                                    copyToClipboard(
                                                        getProjectQrUrl(
                                                            project,
                                                        ),
                                                    )
                                                "
                                                class="mt-1 text-xs text-emerald-600 hover:text-emerald-700"
                                            >
                                                Copy URL
                                            </button>
                                        </div>
                                    </div>

                                    <div v-else class="mb-4">
                                        <div
                                            class="mb-3 rounded-lg border border-red-200 bg-red-50 p-3"
                                        >
                                            <p
                                                class="text-xs font-medium text-red-800"
                                            >
                                                QR Code Expired
                                            </p>
                                            <p class="text-xs text-red-700">
                                                Generate a new QR code to enable
                                                client access
                                            </p>
                                        </div>
                                    </div>

                                    <form
                                        @submit.prevent="generateQr(project.id)"
                                        class="space-y-3"
                                    >
                                        <div>
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                            >
                                                Expiration (hours)
                                            </label>
                                            <select
                                                v-model="
                                                    qrForms[project.id].hours
                                                "
                                                class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            >
                                                <option value="24">
                                                    24 hours
                                                </option>
                                                <option value="48">
                                                    48 hours (recommended)
                                                </option>
                                                <option value="72">
                                                    72 hours
                                                </option>
                                                <option value="168">
                                                    1 week
                                                </option>
                                            </select>
                                        </div>
                                        <button
                                            type="submit"
                                            :disabled="qrProcessing[project.id]"
                                            class="w-full rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-emerald-700 disabled:bg-slate-300"
                                        >
                                            <span
                                                v-if="qrProcessing[project.id]"
                                                >Generating...</span
                                            >
                                            <span v-else>Generate QR Code</span>
                                        </button>
                                    </form>
                                </div>

                                <!-- Editable schedule (moved from ProjectDetail.vue) -->
                                <div
                                    class="mt-2 grid grid-cols-1 gap-4 border-t border-slate-100 pt-2 pt-4 md:grid-cols-2"
                                >
                                    <div class="space-y-3">
                                        <div>
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                            >
                                                Meeting Mode
                                            </label>
                                            <div class="grid grid-cols-2 gap-2">
                                                <button
                                                    type="button"
                                                    @click="
                                                        scheduleForms[
                                                            project.id
                                                        ].inception_meeting_mode =
                                                            'online'
                                                    "
                                                    :class="[
                                                        'flex items-center justify-center gap-2 rounded-lg border px-3 py-2 text-xs font-medium transition-colors',
                                                        scheduleForms[
                                                            project.id
                                                        ]
                                                            .inception_meeting_mode ===
                                                        'online'
                                                            ? 'border-emerald-500 bg-emerald-50 text-emerald-700'
                                                            : 'border-slate-200 bg-white text-slate-600 hover:border-emerald-300',
                                                    ]"
                                                >
                                                    <span
                                                        class="h-2 w-2 rounded-full bg-emerald-500"
                                                    ></span>
                                                    <span>Online</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="
                                                        scheduleForms[
                                                            project.id
                                                        ].inception_meeting_mode =
                                                            'physical'
                                                    "
                                                    :class="[
                                                        'flex items-center justify-center gap-2 rounded-lg border px-3 py-2 text-xs font-medium transition-colors',
                                                        scheduleForms[
                                                            project.id
                                                        ]
                                                            .inception_meeting_mode ===
                                                        'physical'
                                                            ? 'border-emerald-500 bg-emerald-50 text-emerald-700'
                                                            : 'border-slate-200 bg-white text-slate-600 hover:border-emerald-300',
                                                    ]"
                                                >
                                                    <span
                                                        class="h-2 w-2 rounded-full bg-slate-500"
                                                    ></span>
                                                    <span>Physical</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                            >
                                                Scheduled Date &amp; Time
                                            </label>
                                            <input
                                                v-model="
                                                    scheduleForms[project.id]
                                                        .inception_meeting_scheduled_at
                                                "
                                                type="datetime-local"
                                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            />
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <div
                                            v-if="
                                                scheduleForms[project.id]
                                                    .inception_meeting_mode ===
                                                'physical'
                                            "
                                        >
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                            >
                                                Physical Location
                                            </label>
                                            <input
                                                v-model="
                                                    scheduleForms[project.id]
                                                        .inception_meeting_location
                                                "
                                                type="text"
                                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                                placeholder="Boardroom, client office, etc."
                                            />
                                        </div>

                                        <div
                                            v-if="
                                                scheduleForms[project.id]
                                                    .inception_meeting_mode ===
                                                'online'
                                            "
                                        >
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                            >
                                                Online Meeting Link
                                            </label>
                                            <input
                                                v-model="
                                                    scheduleForms[project.id]
                                                        .inception_meeting_link
                                                "
                                                type="text"
                                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                                placeholder="Zoom, Teams, Google Meet..."
                                            />
                                        </div>

                                        <div>
                                            <label
                                                class="mb-1 block text-xs font-medium text-slate-700"
                                            >
                                                Internal Notes (optional)
                                            </label>
                                            <textarea
                                                v-model="
                                                    scheduleForms[project.id]
                                                        .inception_meeting_notes
                                                "
                                                rows="3"
                                                class="w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-xs focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                                placeholder="Agenda, key attendees, prep requirements..."
                                            ></textarea>
                                        </div>

                                        <div class="flex justify-end">
                                            <button
                                                type="button"
                                                :disabled="
                                                    scheduleProcessing[
                                                        project.id
                                                    ]
                                                "
                                                @click="
                                                    updateSchedule(project.id)
                                                "
                                                class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                                            >
                                                <span
                                                    v-if="
                                                        scheduleProcessing[
                                                            project.id
                                                        ]
                                                    "
                                                    >Saving...</span
                                                >
                                                <span v-else
                                                    >Save Schedule</span
                                                >
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
import AppLayout from '@/layouts/AppLayout.vue';
import admin from '@/routes/admin';
import { router } from '@inertiajs/vue3';
import { Users } from 'lucide-vue-next';
import QRCode from 'qrcode';
import { onMounted, reactive, ref, watch } from 'vue';

const isRequestingProfile = ref(false);
const isRegistering = ref(false);

interface Project {
    id: number;
    uuid: string;
    name: string;
    project_type: string | null;
    location: string | null;
    current_step: number;
    qr_expires_at?: string | null;
    inception_meeting_mode?: 'online' | 'physical' | null;
    inception_meeting_scheduled_at?: string | null;
    inception_meeting_location?: string | null;
    inception_meeting_link?: string | null;
    inception_meeting_notes?: string | null;
}

interface Client {
    id: number;
    name: string | null;
    contact_person: string | null;
    email: string | null;
    phone: string | null;
    is_registered: boolean;
    interests_count: number;
    first_interest_at?: string | null;
    last_interest_at?: string | null;
}

interface Interest {
    id: number;
    project_name: string;
    company_name: string;
    contact_person: string;
    email: string;
    phone: string;
    interest_type: string;
    message?: string | null;
    created_at: string;
}

const props = defineProps<{
    client: Client;
    projects: Project[];
    interests: Interest[];
    qr_urls: Record<number, string>;
}>();

const client = props.client;
const projects = props.projects;
const interests = props.interests;

const breadcrumbs = [
    { title: 'Admin', href: admin.projects.index.url() },
    { title: 'Manage Clients', href: admin.clients.index.url() },
    { title: client.name || 'Client', href: '#' },
];

const scheduleForms = reactive<
    Record<
        number,
        {
            inception_meeting_mode: 'online' | 'physical' | null;
            inception_meeting_scheduled_at: string;
            inception_meeting_location: string;
            inception_meeting_link: string;
            inception_meeting_notes: string;
        }
    >
>({});

const scheduleProcessing = reactive<Record<number, boolean>>({});

const qrForms = reactive<Record<number, { hours: number }>>({});
const qrProcessing = reactive<Record<number, boolean>>({});
const qrCodeDataUrls = reactive<Record<number, string>>({});

projects.forEach((project) => {
    scheduleForms[project.id] = {
        inception_meeting_mode:
            (project.inception_meeting_mode as 'online' | 'physical' | null) ||
            null,
        inception_meeting_scheduled_at: project.inception_meeting_scheduled_at
            ? new Date(project.inception_meeting_scheduled_at)
                  .toISOString()
                  .slice(0, 16)
            : '',
        inception_meeting_location: project.inception_meeting_location || '',
        inception_meeting_link: project.inception_meeting_link || '',
        inception_meeting_notes: project.inception_meeting_notes || '',
    };
    scheduleProcessing[project.id] = false;

    qrForms[project.id] = { hours: 48 };
    qrProcessing[project.id] = false;
});

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

const formatInterestType = (type: string) => {
    const map: Record<string, string> = {
        general: 'General Interest',
        investor: 'Investment Opportunity',
        partner: 'Partnership Inquiry',
        other: 'Other',
    };
    return map[type] || type;
};

const updateSchedule = (projectId: number) => {
    const form = scheduleForms[projectId];
    if (!form) return;

    scheduleProcessing[projectId] = true;

    router.post(`/admin/projects/${projectId}/schedule-inception`, form, {
        onFinish: () => {
            scheduleProcessing[projectId] = false;
        },
    });
};

const getProjectQrUrl = (project: Project) => {
    return props.qr_urls[project.id] || null;
};

const isProjectQrExpired = (project: Project) => {
    if (!project.qr_expires_at) return true;
    return new Date(project.qr_expires_at) < new Date();
};

const copyToClipboard = async (text: string) => {
    try {
        await navigator.clipboard.writeText(text);
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
};

const generateQr = (projectId: number) => {
    qrProcessing[projectId] = true;

    router.post(
        `/admin/projects/${projectId}/generate-qr`,
        qrForms[projectId],
        {
            onFinish: () => {
                qrProcessing[projectId] = false;
            },
        },
    );
};

const generateQrCodeImage = async (projectId: number) => {
    const qrUrl = getProjectQrUrl(projects.find((p) => p.id === projectId)!);
    if (
        qrUrl &&
        !isProjectQrExpired(projects.find((p) => p.id === projectId)!)
    ) {
        try {
            qrCodeDataUrls[projectId] = await QRCode.toDataURL(qrUrl, {
                width: 200,
                margin: 2,
                color: {
                    dark: '#000000',
                    light: '#ffffff',
                },
            });
        } catch (err) {
            console.error(err);
        }
    } else {
        qrCodeDataUrls[projectId] = '';
    }
};

onMounted(() => {
    projects.forEach((project) => {
        generateQrCodeImage(project.id);
    });
});

watch(
    () => props.qr_urls,
    () => {
        projects.forEach((project) => {
            generateQrCodeImage(project.id);
        });
    },
    { deep: true },
);

const requestCompanyProfile = () => {
    if (!client.email || !client.contact_person || !client.name) {
        alert('Client information is incomplete');
        return;
    }

    isRequestingProfile.value = true;

    router.post(
        `/admin/clients/${client.id}/request-profile`,
        {
            email: client.email,
            contact_person: client.contact_person,
            company_name: client.name,
        },
        {
            onFinish: () => {
                isRequestingProfile.value = false;
            },
            onSuccess: () => {
                alert('Company profile request sent successfully!');
            },
            onError: () => {
                alert('Failed to send company profile request');
            },
        },
    );
};

const quickRegister = () => {
    isRegistering.value = true;
    router.post(
        admin.clients.store.url(),
        {
            company_name: client.name,
            contact_person: client.contact_person,
            title: '', // Not strictly known from Interest payload
            email: client.email,
            phone: client.phone,
        },
        {
            preserveState: true,
            preserveScroll: true,
            onFinish: () => {
                isRegistering.value = false;
            },
            onSuccess: () => {
                alert('Client registered successfully and credentials emailed.');
            },
            onError: () => {
                alert('Registration failed. The email might already be registered.');
            },
        }
    );
};
</script>
