<template>
    <HomeLayout>
        <div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-100">
            <!-- Hero Section -->
            <section class="relative overflow-hidden bg-slate-900 px-6 py-32 text-white">
                <div class="absolute inset-0">
                    <!-- Dynamic Background Image -->
                    <img v-if="primaryImage" :src="`/storage/${primaryImage.path}`"
                        class="h-full w-full object-cover mix-blend-overlay opacity-50" alt="Project Background" />

                    <!-- Fallback Pattern -->
                    <div v-else
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-[0.06]">
                    </div>

                    <!-- Gradient Overlays for Text Legibility -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-slate-900/40">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 h-2/3 w-full bg-gradient-to-t from-emerald-600/20 to-transparent">
                    </div>
                </div>

                <div class="relative z-10 mx-auto max-w-6xl">
                    <div class="mb-6 flex items-center gap-3" v-reveal>
                        <a href="/projects" class="text-slate-400 transition-colors hover:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <span class="text-slate-400">/</span>
                        <span class="text-slate-400">Projects</span>
                        <span class="text-slate-400">/</span>
                        <span class="font-bold text-white">{{
                            project.name
                        }}</span>
                    </div>

                    <div class="flex flex-col gap-8 md:flex-row md:items-end md:justify-between">
                        <div class="flex-1">
                            <div class="mb-4 flex items-center gap-4" v-reveal>
                                <span :class="[
                                    'rounded-full px-4 py-2 text-xs font-black tracking-widest uppercase',
                                    getProjectTypeBadge(),
                                ]">
                                    {{
                                        formatProjectType(project.project_type)
                                    }}
                                </span>
                                <span v-if="project.capacity_mw"
                                    class="rounded-full bg-white/10 px-4 py-2 text-xs font-bold text-white">
                                    {{ project.capacity_mw }} MW
                                </span>
                            </div>

                            <h1 v-reveal class="mb-6 text-2xl leading-[0.9] font-black tracking-tighter md:text-3xl">
                                {{ project.name }}
                            </h1>

                            <!-- <p v-reveal class="max-w-3xl text-lg leading-relaxed font-medium text-slate-300 md:text-xl">
                                {{
                                    project.description ||
                                    'A cutting-edge renewable energy project designed to power sustainable growth.'
                                }}
                            </p> -->
                        </div>

                        <div v-reveal class="flex flex-col gap-4 sm:flex-row">
                            <button @click="openInterestModal"
                                class="rounded-2xl bg-emerald-600 px-8 py-4 font-bold tracking-widest text-white uppercase transition-all hover:shadow-2xl hover:shadow-emerald-200">
                                Express Interest
                            </button>
                            <button @click="openQuestionModal"
                                class="rounded-2xl border-2 border-white px-8 py-4 font-bold tracking-widest text-white uppercase transition-all hover:bg-white hover:text-slate-900">
                                Ask Question
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Stats -->
            <section class="border-b border-slate-200 bg-white px-6 py-12">
                <div class="mx-auto max-w-6xl">
                    <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                        <div v-reveal class="rounded-2xl border border-slate-100 bg-slate-50 p-6 text-center">
                            <p class="mb-2 text-xs font-black tracking-widest text-slate-400 uppercase">
                                Project Type
                            </p>
                            <p class="text-2xl font-black text-slate-900">
                                {{ formatProjectType(project.project_type) }}
                            </p>
                        </div>

                        <div v-reveal class="rounded-2xl border border-slate-100 bg-slate-50 p-6 text-center">
                            <p class="mb-2 text-xs font-black tracking-widest text-slate-400 uppercase">
                                Capacity
                            </p>
                            <p class="text-2xl font-black text-slate-900">
                                {{ project.capacity_mw || 'TBD' }}
                                <span v-if="project.capacity_mw" class="text-base">MW</span>
                            </p>
                        </div>

                        <div v-reveal class="rounded-2xl border border-slate-100 bg-slate-50 p-6 text-center">
                            <p class="mb-2 text-xs font-black tracking-widest text-slate-400 uppercase">
                                Location
                            </p>
                            <p class="text-xl font-black text-slate-900">
                                {{ project.location || 'Kenya' }}
                            </p>
                        </div>

                        <div v-reveal class="rounded-2xl border border-slate-100 bg-slate-50 p-6 text-center">
                            <p class="mb-2 text-xs font-black tracking-widest text-slate-400 uppercase">
                                Status
                            </p>
                            <p class="text-xl font-black text-emerald-600">
                                {{ getProjectStatus() }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Content -->
            <section class="px-6 py-20">
                <div class="mx-auto max-w-6xl">
                    <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
                        <!-- Left Column - Main Details -->
                        <div class="space-y-12 lg:col-span-2">
                            <!-- Project Overview -->
                            <div v-reveal
                                class="rounded-[3rem] border border-slate-100 bg-white p-10 shadow-xl shadow-slate-200/50">
                                <h2 class="mb-6 text-3xl font-black tracking-tighter text-slate-900">
                                    Project Overview
                                </h2>
                                <div v-if="project.description"
                                    class="prose prose-slate prose-lg max-w-none prose-headings:font-black prose-headings:tracking-tighter prose-headings:text-slate-900 prose-p:text-slate-600 prose-p:leading-relaxed prose-a:text-emerald-600 prose-a:font-bold prose-img:rounded-3xl prose-img:shadow-xl"
                                    v-html="project.description"></div>
                                <div v-else class="prose prose-slate max-w-none">
                                    <p class="text-lg leading-relaxed text-slate-600">
                                        This renewable energy project represents a significant investment in sustainable
                                        infrastructure, designed to deliver clean, reliable power while supporting local
                                        economic development and environmental stewardship.
                                    </p>
                                </div>
                            </div>

                            <!-- Project Gallery -->
                            <div v-if="project.images && project.images.length > 0" v-reveal
                                class="rounded-[3rem] border border-slate-100 bg-white p-10 shadow-xl shadow-slate-200/50">
                                <h2 class="mb-8 text-3xl font-black tracking-tighter text-slate-900">
                                    Project Gallery
                                </h2>
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                    <div v-for="image in project.images" :key="image.id"
                                        class="group relative aspect-[4/3] overflow-hidden rounded-2xl bg-slate-100">
                                        <img :src="`/storage/${image.path}`" :alt="project.name"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Specifications -->
                            <div v-reveal
                                class="rounded-[3rem] border border-slate-100 bg-white p-10 shadow-xl shadow-slate-200/50">
                                <h2 class="mb-8 text-3xl font-black tracking-tighter text-slate-900">
                                    Technical Specifications
                                </h2>
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6">
                                        <p class="mb-2 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                            Project ID
                                        </p>
                                        <p class="font-mono text-lg font-black text-slate-900">
                                            {{ project.uuid.substring(0, 8) }}
                                        </p>
                                    </div>

                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6">
                                        <p class="mb-2 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                            Technology
                                        </p>
                                        <p class="text-lg font-black text-slate-900">
                                            {{ getTechnologyType() }}
                                        </p>
                                    </div>

                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6">
                                        <p class="mb-2 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                            Capacity
                                        </p>
                                        <p class="text-lg font-black text-slate-900">
                                            {{
                                                project.capacity_mw ||
                                                'To Be Determined'
                                            }}
                                            {{
                                                project.capacity_mw ? 'MW' : ''
                                            }}
                                        </p>
                                    </div>

                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6">
                                        <p class="mb-2 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                            Location
                                        </p>
                                        <p class="text-lg font-black text-slate-900">
                                            {{ project.location || 'Kenya' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Timeline -->
                            <div v-reveal
                                class="rounded-[3rem] border border-slate-100 bg-white p-10 shadow-xl shadow-slate-200/50">
                                <h2 class="mb-8 text-3xl font-black tracking-tighter text-slate-900">
                                    Project Timeline
                                </h2>
                                <div class="space-y-6">
                                    <div v-for="(step, index) in projectSteps" :key="index" class="flex gap-6">
                                        <div class="flex flex-col items-center">
                                            <div :class="[
                                                'flex h-12 w-12 items-center justify-center rounded-full text-sm font-black transition-all',
                                                step.completed
                                                    ? 'bg-emerald-600 text-white'
                                                    : step.current
                                                        ? 'bg-emerald-100 text-emerald-600 ring-4 ring-emerald-200'
                                                        : 'bg-slate-100 text-slate-400',
                                            ]">
                                                {{ index + 1 }}
                                            </div>
                                            <div v-if="
                                                index <
                                                projectSteps.length - 1
                                            " :class="[
                                                'mt-2 w-0.5 flex-1',
                                                step.completed
                                                    ? 'bg-emerald-600'
                                                    : 'bg-slate-200',
                                            ]"></div>
                                        </div>
                                        <div class="flex-1 pb-8">
                                            <h3 :class="[
                                                'mb-2 text-lg font-black',
                                                step.completed ||
                                                    step.current
                                                    ? 'text-slate-900'
                                                    : 'text-slate-400',
                                            ]">
                                                {{ step.title }}
                                            </h3>
                                            <p :class="[
                                                'text-sm',
                                                step.completed ||
                                                    step.current
                                                    ? 'text-slate-600'
                                                    : 'text-slate-400',
                                            ]">
                                                {{ step.description }}
                                            </p>
                                            <p v-if="step.completedAt" class="mt-2 text-xs font-bold text-emerald-600">
                                                Completed:
                                                {{
                                                    formatDate(step.completedAt)
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Client Company Info (if available) -->
                            <div v-if="project.client_company" v-reveal
                                class="rounded-[3rem] border border-emerald-100 bg-emerald-50 p-10">
                                <h2 class="mb-6 text-3xl font-black tracking-tighter text-emerald-900">
                                    Client Information
                                </h2>
                                <div class="space-y-4">
                                    <div>
                                        <p class="mb-1 text-xs font-bold tracking-widest text-emerald-600 uppercase">
                                            Company Name
                                        </p>
                                        <p class="text-xl font-black text-emerald-900">
                                            {{ project.client_company.name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Sidebar -->
                        <div class="space-y-8">
                            <!-- CTA Card -->
                            <div v-reveal class="sticky top-24 rounded-[3rem] bg-slate-900 p-8 text-white">
                                <h3 class="mb-4 text-2xl font-black tracking-tighter">
                                    Interested in this project?
                                </h3>
                                <p class="mb-6 text-sm leading-relaxed text-slate-300">
                                    Get in touch with our team to learn more
                                    about investment opportunities, technical
                                    specifications, and partnership options.
                                </p>

                                <div class="space-y-3">
                                    <button @click="openInterestModal"
                                        class="w-full rounded-2xl bg-emerald-600 py-4 font-bold tracking-widest text-white uppercase transition-all hover:bg-emerald-700">
                                        Express Interest
                                    </button>
                                    <button @click="openQuestionModal"
                                        class="w-full rounded-2xl border-2 border-white py-4 font-bold tracking-widest text-white uppercase transition-all hover:bg-white hover:text-slate-900">
                                        Ask a Question
                                    </button>
                                    <button @click="openInceptionModalFromSidebar"
                                        class="w-full rounded-2xl bg-white/10 py-4 font-bold tracking-widest text-white uppercase transition-all hover:bg-white/20">
                                        Initiate Inception Meeting
                                    </button>
                                </div>

                                <div class="mt-8 border-t border-white/10 pt-8">
                                    <p class="mb-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                        Contact Information
                                    </p>
                                    <div class="space-y-3 text-sm">
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                            <span>+254 794 833 868</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>Kitisuru, Nairobi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Benefits -->
                            <div v-reveal
                                class="rounded-[3rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50">
                                <h3 class="mb-6 text-xl font-black tracking-tighter text-slate-900">
                                    Key Benefits
                                </h3>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                                            <svg class="h-4 w-4 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-slate-600">Clean, renewable energy
                                            generation</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                                            <svg class="h-4 w-4 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-slate-600">Significant carbon footprint
                                            reduction</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                                            <svg class="h-4 w-4 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-slate-600">Local job creation and economic
                                            growth</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                                            <svg class="h-4 w-4 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-slate-600">Long-term sustainable returns</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Interest + Inception Wizard Modal -->
            <Transition name="fade">
                <div v-if="showInterestModal"
                    class="fixed inset-0 z-[250] flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur-xl"
                    @click="closeInterestModal">
                    <div @click.stop
                        class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white shadow-2xl">
                        <div
                            class="sticky top-0 flex items-center justify-between rounded-t-3xl border-b border-slate-200 bg-white p-8">
                            <div>
                                <h3 class="text-3xl font-black text-slate-900">
                                    <span v-if="engagementStep === 1">Express Interest</span>
                                    <span v-else>Initiate Inception Meeting</span>
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ project.name }}
                                </p>
                            </div>
                            <button @click="closeInterestModal"
                                class="text-slate-400 transition-colors hover:text-slate-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form @submit.prevent="handleEngagementSubmit" class="space-y-6 p-8">
                            <!-- Step indicator -->
                            <div class="mb-2 flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <div :class="[
                                        'flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold',
                                        engagementStep === 1
                                            ? 'bg-emerald-600 text-white'
                                            : 'bg-emerald-100 text-emerald-700',
                                    ]">
                                        1
                                    </div>
                                    <span class="text-xs font-semibold tracking-widest text-slate-500 uppercase">
                                        Interest
                                    </span>
                                </div>
                                <div class="h-px flex-1 bg-slate-200"></div>
                                <div class="flex items-center gap-2">
                                    <div :class="[
                                        'flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold',
                                        engagementStep === 2
                                            ? 'bg-emerald-600 text-white'
                                            : 'bg-slate-100 text-slate-500',
                                    ]">
                                        2
                                    </div>
                                    <span class="text-xs font-semibold tracking-widest text-slate-500 uppercase">
                                        Inception Meeting
                                    </span>
                                </div>
                            </div>

                            <!-- Step 1: Interest details -->
                            <div v-if="engagementStep === 1" class="space-y-6">
                                <p class="text-xs text-slate-500">
                                    Start by telling us about your company and
                                    the nature of your interest in this project.
                                    You'll confirm inception meeting preferences
                                    in the next step.
                                </p>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Company Name
                                            *</label>
                                        <input v-model="interestForm.company_name" type="text" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="Your Company Ltd" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Contact Person
                                            *</label>
                                        <input v-model="interestForm.contact_person
                                            " type="text" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="John Doe" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Email Address
                                            *</label>
                                        <input v-model="interestForm.email" type="email" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="john@company.com" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Phone Number
                                            *</label>
                                        <input v-model="interestForm.phone" type="tel" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="+254 700 000 000" />
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Interest Type *</label>
                                    <select v-model="interestForm.interest_type" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500">
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
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Message
                                        (Optional)</label>
                                    <textarea v-model="interestForm.message" rows="4"
                                        class="w-full resize-none rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Tell us more about your interest..."></textarea>
                                </div>

                                <div class="flex gap-4 pt-4">
                                    <button type="button" @click="closeInterestModal"
                                        class="flex-1 rounded-xl border-2 border-slate-300 px-6 py-4 font-bold text-slate-700 transition-colors hover:bg-slate-50">
                                        Cancel
                                    </button>
                                    <button type="button" @click="goToInceptionStep"
                                        class="flex-1 rounded-xl bg-emerald-600 px-6 py-4 font-bold text-white transition-colors hover:bg-emerald-700">
                                        Continue to Inception Meeting
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Inception meeting preferences -->
                            <div v-else class="space-y-6">
                                <div
                                    class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
                                    <p class="mb-1 font-semibold">
                                        Inception Meeting Preferences
                                    </p>
                                    <p>
                                        We’ll generate a secure onboarding link
                                        after you submit this form.
                                    </p>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Meeting Mode *</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <button type="button" @click="
                                            inceptionForm.meeting_mode =
                                            'online'
                                            " :class="[
                                                'flex items-center justify-center gap-2 rounded-2xl border px-4 py-3 text-sm font-semibold transition-all',
                                                inceptionForm.meeting_mode ===
                                                    'online'
                                                    ? 'border-emerald-600 bg-emerald-600 text-white shadow-lg shadow-emerald-200'
                                                    : 'border-slate-200 bg-white text-slate-700 hover:border-emerald-300',
                                            ]">
                                            <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                                            <span>Online</span>
                                        </button>
                                        <button type="button" @click="
                                            inceptionForm.meeting_mode =
                                            'physical'
                                            " :class="[
                                                'flex items-center justify-center gap-2 rounded-2xl border px-4 py-3 text-sm font-semibold transition-all',
                                                inceptionForm.meeting_mode ===
                                                    'physical'
                                                    ? 'border-emerald-600 bg-emerald-600 text-white shadow-lg shadow-emerald-200'
                                                    : 'border-slate-200 bg-white text-slate-700 hover:border-emerald-300',
                                            ]">
                                            <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                                            <span>Physical</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Company Name
                                            *</label>
                                        <input v-model="inceptionForm.company_name" type="text" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="Your Company Ltd" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Contact Person
                                            *</label>
                                        <input v-model="inceptionForm.contact_person
                                            " type="text" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="John Doe" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Email Address
                                            *</label>
                                        <input v-model="inceptionForm.email" type="email" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="john@company.com" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-slate-700">Phone Number
                                            *</label>
                                        <input v-model="inceptionForm.phone" type="tel" required
                                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                            placeholder="+254 700 000 000" />
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Project Name *</label>
                                    <input v-model="inceptionForm.project_name" type="text" readonly
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-black" />
                                </div>

                                <div>
                                    <label class="mb-3 block text-sm font-bold text-slate-700">Questions for the Meeting
                                        (Optional)</label>
                                    <div class="space-y-3">
                                        <div v-for="(
question, index
                                            ) in inceptionForm.questions" :key="index" class="flex gap-2">
                                            <input v-model="inceptionForm.questions[
                                                index
                                            ]
                                                " type="text"
                                                class="flex-1 rounded-xl border border-slate-300 px-4 py-3 text-black transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                                :placeholder="'Question ' + (index + 1)
                                                    " />
                                            <button v-if="
                                                inceptionForm.questions
                                                    .length > 1
                                            " type="button" @click="
                                                removeInceptionQuestion(
                                                    index,
                                                )
                                                "
                                                class="rounded-xl px-4 py-3 text-red-600 transition-colors hover:bg-red-50">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <button v-if="
                                            inceptionForm.questions.length <
                                            5
                                        " type="button" @click="addInceptionQuestion"
                                            class="w-full rounded-xl border-2 border-dashed border-slate-300 px-4 py-3 font-medium text-slate-600 transition-colors hover:border-emerald-500 hover:text-emerald-600">
                                            + Add Another Question
                                        </button>
                                    </div>
                                </div>

                                <div class="flex gap-4 pt-4">
                                    <button type="button" @click="engagementStep = 1"
                                        class="flex-1 rounded-xl border-2 border-slate-300 px-6 py-4 font-bold text-slate-700 transition-colors hover:bg-slate-50">
                                        Back
                                    </button>
                                    <button type="submit" :disabled="isSubmittingEngagement"
                                        class="flex-1 rounded-xl bg-emerald-600 px-6 py-4 font-bold text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                                        <span v-if="isSubmittingEngagement">Processing...</span>
                                        <span v-else>Submit &amp; Generate QR</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </Transition>

            <!-- Question Modal -->
            <Transition name="fade">
                <div v-if="showQuestionModal"
                    class="fixed inset-0 z-[250] flex items-center justify-center bg-slate-900/60 p-6 backdrop-blur-xl"
                    @click="closeQuestionModal">
                    <div @click.stop
                        class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white shadow-2xl">
                        <div
                            class="sticky top-0 flex items-center justify-between rounded-t-3xl border-b border-slate-200 bg-white p-8">
                            <div>
                                <h3 class="text-3xl font-black text-slate-900">
                                    Ask a Question
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ project.name }}
                                </p>
                            </div>
                            <button @click="closeQuestionModal"
                                class="text-slate-400 transition-colors hover:text-slate-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form @submit.prevent="submitQuestion" class="space-y-6 p-8">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Company Name *</label>
                                    <input v-model="questionForm.company_name" type="text" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Your Company Ltd" />
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Contact Person *</label>
                                    <input v-model="questionForm.contact_person" type="text" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="John Doe" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Email Address *</label>
                                    <input v-model="questionForm.email" type="email" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="john@company.com" />
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-slate-700">Phone Number *</label>
                                    <input v-model="questionForm.phone" type="tel" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                        placeholder="+254 700 000 000" />
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-bold text-slate-700">Your Question *</label>
                                <textarea v-model="questionForm.question" rows="5" required
                                    class="w-full resize-none rounded-xl border border-slate-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="What would you like to know about this project?"></textarea>
                            </div>
                            <div class="flex gap-4 pt-4">
                                <button type="button" @click="closeQuestionModal"
                                    class="flex-1 rounded-xl border-2 border-slate-300 px-6 py-4 font-bold text-slate-700 transition-colors hover:bg-slate-50">
                                    Cancel
                                </button>
                                <button type="submit" :disabled="isSubmittingQuestion"
                                    class="flex-1 rounded-xl bg-emerald-600 px-6 py-4 font-bold text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                                    <span v-if="isSubmittingQuestion">Submitting...</span>
                                    <span v-else>Submit Question</span>
                                </button>
                            </div>
                        </form>
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
    id: number;
    uuid: string;
    name: string;
    description: string | null;
    project_type: 'SOLAR' | 'BESS' | 'SOLAR_BESS' | 'OTHER';
    capacity_mw: number | null;
    location: string | null;
    current_step: number;
    nda_signed_at: string | null;
    inception_completed_at: string | null;
    rfq_completed_at: string | null;
    created_at: string;
    client_company?: {
        name: string;
    };
    images?: Array<{
        id: number;
        project_id: number;
        path: string;
        is_primary: boolean;
        created_at: string;
        updated_at: string;
    }>;
}

