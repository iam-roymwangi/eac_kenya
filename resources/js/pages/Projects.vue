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
                        Global
                        <span class="text-emerald-500">Infrastructure</span>
                        Portfolio.
                    </h1>
                    <p
                        v-reveal
                        class="mx-auto max-w-2xl text-lg leading-relaxed font-medium text-slate-400 md:text-xl"
                    >
                        From the Rift Valley to the North Sea, we identify and
                        manage high-performing renewable assets that define the
                        next decade of energy.
                    </p>
                </div>
            </section>

            <section
                class="sticky top-[73px] z-[90] border-b border-slate-200 bg-slate-50/80 px-6 py-6 backdrop-blur-md"
            >
                <div
                    class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 md:flex-row"
                >
                    <div class="flex items-center gap-4">
                        <span
                            class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                            >Sector Focus</span
                        >
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="type in projectTypes"
                                :key="type"
                                @click="selectedType = type"
                                :class="[
                                    'rounded-full px-5 py-2 text-xs font-bold tracking-widest uppercase transition-all duration-300',
                                    selectedType === type
                                        ? 'scale-105 bg-emerald-600 text-white shadow-lg shadow-emerald-200'
                                        : 'border border-slate-200 bg-white text-slate-500 hover:border-emerald-300',
                                ]"
                            >
                                {{ type }}
                            </button>
                        </div>
                    </div>
                    <div
                        class="rounded-lg bg-slate-100 px-4 py-2 text-xs font-bold text-slate-400"
                    >
                        SHOWING {{ filteredProjects.length }} KEY ASSETS
                    </div>
                </div>
            </section>

            <section class="px-6 py-20">
                <div class="mx-auto max-w-7xl">
                    <TransitionGroup
                        name="project-grid"
                        tag="div"
                        class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3"
                    >
                        <div
                            v-for="(project, index) in filteredProjects"
                            :key="project.name"
                            v-reveal
                            class="group relative overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50 transition-all duration-500 hover:-translate-y-3"
                        >
                            <div class="relative h-72 overflow-hidden">
                                <img
                                    :src="project.image"
                                    class="h-full w-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                />
                                <div class="absolute top-6 left-6">
                                    <span
                                        :class="[
                                            'rounded-full px-4 py-1.5 text-[10px] font-black tracking-widest text-white uppercase shadow-xl',
                                            getBadgeColor(project.type),
                                        ]"
                                    >
                                        {{ project.type }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-8">
                                <div
                                    class="mb-4 flex items-start justify-between"
                                >
                                    <h3
                                        class="text-2xl font-black tracking-tighter text-slate-900"
                                    >
                                        {{ project.name }}
                                    </h3>
                                    <span
                                        class="text-sm font-bold text-emerald-600"
                                        >{{ project.roi }} ROI</span
                                    >
                                </div>
                                <p
                                    class="mb-8 line-clamp-2 text-sm leading-relaxed font-medium text-slate-500"
                                >
                                    {{ project.description }}
                                </p>

                                <div class="mb-8 grid grid-cols-2 gap-4">
                                    <div
                                        class="rounded-2xl border border-slate-100 bg-slate-50 p-3"
                                    >
                                        <p
                                            class="text-[9px] font-bold tracking-widest text-slate-400 uppercase"
                                        >
                                            Capacity
                                        </p>
                                        <p
                                            class="text-sm font-black text-slate-700"
                                        >
                                            {{ project.capacity }}
                                        </p>
                                    </div>
                                    <div
                                        class="rounded-2xl border border-slate-100 bg-slate-50 p-3"
                                    >
                                        <p
                                            class="text-[9px] font-bold tracking-widest text-slate-400 uppercase"
                                        >
                                            Location
                                        </p>
                                        <p
                                            class="truncate text-sm font-black text-slate-700"
                                        >
                                            {{ project.location }}
                                        </p>
                                    </div>
                                </div>

                                <button
                                    @click="openProjectModal(index)"
                                    class="mb-3 w-full rounded-2xl bg-slate-900 py-4 text-xs font-bold tracking-[0.2em] text-white uppercase transition-colors group-hover:bg-emerald-600"
                                >
                                    {{
                                        project.isDatabase
                                            ? 'View Details'
                                            : 'Technical Data Sheet'
                                    }}
                                </button>

                                <button
                                    @click="openInterestModal(project)"
                                    class="w-full rounded-2xl border-2 border-emerald-600 py-3 text-xs font-bold tracking-[0.2em] text-emerald-600 uppercase transition-colors hover:bg-emerald-600 hover:text-white"
                                >
                                    Express Interest
                                </button>
                            </div>
                        </div>
                    </TransitionGroup>
                </div>
            </section>

            <Transition name="fade">
                <div
                    v-if="
                        selectedProjectIndex !== null &&
                        !filteredProjects[selectedProjectIndex]?.isDatabase
                    "
                    class="fixed inset-0 z-[200] flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur-xl"
                    @click="selectedProjectIndex = null"
                >
                    <div
                        @click.stop
                        class="relative flex h-[85vh] w-full max-w-5xl flex-col overflow-hidden rounded-[3rem] bg-white shadow-2xl md:flex-row"
                    >
                        <button
                            @click="selectedProjectIndex = null"
                            class="absolute top-8 right-8 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-slate-900 backdrop-blur-md transition-all hover:bg-white"
                        >
                            ✕
                        </button>

                        <div class="relative h-64 md:h-auto md:w-1/2">
                            <img
                                :src="
                                    filteredProjects[selectedProjectIndex]
                                        ?.image
                                "
                                class="h-full w-full object-cover"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"
                            ></div>
                            <div class="absolute bottom-10 left-10 text-white">
                                <p
                                    class="mb-2 text-xs font-bold tracking-widest text-emerald-400 uppercase"
                                >
                                    {{
                                        filteredProjects[selectedProjectIndex]
                                            ?.type
                                    }}
                                    Division
                                </p>
                                <h2
                                    class="text-4xl font-black tracking-tighter"
                                >
                                    {{
                                        filteredProjects[selectedProjectIndex]
                                            ?.name
                                    }}
                                </h2>
                            </div>
                        </div>

                        <div class="overflow-y-auto bg-white p-12 md:w-1/2">
                            <div class="space-y-8">
                                <div>
                                    <h4
                                        class="mb-4 text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                                    >
                                        Infrastructure Overview
                                    </h4>
                                    <p
                                        class="leading-relaxed font-medium text-slate-600"
                                    >
                                        {{
                                            filteredProjects[
                                                selectedProjectIndex
                                            ]?.fullDescription
                                        }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div
                                        v-for="(val, label) in getMetricObject(
                                            filteredProjects[
                                                selectedProjectIndex
                                            ],
                                        )"
                                        :key="label"
                                        class="rounded-[2rem] border border-slate-100 bg-slate-50 p-6 transition-colors hover:border-emerald-200"
                                    >
                                        <p
                                            class="mb-1 text-[9px] font-bold tracking-widest text-slate-400 uppercase"
                                        >
                                            {{ label }}
                                        </p>
                                        <p
                                            class="text-2xl font-black tracking-tighter text-slate-900"
                                        >
                                            {{ val }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="rounded-[2rem] border border-emerald-100 bg-emerald-50 p-8"
                                >
                                    <h5
                                        class="mb-4 text-xs font-black tracking-widest text-emerald-800 uppercase"
                                    >
                                        ESG Impact Metrics
                                    </h5>
                                    <ul class="space-y-3">
                                        <li
                                            v-for="metric in filteredProjects[
                                                selectedProjectIndex
                                            ]?.metrics"
                                            :key="metric"
                                            class="flex items-center gap-3 text-sm font-medium text-emerald-900"
                                        >
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                            ></span>
                                            {{ metric }}
                                        </li>
                                    </ul>
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    <button
                                        @click="
                                            openInterestModalFromDetail(
                                                filteredProjects[
                                                    selectedProjectIndex
                                                ],
                                            )
                                        "
                                        class="w-full rounded-2xl bg-emerald-600 py-4 font-bold tracking-widest text-white uppercase transition-all hover:shadow-xl hover:shadow-emerald-200"
                                    >
                                        Express Interest
                                    </button>
                                    <button
                                        @click="
                                            openQuestionModal(
                                                filteredProjects[
                                                    selectedProjectIndex
                                                ],
                                            )
                                        "
                                        class="w-full rounded-2xl border-2 border-slate-900 py-4 font-bold tracking-widest text-slate-900 uppercase transition-all hover:bg-slate-900 hover:text-white"
                                    >
                                        Ask a Question
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>

            <!-- Interest Modal -->
            <Transition name="fade">
                <div
                    v-if="showInterestModal"
                    class="fixed inset-0 z-[250] flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur-xl"
                    @click="closeInterestModal"
                >
                    <div
                        @click.stop
                        class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white shadow-2xl"
                    >
                        <div
                            class="sticky top-0 flex items-center justify-between rounded-t-3xl border-b border-slate-200 bg-white p-8"
                        >
                            <div>
                                <h3 class="text-3xl font-black text-slate-900">
                                    Express Interest
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ selectedProject?.name }}
                                </p>
                            </div>
                            <button
                                @click="closeInterestModal"
                                class="text-slate-400 transition-colors hover:text-slate-600"
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

                        <form
                            @submit.prevent="submitInterest"
                            class="space-y-6 p-8"
                        >
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Company Name *</label
                                    >
                                    <input
                                        v-model="interestForm.company_name"
                                        type="text"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Your Company Ltd"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Contact Person *</label
                                    >
                                    <input
                                        v-model="interestForm.contact_person"
                                        type="text"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="John Doe"
                                    />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Email Address *</label
                                    >
                                    <input
                                        v-model="interestForm.email"
                                        type="email"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="john@company.com"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Phone Number *</label
                                    >
                                    <input
                                        v-model="interestForm.phone"
                                        type="tel"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="+254 700 000 000"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                    >Interest Type *</label
                                >
                                <select
                                    v-model="interestForm.interest_type"
                                    required
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                >
                                    <option value="general">
                                        General Interest
                                    </option>
                                    <option value="investor">
                                        Investment Opportunity
                                    </option>
                                    <option value="partner">
                                        Partnership Inquiry
                                    </option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                    >Message (Optional)</label
                                >
                                <textarea
                                    v-model="interestForm.message"
                                    rows="4"
                                    class="w-full resize-none rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Tell us more about your interest..."
                                ></textarea>
                            </div>

                            <div class="flex gap-4 pt-4">
                                <button
                                    type="button"
                                    @click="closeInterestModal"
                                    class="flex-1 rounded-xl border-2 border-slate-300 px-6 py-4 font-bold text-slate-700 transition-colors hover:bg-slate-50"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    :disabled="isSubmittingInterest"
                                    class="flex-1 rounded-xl bg-emerald-600 px-6 py-4 font-bold text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                                >
                                    <span v-if="isSubmittingInterest"
                                        >Submitting...</span
                                    >
                                    <span v-else>Submit Interest</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Transition>

            <!-- Question Modal -->
            <Transition name="fade">
                <div
                    v-if="showQuestionModal"
                    class="fixed inset-0 z-[250] flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur-xl"
                    @click="closeQuestionModal"
                >
                    <div
                        @click.stop
                        class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white shadow-2xl"
                    >
                        <div
                            class="sticky top-0 flex items-center justify-between rounded-t-3xl border-b border-slate-200 bg-white p-8"
                        >
                            <div>
                                <h3 class="text-3xl font-black text-slate-900">
                                    Ask a Question
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ selectedProject?.name }}
                                </p>
                            </div>
                            <button
                                @click="closeQuestionModal"
                                class="text-slate-400 transition-colors hover:text-slate-600"
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

                        <form
                            @submit.prevent="submitQuestion"
                            class="space-y-6 p-8"
                        >
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Company Name *</label
                                    >
                                    <input
                                        v-model="questionForm.company_name"
                                        type="text"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Your Company Ltd"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Contact Person *</label
                                    >
                                    <input
                                        v-model="questionForm.contact_person"
                                        type="text"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="John Doe"
                                    />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Email Address *</label
                                    >
                                    <input
                                        v-model="questionForm.email"
                                        type="email"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="john@company.com"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Phone Number *</label
                                    >
                                    <input
                                        v-model="questionForm.phone"
                                        type="tel"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="+254 700 000 000"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                    >Your Question *</label
                                >
                                <textarea
                                    v-model="questionForm.question"
                                    rows="5"
                                    required
                                    class="w-full resize-none rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="What would you like to know about this project?"
                                ></textarea>
                            </div>

                            <div
                                class="rounded-xl border border-emerald-200 bg-emerald-50 p-4"
                            >
                                <div class="flex items-start gap-3">
                                    <svg
                                        class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-600"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                    <p class="text-sm text-emerald-800">
                                        After submitting your question, you can
                                        initiate an inception meeting to discuss
                                        the project in detail.
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-4 pt-4">
                                <button
                                    type="button"
                                    @click="closeQuestionModal"
                                    class="flex-1 rounded-xl border-2 border-slate-300 px-6 py-4 font-bold text-slate-700 transition-colors hover:bg-slate-50"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    :disabled="isSubmittingQuestion"
                                    class="flex-1 rounded-xl bg-emerald-600 px-6 py-4 font-bold text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                                >
                                    <span v-if="isSubmittingQuestion"
                                        >Submitting...</span
                                    >
                                    <span v-else>Submit Question</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Transition>

            <!-- Inception Meeting Modal (after question submission) -->
            <Transition name="fade">
                <div
                    v-if="showInceptionModal"
                    class="fixed inset-0 z-[260] flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur-xl"
                    @click="closeInceptionModal"
                >
                    <div
                        @click.stop
                        class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white shadow-2xl"
                    >
                        <div
                            class="sticky top-0 flex items-center justify-between rounded-t-3xl border-b border-slate-200 bg-white p-8"
                        >
                            <div>
                                <h3 class="text-3xl font-black text-slate-900">
                                    Initiate Inception Meeting
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ selectedProject?.name }}
                                </p>
                            </div>
                            <button
                                @click="closeInceptionModal"
                                class="text-slate-400 transition-colors hover:text-slate-600"
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

                        <div class="p-8">
                            <div
                                class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-6"
                            >
                                <h4 class="mb-2 font-bold text-emerald-900">
                                    What happens next?
                                </h4>
                                <ul class="space-y-2 text-sm text-emerald-800">
                                    <li class="flex items-start gap-2">
                                        <span class="font-bold text-emerald-600"
                                            >1.</span
                                        >
                                        <span
                                            >You'll receive a QR code to start
                                            the onboarding process</span
                                        >
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="font-bold text-emerald-600"
                                            >2.</span
                                        >
                                        <span
                                            >Sign the NDA to protect
                                            confidential information</span
                                        >
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="font-bold text-emerald-600"
                                            >3.</span
                                        >
                                        <span
                                            >Complete the inception meeting
                                            documentation</span
                                        >
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="font-bold text-emerald-600"
                                            >4.</span
                                        >
                                        <span
                                            >Submit your RFQ package with
                                            project details</span
                                        >
                                    </li>
                                </ul>
                            </div>

                            <form
                                @submit.prevent="submitInceptionMeeting"
                                class="space-y-6"
                            >
                                <div
                                    class="grid grid-cols-1 gap-4 md:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            class="mb-2 block text-sm font-bold text-slate-700"
                                            >Company Name *</label
                                        >
                                        <input
                                            v-model="inceptionForm.company_name"
                                            type="text"
                                            required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="Your Company Ltd"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="mb-2 block text-sm font-bold text-slate-700"
                                            >Contact Person *</label
                                        >
                                        <input
                                            v-model="
                                                inceptionForm.contact_person
                                            "
                                            type="text"
                                            required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="John Doe"
                                        />
                                    </div>
                                </div>

                                <div
                                    class="grid grid-cols-1 gap-4 md:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            class="mb-2 block text-sm font-bold text-slate-700"
                                            >Email Address *</label
                                        >
                                        <input
                                            v-model="inceptionForm.email"
                                            type="email"
                                            required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="john@company.com"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="mb-2 block text-sm font-bold text-slate-700"
                                            >Phone Number *</label
                                        >
                                        <input
                                            v-model="inceptionForm.phone"
                                            type="tel"
                                            required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="+254 700 000 000"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                        >Project Name *</label
                                    >
                                    <input
                                        v-model="inceptionForm.project_name"
                                        type="text"
                                        required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Solar Farm Project"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="mb-3 block text-sm font-bold text-slate-700"
                                        >Questions for the Meeting
                                        (Optional)</label
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
                                                v-model="
                                                    inceptionForm.questions[
                                                        index
                                                    ]
                                                "
                                                type="text"
                                                class="flex-1 rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                                :placeholder="
                                                    'Question ' + (index + 1)
                                                "
                                            />
                                            <button
                                                v-if="
                                                    inceptionForm.questions
                                                        .length > 1
                                                "
                                                type="button"
                                                @click="removeQuestion(index)"
                                                class="rounded-xl px-4 py-3 text-red-600 transition-colors hover:bg-red-50"
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
                                            v-if="
                                                inceptionForm.questions.length <
                                                5
                                            "
                                            type="button"
                                            @click="addQuestion"
                                            class="w-full rounded-xl border-2 border-dashed border-slate-300 px-4 py-3 font-medium text-slate-600 transition-colors hover:border-emerald-500 hover:text-emerald-600"
                                        >
                                            + Add Another Question
                                        </button>
                                    </div>
                                </div>

                                <div class="flex gap-4 pt-4">
                                    <button
                                        type="button"
                                        @click="closeInceptionModal"
                                        class="flex-1 rounded-xl border-2 border-slate-300 px-6 py-4 font-bold text-slate-700 transition-colors hover:bg-slate-50"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        :disabled="isSubmittingInception"
                                        class="flex-1 rounded-xl bg-emerald-600 px-6 py-4 font-bold text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                                    >
                                        <span v-if="isSubmittingInception"
                                            >Processing...</span
                                        >
                                        <span v-else>Generate QR Code</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';
