<template>
    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-4xl px-4 py-8">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="mb-2 text-3xl font-bold text-slate-900">
                    EAC Green Group
                </h1>
                <h2 class="mb-4 text-xl text-slate-600">
                    Client Onboarding - Step 3: RFQ & Documentation
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
                    <span>Step 3 of 3</span>
                    <span>100% Complete</span>
                </div>
                <div class="h-2 w-full rounded-full bg-slate-200">
                    <div
                        class="h-2 rounded-full bg-emerald-600"
                        style="width: 100%"
                    ></div>
                </div>
            </div>

            <form @submit.prevent="submitRfq" class="space-y-8">
                <!-- Technical Drawings Section -->
                <div class="rounded-lg bg-white p-8 shadow-lg">
                    <h3 class="mb-6 text-lg font-semibold text-slate-900">
                        Technical Drawings & Documents
                    </h3>

                    <div class="mb-6">
                        <label
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Upload Technical Drawings
                        </label>
                        <div
                            class="rounded-lg border-2 border-dashed border-slate-300 p-6 text-center transition-colors hover:border-emerald-400"
                        >
                            <input
                                ref="fileInput"
                                type="file"
                                multiple
                                accept=".pdf,.dwg,.dxf,.jpg,.jpeg,.png"
                                @change="handleFileUpload"
                                class="hidden"
                            />
                            <svg
                                class="mx-auto mb-4 h-12 w-12 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                ></path>
                            </svg>
                            <p class="mb-2 text-slate-600">
                                Click to upload or drag and drop
                            </p>
                            <p class="text-xs text-slate-500">
                                PDF, DWG, DXF, JPG, PNG (max 10MB each)
                            </p>
                            <button
                                type="button"
                                @click="$refs.fileInput.click()"
                                class="mt-4 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-emerald-700"
                            >
                                Select Files
                            </button>
                        </div>

                        <!-- File List -->
                        <div v-if="selectedFiles.length > 0" class="mt-4">
                            <h4 class="mb-2 text-sm font-medium text-slate-700">
                                Selected Files:
                            </h4>
                            <div class="space-y-2">
                                <div
                                    v-for="(file, index) in selectedFiles"
                                    :key="index"
                                    class="flex items-center justify-between rounded-lg bg-slate-50 p-3"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-3 h-5 w-5 text-slate-400"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        <span class="text-sm text-slate-700">{{
                                            file.name
                                        }}</span>
                                        <span
                                            class="ml-2 text-xs text-slate-500"
                                            >({{
                                                formatFileSize(file.size)
                                            }})</span
                                        >
                                    </div>
                                    <button
                                        type="button"
                                        @click="removeFile(index)"
                                        class="text-sm text-red-500 hover:text-red-700"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Requirements Section -->
                <div class="rounded-lg bg-white p-8 shadow-lg">
                    <h3 class="mb-6 text-lg font-semibold text-slate-900">
                        Project Requirements
                    </h3>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Regulatory Requirements -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Regulatory Requirements
                            </label>
                            <textarea
                                v-model="form.regulatory_requirements"
                                rows="6"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="Describe any specific regulatory requirements, permits, or compliance standards..."
                            ></textarea>
                        </div>

                        <!-- Project Timeline -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Project Timeline Expectations
                            </label>
                            <textarea
                                v-model="form.project_timeline"
                                rows="6"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="Describe your expected project timeline, key milestones, and any critical deadlines..."
                            ></textarea>
                        </div>
                    </div>

                    <!-- Environmental Considerations -->
                    <div class="mt-6">
                        <label
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Environmental Considerations
                        </label>
                        <textarea
                            v-model="form.environmental_considerations"
                            rows="4"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                            placeholder="Describe any environmental factors, constraints, or sustainability requirements..."
                        ></textarea>
                    </div>
                </div>

                <!-- Financial Assumptions Section -->
                <div class="rounded-lg bg-white p-8 shadow-lg">
                    <h3 class="mb-6 text-lg font-semibold text-slate-900">
                        Financial Assumptions
                    </h3>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Project Budget Range (USD)
                            </label>
                            <select
                                v-model="
                                    form.financial_assumptions.budget_range
                                "
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="">Select budget range</option>
                                <option value="under_1m">Under $1M</option>
                                <option value="1m_5m">$1M - $5M</option>
                                <option value="5m_10m">$5M - $10M</option>
                                <option value="10m_25m">$10M - $25M</option>
                                <option value="25m_50m">$25M - $50M</option>
                                <option value="over_50m">Over $50M</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Financing Structure
                            </label>
                            <select
                                v-model="
                                    form.financial_assumptions
                                        .financing_structure
                                "
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="">
                                    Select financing structure
                                </option>
                                <option value="equity">100% Equity</option>
                                <option value="debt_equity">
                                    Debt + Equity
                                </option>
                                <option value="project_finance">
                                    Project Finance
                                </option>
                                <option value="government_grants">
                                    Government Grants
                                </option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Expected ROI Timeline
                            </label>
                            <select
                                v-model="
                                    form.financial_assumptions.roi_timeline
                                "
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="">Select ROI timeline</option>
                                <option value="3_5_years">3-5 years</option>
                                <option value="5_7_years">5-7 years</option>
                                <option value="7_10_years">7-10 years</option>
                                <option value="10_plus_years">10+ years</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Risk Tolerance
                            </label>
                            <select
                                v-model="
                                    form.financial_assumptions.risk_tolerance
                                "
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="">Select risk tolerance</option>
                                <option value="conservative">
                                    Conservative
                                </option>
                                <option value="moderate">Moderate</option>
                                <option value="aggressive">Aggressive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Error Display -->
                <div
                    v-if="Object.keys(errors).length > 0"
                    class="rounded-lg border border-red-200 bg-red-50 p-4"
                >
                    <h4 class="mb-2 font-medium text-red-800">
                        Please correct the following errors:
                    </h4>
                    <ul class="space-y-1 text-sm text-red-700">
                        <li v-for="(error, field) in errors" :key="field">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <button
                        type="button"
                        @click="goBack"
                        class="rounded-lg px-6 py-3 font-medium text-slate-600 transition-colors hover:text-slate-800"
                    >
                        ← Previous Step
                    </button>
                    <button
                        type="submit"
                        :disabled="processing"
                        class="rounded-lg bg-emerald-600 px-8 py-3 font-medium text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                    >
                        <span v-if="processing">Submitting...</span>
                        <span v-else>Submit RFQ Package</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

