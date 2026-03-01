<template>
    <HomeLayout>
        <div
            class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-100"
        >
            <section
                class="relative overflow-hidden rounded-b-[4rem] bg-slate-900 px-6 py-24 text-white"
            >
                <div class="absolute inset-0 opacity-20">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-30"
                    ></div>
                    <div
                        class="absolute bottom-0 left-0 h-1/2 w-full bg-gradient-to-t from-emerald-500/20 to-transparent"
                    ></div>
                </div>

                <div class="relative z-10 mx-auto max-w-4xl text-center">
                    <h1
                        v-reveal
                        class="mb-8 text-5xl leading-[0.9] font-black tracking-tighter md:text-7xl"
                    >
                        Our
                        <span class="text-emerald-500">Methodology</span> for
                        Success.
                    </h1>
                    <p
                        v-reveal
                        class="mx-auto max-w-2xl text-lg leading-relaxed font-medium text-slate-400 md:text-xl"
                    >
                        A structured, seven-stage workflow designed to reduce
                        risk, align expectations, and ensure professional
                        delivery from first engagement to project
                        implementation.
                    </p>
                </div>
            </section>

            <section class="px-6 py-24">
                <div class="mx-auto max-w-7xl">
                    <div class="relative">
                        <div
                            class="absolute top-[4.5rem] left-0 z-0 hidden h-0.5 w-full bg-slate-200 lg:block"
                        ></div>

                        <div
                            class="relative z-10 grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-7 lg:gap-4"
                        >
                            <div
                                v-for="(step, index) in steps"
                                :key="index"
                                v-reveal
                                class="group flex flex-col items-center text-center"
                            >
                                <div
                                    class="mb-6 flex h-16 w-16 transform items-center justify-center rounded-2xl border border-slate-100 bg-white shadow-xl shadow-slate-200 transition-all duration-500 group-hover:-translate-y-2 group-hover:bg-emerald-600 group-hover:text-white"
                                >
                                    <span
                                        class="text-2xl tracking-tighter text-black transition-transform group-hover:scale-110"
                                        >0{{ index + 1 }}</span
                                    >
                                </div>

                                <div
                                    class="flex-grow rounded-[2rem] border border-slate-100 bg-white p-6 shadow-lg shadow-slate-200/50 transition-colors hover:border-emerald-200"
                                >
                                    <h3
                                        class="mb-3 text-lg font-black tracking-tighter text-slate-900 uppercase"
                                    >
                                        {{ step.title }}
                                    </h3>
                                    <p
                                        class="mb-4 text-xs font-bold tracking-widest text-emerald-600 text-slate-500 uppercase"
                                    >
                                        {{ step.objective }}
                                    </p>
                                    <p
                                        class="text-sm leading-relaxed text-slate-600"
                                    >
                                        {{ step.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section
                class="mx-6 mb-20 rounded-[4rem] bg-slate-900 py-20 text-white"
            >
                <div class="mx-auto max-w-6xl px-6">
                    <div
                        v-for="(step, index) in steps"
                        :key="'detail-' + index"
                        class="mb-24 last:mb-0"
                    >
                        <div
                            :class="[
                                'flex flex-col items-center gap-12 md:flex-row',
                                index % 2 === 0 ? '' : 'md:flex-row-reverse',
                            ]"
                        >
                            <div class="md:w-1/2" v-reveal>
                                <span
                                    class="mb-4 block text-6xl text-black text-emerald-500 opacity-20"
                                    >STEP 0{{ index + 1 }}</span
                                >
                                <h2
                                    class="mb-6 text-4xl font-black tracking-tighter"
                                >
                                    {{ step.title }}
                                </h2>
                                <p
                                    class="mb-8 text-lg leading-relaxed text-slate-400"
                                >
                                    {{ step.fullDescription }}
                                </p>

                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div
                                        v-for="item in step.activities"
                                        :key="item"
                                        class="rounded-2xl border border-white/10 bg-white/5 p-4"
                                    >
                                        <p
                                            class="mb-1 text-[10px] font-black tracking-[0.2em] text-emerald-400 uppercase"
                                        >
                                            Key Activity
                                        </p>
                                        <p class="text-sm font-bold text-white">
                                            {{ item }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex aspect-video w-full items-center justify-center overflow-hidden rounded-[3rem] border border-white/10 bg-white/5 md:w-1/2"
                                v-reveal
                            >
                                <div class="p-12 text-center">
                                    <p
                                        class="mb-4 text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                                    >
                                        Phase Deliverable
                                    </p>
                                    <p
                                        class="text-2xl font-black text-emerald-400 italic"
                                    >
                                        {{ step.output }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- <section class="py-24 px-6 bg-slate-50">
      <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 v-reveal class="text-4xl font-black tracking-tighter mb-6 text-slate-900">Resource <span class="text-emerald-600">Center</span></h2>
        <p v-reveal class="text-slate-500 font-medium">Access technical templates and documentation for utility-scale solar project procurement.</p>
      </div>

      <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div v-reveal class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between items-start group">
          <div>
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
              <span class="text-white text-xl">📄</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter mb-4">RFQ Template (40MW PV + BESS)</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-8">
              A comprehensive technical and financial template for ground-mounted, grid-connected solar plants.
            </p>
          </div>
          <button class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase tracking-[0.2em] group-hover:bg-emerald-600 transition-colors">
            Download DOCX
          </button>
        </div>

        <div v-reveal class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between items-start group">
          <div>
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
              <span class="text-white text-xl">🛡️</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter mb-4">Standard NDA Template</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-8">
              Ensures confidentiality for technical and commercial project discussions.
            </p>
          </div>
          <button class="w-full py-4 border-2 border-slate-900 text-slate-900 rounded-2xl font-bold text-xs uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all">
            Download PDF
          </button>
        </div>
      </div>
    </section> -->

            <!-- <section class="py-24 px-6 text-center">
      <div v-reveal class="max-w-3xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-8 leading-tight">Ready to synchronize with the <span class="text-emerald-600">Kenyan Grid?</span></h2>
        <button 
          @click="showInceptionModal = true"
          class="px-10 py-5 bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest hover:shadow-2xl hover:shadow-emerald-200 transition-all transform hover:-translate-y-1">
          Initiate Inception Meeting
        </button>
      </div>
    </section> -->

            <!-- Inception Meeting Modal -->
            <div
                v-if="showInceptionModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                @click.self="showInceptionModal = false"
            >
                <div
                    class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white p-8"
                >
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-3xl font-black text-slate-900">
                            Initiate Inception Meeting
                        </h3>
                        <button
                            @click="showInceptionModal = false"
                            class="text-slate-400 hover:text-slate-600"
                        >
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <p class="mb-6 text-slate-600">
                        Fill in your details to receive a QR code for starting
                        the onboarding process.
                    </p>

                    <form
                        @submit.prevent="submitInceptionForm"
                        class="space-y-4"
                    >
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                                >Company Name *</label
                            >
                            <input
                                v-model="inceptionForm.company_name"
                                type="text"
                                required
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="Your Company Ltd"
                            />
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                                >Contact Person *</label
                            >
                            <input
                                v-model="inceptionForm.contact_person"
                                type="text"
                                required
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="John Doe"
                            />
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                                >Email Address *</label
                            >
                            <input
                                v-model="inceptionForm.email"
                                type="email"
                                required
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="john@company.com"
                            />
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                                >Phone Number *</label
                            >
                            <input
                                v-model="inceptionForm.phone"
                                type="tel"
                                required
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="+254 700 000 000"
                            />
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                                >Project Name *</label
                            >
                            <input
                                v-model="inceptionForm.project_name"
                                type="text"
                                required
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="Solar Farm Project"
                            />
                        </div>

                        <div>
                            <label
                                class="mb-3 block text-sm font-medium text-slate-700"
                                >Questions for the Meeting (Optional)</label
                            >
                            <div class="space-y-3">
                                <div
                                    v-for="(
                                        question, index
                                    ) in inceptionForm.questions"
                                    :key="index"
                                    class="flex gap-2"
                                >
                                    <input
                                        v-model="inceptionForm.questions[index]"
                                        type="text"
                                        class="flex-1 rounded-lg border border-slate-300 px-4 py-3 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        :placeholder="'Question ' + (index + 1)"
                                    />
                                    <button
                                        v-if="
                                            inceptionForm.questions.length > 1
                                        "
                                        type="button"
                                        @click="removeQuestion(index)"
                                        class="rounded-lg px-3 text-red-600 transition-colors hover:bg-red-50"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                                <button
                                    v-if="inceptionForm.questions.length < 5"
                                    type="button"
                                    @click="addQuestion"
                                    class="w-full rounded-lg border-2 border-dashed border-slate-300 px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-emerald-500 hover:text-emerald-600"
                                >
                                    + Add Another Question
                                </button>
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button
                                type="button"
                                @click="showInceptionModal = false"
                                class="flex-1 rounded-lg border-2 border-slate-300 px-6 py-3 font-medium text-slate-700 transition-colors hover:bg-slate-50"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="flex-1 rounded-lg bg-emerald-600 px-6 py-3 font-medium text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                            >
                                <span v-if="isSubmitting">Processing...</span>
                                <span v-else>Generate QR Code</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

const showInceptionModal = ref(false);
const isSubmitting = ref(false);

const inceptionForm = reactive({
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    project_name: '',
    meeting_mode: 'online' as 'online' | 'physical',
    questions: [''],
});

const addQuestion = () => {
    if (inceptionForm.questions.length < 5) {
        inceptionForm.questions.push('');
    }
};

const removeQuestion = (index: number) => {
    if (inceptionForm.questions.length > 1) {
        inceptionForm.questions.splice(index, 1);
    }
};

const submitInceptionForm = () => {
    isSubmitting.value = true;
    router.post('/initiate-inception', inceptionForm, {
        onFinish: () => {
            isSubmitting.value = false;
        },
    });
};

const steps = [
    {
        title: 'Inception Meeting',
        objective: 'Project Alignment',
        description:
            'Clarifying objectives, timelines, and stakeholder roles to confirm client needs.',
        fullDescription:
            'We introduce key stakeholders and define preliminary scope, risks, and constraints to ensure alignment before proceeding.',
        activities: [
            'Stakeholder Intro',
            'Risk Identification',
            'Timeline Review',
        ],
        output: 'Meeting Minutes',
    },
    {
        title: 'NDA Signing',
        objective: 'Establish Confidentiality',
        description:
            'Protecting sensitive technical and financial information shared between parties.',
        fullDescription:
            'Following the inception meeting, both parties sign a Non-Disclosure Agreement (NDA) to ensure strategic information remains confidential.',
        activities: [
            'Legal Review',
            'Digital Signature',
            'Strategic Alignment',
        ],
        output: 'Signed NDA',
    },
    {
        title: 'RFQ & Documentation',
        objective: 'Technical Assessment',
        description:
            'Gathering detailed regulatory and commercial data for accurate project assessment.',
        fullDescription:
            'Reviewing technical specifications, financial assumptions, and project drawings to define clear requirements.',
        activities: [
            'Technical Drawing Review',
            'Financial Assumptions',
            'Regulatory Scoping',
        ],
        output: 'Completed RFQ Package',
    },
    {
        title: 'Site Visit',
        objective: 'Feasibility Validation',
        description:
            'Physical or virtual assessment to reduce assumptions and mitigate implementation risks.',
        fullDescription:
            'We conduct on-site inspections, measurements, and environmental assessments to confirm design feasibility.',
        activities: [
            'Physical Inspection',
            'Grid Point Review',
            'Local Briefing',
        ],
        output: 'Site Visit Report',
    },
    {
        title: 'Compliance',
        objective: 'Standardization',
        description:
            'Evaluating projects against legal, environmental, and industry governance.',
        fullDescription:
            'Addressing gaps in EPRA licensing, NEMA compliance, and international IEC/IEEE standards before commitment.',
        activities: ['EPRA Licensing', 'NEMA/EMCA Review', 'Safety Checks'],
        output: 'Compliance Confirmation',
    },
    {
        title: 'Contract Signing',
        objective: 'Formal Commitment',
        description:
            'Executing a formal agreement under agreed commercial and technical terms.',
        fullDescription:
            'Finalizing negotiation and legal review of the EPC contract and securities like Performance Bonds.',
        activities: [
            'Legal Negotiation',
            'Securities Execution',
            'Final Review',
        ],
        output: 'Executed Contract',
    },
    {
        title: 'Implementation',
        objective: 'Project Delivery',
        description:
            'Execution according to agreed scope, quality, cost, and timeline.',
        fullDescription:
            'Mobilization and monitoring using project management best practices and regular reporting.',
        activities: ['Mobilization', 'Progress Monitoring', 'KPI Validation'],
        output: 'Project Deliverables',
    },
];

// v-reveal directive for the scroll animations
const vReveal = {
    mounted: (el: HTMLElement) => {
        el.classList.add(
            'opacity-0',
            'translate-y-8',
            'transition-all',
            'duration-700',
        );
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    el.classList.remove('opacity-0', 'translate-y-8');
                    el.classList.add('opacity-100', 'translate-y-0');
                }
            },
            { threshold: 0.1 },
        );
        observer.observe(el);
    },
};

const navigateHome = () => (window.location.href = '/');
</script>
