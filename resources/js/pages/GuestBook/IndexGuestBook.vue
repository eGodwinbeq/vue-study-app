<script setup>
import {Link} from "@inertiajs/vue3";
import Navigation from "@/components/Navigation.vue";
import {ref, watch} from 'vue';
import {useForm} from '@inertiajs/vue3';

defineProps({
    signatures: Array
})

const form = useForm({
    name: '',
    message: ''
});

// Toast notification system
const toasts = ref([]);
let toastIdCounter = 0;

const addToast = (message, type = 'info', duration = 3000) => {
    const id = ++toastIdCounter;
    toasts.value.push({id, message, type, duration});
};

const removeToast = (id) => {
    const index = toasts.value.findIndex(toast => toast.id === id);
    if (index > -1) {
        toasts.value.splice(index, 1);
    }
};

// Watch for flash messages
watch(() => form.recentlySuccessful, (newVal) => {
    if (newVal) {
        addToast('Signature added successfully!', 'success', 3000);
    }
});

// Watch for errors
watch(() => form.hasErrors, (hasErrors) => {
    if (hasErrors) {
        addToast('Please fix the errors in the form', 'error', 4000);
    }
});

const submitSignature = () => {
    form.post('/guestbook', {
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            // Error toast will be shown by the watcher
        }
    });
};
</script>

<template>
    <!-- Toast Container -->
    <div class="fixed top-4 right-4 z-50 flex flex-col items-end space-y-3">
        <TransitionGroup name="toast">
            <div
                v-for="toast in toasts"
                :key="toast.id"
                class="toast-item"
                :class="[
                    'flex items-start gap-3 p-4 rounded-lg border shadow-lg transition-all duration-300',
                    toast.type === 'success' ? 'bg-green-50 border-green-200' : '',
                    toast.type === 'error' ? 'bg-red-50 border-red-200' : '',
                    toast.type === 'warning' ? 'bg-yellow-50 border-yellow-200' : '',
                    toast.type === 'info' ? 'bg-blue-50 border-blue-200' : ''
                ]"
                style="min-width: 320px; max-width: 420px;"
            >
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <svg v-if="toast.type === 'success'" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <svg v-else-if="toast.type === 'error'" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <svg v-else-if="toast.type === 'warning'" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <svg v-else class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <!-- Message -->
                <div
                    class="flex-1 text-sm font-medium"
                    :class="[
                        toast.type === 'success' ? 'text-green-900' : '',
                        toast.type === 'error' ? 'text-red-900' : '',
                        toast.type === 'warning' ? 'text-yellow-900' : '',
                        toast.type === 'info' ? 'text-blue-900' : ''
                    ]"
                >
                    {{ toast.message }}
                </div>

                <!-- Close Button -->
                <button
                    @click="removeToast(toast.id)"
                    class="flex-shrink-0 hover:opacity-70 transition-opacity"
                    :class="[
                        toast.type === 'success' ? 'text-green-500' : '',
                        toast.type === 'error' ? 'text-red-500' : '',
                        toast.type === 'warning' ? 'text-yellow-500' : '',
                        toast.type === 'info' ? 'text-blue-500' : ''
                    ]"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Auto-close Timer Component -->
                <ToastTimer :duration="toast.duration" :toast-id="toast.id" @remove="removeToast"/>
            </div>
        </TransitionGroup>
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
                    <input id="name" v-model="form.name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Your name" />
                    <span v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</span>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" v-model="form.message" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Leave a message (optional)"></textarea>
                    <span v-if="form.errors.message" class="text-red-500 text-sm mt-1">{{ form.errors.message }}</span>
                </div>

                <button type="submit" :disabled="form.processing" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <span v-if="form.processing">Submitting...</span>
                    <span v-else>Sign Guest Book</span>
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

<!-- Toast Timer Component -->
<script>
import {onMounted, onUnmounted} from 'vue';

export const ToastTimer = {
    props: {
        duration: Number,
        toastId: Number
    },
    emits: ['remove'],
    setup(props, {emit}) {
        let timer;

        onMounted(() => {
            timer = setTimeout(() => {
                emit('remove', props.toastId);
            }, props.duration);
        });

        onUnmounted(() => {
            if (timer) {
                clearTimeout(timer);
            }
        });

        return {};
    },
    template: '<span style="display: none;"></span>'
};
</script>

<style scoped>
/* Toast animations */
.toast-enter-active {
    transition: all 0.5s ease-out;
}

.toast-leave-active {
    transition: all 3s ease-in;
}

.toast-enter-from {
    transform: translateX(100%);
    opacity: 0;
}

.toast-leave-to {
    transform: translateX(100%);
    opacity: 0;
}

.toast-move {
    transition: transform 0.3s ease;
}
</style>