const props = defineProps({
    project: Object,
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const processing = ref(false);
const selectedFiles = ref([]);
const fileInput = ref(null);

const form = reactive({
    regulatory_requirements: '',
    project_timeline: '',
    environmental_considerations: '',
    financial_assumptions: {
        budget_range: '',
        financing_structure: '',
        roi_timeline: '',
        risk_tolerance: '',
    },
});

const handleFileUpload = (event) => {
    const files = Array.from(event.target.files);
    selectedFiles.value = [...selectedFiles.value, ...files];
};

const removeFile = (index) => {
    selectedFiles.value.splice(index, 1);
};

const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

const goBack = () => {
    router.get(`/onboarding/${props.project.uuid}/inception`);
};

const submitRfq = () => {
    processing.value = true;

    const formData = new FormData();
    formData.append('uuid', props.project.uuid);
    formData.append('regulatory_requirements', form.regulatory_requirements);
    formData.append('project_timeline', form.project_timeline);
    formData.append(
        'environmental_considerations',
        form.environmental_considerations,
    );

    // Add financial assumptions as individual fields
    formData.append(
        'financial_assumptions[budget_range]',
        form.financial_assumptions.budget_range,
    );
    formData.append(
        'financial_assumptions[financing_structure]',
        form.financial_assumptions.financing_structure,
    );
    formData.append(
        'financial_assumptions[roi_timeline]',
        form.financial_assumptions.roi_timeline,
    );
    formData.append(
        'financial_assumptions[risk_tolerance]',
        form.financial_assumptions.risk_tolerance,
    );

    // Add files
    selectedFiles.value.forEach((file, index) => {
        formData.append(`technical_drawings[${index}]`, file);
    });

    router.post(`/onboarding/${props.project.uuid}/step-three`, formData, {
        onFinish: () => {
            processing.value = false;
        },
    });
};
</script>
