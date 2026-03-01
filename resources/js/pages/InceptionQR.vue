<template>
    <div class="flex min-h-screen items-center justify-center bg-slate-50 p-6">
        <div class="w-full max-w-2xl rounded-3xl bg-white p-8 shadow-2xl">
            <!-- Success Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100"
                >
                    <svg
                        class="h-8 w-8 text-emerald-600"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <h1 class="mb-2 text-3xl font-black text-slate-900">
                    QR Code Generated!
                </h1>
                <p class="text-slate-600">
                    Scan the QR code below to begin your onboarding journey
                </p>
            </div>

            <!-- QR Code Display -->
            <div class="mb-6 rounded-2xl bg-slate-50 p-8">
                <div class="mb-4 flex justify-center">
                    <div
                        ref="qrCodeContainer"
                        class="rounded-xl bg-white p-4 shadow-lg"
                    ></div>
                </div>
                <p class="text-center text-sm text-slate-500">
                    This QR code expires in 48 hours
                </p>
            </div>

            <!-- Project Information -->
            <div class="mb-6 rounded-2xl bg-emerald-50 p-6">
                <h3 class="mb-3 font-bold text-slate-900">Project Details</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Project Name:</span>
                        <span class="font-medium text-slate-900">{{
                            project.name
                        }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Company:</span>
                        <span class="font-medium text-slate-900">{{
                            contact_info.company_name
                        }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Contact Person:</span>
                        <span class="font-medium text-slate-900">{{
                            contact_info.contact_person
                        }}</span>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="border-t border-slate-200 pt-6">
                <h3 class="mb-3 font-bold text-slate-900">Next Steps:</h3>
                <ol class="space-y-2 text-sm text-slate-600">
                    <li class="flex items-start">
                        <span class="mr-2 font-bold text-emerald-600">1.</span>
                        <span>Scan the QR code with your mobile device</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 font-bold text-emerald-600">2.</span>
                        <span
                            >Review and sign the Non-Disclosure Agreement</span
                        >
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 font-bold text-emerald-600">3.</span>
                        <span
                            >Complete the inception meeting documentation</span
                        >
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 font-bold text-emerald-600">4.</span>
                        <span
                            >Submit your RFQ package with project details</span
                        >
                    </li>
                </ol>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex gap-4">
                <button
                    @click="downloadQR"
                    class="flex-1 rounded-lg bg-slate-900 px-6 py-3 font-medium text-white transition-colors hover:bg-slate-800"
                >
                    Download QR Code
                </button>
                <a
                    href="/"
                    class="flex-1 rounded-lg border-2 border-slate-300 px-6 py-3 text-center font-medium text-slate-700 transition-colors hover:bg-slate-50"
                >
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import QRCode from 'qrcode';
import { onMounted, ref } from 'vue';

const props = defineProps({
    project: Object,
    qr_url: String,
    contact_info: Object,
});

const qrCodeContainer = ref(null);

onMounted(async () => {
    if (qrCodeContainer.value && props.qr_url) {
        await QRCode.toCanvas(props.qr_url, {
            width: 256,
            margin: 2,
            color: {
                dark: '#0f172a',
                light: '#ffffff',
            },
        }).then((canvas) => {
            qrCodeContainer.value.appendChild(canvas);
        });
    }
});

const downloadQR = async () => {
    const canvas = document.createElement('canvas');
    await QRCode.toCanvas(canvas, props.qr_url, {
        width: 512,
        margin: 2,
    });

    const link = document.createElement('a');
    link.download = `${props.project.name.replace(/\s+/g, '_')}_QR.png`;
    link.href = canvas.toDataURL();
    link.click();
};
</script>
