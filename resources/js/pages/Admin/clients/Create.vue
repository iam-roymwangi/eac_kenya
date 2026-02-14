<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue
import routes from '@/routes';

const breadcrumbs = [
  { title: 'Client', href: routes.client().url },
  { title: 'Onboard', href: routes.client().onboard?.url ?? '#' },
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
    <div class="p-6 max-w-2xl">
      <h1 class="text-2xl font-bold mb-2">Onboard New Client</h1>
      <p class="text-slate-600 mb-6">Create a client account so they can access the portal.</p>

      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label class="block text-sm font-medium">Full name</label>
          <input v-model="form.name" type="text" class="mt-1 block w-full rounded border px-3 py-2" />
          <p v-if="form.errors.name" class="text-xs text-red-600 mt-1">{{ form.errors.name }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium">Email</label>
          <input v-model="form.email" type="email" class="mt-1 block w-full rounded border px-3 py-2" />
          <p v-if="form.errors.email" class="text-xs text-red-600 mt-1">{{ form.errors.email }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium">Phone</label>
          <input v-model="form.phone" type="tel" class="mt-1 block w-full rounded border px-3 py-2" />
          <p v-if="form.errors.phone" class="text-xs text-red-600 mt-1">{{ form.errors.phone }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium">Company</label>
          <input v-model="form.company" type="text" class="mt-1 block w-full rounded border px-3 py-2" />
          <p v-if="form.errors.company" class="text-xs text-red-600 mt-1">{{ form.errors.company }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium">Password</label>
          <input v-model="form.password" type="password" class="mt-1 block w-full rounded border px-3 py-2" />
          <p v-if="form.errors.password" class="text-xs text-red-600 mt-1">{{ form.errors.password }}</p>
        </div>

        <div class="flex items-center gap-3">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-emerald-600 text-white px-4 py-2 rounded disabled:opacity-60"
          >
            {{ form.processing ? 'Creating...' : 'Create Client' }}
          </button>

          <a :href="routes.client().projects.index.url()" class="text-emerald-600 underline">Back to dashboard</a>
        </div>

        <p v-if="form.errors.message" class="text-sm text-red-600">{{ form.errors.message }}</p>
      </form>
    </div>
  </AppLayout>
</template>