const props = defineProps<{
    project: Project;
}>();

const primaryImage = computed(() => {
    if (!props.project.images || props.project.images.length === 0) return null;
    return props.project.images.find(img => img.is_primary) || props.project.images[0];
});

// Modal states
const showInterestModal = ref(false);
const showQuestionModal = ref(false);
const engagementStep = ref<1 | 2>(1);
const isSubmittingEngagement = ref(false);
const isSubmittingQuestion = ref(false);

// Forms
const interestForm = reactive({
    project_name: props.project.name,
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    interest_type: 'general',
    message: '',
});

const questionForm = reactive({
    project_name: props.project.name,
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    question: '',
});

const inceptionForm = reactive({
    project_name: props.project.name,
    company_name: '',
    contact_person: '',
    email: '',
    phone: '',
    meeting_mode: 'online' as 'online' | 'physical',
    questions: [''] as string[],
});

const projectSteps = computed(() => [
    {
        title: 'Inception Meeting',
        description: 'Initial project discussion and alignment',
        completed: props.project.current_step > 1,
        current: props.project.current_step === 1,
        completedAt: props.project.inception_completed_at,
    },
    {
        title: 'NDA Signing',
        description: 'Confidentiality agreement execution',
        completed: props.project.current_step > 2,
        current: props.project.current_step === 2,
        completedAt: props.project.nda_signed_at,
    },
    {
        title: 'RFQ & Documentation',
        description: 'Technical and financial documentation',
        completed: props.project.current_step > 3,
        current: props.project.current_step === 3,
        completedAt: props.project.rfq_completed_at,
    },
    {
        title: 'Site Visit',
        description: 'Physical assessment and validation',
        completed: props.project.current_step > 4,
        current: props.project.current_step === 4,
        completedAt: null,
    },
    {
        title: 'Compliance Review',
        description: 'Regulatory and legal compliance',
        completed: props.project.current_step > 5,
        current: props.project.current_step === 5,
        completedAt: null,
    },
    {
        title: 'Contract Signing',
        description: 'Formal agreement execution',
        completed: props.project.current_step > 6,
        current: props.project.current_step === 6,
        completedAt: null,
    },
    {
        title: 'Implementation',
        description: 'Project execution and delivery',
        completed: props.project.current_step > 7,
        current: props.project.current_step === 7,
        completedAt: null,
    },
]);

