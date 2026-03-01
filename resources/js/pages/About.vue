<template>
    <HomeLayout>
        <section class="relative overflow-hidden bg-slate-900 px-6 pt-32 pb-20">
            <div class="absolute inset-0 opacity-40">
                <img
                    src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?q=80&w=2070"
                    class="h-full w-full object-cover"
                    alt="Energy Infrastructure"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-900/80 to-slate-900"
                ></div>
            </div>

            <div class="relative z-10 mx-auto max-w-7xl">
                <div v-reveal class="max-w-3xl">
                    <div class="mb-8 flex items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-600 shadow-lg shadow-emerald-500/20"
                        >
                            <span class="text-2xl font-black text-white"
                                >E</span
                            >
                        </div>
                        <h1
                            class="text-3xl font-black tracking-tighter text-white"
                        >
                            EAC GROUP
                        </h1>
                    </div>
                    <h2
                        class="mb-8 text-5xl leading-[0.9] font-black tracking-tighter text-white md:text-7xl"
                    >
                        Invest. Protect.
                        <span class="text-emerald-500 italic">Prosper.</span>
                    </h2>
                    <p
                        class="text-xl leading-relaxed font-medium text-slate-400"
                    >
                        A leading Special Purpose Vehicle (SPV) management and
                        EPC consultancy based in Kitisuru, Nairobi. We
                        specialize in the turnkey delivery of utility-scale
                        renewable energy assets.
                    </p>
                </div>
            </div>
        </section>

        <section class="px-6 py-24">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-16 lg:grid-cols-12">
                    <div class="lg:col-span-4" v-reveal>
                        <h3
                            class="mb-4 text-xs font-black tracking-[0.3em] text-emerald-600 uppercase"
                        >
                            Scope of Work
                        </h3>
                        <h4 class="mb-6 text-4xl font-black tracking-tighter">
                            Complete Project Execution.
                        </h4>
                        <p class="font-medium text-slate-500">
                            From initial engineering to grid synchronization,
                            our EPC framework ensures every asset is grid-ready
                            and high-performing.
                        </p>
                    </div>

                    <div class="grid gap-8 md:grid-cols-2 lg:col-span-8">
                        <div
                            v-for="item in scopeItems"
                            :key="item.title"
                            v-reveal
                            class="rounded-[2rem] border border-slate-100 bg-slate-50 p-8 transition-colors hover:border-emerald-200"
                        >
                            <div class="mb-4 text-3xl">{{ item.icon }}</div>
                            <h5 class="mb-3 text-lg font-black">
                                {{ item.title }}
                            </h5>
                            <ul class="space-y-2">
                                <li
                                    v-for="point in item.points"
                                    :key="point"
                                    class="flex items-start gap-2 text-sm text-slate-500"
                                >
                                    <span class="mt-1 text-emerald-500">●</span>
                                    {{ point }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-4 rounded-[4rem] bg-slate-900 px-6 py-24 text-white">
            <div class="mx-auto max-w-7xl">
                <div class="mb-16 text-center">
                    <h3
                        class="mb-4 text-xs font-black tracking-[0.3em] text-emerald-500 uppercase"
                    >
                        Operational Pipeline
                    </h3>
                    <h4 class="text-5xl font-black tracking-tighter">
                        Utility-Scale Leadership.
                    </h4>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <div
                        v-for="project in keyProjects"
                        :key="project.name"
                        v-reveal
                        class="group relative overflow-hidden rounded-[3rem] border border-white/5 bg-slate-800"
                    >
                        <div class="space-y-6 p-10">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-black tracking-widest text-emerald-400 uppercase"
                                        >Current Engagement</span
                                    >
                                    <h5
                                        class="mt-2 text-3xl font-black tracking-tighter"
                                    >
                                        {{ project.name }}
                                    </h5>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-white">
                                        {{ project.capacity }}
                                    </p>
                                    <p
                                        class="text-[10px] font-bold text-slate-500 uppercase"
                                    >
                                        {{ project.location }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-sm leading-relaxed text-slate-400">
                                {{ project.details }}
                            </p>
                            <div
                                class="flex gap-4 border-t border-white/10 pt-6"
                            >
                                <div
                                    class="rounded-xl bg-white/5 px-4 py-2 text-[10px] font-bold tracking-widest uppercase"
                                >
                                    BESS Integrated
                                </div>
                                <div
                                    class="rounded-xl bg-white/5 px-4 py-2 text-[10px] font-bold tracking-widest uppercase"
                                >
                                    Grid Connected
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 py-24">
            <div class="mx-auto max-w-7xl">
                <div class="mx-auto mb-20 max-w-2xl text-center">
                    <h3
                        class="mb-4 text-xs font-black tracking-[0.3em] text-emerald-600 uppercase"
                    >
                        Technical Compliance
                    </h3>
                    <h4 class="text-4xl font-black tracking-tighter">
                        Global Standards. Local Excellence.
                    </h4>
                </div>

                <div class="grid gap-12 md:grid-cols-3">
                    <div
                        v-for="group in standards"
                        :key="group.category"
                        v-reveal
                        class="space-y-6"
                    >
                        <h5
                            class="border-b border-slate-200 pb-4 text-sm font-black tracking-widest uppercase"
                        >
                            {{ group.category }}
                        </h5>
                        <ul class="space-y-4">
                            <li
                                v-for="std in group.items"
                                :key="std.code"
                                class="group"
                            >
                                <p
                                    class="text-xs font-black text-slate-900 transition-colors group-hover:text-emerald-600"
                                >
                                    {{ std.code }}
                                </p>
                                <p
                                    class="text-xs tracking-tighter text-slate-500 uppercase"
                                >
                                    {{ std.desc }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <footer class="border-t border-slate-200 bg-slate-50 px-6 pt-20 pb-10">
            <div class="mx-auto grid max-w-7xl items-end gap-12 md:grid-cols-3">
                <div>
                    <p
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-slate-400 uppercase"
                    >
                        HQ Location
                    </p>
                    <p class="text-sm font-bold text-slate-900 uppercase">
                        Kitisuru, Kitisuru Rd
                    </p>
                    <p class="text-sm font-bold text-slate-900">
                        Nairobi, Kenya
                    </p>
                </div>
                <div class="text-center">
                    <p
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-slate-400 uppercase"
                    >
                        Direct Inquiry
                    </p>
                    <p
                        class="text-sm font-black tracking-widest text-emerald-600 uppercase"
                    >
                        info@eacgreengroup.co.ke
                    </p>
                </div>
                <div class="md:text-right">
                    <p
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-slate-400 uppercase"
                    >
                        Registration
                    </p>
                    <p class="text-sm font-bold text-slate-900 uppercase">
                        Registered Special Purpose Vehicle (SPV)
                    </p>
                </div>
            </div>
        </footer>
    </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';
const scopeItems = [
    {
        icon: '📐',
        title: 'Engineering & Design',
        points: [
            'Full system layout (DC/AC)',
            'Structural mounting design',
            'SCADA & Data Acquisition',
            'BESS layout & dispatch logic',
        ],
    },
    {
        icon: '🏗️',
        title: 'Civil & Electrical',
        points: [
            'Site clearance & grading',
            'Substation construction',
            '132kV / 220kV Interconnection',
            'Trenching & Inverter stations',
        ],
    },
    {
        icon: '⚡',
        title: 'Commissioning',
        points: [
            'Cold & Hot commissioning',
            'Kenyan Grid Code validation',
            'As-Built documentation',
            'Staff O&M training',
        ],
    },
    {
        icon: '🛡️',
        title: 'Project Procurement',
        points: [
            'Tier-1 PV Module sourcing',
            'MV Transformers & Switchgear',
            'Importation & Logistics',
            'Insurance during transit',
        ],
    },
];

const keyProjects = [
    {
        name: 'Nyakwere Solar PV',
        location: 'Homabay County',
        capacity: '40 MWp + 10 MW BESS',
        details:
            'Utility-scale ground-mounted solar plant integrated with battery storage for frequency regulation and peak shifting.',
    },
    {
        name: 'Lamu Solargen Park',
        location: 'Lamu County',
        capacity: '44 MWp + 20 MWh BESS',
        details:
            'A landmark USD 98.6M project featuring high-capacity storage and grid-tied solar generation.',
    },
];

const standards = [
    {
        category: 'Kenyan Regulation',
        items: [
            { code: 'Energy Act 2019', desc: 'Licensing & Interconnection' },
            { code: 'EMCA 1999', desc: 'Environmental Management' },
            { code: 'NEMA ESIA', desc: 'Compliance & Impact Assessment' },
        ],
    },
    {
        category: 'Solar & Grid Quality',
        items: [
            { code: 'IEC 61215 & 61730', desc: 'PV Module Quality & Safety' },
            { code: 'IEEE 1547', desc: 'Smart Grid Interoperability' },
            { code: 'Kenya Grid Code', desc: 'Voltage & Frequency Stability' },
        ],
    },
    {
        category: 'Storage & Safety',
        items: [
            { code: 'IEC 62933', desc: 'BESS System Safety' },
            { code: 'ISO 45001', desc: 'Occupational Safety Compliance' },
            {
                code: 'World Bank ESS',
                desc: 'Environmental & Social Standards',
            },
        ],
    },
];

// Intersection Observer for Scroll Reveals
const vReveal = {
    mounted: (el: HTMLElement) => {
        el.classList.add(
            'opacity-0',
            'translate-y-8',
            'transition-all',
            'duration-1000',
            'ease-out',
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
@keyframes slow-zoom {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.1);
    }
}
.animate-slow-zoom {
    animation: slow-zoom 20s infinite alternate ease-in-out;
}
</style>
