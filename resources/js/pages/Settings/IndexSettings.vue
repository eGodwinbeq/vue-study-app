<script setup>
import {useForm} from "@inertiajs/vue3";
import Navigation from "@/components/Navigation.vue";

defineProps({
    users: Object
})


const form = useForm({
    avatar: null,
})

function handleFileChange(event) {
    form.avatar = event.target.files[0]
}

function submit() {
    form.put('/settings-update', {
        onSuccesss: () => form.reset('avatar'),
    })
}
</script>


<template>

    <Navigation/>

    <div class="flex justify-center mt-4">
        <!-- Profile Card -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md text-center">
            <!-- Avatar -->
            <div class="flex justify-center mb-4 relative">
                <img v-if="users.avatar" :src="users.avatar" alt="User Avatar" class="w-28 h-28 rounded-full border-4 border-blue-500">

                <img v-else :src="'images/No_Profile.webp'" alt="User Avatar" class="w-28 h-28 rounded-full border-4 border-blue-500">
            </div>


            <!-- User Info -->
            <h1 class="text-2xl font-semibold text-gray-800">{{ users.name }}</h1>
            <p class="text-gray-600 mb-4">{{ users.role }}</p>

        </div>

        <!-- Update Profile Form -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Profile</h2>

            <form @submit.prevent="submit">
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-4">
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">
                        Avatar
                    </label>

                    <!-- Use @change instead of v-model -->
                    <input id="avatar" type="file" @change="handleFileChange" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm  focus:outline-none focus:ring-2 focus:ring-blue-500  focus:border-blue-500 transition"/>
                </div>

                <!-- Example error display -->
                <div v-if="form.errors.avatar" class="text-red-500 text-sm mb-4">
                    {{ form.errors.avatar }}
                </div>

                <button type="submit" :disabled="form.processing" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    Submit
                </button>
            </form>
        </div>


    </div>

</template>
