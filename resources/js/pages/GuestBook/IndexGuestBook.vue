<script setup>
import {Link} from "@inertiajs/vue3";
import Navigation from "@/components/Navigation.vue";
import {ref} from 'vue';
import {useForm} from '@inertiajs/vue3';

defineProps({
    signatures: Array
})

const form = useForm({
    name: '',
    message: ''
});

const submitSignature = () => {
    form.post('/guestbook', {
        onSuccess: () => {
            form.reset();
        }
    });
};
</script>

<template>
    <!-- Success message -->
    <div v-if="$page.props.flash.message" class="v-notification bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ $page.props.flash.message }}
    </div>

    <Navigation/>

    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Guest Book</h1>
            <p class="text-gray-600">Leave your signature and message for others to see</p>
        </div>

        <!-- Add Signature Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Leave Your Signature</h2>

            <form @submit.prevent="submitSignature" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Your name"
                        required
                    />
                    <span v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</span>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea
                        id="message"
                        v-model="form.message"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Leave a message (optional)"
                    ></textarea>
                    <span v-if="form.errors.message" class="text-red-500 text-sm mt-1">{{ form.errors.message }}</span>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span v-if="form.processing">Submitting...</span>
                    <span v-else>Guest </span>
                </button>
            </form>
        </div>

        <!-- Signatures Display -->
        <div v-if="signatures.length > 0" class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Previous Signatures</h2>

            <div v-for="signature in signatures" :key="signature.id" class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">{{ signature.name }}</h3>
                            <span class="text-sm text-gray-500">
                                {{
                                    new Date(signature.created_at).toLocaleDateString('en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    })
                                }}
                            </span>
                        </div>
                        <p v-if="signature.message" class="text-gray-700 whitespace-pre-line">{{ signature.message }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else class="bg-white shadow-md rounded-lg p-12 text-center">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No signatures yet</h3>
            <p class="text-gray-500">Be the first to sign the guest book!</p>
        </div>
    </div>
</template>

<style scoped>
/* Additional custom styles if needed */
</style>