const getProjectTypeBadge = () => {
    const badges: Record<string, string> = {
        SOLAR: 'bg-amber-500 text-white',
        BESS: 'bg-blue-500 text-white',
        SOLAR_BESS: 'bg-purple-500 text-white',
        OTHER: 'bg-slate-500 text-white',
    };
    return badges[props.project.project_type] || badges.OTHER;
};

const formatProjectType = (type: string) => {
    const types: Record<string, string> = {
        SOLAR: 'Solar PV',
        BESS: 'Battery Storage',
        SOLAR_BESS: 'Solar + BESS',
        OTHER: 'Renewable Energy',
    };
    return types[type] || type;
};

const getTechnologyType = () => {
    const tech: Record<string, string> = {
        SOLAR: 'Photovoltaic Solar Panels',
        BESS: 'Battery Energy Storage System',
        SOLAR_BESS: 'Hybrid Solar + Storage',
        OTHER: 'Renewable Energy Technology',
    };
    return tech[props.project.project_type] || 'Renewable Energy';
};

const getProjectStatus = () => {
    if (props.project.current_step === 1) return 'Initiating';
    if (props.project.current_step <= 3) return 'Planning';
    if (props.project.current_step <= 5) return 'In Progress';
    if (props.project.current_step === 6) return 'Contracting';
    return 'Active';
};

