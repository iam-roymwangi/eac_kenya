<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs = [
    { title: 'Clients', href: '/admin/clients' },
    { title: 'Onboard', href: '/admin/clients/create' },
];

const form = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    password: '',
});

function submit() {
    // adjust endpoint as needed (e.g. routes.client().store.url())
    form.post('/clients', {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
    });
}
</script>

<template>
    <Head title="Onboard Client" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-2xl p-6">
            <h1 class="mb-2 text-2xl font-bold">Onboard New Client</h1>
            <p class="mb-6 text-slate-600">
                Create a client account so they can access the portal.
            </p>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Full name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full rounded border px-3 py-2"
                    />
                    <p
                        v-if="form.errors.name"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.name }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full rounded border px-3 py-2"
                    />
                    <p
                        v-if="form.errors.email"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input
                        v-model="form.phone"
                        type="tel"
                        class="mt-1 block w-full rounded border px-3 py-2"
                    />
                    <p
                        v-if="form.errors.phone"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.phone }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium">Company</label>
                    <input
                        v-model="form.company"
                        type="text"
                        class="mt-1 block w-full rounded border px-3 py-2"
                    />
                    <p
                        v-if="form.errors.company"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.company }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full rounded border px-3 py-2"
                    />
                    <p
                        v-if="form.errors.password"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded bg-emerald-600 px-4 py-2 text-white disabled:opacity-60"
                    >
                        {{ form.processing ? 'Creating...' : 'Create Client' }}
                    </button>

                    <a href="/admin/clients" class="text-emerald-600 underline"
                        >Back to dashboard</a
                    >
                </div>

                <!-- <p v-if="form.errors.message" class="text-sm text-red-600">{{ form.errors.message }}</p> -->
            </form>
        </div>
    </AppLayout>
</template>