import { router } from '@inertiajs/vue3';
import { computed, reactive, ref } from 'vue';

interface Project {
    id?: number;
    name: string;
    type: 'Solar' | 'Wind' | 'Hydro' | 'Geothermal';
    description: string;
    fullDescription?: string;
    capacity: string;
    roi?: string;
    year?: string;
    location: string;
    image?: string;
    metrics?: string[];
    isDatabase?: boolean;
}

const props = defineProps<{
    dbProjects?: Project[];
}>();

const staticProjects: Project[] = [];

// Merge database projects with static projects
const projects = computed(() => {
    const dbProjs = (props.dbProjects || []).map((p) => {
        // Assign image based on project name or type
        let image =
            'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=2070&auto=format&fit=crop'; // Default solar

        if (p.name === 'Nyakwere Hills Solar Project') {
            image =
                'https://media.licdn.com/dms/image/v2/D4D22AQEuJWEPNGrp4w/feedshare-shrink_2048_1536/B4DZniGPs5JMAw-/0/1760434919295?e=2147483647&v=beta&t=VlN__V4p_uSQc4A9x-abBzD2pWo_CYUxHTNXXDC_27o';
        } else if (p.type === 'Wind') {
            image = '/images/ol-ndanyat-wind.png';
        }

        return {
            ...p,
            fullDescription: p.description,
            roi: 'TBD',
            year: '2026',
            image: image,
            metrics: ['Clean Energy', 'Sustainable', 'High Impact'],
        };
    });
    return [...dbProjs, ...staticProjects];
});

