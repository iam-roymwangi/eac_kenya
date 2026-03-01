<template>
    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-4xl px-4 py-8">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="mb-2 text-3xl font-bold text-slate-900">
                    EAC Green Group
                </h1>
                <h2 class="mb-4 text-xl text-slate-600">
                    Client Onboarding - Step 2: Inception Meeting
                </h2>
                <div class="text-sm text-slate-500">
                    Project: {{ project.name }}
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mb-8">
                <div
                    class="mb-2 flex items-center justify-between text-sm text-slate-600"
                >
                    <span>Step 2 of 3</span>
                    <span>67% Complete</span>
                </div>
                <div class="h-2 w-full rounded-full bg-slate-200">
                    <div
                        class="h-2 rounded-full bg-emerald-600"
                        style="width: 67%"
                    ></div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-8 shadow-lg">
                <!-- Success Message -->
                <div
                    class="mb-8 rounded-lg border border-emerald-200 bg-emerald-50 p-4"
                >
                    <div class="flex items-center">
                        <svg
                            class="mr-3 h-5 w-5 text-emerald-600"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <p class="font-medium text-emerald-800">
                            Inception Meeting Completed
                        </p>
                    </div>
                </div>

                <!-- Project Summary -->
                <div class="mb-8">
                    <h3 class="mb-6 text-lg font-semibold text-slate-900">
                        Project Overview
                    </h3>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="rounded-lg bg-slate-50 p-6">
                            <h4 class="mb-3 font-medium text-slate-900">
                                Project Details
                            </h4>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-sm text-slate-600"
                                        >Project Name:</span
                                    >
                                    <p class="font-medium text-slate-900">
                                        {{ project.name }}
                                    </p>
                                </div>
                                <div v-if="project.project_type">
                                    <span class="text-sm text-slate-600"
                                        >Type:</span
                                    >
                                    <p class="font-medium text-slate-900">
                                        {{
                                            formatProjectType(
                                                project.project_type,
                                            )
                                        }}
                                    </p>
                                </div>
                                <div v-if="project.capacity_mw">
                                    <span class="text-sm text-slate-600"
                                        >Capacity:</span
                                    >
                                    <p class="font-medium text-slate-900">
                                        {{ project.capacity_mw }} MW
                                    </p>
                                </div>
                                <div v-if="project.location">
                                    <span class="text-sm text-slate-600"
                                        >Location:</span
                                    >
                                    <p class="font-medium text-slate-900">
                                        {{ project.location }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-lg bg-slate-50 p-6">
                            <h4 class="mb-3 font-medium text-slate-900">
                                Project Description
                            </h4>
                            <p class="text-sm leading-relaxed text-slate-700">
                                {{
                                    project.description ||
                                    'This renewable energy project represents a significant step towards sustainable development in Kenya. Our team will work closely with you to ensure successful project delivery from conception to commissioning.'
                                }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Inception Meeting Content -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-semibold text-slate-900">
                        Intent to Award Document
                    </h3>

                    <!-- PDF Viewer for Intent Award -->
                    <div
                        class="mb-6 overflow-hidden rounded-lg border border-slate-300"
                    >
                        <iframe
                            src="/documents/Intent_Award_EACGreenGroupLtd_template.pdf#toolbar=0&navpanes=0&scrollbar=1"
                            class="h-[500px] w-full"
                            @contextmenu.prevent
                            style="pointer-events: auto"
                        ></iframe>
                    </div>
                    <p class="mb-6 text-xs text-slate-500">
                        Please review the Intent to Award document above. This
                        outlines the preliminary agreement framework.
                    </p>
                </div>

                <!-- Inception Meeting Objectives -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-semibold text-slate-900">
                        Inception Meeting Objectives
                    </h3>

                    <div class="mb-6 rounded-lg bg-emerald-50 p-6">
                        <h4 class="mb-3 font-medium text-emerald-900">
                            Meeting Agenda
                        </h4>
                        <ul class="space-y-2 text-sm text-emerald-800">
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-2 w-2 shrink-0 rounded-full bg-emerald-600"
                                ></span>
                                Project intent alignment and stakeholder
                                identification
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-2 w-2 shrink-0 rounded-full bg-emerald-600"
                                ></span>
                                Scope definition and technical requirements
                                review
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-2 w-2 shrink-0 rounded-full bg-emerald-600"
                                ></span>
                                Timeline expectations and milestone planning
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-2 w-2 shrink-0 rounded-full bg-emerald-600"
                                ></span>
                                Communication protocols and project governance
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-2 w-2 shrink-0 rounded-full bg-emerald-600"
                                ></span>
                                Risk assessment and mitigation strategies
                            </li>
                        </ul>
                    </div>

                    <div class="rounded-lg bg-slate-50 p-6">
                        <h4 class="mb-3 font-medium text-slate-900">
                            Key Outcomes
                        </h4>
                        <p class="mb-4 text-sm leading-relaxed text-slate-700">
                            By completing this inception meeting, we establish a
                            shared understanding of:
                        </p>
                        <ul class="space-y-2 text-sm text-slate-700">
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-1.5 w-1.5 shrink-0 rounded-full bg-slate-400"
                                ></span>
                                Project objectives and success criteria
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-1.5 w-1.5 shrink-0 rounded-full bg-slate-400"
                                ></span>
                                Roles and responsibilities of all parties
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-1.5 w-1.5 shrink-0 rounded-full bg-slate-400"
                                ></span>
                                Technical specifications and performance
                                requirements
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="mt-2 mr-3 h-1.5 w-1.5 shrink-0 rounded-full bg-slate-400"
                                ></span>
                                Project delivery methodology and quality
                                standards
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <button
                        @click="goBack"
                        class="rounded-lg px-6 py-3 font-medium text-slate-600 transition-colors hover:text-slate-800"
                    >
                        ← Previous Step
                    </button>
                    <button
                        @click="completeMeeting"
                        :disabled="processing"
                        class="rounded-lg bg-emerald-600 px-8 py-3 font-medium text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                    >
                        <span v-if="processing">Processing...</span>
                        <span v-else>Complete Meeting & Continue</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    project: Object,
});

const processing = ref(false);

const formatProjectType = (type) => {
    const types = {
        SOLAR: 'Solar PV',
        BESS: 'Battery Energy Storage System',
        SOLAR_BESS: 'Solar PV + Battery Storage',
        OTHER: 'Other Renewable Energy',
    };
    return types[type] || type;
};

const goBack = () => {
    router.get(`/onboarding/${props.project.uuid}`);
};

const completeMeeting = () => {
    processing.value = true;

    router.post(
        `/onboarding/${props.project.uuid}/step-two`,
        {
            uuid: props.project.uuid,
        },
        {
            onFinish: () => {
                processing.value = false;
            },
        },
    );
};
</script>
