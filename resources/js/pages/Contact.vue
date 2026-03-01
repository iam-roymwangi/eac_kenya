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
                        Let's Synchronize <br />
                        <span class="text-emerald-500">Your Vision.</span>
                    </h1>
                    <p
                        v-reveal
                        class="mx-auto max-w-2xl text-lg leading-relaxed font-medium text-slate-400 md:text-xl"
                    >
                        Whether you are an EPC contractor or an infrastructure
                        developer, our Nairobi-based team is ready to facilitate
                        your entry into the Kenyan energy market.
                    </p>
                </div>
            </section>

            <section class="relative z-20 -mt-16 px-6 py-24">
                <div class="mx-auto max-w-7xl">
                    <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
                        <div
                            v-reveal
                            class="rounded-[3rem] border border-slate-100 bg-white p-8 shadow-2xl shadow-slate-200 md:p-12 lg:col-span-7"
                        >
                            <h2
                                class="mb-8 text-3xl font-black tracking-tighter text-slate-900 uppercase"
                            >
                                Project Inquiry
                            </h2>

                            <form
                                @submit.prevent="submitInquiry"
                                class="space-y-6"
                            >
                                <div
                                    class="grid grid-cols-1 gap-6 md:grid-cols-2"
                                >
                                    <div class="space-y-2">
                                        <label
                                            class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase"
                                            >Full Name</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.name"
                                            required
                                            class="w-full rounded-2xl border-none bg-slate-50 px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                                            placeholder="e.g. Ira Munn"
                                        />
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase"
                                            >Company Email</label
                                        >
                                        <input
                                            type="email"
                                            v-model="form.email"
                                            required
                                            class="w-full rounded-2xl border-none bg-slate-50 px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                                            placeholder="name@company.com"
                                        />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase"
                                        >Interest Area</label
                                    >
                                    <select
                                        v-model="form.interest"
                                        class="w-full rounded-2xl border-none bg-slate-50 px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
                                    >
                                        <option value="solar">
                                            Solar Energy Solutions
                                        </option>
                                        <option value="bess">
                                            Battery Storage (BESS)
                                        </option>
                                        <option value="regulatory">
                                            Regulatory & Compliance
                                        </option>
                                        <option value="water">
                                            Water Solutions
                                        </option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="ml-2 text-[10px] font-black tracking-widest text-slate-400 uppercase"
                                        >Message</label
                                    >
                                    <textarea
                                        v-model="form.message"
                                        rows="5"
                                        class="w-full rounded-2xl border-none bg-slate-50 px-6 py-4 font-medium text-slate-900 transition-all focus:ring-2 focus:ring-emerald-500"
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

                        <div class="space-y-8 lg:col-span-5">
                            <div
                                v-reveal
                                class="group relative overflow-hidden rounded-[3rem] bg-slate-900 p-10 text-white shadow-xl"
                            >
                                <div
                                    class="absolute top-0 right-0 -mt-16 -mr-16 h-32 w-32 rounded-full bg-emerald-500/10 blur-2xl transition-all group-hover:bg-emerald-500/20"
                                ></div>

                                <h3
                                    class="mb-8 text-[10px] font-black tracking-[0.4em] text-emerald-500 uppercase"
                                >
                                    Headquarters
                                </h3>
                                <div class="relative z-10 space-y-8">
                                    <div class="flex items-start gap-5">
                                        <div
                                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white/5 text-xl"
                                        >
                                            📍
                                        </div>
                                        <div>
                                            <p
                                                class="mb-1 text-sm font-black tracking-tighter uppercase"
                                            >
                                                Nairobi, Kenya
                                            </p>
                                            <p
                                                class="text-sm leading-relaxed text-slate-400"
                                            >
                                                Block 2.5B, Kitisuru Road,<br />Kitisuru,
                                                Nairobi [cite: 239]
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-5">
                                        <div
                                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white/5 text-xl"
                                        >
                                            📞
                                        </div>
                                        <div>
                                            <p
                                                class="mb-1 text-sm font-black tracking-tighter uppercase"
                                            >
                                                Direct Line
                                            </p>
                                            <p
                                                class="text-sm leading-relaxed text-slate-400"
                                            >
                                                (+254)-794-833-868 [cite: 234]
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-5">
                                        <div
                                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white/5 text-xl"
                                        >
                                            ✉️
                                        </div>
                                        <div>
                                            <p
                                                class="mb-1 text-sm font-black tracking-tighter uppercase"
                                            >
                                                Official Email
                                            </p>
                                            <p
                                                class="text-sm leading-relaxed text-slate-400"
                                            >
                                                info.eacgreengroup.co.ke [cite:
                                                87]
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                v-reveal
                                class="rounded-[3rem] border border-emerald-100 bg-emerald-50 p-10"
                            >
                                <h4
                                    class="mb-4 text-xl font-black tracking-tighter text-emerald-900"
                                >
                                    Standard Procedure [cite: 105]
                                </h4>
                                <p
                                    class="mb-6 text-sm leading-relaxed text-emerald-800/70"
                                >
                                    All high-level project engagements begin
                                    with the execution of a Non-Disclosure
                                    Agreement (NDA) to protect technical and
                                    commercial integrity[cite: 107, 142].
                                </p>
                                <a
                                    href="/our-process"
                                    class="flex items-center gap-2 text-xs font-black tracking-widest text-emerald-600 uppercase transition-all hover:gap-4"
                                >
                                    Learn about our 7-step process
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section v-reveal class="mx-auto mb-24 max-w-7xl px-6">
                <div
                    class="h-96 w-full overflow-hidden rounded-[4rem] bg-slate-200 grayscale transition-all duration-1000 hover:grayscale-0"
                >
                    <div
                        class="flex h-full w-full items-center justify-center bg-slate-100 font-bold tracking-widest text-slate-400 uppercase"
                    >
                        Interactive Map: Kitisuru Road, Nairobi
                    </div>
                </div>
            </section>
        </div>
    </HomeLayout>
</template>

<script setup lang="ts">
import HomeLayout from '@/layouts/HomeLayout.vue';
import { ref } from 'vue';

const form = ref({
    name: '',
    email: '',
    interest: 'solar',
    message: '',
});

const submitInquiry = () => {
    console.log('Form Submitted:', form.value);
    alert(
        'Thank you for your inquiry. Our technical team will reach out within 24 hours.',
    );
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
