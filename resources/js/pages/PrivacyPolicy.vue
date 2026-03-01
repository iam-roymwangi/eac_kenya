<template>
    <HomeLayout>
        <div
            class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-100"
        >
            <section
                class="relative overflow-hidden rounded-b-[3rem] bg-slate-900 px-6 py-20 text-white"
            >
                <div class="relative z-10 mx-auto max-w-4xl text-center">
                    <h1
                        v-reveal
                        class="mb-4 text-4xl font-black tracking-tighter uppercase md:text-6xl"
                    >
                        Privacy <span class="text-emerald-500">Policy.</span>
                    </h1>
                    <p
                        v-reveal
                        class="text-xs font-bold tracking-[0.2em] text-slate-400 uppercase"
                    >
                        Last Updated: February 3, 2026
                    </p>
                </div>
            </section>

            <section class="px-6 py-20">
                <div class="mx-auto flex max-w-7xl flex-col gap-16 lg:flex-row">
                    <aside class="lg:w-1/4">
                        <div class="sticky top-32 space-y-4">
                            <p
                                class="mb-6 text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                            >
                                Contents
                            </p>
                            <nav class="flex flex-col gap-2">
                                <a
                                    v-for="section in sections"
                                    :key="section.id"
                                    :href="'#' + section.id"
                                    class="border-l-2 border-transparent pl-4 text-sm font-bold text-slate-500 transition-colors hover:border-emerald-500 hover:text-emerald-600"
                                >
                                    {{ section.title }}
                                </a>
                            </nav>
                        </div>
                    </aside>

                    <div
                        class="rounded-[3rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50 md:p-16 lg:w-3/4"
                    >
                        <div class="prose prose-slate max-w-none space-y-12">
                            <section id="introduction" v-reveal>
                                <h2
                                    class="mb-6 text-3xl font-black tracking-tighter text-slate-900 uppercase"
                                >
                                    1. Introduction
                                </h2>
                                <p
                                    class="leading-relaxed font-medium text-slate-600"
                                >
                                    EAC Green Group Ltd ("we", "us", or "the
                                    Consultant") is committed to protecting the
                                    privacy and confidentiality of our clients,
                                    specifically EPC contractors and
                                    stakeholders involved in our renewable
                                    energy projects[cite: 140, 239]. This policy
                                    outlines how we handle data during our
                                    7-step client handling process[cite: 102].
                                </p>
                            </section>

                            <section id="data-collection" v-reveal>
                                <h2
                                    class="mb-6 text-3xl font-black tracking-tighter text-slate-900 uppercase"
                                >
                                    2. Data We Collect
                                </h2>
                                <p
                                    class="mb-4 leading-relaxed font-medium text-slate-600"
                                >
                                    In the course of providing consultancy
                                    services for projects such as the Kimuka 2
                                    Solar PV plant[cite: 7], we collect:
                                </p>
                                <ul
                                    class="grid list-none grid-cols-1 gap-4 p-0 md:grid-cols-2"
                                >
                                    <li
                                        v-for="item in dataItems"
                                        :key="item"
                                        class="flex items-center gap-3 rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-700"
                                    >
                                        <span
                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                        ></span>
                                        {{ item }}
                                    </li>
                                </ul>
                            </section>

                            <section id="confidentiality" v-reveal>
                                <h2
                                    class="mb-6 text-3xl font-black tracking-tighter text-slate-900 uppercase"
                                >
                                    3. Confidentiality & NDAs
                                </h2>
                                <div
                                    class="rounded-3xl border border-emerald-100 bg-emerald-50 p-8"
                                >
                                    <p
                                        class="mb-4 font-bold text-emerald-900 italic"
                                    >
                                        "Technical, financial, and strategic
                                        information remains confidential."
                                        [cite: 142]
                                    </p>
                                    <p
                                        class="text-sm leading-relaxed text-emerald-800/80"
                                    >
                                        Per our standard operating procedure, an
                                        NDA must be executed before any detailed
                                        discussions or document exchanges
                                        occur[cite: 142]. This obligation
                                        survives for one year after the
                                        termination of our consultancy
                                        agreements[cite: 318].
                                    </p>
                                </div>
                            </section>

                            <section id="regulatory-sharing" v-reveal>
                                <h2
                                    class="mb-6 text-3xl font-black tracking-tighter text-slate-900 uppercase"
                                >
                                    4. Regulatory Disclosure
                                </h2>
                                <p
                                    class="leading-relaxed font-medium text-slate-600"
                                >
                                    To facilitate project success, we may share
                                    relevant technical data with Kenyan
                                    regulatory bodies, including EPRA and NEMA,
                                    specifically for licensing and
                                    interconnection purposes[cite: 48, 49, 258].
                                </p>
                            </section>

                            <section id="contact-privacy" v-reveal>
                                <h2
                                    class="mb-6 text-3xl font-black tracking-tighter text-slate-900 uppercase"
                                >
                                    5. Contact Information
                                </h2>
                                <p
                                    class="leading-relaxed font-medium text-slate-600"
                                >
                                    For questions regarding data privacy, please
                                    contact our Kitisuru office at
                                    (+254)-794-833-868 or email
                                    info.eacgreengroup.co.ke[cite: 87, 235].
                                </p>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';
const sections = [
    { id: 'introduction', title: 'Introduction' },
    { id: 'data-collection', title: 'Data We Collect' },
    { id: 'confidentiality', title: 'Confidentiality' },
    { id: 'regulatory-sharing', title: 'Regulatory Disclosure' },
    { id: 'contact-privacy', title: 'Contact' },
];

const dataItems = [
    'Technical Project Layouts',
    'Company Registration Docs',
    'Personnel CVs/IDs',
    'Financial Statements',
    'Bill of Quantities (BoQ)',
    'Regulatory Permits',
];

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
