<template>
    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-4xl px-4 py-8">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="mb-2 text-3xl font-bold text-slate-900">
                    EAC Green Group
                </h1>
                <h2 class="mb-4 text-xl text-slate-600">Onboarding Complete</h2>
            </div>

            <!-- Success Card -->
            <div class="rounded-lg bg-white p-8 text-center shadow-lg">
                <!-- Success Icon -->
                <div
                    class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100"
                >
                    <svg
                        class="h-10 w-10 text-emerald-600"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h3 class="mb-4 text-2xl font-bold text-slate-900">
                    Congratulations!
                </h3>
                <p class="mb-8 text-lg text-slate-600">
                    You have successfully completed the initial onboarding
                    process for <strong>{{ project.name }}</strong
                    >.
                </p>

                <!-- Completion Summary -->
                <div class="mb-8 rounded-lg bg-emerald-50 p-6">
                    <h4 class="mb-4 font-semibold text-emerald-900">
                        What's Been Completed
                    </h4>
                    <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-3">
                        <div class="flex items-center text-emerald-800">
                            <svg
                                class="mr-2 h-5 w-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            NDA Signed
                        </div>
                        <div class="flex items-center text-emerald-800">
                            <svg
                                class="mr-2 h-5 w-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            Inception Meeting
                        </div>
                        <div class="flex items-center text-emerald-800">
                            <svg
                                class="mr-2 h-5 w-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            RFQ Submitted
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="mb-8 rounded-lg bg-slate-50 p-6 text-left">
                    <h4 class="mb-4 font-semibold text-slate-900">
                        What Happens Next
                    </h4>
                    <div class="space-y-3 text-sm text-slate-700">
                        <div class="flex items-start">
                            <span
                                class="mt-0.5 mr-3 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-xs font-bold text-white"
                                >1</span
                            >
                            <div>
                                <p class="font-medium">
                                    Document Review (2-3 business days)
                                </p>
                                <p class="text-slate-600">
                                    Our technical team will review your
                                    submitted documentation and requirements.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span
                                class="mt-0.5 mr-3 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-xs font-bold text-white"
                                >2</span
                            >
                            <div>
                                <p class="font-medium">
                                    Initial Proposal (5-7 business days)
                                </p>
                                <p class="text-slate-600">
                                    We'll prepare a comprehensive proposal
                                    including technical specifications and
                                    commercial terms.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span
                                class="mt-0.5 mr-3 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-xs font-bold text-white"
                                >3</span
                            >
                            <div>
                                <p class="font-medium">
                                    Project Kickoff Meeting
                                </p>
                                <p class="text-slate-600">
                                    Schedule a detailed discussion to finalize
                                    project parameters and next steps.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-8 rounded-lg bg-slate-50 p-6">
                    <h4 class="mb-4 font-semibold text-slate-900">
                        Your Project Team
                    </h4>
                    <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                        <div>
                            <p class="font-medium text-slate-900">
                                Project Manager
                            </p>
                            <p class="text-slate-600">
                                Will be assigned within 24 hours
                            </p>
                        </div>
                        <div>
                            <p class="font-medium text-slate-900">
                                Technical Lead
                            </p>
                            <p class="text-slate-600">
                                Will be assigned based on project type
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 border-t border-slate-200 pt-4">
                        <p class="mb-2 font-medium text-slate-900">
                            Questions or Concerns?
                        </p>
                        <p class="text-slate-600">
                            Contact us at
                            <a
                                href="mailto:projects@eacgreen.co.ke"
                                class="text-emerald-600 hover:text-emerald-700"
                                >projects@eacgreen.co.ke</a
                            >
                        </p>
                        <p class="text-slate-600">
                            Or call us at
                            <a
                                href="tel:+254700000000"
                                class="text-emerald-600 hover:text-emerald-700"
                                >+254 700 000 000</a
                            >
                        </p>
                    </div>
                </div>

                <!-- Reference Information -->
                <div class="mb-8 text-sm text-slate-500">
                    <p>
                        Project Reference:
                        <span class="font-mono">{{ project.uuid }}</span>
                    </p>
                    <p>Please keep this reference for your records.</p>
                </div>

                <!-- Action Button -->
                <button
                    @click="goToHome"
                    class="rounded-lg bg-emerald-600 px-8 py-3 font-medium text-white transition-colors hover:bg-emerald-700"
                >
                    Return to EAC Green Group
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    project: Object,
});

const goToHome = () => {
    router.get('/');
};
</script>