const projectTypes = ['all', 'Solar', 'Wind', 'Geothermal'];
const selectedType = ref('all');
const selectedProjectIndex = ref<number | null>(null);
const selectedProject = ref<Project | null>(null);

// Modal states
const showInterestModal = ref(false);
const showQuestionModal = ref(false);
const showInceptionModal = ref(false);

// Submission states
const isSubmittingInterest = ref(false);
const isSubmittingQuestion = ref(false);
const isSubmittingInception = ref(false);

// Forms
const interestForm = reactive({
    project_name: '',
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    interest_type: 'general',
    message: '',
});

const questionForm = reactive({
    project_name: '',
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    question: '',
});

const inceptionForm = reactive({
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    project_name: '',
    meeting_mode: 'online' as 'online' | 'physical',
    questions: [''],
});

const filteredProjects = computed(() => {
    if (selectedType.value === 'all') return projects.value;
    return projects.value.filter((p) => p.type === selectedType.value);
});

const getBadgeColor = (type: string) => {
    const colors: any = {
        Solar: 'bg-amber-500',
        Wind: 'bg-blue-500',
        Geothermal: 'bg-red-500',
    };
    return colors[type] || 'bg-emerald-600';
};

const getMetricObject = (p: Project) => ({
    Capacity: p.capacity,
    'Project ROI': p.roi,
    Vintage: p.year,
    Location: p.location,
});

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

