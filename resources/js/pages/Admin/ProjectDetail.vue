<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <!-- Header -->
            <div class="mb-6 flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        {{ project.name }}
                    </h1>
                    <p class="text-slate-600">{{ project.location }}</p>
                </div>
                <a :href="admin.projects.index.url()"
                    class="rounded-lg px-4 py-2 font-medium text-slate-600 transition-colors hover:text-slate-800">
                    ← Back to Projects
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Project Details -->
                <div class="space-y-6 lg:col-span-2">
                    <!-- Basic Information -->
                    <div class="rounded-lg bg-white p-6 shadow">
                        <h3 class="mb-4 text-lg font-semibold text-slate-900">
                            Project Information
                        </h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <span class="text-sm text-slate-600">Project Type:</span>
                                <p class="font-medium text-slate-900">
                                    {{
                                        formatProjectType(project.project_type)
                                    }}
                                </p>
                            </div>
                            <div v-if="project.capacity_mw">
                                <span class="text-sm text-slate-600">Capacity:</span>
                                <p class="font-medium text-slate-900">
                                    {{ project.capacity_mw }} MW
                                </p>
                            </div>
                            <div>
                                <span class="text-sm text-slate-600">Current Step:</span>
                                <p class="font-medium text-slate-900">
                                    Step {{ project.current_step }}:
                                    {{ step_names[project.current_step] }}
                                </p>
                            </div>
                            <div>
                                <span class="text-sm text-slate-600">Created:</span>
                                <p class="font-medium text-slate-900">
                                    {{ formatDate(project.created_at) }}
                                </p>
                            </div>
                        </div>
                        <div v-if="project.description" class="mt-4">
                            <span class="text-sm text-slate-600">Description:</span>
                            <div class="mt-1 prose prose-slate max-w-none prose-sm text-slate-900"
                                v-html="project.description"></div>
                        </div>
                    </div>

                    <!-- Onboarding Progress -->
                    <!-- <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Onboarding Progress</h3>
            <div class="space-y-4">
              <div v-for="(stepName, stepNumber) in step_names" :key="stepNumber" class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full mr-4"
                     :class="stepNumber <= project.current_step 
                       ? 'bg-emerald-600 text-white' 
                       : 'bg-slate-200 text-slate-600'">
                  <span class="text-sm font-medium">{{ stepNumber }}</span>
                </div>
                <div class="flex-1">
                  <p class="font-medium text-slate-900">{{ stepName }}</p>
                  <p v-if="getStepStatus(stepNumber)" class="text-sm text-slate-600">
                    {{ getStepStatus(stepNumber) }}
                  </p>
                </div>
                <div v-if="stepNumber <= project.current_step">
                  <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div> -->

                    <!-- RFQ Data (if available) -->
                    <div v-if="project.rfq_data" class="rounded-lg bg-white p-6 shadow">
                        <h3 class="mb-4 text-lg font-semibold text-slate-900">
                            RFQ Submission
                        </h3>
                        <div class="space-y-4">
                            <div v-if="project.rfq_data.regulatory_requirements">
                                <span class="text-sm text-slate-600">Regulatory Requirements:</span>
                                <p class="mt-1 text-slate-900">
                                    {{
                                        project.rfq_data.regulatory_requirements
                                    }}
                                </p>
                            </div>
                            <div v-if="project.rfq_data.project_timeline">
                                <span class="text-sm text-slate-600">Project Timeline:</span>
                                <p class="mt-1 text-slate-900">
                                    {{ project.rfq_data.project_timeline }}
                                </p>
                            </div>
                            <div v-if="
                                project.rfq_data
                                    .environmental_considerations
                            ">
                                <span class="text-sm text-slate-600">Environmental Considerations:</span>
                                <p class="mt-1 text-slate-900">
                                    {{
                                        project.rfq_data
                                            .environmental_considerations
                                    }}
                                </p>
                            </div>
                            <div v-if="
                                project.rfq_data.technical_drawings &&
                                project.rfq_data.technical_drawings.length >
                                0
                            ">
                                <span class="text-sm text-slate-600">Technical Drawings:</span>
                                <ul class="mt-1 space-y-1">
                                    <li v-for="file in project.rfq_data
                                        .technical_drawings" :key="file.path" class="text-sm text-slate-900">
                                        {{ file.original_name }} ({{
                                            formatFileSize(file.size)
                                        }})
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Project Interests -->
                    <div class="rounded-lg bg-white p-6 shadow">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">
                                Project Interests
                            </h3>
                            <span
                                class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-800">
                                {{ interests.length }}
                                {{
                                    interests.length === 1
                                        ? 'Interest'
                                        : 'Interests'
                                }}
                            </span>
                        </div>

                        <div v-if="interests.length === 0" class="py-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="mt-2 text-sm text-slate-500">
                                No interests recorded yet
                            </p>
                        </div>

                        <div v-else class="space-y-3">
                            <div v-for="interest in interests" :key="interest.id"
                                class="overflow-hidden rounded-lg border border-slate-200 transition-colors hover:border-emerald-300">
                                <button @click="toggleInterest(interest.id)"
                                    class="flex w-full items-center justify-between bg-slate-50 px-4 py-3 transition-colors hover:bg-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100">
                                            <svg class="h-5 w-5 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="font-medium text-slate-900">
                                                {{ interest.company_name }}
                                            </p>
                                            <p class="text-sm text-slate-500">
                                                {{ interest.contact_person }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span :class="[
                                            'rounded-full px-2.5 py-1 text-xs font-medium',
                                            getInterestTypeBadge(
                                                interest.interest_type,
                                            ),
                                        ]">
                                            {{
                                                formatInterestType(
                                                    interest.interest_type,
                                                )
                                            }}
                                        </span>
                                        <svg class="h-5 w-5 text-slate-400 transition-transform" :class="{
                                            'rotate-180':
                                                expandedInterests.includes(
                                                    interest.id,
                                                ),
                                        }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </button>

                                <div v-if="
                                    expandedInterests.includes(interest.id)
                                " class="border-t border-slate-200 bg-white px-4 py-4">
                                    <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Email</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{ interest.email }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Phone</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{ interest.phone }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Interest
                                                Type</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{
                                                    formatInterestType(
                                                        interest.interest_type,
                                                    )
                                                }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Submitted</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{
                                                    formatDateTime(
                                                        interest.created_at,
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div v-if="interest.message">
                                        <span
                                            class="text-xs font-medium tracking-wider text-slate-500 uppercase">Message</span>
                                        <p class="mt-1 rounded-lg bg-slate-50 p-3 text-sm text-slate-900">
                                            {{ interest.message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Questions -->
                    <div class="rounded-lg bg-white p-6 shadow">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">
                                Project Questions
                            </h3>
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">
                                {{ questions.length }}
                                {{
                                    questions.length === 1
                                        ? 'Question'
                                        : 'Questions'
                                }}
                            </span>
                        </div>

                        <div v-if="questions.length === 0" class="py-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <p class="mt-2 text-sm text-slate-500">
                                No questions asked yet
                            </p>
                        </div>

                        <div v-else class="space-y-3">
                            <div v-for="question in questions" :key="question.id"
                                class="overflow-hidden rounded-lg border border-slate-200 transition-colors hover:border-blue-300">
                                <button @click="toggleQuestion(question.id)"
                                    class="flex w-full items-center justify-between bg-slate-50 px-4 py-3 transition-colors hover:bg-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                            <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 text-left">
                                            <p class="font-medium text-slate-900">
                                                {{ question.company_name }}
                                            </p>
                                            <p class="line-clamp-1 text-sm text-slate-500">
                                                {{ question.question }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span v-if="question.admin_response"
                                            class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800">
                                            Answered
                                        </span>
                                        <span v-else
                                            class="rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-800">
                                            Pending
                                        </span>
                                        <svg class="h-5 w-5 text-slate-400 transition-transform" :class="{
                                            'rotate-180':
                                                expandedQuestions.includes(
                                                    question.id,
                                                ),
                                        }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </button>

                                <div v-if="
                                    expandedQuestions.includes(question.id)
                                " class="border-t border-slate-200 bg-white px-4 py-4">
                                    <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Contact
                                                Person</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{ question.contact_person }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Email</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{ question.email }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Phone</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{ question.phone }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs font-medium tracking-wider text-slate-500 uppercase">Submitted</span>
                                            <p class="mt-1 text-sm text-slate-900">
                                                {{
                                                    formatDateTime(
                                                        question.created_at,
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <span
                                            class="text-xs font-medium tracking-wider text-slate-500 uppercase">Question</span>
                                        <p class="mt-1 rounded-lg bg-blue-50 p-3 text-sm text-slate-900">
                                            {{ question.question }}
                                        </p>
                                    </div>
                                    <div v-if="question.admin_response">
                                        <span class="text-xs font-medium tracking-wider text-slate-500 uppercase">Admin
                                            Response</span>
                                        <p class="mt-1 rounded-lg bg-green-50 p-3 text-sm text-slate-900">
                                            {{ question.admin_response }}
                                        </p>
                                        <p class="mt-2 text-xs text-slate-500">
                                            Responded:
                                            {{
                                                formatDateTime(
                                                    question.responded_at,
                                                )
                                            }}
                                        </p>
                                    </div>
                                    <div v-else>
                                        <form @submit.prevent="
                                            respondToQuestion(question.id)
                                            " class="mt-4">
                                            <label
                                                class="mb-2 block text-xs font-medium tracking-wider text-slate-500 uppercase">
                                                Your Response
                                            </label>
                                            <textarea v-model="responseForm[question.id]
                                                " rows="3"
                                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                                placeholder="Type your response here..."></textarea>
                                            <button type="submit" :disabled="!responseForm[
                                                question.id
                                                ] ||
                                                responseProcessing[
                                                question.id
                                                ]
                                                "
                                                class="mt-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 disabled:bg-slate-300">
                                                <span v-if="
                                                    responseProcessing[
                                                    question.id
                                                    ]
                                                ">Submitting...</span>
                                                <span v-else>Submit Response</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Sidebar -->
                <div class="space-y-6">
                    <!-- Step Management -->
                    <div class="rounded-lg bg-white p-6 shadow">
                        <h3 class="mb-4 text-lg font-semibold text-slate-900">
                            Step Management
                        </h3>

                        <form @submit.prevent="resetStep" class="space-y-4">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    Reset to Step
                                </label>
                                <select v-model="stepForm.step"
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500">
                                    <option v-for="(
stepName, stepNumber
                                        ) in step_names" :key="stepNumber" :value="stepNumber">
                                        Step {{ stepNumber }}: {{ stepName }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit" :disabled="stepProcessing"
                                class="w-full rounded-lg bg-slate-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-slate-700 disabled:bg-slate-300">
                                <span v-if="stepProcessing">Resetting...</span>
                                <span v-else>Reset Step</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import admin from '@/routes/admin';
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

const props = defineProps({
    project: Object,
    qr_url: String,
    step_names: Object,
    interests: Array,
    questions: Array,
});

const breadcrumbs = [
    { title: 'Admin', href: admin.projects.index.url() },
    { title: 'Projects', href: admin.projects.index.url() },
    {
        title: props.project.name,
        href: admin.projects.show.url(props.project.id),
    },
];

const stepProcessing = ref(false);
const expandedInterests = ref([]);
const expandedQuestions = ref([]);
const responseForm = reactive({});
const responseProcessing = reactive({});

const stepForm = reactive({
    step: props.project.current_step,
});

const formatProjectType = (type) => {
    const types = {
        SOLAR: 'Solar PV',
        BESS: 'Battery Energy Storage System',
        SOLAR_BESS: 'Solar PV + Battery Storage',
        OTHER: 'Other Renewable Energy',
    };
    return types[type] || type;
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

const formatDateTime = (dateString) => {
    return new Date(dateString).toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

const getStepStatus = (stepNumber) => {
    if (stepNumber === 1 && props.project.inception_completed_at) {
        return `Completed: ${formatDateTime(props.project.inception_completed_at)}`;
    }
    if (stepNumber === 2 && props.project.nda_signed_at) {
        return `Signed: ${formatDateTime(props.project.nda_signed_at)}`;
    }
    if (stepNumber === 3 && props.project.rfq_completed_at) {
        return `Submitted: ${formatDateTime(props.project.rfq_completed_at)}`;
    }
    return null;
};

const copyToClipboard = async (text) => {
    try {
        await navigator.clipboard.writeText(text);
        // You could add a toast notification here
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
};

const resetStep = () => {
    stepProcessing.value = true;

    router.post(admin.projects.resetStep.url(props.project.id), stepForm, {
        onFinish: () => {
            stepProcessing.value = false;
        },
    });
};

const toggleInterest = (id) => {
    const index = expandedInterests.value.indexOf(id);
    if (index > -1) {
        expandedInterests.value.splice(index, 1);
    } else {
        expandedInterests.value.push(id);
    }
};

const toggleQuestion = (id) => {
    const index = expandedQuestions.value.indexOf(id);
    if (index > -1) {
        expandedQuestions.value.splice(index, 1);
    } else {
        expandedQuestions.value.push(id);
    }
};

const getInterestTypeBadge = (type) => {
    const badges = {
        general: 'bg-slate-100 text-slate-800',
        investor: 'bg-emerald-100 text-emerald-800',
        partner: 'bg-blue-100 text-blue-800',
        other: 'bg-purple-100 text-purple-800',
    };
    return badges[type] || badges.general;
};

const formatInterestType = (type) => {
    const types = {
        general: 'General Interest',
        investor: 'Investment Opportunity',
        partner: 'Partnership Inquiry',
        other: 'Other',
    };
    return types[type] || type;
};

const respondToQuestion = (questionId) => {
    if (!responseForm[questionId]) return;

    responseProcessing[questionId] = true;

    router.post(
        admin.questions.respond.url(questionId),
        {
            response: responseForm[questionId],
        },
        {
            onSuccess: () => {
                responseForm[questionId] = '';
            },
            onFinish: () => {
                responseProcessing[questionId] = false;
            },
        },
    );
};
</script>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
