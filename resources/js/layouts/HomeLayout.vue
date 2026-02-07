<template>
    <div class="min-h-screen bg-slate-50 font-sans selection:bg-emerald-200 selection:text-emerald-900">
        <div class="fixed top-0 left-0 z-[110] h-1 bg-emerald-500 transition-all duration-150"
            :style="{ width: scrollProgress + '%' }"></div>

        <nav class="fixed top-0 z-[100] w-full transition-all duration-500" :class="[
            isScrolled ? 'bg-white py-3 shadow-sm' : 'bg-transparent py-6',
        ]">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6">
                <Link href="/" class="flex cursor-pointer items-center gap-3 transition-opacity hover:opacity-80">
                    <img src="/images/EAC_Logo.svg" alt="EAC Green Group Logo" class="h-10 w-auto" />
                </Link>

                <button @click="mobileMenu = true" class="block lg:hidden"
                    :class="isScrolled ? 'text-slate-900' : 'text-white'">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16M4 16h16" />
                    </svg>
                </button>

                <div class="hidden items-center gap-8 lg:flex">
                    <div class="group relative">
                        <button
                            class="flex items-center gap-1 text-xs font-bold tracking-widest uppercase transition-colors"
                            :class="isScrolled
                                ? 'text-slate-600 hover:text-emerald-600'
                                : 'text-white/80 hover:text-white'
                                ">
                            Renewable Energy
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div
                            class="invisible absolute top-full left-0 w-64 pt-4 opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">
                            <div class="overflow-hidden rounded-2xl border border-white/10 bg-slate-900 p-4 shadow-2xl">
                                <a v-for="link in renewableLinks" :key="link" href="/projects"
                                    class="block border-b border-white/5 px-4 py-3 text-[10px] font-black tracking-[0.15em] text-white/70 uppercase transition-colors last:border-none hover:text-emerald-400">
                                    {{ link }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <button
                            class="flex items-center gap-1 text-xs font-bold tracking-widest uppercase transition-colors"
                            :class="isScrolled
                                ? 'text-slate-600 hover:text-emerald-600'
                                : 'text-white/80 hover:text-white'
                                ">
                            Water Solutions
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div
                            class="invisible absolute top-full left-0 w-64 pt-4 opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">
                            <div class="rounded-2xl border border-white/10 bg-slate-900 p-4 shadow-2xl">
                                <a href="#"
                                    class="block px-4 py-3 text-[10px] font-black tracking-[0.15em] text-white/70 uppercase hover:text-emerald-400">Infrastructure
                                    Management</a>
                            </div>
                        </div>
                    </div>

                    <Link href="/projects" class="text-xs font-bold tracking-widest uppercase transition-colors" :class="isScrolled
                        ? 'text-slate-600 hover:text-emerald-600'
                        : 'text-white/80 hover:text-white'
                        ">
                        Projects
                    </Link>

                    <Link href="/our-process" class="text-xs font-bold tracking-widest uppercase transition-colors"
                        :class="isScrolled
                            ? 'text-slate-600 hover:text-emerald-600'
                            : 'text-white/80 hover:text-white'
                            ">
                        Our Process
                    </Link>

                    <Link href="/contact"
                        class="inline-block rounded-full bg-emerald-600 px-6 py-2.5 text-[10px] font-black tracking-widest text-white uppercase transition-all hover:shadow-xl hover:shadow-emerald-200">
                        Contact Us
                    </Link>
                </div>
            </div>

        </nav>

        <slot></slot>

        <footer class="bg-white pt-24 pb-12 text-slate-900">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-20 grid grid-cols-1 gap-16 md:grid-cols-12">
                    <div class="space-y-8 md:col-span-5">
                        <div class="flex items-center gap-3">
                            <img src="/images/EAC_Logo.svg" alt="EAC Green Group Logo" class="h-10 w-auto" />
                            <span class="text-2xl font-black tracking-tighter uppercase">EAC Green Group</span>
                        </div>
                        <p class="max-w-sm font-medium text-slate-500">
                            Providing technical, regulatory, and strategic
                            insight for renewable energy infrastructure in
                            Kenya[cite: 256, 270].
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 md:col-span-7 md:grid-cols-3">
                        <div v-for="(group, title) in footerLinks" :key="title">
                            <h6 class="mb-6 text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase">
                                {{ title }}
                            </h6>
                            <ul class="space-y-4">
                                <li v-for="link in group" :key="link.text">
                                    <a :href="link.url"
                                        class="text-sm font-bold text-slate-600 transition-colors hover:text-emerald-600">{{
                                            link.text }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <Transition enter-active-class="transition duration-300 ease-out" enter-from-class="opacity-0"
        enter-to-class="opacity-100" leave-active-class="transition duration-200 ease-in" leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <div v-if="mobileMenu" class="fixed inset-0 z-[200] bg-slate-900/60 backdrop-blur-xl lg:hidden">
            <div class="flex h-full flex-col bg-white p-8">
                <div class="flex items-center justify-between">
                    <img src="/images/EAC_Logo.svg" alt="Logo" class="h-8 w-auto" />
                    <button @click="mobileMenu = false" class="text-slate-900">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mt-16 flex flex-col gap-8">
                    <Link href="/projects" @click="mobileMenu = false"
                        class="text-2xl font-black tracking-tight text-slate-900 uppercase">Projects</Link>
                    <Link href="/our-process" @click="mobileMenu = false"
                        class="text-2xl font-black tracking-tight text-slate-900 uppercase">Our Process</Link>

                    <div class="h-px w-full bg-slate-100"></div>

                    <p class="text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase">Services</p>
                    <Link v-for="link in renewableLinks" :key="link" href="/projects" @click="mobileMenu = false"
                        class="text-lg font-bold text-slate-600">
                        {{ link }}
                    </Link>
                </div>

                <div class="mt-auto">
                    <Link href="/contact" @click="mobileMenu = false"
                        class="flex w-full items-center justify-center rounded-2xl bg-emerald-600 py-5 text-sm font-black tracking-widest text-white uppercase shadow-xl shadow-emerald-200">
                        Contact Us
                    </Link>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';

const isScrolled = ref(false);
const scrollProgress = ref(0);
const mobileMenu = ref(false);

// Lock body scroll when mobile menu is open
watch(mobileMenu, (val) => {
    if (val) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
});

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
        { text: 'Contact Us', url: '/contact' },
    ],
    legal: [
        { text: 'Privacy Policy', url: '/privacy-policy' },
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

const handleScroll = () => {
    const winScroll =
        document.body.scrollTop || document.documentElement.scrollTop;
    const height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    scrollProgress.value = (winScroll / height) * 100;
    isScrolled.value = window.scrollY > 100;
};

onMounted(() => window.addEventListener('scroll', handleScroll));
onUnmounted(() => window.removeEventListener('scroll', handleScroll));

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