const openProjectModal = (i: number) => {
    const project = filteredProjects.value[i];
    // If it's a database project, navigate to detail page
    if (project.isDatabase && project.id) {
        router.visit(`/projects/${project.id}`);
    } else {
        // Otherwise show the modal for static projects
        selectedProjectIndex.value = i;
    }
};

const openInterestModal = (project: Project) => {
    selectedProject.value = project;
    interestForm.project_name = project.name;
    showInterestModal.value = true;
};

const openInterestModalFromDetail = (project: Project) => {
    selectedProjectIndex.value = null;
    openInterestModal(project);
};

const closeInterestModal = () => {
    showInterestModal.value = false;
    resetInterestForm();
};

const openQuestionModal = (project: Project) => {
    selectedProjectIndex.value = null;
    selectedProject.value = project;
    questionForm.project_name = project.name;
    showQuestionModal.value = true;
};

const closeQuestionModal = () => {
    showQuestionModal.value = false;
    resetQuestionForm();
};

const closeInceptionModal = () => {
    showInceptionModal.value = false;
    resetInceptionForm();
};

const resetInterestForm = () => {
    Object.assign(interestForm, {
        project_name: '',
        company_name: '',
        contact_person: '',
        email: '',
        phone: '',
        interest_type: 'general',
        message: '',
    });
};

