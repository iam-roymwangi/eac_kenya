<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-900">
                    Register New Client
                </h1>
                <p class="text-slate-600">
                    Register a client to grant them portal access
                </p>
            </div>

            <div class="max-w-2xl">
                <form
                    @submit.prevent="submit"
                    class="rounded-lg bg-white p-6 shadow"
                >
                    <div class="space-y-6">
                        <!-- Company Name -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Company Name *
                            </label>
                            <input
                                v-model="form.company_name"
                                type="text"
                                required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="e.g., Acme Renewables"
                            />
                            <div
                                v-if="form.errors.company_name"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.company_name }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Contact Person Full Name -->
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Contact Person Full Name *
                                </label>
                                <input
                                    v-model="form.contact_person"
                                    type="text"
                                    required
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g., Jane Doe"
                                />
                                <div
                                    v-if="form.errors.contact_person"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.contact_person }}
                                </div>
                            </div>

                            <!-- Title -->
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Job Title
                                </label>
                                <input
                                    v-model="form.title"
                                    type="text"
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g., Managing Director"
                                />
                                <div
                                    v-if="form.errors.title"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.title }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Email Address -->
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Email Address *
                                </label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    required
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g., jane@acmerenewables.com"
                                />
                                <div
                                    v-if="form.errors.email"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.email }}
                                </div>
                                <p class="mt-2 text-xs text-slate-500">
                                    Login credentials will be sent to this email
                                    address.
                                </p>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Phone Number *
                                </label>
                                <input
                                    v-model="form.phone"
                                    type="tel"
                                    required
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g., +254 700 000 000"
                                />
                                <div
                                    v-if="form.errors.phone"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.phone }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="mt-8 flex justify-between border-t border-slate-100 pt-4"
                    >
                        <a
                            :href="admin.clients.index.url()"
                            class="rounded-lg px-6 py-2 font-medium text-slate-600 transition-colors hover:text-slate-800"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="flex min-w-[140px] items-center justify-center rounded-lg bg-emerald-600 px-6 py-2 font-medium text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                        >
                            <svg
                                v-if="form.processing"
                                class="mr-2 -ml-1 h-4 w-4 animate-spin text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            {{
                                form.processing
                                    ? 'Registering...'
                                    : 'Register Client'
                            }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import admin from '@/routes/admin';
import { useForm } from '@inertiajs/vue3';

const breadcrumbs = [
    { title: 'Admin', href: admin.clients.index.url() },
    { title: 'Clients', href: admin.clients.index.url() },
    { title: 'Register', href: admin.clients.create.url() },
];

const form = useForm({
    company_name: '',
    contact_person: '',
    title: '',
    email: '',
    phone: '',
});

const submit = () => {
    form.post(admin.clients.store.url(), {
        preserveScroll: true,
    });
};
</script>