const formatDate = (date: string | null) => {
    if (!date) return '';
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

const openInterestModal = () => {
    engagementStep.value = 1;
    showInterestModal.value = true;
};

const closeInterestModal = () => {
    showInterestModal.value = false;
    engagementStep.value = 1;
};

const openQuestionModal = () => {
    showQuestionModal.value = true;
};

const closeQuestionModal = () => {
    showQuestionModal.value = false;
};

const openInceptionModalFromSidebar = () => {
    // Jump directly to step 2 but keep a single wizard experience
    interestForm.project_name = props.project.name;
    inceptionForm.project_name = props.project.name;
    engagementStep.value = 2;
    showInterestModal.value = true;
};

const goToInceptionStep = () => {
    // Prefill inception form with interest data
    inceptionForm.company_name = interestForm.company_name;
    inceptionForm.contact_person = interestForm.contact_person;
    inceptionForm.email = interestForm.email;
    inceptionForm.phone = interestForm.phone;
    inceptionForm.project_name = interestForm.project_name;
    engagementStep.value = 2;
};

const handleEngagementSubmit = () => {
    if (engagementStep.value === 1) {
        goToInceptionStep();
        return;
    }

    isSubmittingEngagement.value = true;

    // First record interest, then initiate inception meeting
    router.post('/projects/record-interest', interestForm, {
        onSuccess: () => {
            router.post('/initiate-inception', inceptionForm, {
                onSuccess: () => {
                    closeInterestModal();
                },
                onError: () => {
                    alert(
                        'There was an error initiating the inception meeting. Please try again.',
                    );
                },
                onFinish: () => {
                    isSubmittingEngagement.value = false;
                },
            });
        },
        onError: () => {
            alert(
                'There was an error submitting your interest. Please check the details and try again.',
            );
            isSubmittingEngagement.value = false;
        },
    });
};

const submitQuestion = () => {
    isSubmittingQuestion.value = true;
    router.post('/projects/ask-question', questionForm, {
        onSuccess: () => {
            closeQuestionModal();
            alert('Your question has been submitted. We will respond shortly.');
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

const addInceptionQuestion = () => {
    if (inceptionForm.questions.length < 5) {
        inceptionForm.questions.push('');
    }
};

const removeInceptionQuestion = (index: number) => {
    if (inceptionForm.questions.length > 1) {
        inceptionForm.questions.splice(index, 1);
    }
};

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
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.prose {
    max-width: none;
}
</style>