const resetQuestionForm = () => {
    Object.assign(questionForm, {
        project_name: '',
        company_name: '',
        contact_person: '',
        email: '',
        phone: '',
        question: '',
    });
};

const resetInceptionForm = () => {
    Object.assign(inceptionForm, {
        company_name: '',
        contact_person: '',
        email: '',
        phone: '',
        project_name: '',
        questions: [''],
    });
};

const submitInterest = () => {
    isSubmittingInterest.value = true;
    router.post('/projects/record-interest', interestForm, {
        onSuccess: () => {
            closeInterestModal();
            alert('Thank you for your interest! We will contact you shortly.');
        },
        onError: () => {
            alert(
                'There was an error submitting your interest. Please try again.',
            );
        },
        onFinish: () => {
            isSubmittingInterest.value = false;
        },
    });
};

const submitQuestion = () => {
    isSubmittingQuestion.value = true;
    router.post('/projects/ask-question', questionForm, {
        onSuccess: () => {
            closeQuestionModal();
            // Pre-fill inception form with question form data
            inceptionForm.company_name = questionForm.company_name;
            inceptionForm.contact_person = questionForm.contact_person;
            inceptionForm.email = questionForm.email;
            inceptionForm.phone = questionForm.phone;
            inceptionForm.project_name = questionForm.project_name;
            // Show inception modal
            showInceptionModal.value = true;
        },
        onError: () => {
            alert(
                'There was an error submitting your question. Please try again.',
            );
        },
        onFinish: () => {
            isSubmittingQuestion.value = false;
        },
    });
};

const submitInceptionMeeting = () => {
    isSubmittingInception.value = true;
    router.post('/initiate-inception', inceptionForm, {
        onFinish: () => {
            isSubmittingInception.value = false;
        },
    });
};

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
</script>

<style>
.project-grid-enter-active,
.project-grid-leave-active {
    transition: all 0.5s ease;
}
.project-grid-enter-from,
.project-grid-leave-to {
    opacity: 0;
    transform: scale(0.9);
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

::-webkit-scrollbar {
    display: none;
}
</style>
