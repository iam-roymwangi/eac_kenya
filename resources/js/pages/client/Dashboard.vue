<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import routes from '@/routes';

const breadcrumbs = [
	{ title: 'Client', href: routes.client().url },
];
</script>

<template>
	<Head title="Client Dashboard" />
	<AppLayout :breadcrumbs="breadcrumbs">
		<div class="p-6">
			<h1 class="text-2xl font-bold">Client Portal</h1>
			<p class="text-slate-600">View your projects, sign documents, and manage appointments.</p>

			<div class="mt-6 space-y-3">
				<a :href="routes.client().projects.index.url()" class="text-emerald-600 underline">My Projects</a>
			</div>
		</div>
	</AppLayout>
</template>
