<template>
    <HomeLayout>

        <section
            id="hero"
            class="relative flex min-h-screen items-center justify-center overflow-hidden"
        >
            <div class="absolute inset-0 z-0">
                <img
                    src="/images/Hero.png"
                    class="motion-safe:animate-slow-zoom h-full w-full scale-110 object-cover"
                    alt="Kenyan Solar Landscape"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/60 to-transparent"
                ></div>
            </div>

            <div
                class="relative z-10 mx-auto grid max-w-7xl items-center gap-16 px-6 pt-20 lg:grid-cols-2"
            >
                <div v-reveal class="space-y-8 text-left">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-4 py-2 backdrop-blur-md"
                    >
                        <span
                            class="text-[10px] font-bold tracking-[0.2em] text-emerald-400 uppercase"
                            >Invest. Protect. Prosper.</span
                        >
                    </div>

                    <h1
                        class="text-5xl leading-[0.9] font-black tracking-tighter text-white uppercase md:text-8xl"
                    >
                        Powering <br />
                        <span class="text-emerald-500">Kenyan</span> <br />
                        Energy.
                    </h1>

                    <p
                        class="max-w-lg text-lg leading-relaxed font-medium text-slate-300"
                    >
                        Facilitating end-to-end EPC execution for utility-scale
                        solar PV and BESS projects across the East African
                        region[cite: 7, 10].
                    </p>

                    <div class="flex flex-col gap-5 sm:flex-row">
                        <button
                            @click="scrollTo('portfolio')"
                            class="group flex items-center justify-center gap-3 rounded-xl bg-white px-8 py-4 font-bold text-slate-900 transition-all duration-300 hover:bg-emerald-500 hover:text-white"
                        >
                            View Active RFQs
                            <span
                                class="transition-transform group-hover:translate-x-1"
                                >→</span
                            >
                        </button>
                        <a
                            href="/our-process"
                            class="rounded-xl border border-white/20 bg-white/5 px-8 py-4 text-center font-bold text-white backdrop-blur-md transition-all hover:bg-white/10"
                        >
                            Our 7-Step Process
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="relative z-20 bg-white px-6 py-32">
            <div class="mx-auto max-w-7xl">
                <div class="mb-20" v-reveal>
                    <h2
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-emerald-600 uppercase"
                    >
                        Core Competencies
                    </h2>
                    <h3
                        class="text-4xl font-black tracking-tighter text-slate-900 md:text-6xl"
                    >
                        Strategic Consultancy.
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div
                        v-for="service in services"
                        :key="service.title"
                        v-reveal
                        class="group rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all hover:border-emerald-500"
                    >
                        <div
                            class="mb-6 text-3xl transition-transform group-hover:scale-110"
                        >
                            {{ service.icon }}
                        </div>
                        <h4
                            class="mb-4 text-xl font-black text-slate-900 uppercase"
                        >
                            {{ service.title }}
                        </h4>
                        <p class="mb-6 text-sm leading-relaxed text-slate-500">
                            {{ service.desc }}
                        </p>
                        <ul class="space-y-2">
                            <li
                                v-for="item in service.items"
                                :key="item"
                                class="flex items-center gap-2 text-[11px] font-bold tracking-widest text-slate-400 uppercase"
                            >
                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                ></span>
                                {{ item }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section
            id="portfolio"
            class="mx-6 rounded-[4rem] bg-slate-900 px-6 py-24 text-white"
        >
            <div class="mx-auto max-w-7xl">
                <div
                    class="mb-16 flex flex-col justify-between gap-6 md:flex-row md:items-end"
                >
                    <div v-reveal>
                        <h2
                            class="mb-4 text-[10px] font-bold tracking-[0.4em] text-emerald-500 uppercase"
                        >
                            Active Engagements
                        </h2>
                        <h3
                            class="text-4xl font-black tracking-tighter md:text-6xl"
                        >
                            Utility Assets.
                        </h3>
                    </div>
                    <p
                        class="max-w-sm border-l-2 border-emerald-500 pl-6 font-medium text-slate-400"
                    >
                        Managing 80MW+ of solar capacity, including
                        high-capacity Battery Energy Storage Systems
                        (BESS)[cite: 7, 243].
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
                    <div
                        v-for="project in projects"
                        :key="project.name"
                        v-reveal
                        class="group relative aspect-[16/10] overflow-hidden rounded-[3rem] border border-white/10"
                    >
                        <img
                            :src="project.image"
                            class="h-full w-full object-cover opacity-60 transition-all duration-1000 group-hover:scale-105"
                        />
                        <div
                            class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent p-12"
                        >
                            <span
                                class="mb-3 text-xs font-bold tracking-widest text-emerald-400 uppercase"
                                >{{ project.location }}</span
                            >
                            <h4 class="mb-4 text-3xl font-black">
                                {{ project.name }}
                            </h4>
                            <div class="flex gap-4">
                                <span
                                    class="rounded-full bg-white/10 px-4 py-1.5 text-[10px] font-bold tracking-widest uppercase backdrop-blur-md"
                                    >{{ project.capacity }}</span
                                >
                                <span
                                    v-if="project.bess"
                                    class="rounded-full bg-emerald-600/20 px-4 py-1.5 text-[10px] font-bold tracking-widest text-emerald-400 uppercase backdrop-blur-md"
                                    >BESS Integrated</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';

const services = [
    {
        title: 'Project Facilitation',
        icon: '⚡',
        desc: 'Contract review, execution, and facilitation of site visits for international EPC contractors[cite: 249, 252].',
        items: ['EPC Finalization', 'Securities Review', 'Site Logistics'],
    },
    {
        title: 'Regulatory & Compliance',
        icon: '📜',
        desc: 'Liaising with EPRA, NEMA, and local authorities for licenses and permitting[cite: 256, 258].',
        items: ['EPRA Licensing', 'NEMA/EMCA 1999', 'Grid Code Compliance'],
    },
    {
        title: 'Company Regularization',
        icon: '🏗️',
        desc: 'Assisting foreign entities with Kenyan company registration, KRA PIN, and local bank accounts[cite: 260, 309].',
        items: ['Local Registration', 'Tax Compliance', 'Strategic Advisory'],
    },
];

const projects = [
    {
        name: 'Kimuka 2 Solar PV',
        location: 'Kajiado County, Kenya [cite: 7]',
        capacity: '40MW Grid Connected [cite: 7]',
        bess: true,
        image: 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=2070&auto=format&fit=crop',
    },
    {
        name: 'Nyakwere Hills Solar',
        location: 'Nyakwere, Kenya [cite: 243]',
        capacity: '40MW EPC Project [cite: 243]',
        bess: false,
        image: 'https://images.unsplash.com/photo-1466611653911-95282fc3656b?q=80&w=2070&auto=format&fit=crop',
    },
];

const renewableLinks = [
  'Solar Energy Solutions',
  'Wind Energy Systems',
  'Geothermal Power Solutions',
  'Advanced Biofuels Technology',
  'Waste-to-Energy Innovations'
]

const footerLinks = {
    solutions: [
        { text: 'Technical Advisory', url: '#' },
        { text: '7-Step Process', url: '/our-process' },
        { text: 'RFQ Templates', url: '#' },
    ],
    legal: [
        { text: 'Privacy Policy', url: '#' },
        { text: 'Terms of Service', url: '#' },
        { text: 'NDA Agreement', url: '#' },
    ],
    contact: [
        { text: 'Kitisuru, Nairobi', url: '#' },
        { text: '+254 794 833 868', url: '#' },
        { text: 'LinkedIn', url: '#' },
    ],
};

const vReveal = {
    mounted: (el: HTMLElement) => {
        el.classList.add(
            'opacity-0',
            'translate-y-12',
            'transition-all',
            'duration-1000',
            'ease-out',
        );
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        el.classList.remove('opacity-0', 'translate-y-12');
                        el.classList.add('opacity-100', 'translate-y-0');
                    }
                });
            },
            { threshold: 0.1 },
        );
        observer.observe(el);
    },
};

const scrollTo = (id: string) => {
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
};
</script>

<style>
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
html {
    scroll-behavior: smooth;
    scrollbar-width: none;
}
::-webkit-scrollbar {
    display: none;
}
</style>
