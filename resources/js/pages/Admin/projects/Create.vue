<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-900">
                    Create New Project
                </h1>
                <p class="text-slate-600">
                    Set up a new project for client onboarding
                </p>
            </div>

            <div class="max-w-3xl">
                <form
                    @submit.prevent="submit"
                    class="rounded-lg bg-white p-6 shadow"
                >
                    <div class="space-y-6">
                        <!-- Project Name -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Project Name *
                            </label>
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                placeholder="e.g., Kimuka 2 Solar Project"
                            />
                            <div
                                v-if="form.errors.name"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <!-- Project Type -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Project Type *
                            </label>
                            <select
                                v-model="form.project_type"
                                required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="" disabled>
                                    Select project type
                                </option>
                                <option value="SOLAR">Solar PV</option>
                                <option value="BESS">
                                    Battery Energy Storage System
                                </option>
                                <option value="SOLAR_BESS">
                                    Solar PV + Battery Storage
                                </option>
                                <option value="OTHER">
                                    Other Renewable Energy
                                </option>
                            </select>
                            <div
                                v-if="form.errors.project_type"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.project_type }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Capacity -->
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Capacity (MW)
                                </label>
                                <input
                                    v-model="form.capacity_mw"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g., 40.00"
                                />
                                <div
                                    v-if="form.errors.capacity_mw"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.capacity_mw }}
                                </div>
                            </div>

                            <!-- Location -->
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Location
                                </label>
                                <input
                                    v-model="form.location"
                                    type="text"
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                                    placeholder="e.g., Kimuka, Kenya"
                                />
                                <div
                                    v-if="form.errors.location"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.location }}
                                </div>
                            </div>
                        </div>

                        <!-- Images Upload -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Project Images
                            </label>
                            <input
                                type="file"
                                multiple
                                accept="image/*"
                                @change="handleImageUpload"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 file:mr-4 file:rounded-md file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            />
                            <p class="mt-2 text-xs text-slate-500">
                                Maximum file size: 5MB per image. Select
                                multiple holding Ctrl/Cmd.
                            </p>
                            <div
                                v-if="form.errors.images"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.images }}
                            </div>

                            <!-- Image Preview Preview -->
                            <div
                                v-if="imagePreviews.length > 0"
                                class="mt-4 grid grid-cols-3 gap-4 sm:grid-cols-4"
                            >
                                <div
                                    v-for="(preview, index) in imagePreviews"
                                    :key="index"
                                    class="group relative"
                                >
                                    <img
                                        :src="preview"
                                        class="h-24 w-full rounded-md border border-slate-200 object-cover"
                                    />
                                    <button
                                        type="button"
                                        @click="removeImage(index)"
                                        class="absolute -top-2 -right-2 rounded-full bg-red-500 p-1 text-white opacity-0 shadow-sm transition-opacity group-hover:opacity-100"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Project Description
                            </label>
                            <div
                                class="overflow-hidden rounded-lg border border-slate-300"
                            >
                                <QuillEditor
                                    v-model:content="form.description"
                                    contentType="html"
                                    theme="snow"
                                    toolbar="essential"
                                    placeholder="Describe the project objectives, scope, and key features..."
                                    class="min-h-[200px]"
                                />
                            </div>
                            <div
                                v-if="form.errors.description"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.description }}
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="mt-8 flex justify-between border-t border-slate-100 pt-4"
                    >
                        <a
                            :href="admin.projects.index.url()"
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
                                    ? 'Creating...'
                                    : 'Create Project'
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
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref } from 'vue';

const breadcrumbs = [
    { title: 'Admin', href: admin.projects.index.url() },
    { title: 'Projects', href: admin.projects.index.url() },
    { title: 'Create', href: admin.projects.create.url() },
];

const imagePreviews = ref([]);

const form = useForm({
    name: '',
    project_type: '',
    capacity_mw: '',
    location: '',
    description: '',
    images: [],
});

const handleImageUpload = (event) => {
    const files = Array.from(event.target.files);

    // Create previews
    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreviews.value.push(e.target.result);
        };
        reader.readAsDataURL(file);
    });

    // Append new files to existing ones if you want, but standard input `multiple` replaces array
    // So we just replace entirely to match the input state
    form.images = files;

    // Re-generate the previews to match exact array state
    imagePreviews.value = [];
    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreviews.value.push(e.target.result);
        };
        reader.readAsDataURL(file);
    });
};

const removeImage = (index) => {
    form.images.splice(index, 1);
    imagePreviews.value.splice(index, 1);

    // Need to clear file input but programmatic modification of file input is limited
    // However, form.images array will dictate payload
};

const submit = () => {
    form.post(admin.projects.store.url(), {
        preserveScroll: true,
    });
};
</script>

<style>
/* Adjust editor style to fit layout nicely */
.ql-toolbar.ql-snow {
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
    border-color: #cbd5e1;
    background-color: #f8fafc;
}
.ql-container.ql-snow {
    border-bottom-left-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
    border-color: #cbd5e1;
    font-family: inherit;
    font-size: 1rem;
}
.ql-editor {
    min-height: 200px;
}
</style>
