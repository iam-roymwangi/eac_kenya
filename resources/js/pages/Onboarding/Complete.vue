<template>
  <div class="min-h-screen bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">EAC Green Group</h1>
        <h2 class="text-xl text-slate-600 mb-4">Onboarding Complete</h2>
      </div>

      <!-- Success Card -->
      <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <!-- Success Icon -->
        <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-10 h-10 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>

        <!-- Success Message -->
        <h3 class="text-2xl font-bold text-slate-900 mb-4">
          Congratulations!
        </h3>
        <p class="text-lg text-slate-600 mb-8">
          You have successfully completed the initial onboarding process for <strong>{{ project.name }}</strong>.
        </p>

        <!-- Completion Summary -->
        <div class="bg-emerald-50 rounded-lg p-6 mb-8">
          <h4 class="font-semibold text-emerald-900 mb-4">What's Been Completed</h4>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div class="flex items-center text-emerald-800">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              NDA Signed
            </div>
            <div class="flex items-center text-emerald-800">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              Inception Meeting
            </div>
            <div class="flex items-center text-emerald-800">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              RFQ Submitted
            </div>
          </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-slate-50 rounded-lg p-6 mb-8 text-left">
          <h4 class="font-semibold text-slate-900 mb-4">What Happens Next</h4>
          <div class="space-y-3 text-sm text-slate-700">
            <div class="flex items-start">
              <span class="bg-emerald-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-0.5">1</span>
              <div>
                <p class="font-medium">Document Review (2-3 business days)</p>
                <p class="text-slate-600">Our technical team will review your submitted documentation and requirements.</p>
              </div>
            </div>
            <div class="flex items-start">
              <span class="bg-emerald-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-0.5">2</span>
              <div>
                <p class="font-medium">Initial Proposal (5-7 business days)</p>
                <p class="text-slate-600">We'll prepare a comprehensive proposal including technical specifications and commercial terms.</p>
              </div>
            </div>
            <div class="flex items-start">
              <span class="bg-emerald-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-0.5">3</span>
              <div>
                <p class="font-medium">Project Kickoff Meeting</p>
                <p class="text-slate-600">Schedule a detailed discussion to finalize project parameters and next steps.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-slate-50 rounded-lg p-6 mb-8">
          <h4 class="font-semibold text-slate-900 mb-4">Your Project Team</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
              <p class="font-medium text-slate-900">Project Manager</p>
              <p class="text-slate-600">Will be assigned within 24 hours</p>
            </div>
            <div>
              <p class="font-medium text-slate-900">Technical Lead</p>
              <p class="text-slate-600">Will be assigned based on project type</p>
            </div>
          </div>
          <div class="mt-4 pt-4 border-t border-slate-200">
            <p class="font-medium text-slate-900 mb-2">Questions or Concerns?</p>
            <p class="text-slate-600">Contact us at <a href="mailto:projects@eacgreen.co.ke" class="text-emerald-600 hover:text-emerald-700">projects@eacgreen.co.ke</a></p>
            <p class="text-slate-600">Or call us at <a href="tel:+254700000000" class="text-emerald-600 hover:text-emerald-700">+254 700 000 000</a></p>
          </div>
        </div>

        <!-- Reference Information -->
        <div class="text-sm text-slate-500 mb-8">
          <p>Project Reference: <span class="font-mono">{{ project.uuid }}</span></p>
          <p>Please keep this reference for your records.</p>
        </div>

        <!-- Action Button -->
        <button
          @click="goToHome"
          class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-lg font-medium transition-colors"
        >
          Return to EAC Green Group
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
  project: Object
})

const goToHome = () => {
  router.get('/')
}
</script>