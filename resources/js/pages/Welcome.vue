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

        <section class="overflow-hidden bg-white px-6 py-24">
            <div class="mx-auto max-w-7xl">
                <div
                    class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4"
                >
                    <div
                        v-reveal
                        class="group rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all duration-500 hover:border-emerald-500"
                    >
                        <div
                            class="mb-2 text-5xl font-black tracking-tighter text-slate-900 transition-colors group-hover:text-emerald-600"
                        >
                            3.8<span class="text-emerald-500">X</span>
                        </div>
                        <div
                            class="mb-6 h-1 w-10 rounded-full bg-emerald-100 transition-all duration-500 group-hover:w-20"
                        ></div>
                        <p
                            class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                        >
                            Economical growth
                        </p>
                    </div>

                    <div
                        v-reveal
                        class="group rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all duration-500 hover:border-emerald-500"
                    >
                        <div
                            class="mb-2 text-5xl font-black tracking-tighter text-slate-900 transition-colors group-hover:text-emerald-600"
                        >
                            15<span class="text-emerald-500">+</span>
                        </div>
                        <div
                            class="mb-6 h-1 w-10 rounded-full bg-emerald-100 transition-all duration-500 group-hover:w-20"
                        ></div>
                        <p
                            class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                        >
                            Year experiences
                        </p>
                    </div>

                    <div
                        v-reveal
                        class="group rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all duration-500 hover:border-emerald-500"
                    >
                        <div
                            class="mb-2 text-5xl font-black tracking-tighter text-slate-900 transition-colors group-hover:text-emerald-600"
                        >
                            1.2<span class="text-emerald-500">m</span>
                        </div>
                        <div
                            class="mb-6 h-1 w-10 rounded-full bg-emerald-100 transition-all duration-500 group-hover:w-20"
                        ></div>
                        <p
                            class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                        >
                            Clients Around the World
                        </p>
                    </div>

                    <div
                        v-reveal
                        class="group rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all duration-500 hover:border-emerald-500"
                    >
                        <div
                            class="mb-2 text-5xl font-black tracking-tighter text-slate-900 transition-colors group-hover:text-emerald-600"
                        >
                            70<span class="text-emerald-500">+</span>
                        </div>
                        <div
                            class="mb-6 h-1 w-10 rounded-full bg-emerald-100 transition-all duration-500 group-hover:w-20"
                        ></div>
                        <p
                            class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase"
                        >
                            Team Members
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section
            id="services"
            class="relative z-20 overflow-hidden bg-white px-6 py-32"
        >
            <div class="mx-auto max-w-7xl">
                <div class="mb-20 max-w-3xl" v-reveal>
                    <h2
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-emerald-600 uppercase"
                    >
                        How we can help you at EAC
                    </h2>
                    <h3
                        class="mb-8 text-4xl font-black tracking-tighter text-slate-900 md:text-6xl"
                    >
                        All Services.
                    </h3>
                    <p
                        class="text-lg leading-relaxed font-medium text-slate-500"
                    >
                        We provide expert consultancy in renewable energy,
                        global trade, oil & gas, water solutions, and
                        waste-to-energy, helping businesses navigate challenges,
                        optimize operations, and achieve sustainable growth.
                    </p>
                </div>

                <div
                    class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        v-for="service in updatedServices"
                        :key="service.title"
                        v-reveal
                        class="group relative rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all duration-500 hover:border-emerald-500 hover:bg-white hover:shadow-2xl hover:shadow-slate-200"
                    >
                        <div
                            class="mb-8 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition-transform duration-500 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white"
                        >
                            <component :is="service.icon" class="h-8 w-8" />
                        </div>

                        <h4
                            class="mb-4 text-xl font-black tracking-tighter text-slate-900 uppercase"
                        >
                            {{ service.title }}
                        </h4>

                        <p
                            class="text-sm leading-relaxed font-medium text-slate-500"
                        >
                            {{ service.desc }}
                        </p>

                        <div class="mt-8 border-t border-slate-100 pt-8">
                            <a
                                href="#"
                                class="flex items-center gap-2 text-[10px] font-black tracking-widest text-emerald-600 uppercase transition-all group-hover:gap-4"
                            >
                                Learn More <span>→</span>
                            </a>
                        </div>
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
                        @click="handleProjectClick(project)"
                        class="group relative aspect-[16/10] overflow-hidden rounded-[3rem] border border-white/10 cursor-pointer transition-all hover:border-emerald-500 hover:scale-[1.02]"
                    >
                        <img
                            :src="project.image"
                            class="h-full w-full object-cover opacity-60 transition-all duration-1000 group-hover:scale-105 group-hover:opacity-80"
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
                            <div class="mt-4 flex items-center gap-2 text-emerald-400 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                <span>View Details</span>
                                <span>→</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sectors" class="relative z-20 bg-slate-50 px-6 py-32">
            <div class="mx-auto max-w-7xl">
                <div class="mb-20 flex flex-col justify-between gap-8 md:flex-row md:items-end" v-reveal>
                    <div class="max-w-2xl">
                        <h2 class="mb-4 text-[10px] font-black tracking-[0.4em] text-emerald-600 uppercase">
                            Our Reach
                        </h2>
                        <h3 class="text-4xl font-black tracking-tighter text-slate-900 md:text-6xl">
                            What Sectors We Cover.
                        </h3>
                    </div>
                    <div class="max-w-xs border-l-2 border-emerald-500 pl-6">
                        <p class="text-sm font-medium leading-relaxed text-slate-500 uppercase tracking-tight">
                            Strategic advisory across high-growth industries driving East Africa's development.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div
                        v-for="sector in sectorItems"
                        :key="sector.title"
                        v-reveal
                        class="group relative flex flex-col justify-between overflow-hidden rounded-[2.5rem] bg-white p-8 border border-slate-100 transition-all duration-500 hover:border-emerald-500 hover:shadow-2xl hover:shadow-slate-200"
                    >
                        <div class="absolute -bottom-12 -right-12 h-32 w-32 rounded-full bg-emerald-50 opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:scale-150"></div>

                        <div class="relative z-10">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-900 text-white transition-colors duration-500 group-hover:bg-emerald-600">
                                <component :is="sector.icon" class="h-6 w-6" />
                            </div>
                            <h4 class="mb-2 text-lg font-black leading-tight text-slate-900 uppercase tracking-tighter">
                                {{ sector.title }}
                            </h4>
                        </div>

                        <div class="relative z-10 mt-4 pt-4 border-t border-slate-50">
                            <a href="#" class="text-[9px] font-black uppercase tracking-[0.2em] text-emerald-600 flex items-center gap-2">
                                Case Studies <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-20 flex justify-center" v-reveal>
                    <div class="rounded-3xl bg-slate-900 px-8 py-6 text-center shadow-xl">
                        <p class="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                            Looking for something specific?
                            <a href="/contact" class="ml-2 text-emerald-400 hover:text-white transition-colors">Speak to our advisors →</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section
            id="testimonials"
            class="relative z-20 overflow-hidden bg-white px-6 py-32"
        >
            <div class="mx-auto max-w-7xl">
                <div class="mb-20 text-center" v-reveal>
                    <h2
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-emerald-600 uppercase"
                    >
                        Client Trust
                    </h2>
                    <h3
                        class="text-4xl font-black tracking-tighter text-slate-900 md:text-6xl"
                    >
                        Industry Feedback.
                    </h3>
                </div>

                <div
                    class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        v-for="testimonial in testimonials"
                        :key="testimonial.author"
                        v-reveal
                        class="group relative flex flex-col justify-between rounded-[3rem] border border-slate-100 bg-slate-50 p-10 transition-all hover:border-emerald-500"
                    >
                        <div
                            class="absolute top-10 right-10 font-serif text-6xl text-slate-200 italic transition-colors group-hover:text-emerald-100"
                        >
                            “
                        </div>

                        <div class="relative z-10 mb-8">
                            <p
                                class="text-lg leading-relaxed font-medium text-slate-600 italic"
                            >
                                {{ testimonial.quote }}
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-600 text-xl font-black text-white shadow-lg shadow-emerald-200"
                            >
                                {{ testimonial.author[0] }}
                            </div>
                            <div>
                                <h4
                                    class="text-sm font-black tracking-tighter text-slate-900 uppercase"
                                >
                                    {{ testimonial.author }}
                                </h4>
                                <p
                                    class="text-[10px] font-bold tracking-widest text-emerald-600 uppercase"
                                >
                                    {{ testimonial.role }}
                                </p>
                                <p
                                    class="text-[10px] font-bold text-slate-400 uppercase"
                                >
                                    {{ testimonial.company }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="team" class="relative z-20 bg-slate-50 px-6 py-32">
            <div class="mx-auto max-w-7xl">
                <div class="mb-16 max-w-3xl" v-reveal>
                    <h2
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-emerald-600 uppercase"
                    >
                        Meet the consultation team
                    </h2>
                    <h3 class="mb-6 text-4xl font-black tracking-tighter text-slate-900 md:text-6xl">
                        Join Our Team.
                    </h3>
                    <p class="text-lg font-medium leading-relaxed text-slate-500">
                        Explore our diverse case studies showcasing how our consultancy services in
                        renewable energy, global trade, oil &amp; gas, water solutions, and sustainability
                        have helped businesses overcome challenges and achieve long-term success.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="member in consultationTeam"
                        :key="member.name"
                        v-reveal
                        class="group rounded-[3rem] border border-slate-100 bg-white p-10 transition-all duration-500 hover:border-emerald-500 hover:shadow-2xl hover:shadow-slate-200"
                    >
                        <div class="mb-8 flex items-center gap-4">
                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-600 text-xl font-black text-white shadow-lg shadow-emerald-200"
                            >
                                {{ member.initials }}
                            </div>
                            <div class="min-w-0">
                                <div class="truncate text-lg font-black tracking-tighter text-slate-900">
                                    {{ member.name }}
                                </div>
                                <div class="text-[10px] font-black tracking-widest text-emerald-600 uppercase">
                                    {{ member.role }}
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 pt-6">
                            <p class="text-sm font-medium leading-relaxed text-slate-500">
                                {{ member.title }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="relative z-20 bg-white px-6 py-32">
            <div class="mx-auto max-w-4xl">
                <div class="mb-16 text-center" v-reveal>
                    <h2
                        class="mb-4 text-[10px] font-black tracking-[0.4em] text-emerald-600 uppercase"
                    >
                        Contact Us
                    </h2>
                    <h3
                        class="mb-6 text-4xl font-black tracking-tighter text-slate-900 md:text-6xl"
                    >
                        Project Inquiry.
                    </h3>
                    <p class="mx-auto max-w-2xl text-lg font-medium leading-relaxed text-slate-500">
                        Share a few details and our team will respond within 24 hours.
                    </p>
                </div>

                <div
                    v-reveal
                    class="rounded-[3rem] border border-slate-100 bg-slate-50 p-8 shadow-2xl shadow-slate-200 md:p-12"
                >
                    <form @submit.prevent="submitInquiry" class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase">
                                    Full Name
                                </label>
                                <input
                                    v-model="contactForm.name"
                                    type="text"
                                    required
                                    class="w-full rounded-2xl border-none bg-white px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g. Ira Munn"
                                />
                            </div>
                            <div class="space-y-2">
                                <label class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase">
                                    Company Email
                                </label>
                                <input
                                    v-model="contactForm.email"
                                    type="email"
                                    required
                                    class="w-full rounded-2xl border-none bg-white px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                                    placeholder="name@company.com"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase">
                                Interest Area
                            </label>
                            <select
                                v-model="contactForm.interest"
                                class="w-full rounded-2xl border-none bg-white px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="solar">Solar Energy Solutions</option>
                                <option value="bess">Battery Storage (BESS)</option>
                                <option value="regulatory">Regulatory & Compliance</option>
                                <option value="water">Water Solutions</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase">
                                Message
                            </label>
                            <textarea
                                v-model="contactForm.message"
                                rows="5"
                                class="w-full rounded-2xl border-none bg-white px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                                placeholder="Briefly describe your project requirements..."
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-emerald-600 py-5 font-black tracking-widest text-white uppercase transition-all hover:bg-emerald-500 hover:shadow-xl hover:shadow-emerald-200 active:scale-95"
                        >
                            Send Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import HomeLayout from '@/layouts/HomeLayout.vue';
import {
    BarChart3,
    Droplets,
    Flame,
    Globe,
    Recycle,
    Zap,
    Building2, Factory,
    Coins, Sprout, Cpu, Briefcase, HeartPulse, HardHat
} from 'lucide-vue-next';

interface DbProject {
    id: number
    name: string
    location: string
    capacity: string
    bess: boolean
    image: string
    isDatabase: boolean
}

const props = defineProps<{
    canRegister?: boolean
    dbProjects?: DbProject[]
}>()

const contactForm = ref({
    name: '',
    email: '',
    interest: 'solar',
    message: '',
});

const submitInquiry = () => {
    // Replace with real submission when backend endpoint is ready.
    console.log('Homepage inquiry submitted:', contactForm.value);
    alert('Thank you for your inquiry. Our technical team will reach out within 24 hours.');
};

const consultationTeam = [
    {
        name: 'Mr. Christian Khoury',
        initials: 'CK',
        title: 'Chief Operations Officer',
        role: 'Operations',
    },
    {
        name: 'Mr. Sam Sawaia',
        initials: 'SS',
        title: 'Head of Marketing',
        role: 'Marketing',
    },
    {
        name: 'Eng. Wycliffe Ochieng',
        initials: 'WO',
        title: 'Director - Quality Assurance & Compliance',
        role: 'Quality & Compliance',
    },
    {
        name: 'Eng. Kevin Obege',
        initials: 'KO',
        title: 'Director - Engineering & Technology',
        role: 'Engineering',
    },
    {
        name: 'Ms. Hazeline O.A.',
        initials: 'HO',
        title: 'Director - Legal and Corporate Affairs',
        role: 'Legal',
    },
    {
        name: 'BadBurry Yalo Connel',
        initials: 'BY',
        title: 'Head of Business Development',
        role: 'Business Development',
    },
];

const updatedServices = [
    {
        title: 'Renewable Energy Solutions',
        icon: Zap,
        desc: 'Expert guidance on solar, wind, geothermal, and biofuel energy projects, including feasibility studies, project planning, and implementation strategies.',
    },
    {
        title: 'Oil & Gas Infrastructure',
        icon: Flame,
        desc: 'Providing strategic insights on oil and gas exploration, infrastructure development, risk management, and regulatory compliance.',
    },
    {
        title: 'Water Treatment & Desalination',
        icon: Droplets,
        desc: 'Advising industries and municipalities on sustainable water treatment solutions, desalination technologies, and resource management.',
    },
    {
        title: 'Waste-to-Energy Solutions',
        icon: Recycle,
        desc: 'Offering expertise in waste-to-energy projects, including technology selection, regulatory guidance, and project execution.',
    },
    {
        title: 'Trade Finance & Investment',
        icon: BarChart3,
        desc: 'Consulting on trade finance strategies, investment opportunities, risk assessment, and funding options for global businesses.',
    },
];

const staticProjects = [
    {
        name: 'Kimuka 2 Solar PV',
        location: 'Kajiado County, Kenya [cite: 7]',
        capacity: '40MW Grid Connected [cite: 7]',
        bess: true,
        image: 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=2070&auto=format&fit=crop',
        isDatabase: false,
    },
    {
        name: 'Nyakwere Hills Solar',
        location: 'Nyakwere, Kenya [cite: 243]',
        capacity: '40MW EPC Project [cite: 243]',
        bess: false,
        image: 'https://media.licdn.com/dms/image/v2/D4D22AQEuJWEPNGrp4w/feedshare-shrink_2048_1536/B4DZniGPs5JMAw-/0/1760434919295?e=2147483647&v=beta&t=VlN__V4p_uSQc4A9x-abBzD2pWo_CYUxHTNXXDC_27o',
        isDatabase: false,
    },
    {
        name: 'Ol Ndanyat Wind Power Project',
        location: 'Kona Baridi, Kajiado, Kenya',
        capacity: '65MW',
        bess: false,
        image: 'images/ol-ndanyat-wind.png',
        isDatabase: false,
    },
];

// Merge database projects with static projects
const projects = computed(() => {
    if (props.dbProjects && props.dbProjects.length > 0) {
        return props.dbProjects
    }
    return staticProjects
})

const handleProjectClick = (project: any) => {
    if (project.isDatabase && project.id) {
        router.visit(`/projects/${project.id}`)
    } else {
        router.visit('/projects')
    }
}

const sectorItems = [
    { title: 'Renewable Energy & Sustainability', icon: Zap },
    { title: 'Oil & Gas', icon: Flame },
    { title: 'Water & Environmental Solutions', icon: Droplets },
    { title: 'Global Trade & Supply Chain', icon: Globe },
    { title: 'Infrastructure & Construction', icon: HardHat },
    { title: 'Manufacturing & Industrial Development', icon: Factory },
    { title: 'Finance & Investment Advisory', icon: Coins },
    { title: 'Agriculture & Agribusiness', icon: Sprout },
    { title: 'Technology & Digital Transformation', icon: Cpu },
    { title: 'Corporate Financial Planning', icon: Briefcase },
    { title: 'Healthcare & Pharmaceuticals', icon: HeartPulse },
    { title: 'Infrastructure & Construction', icon: Building2 },
];

const renewableLinks = [
    'Solar Energy Solutions',
    'Wind Energy Systems',
    'Geothermal Power Solutions',
    'Advanced Biofuels Technology',
    'Waste-to-Energy Innovations',
];

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

const testimonials = [
    {
        quote: "We've handled close to three projects with EAC green group, they conduct every step with professionalism and vigor, and we can say we are pleased and satisfied with their performance.",
        author: 'Quaint Energy Kenya',
        role: 'Client Partner',
        company: 'Quaint Energy Kenya',
    },
    {
        quote: "EAC Green Group's structured 7-step process provided total clarity and risk mitigation from NDA signing to project implementation[cite: 102, 230].",
        author: 'EPC Partner',
        role: 'Project Director',
        company: 'Global Infrastructure Group',
    },
    {
        quote: 'The strategic insight provided during the regulatory and compliance phase was vital for our successful grid synchronization[cite: 256, 270].',
        author: 'Solar Developer',
        role: 'Technical Lead',
        company: 'Renewable Assets SPV',
    },
];

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
