<script setup>
import {Form, router} from '@inertiajs/vue3'
import {ref} from 'vue'
import Navigation from "@/components/Navigation.vue";

/**
 * Check if a file exists on the server
 * @param {string} filePath - The file path or URL
 * @returns {Promise<string>} - "exists" or "not found"
 */
async function checkFile(filePath) {
    try {
        const response = await fetch(filePath, {method: 'HEAD'})
        return response.ok ? "exists" : "not found"
    } catch (error) {
        return "not found"
    }
}

// Example usage
const filePath = ref('/images/my-logo.png')   // 👈 your variable
const fileStatus = ref("")

async function verifyFile() {
    fileStatus.value = await checkFile(filePath.value)
}


defineProps({
    users: Object
})

// function to check if a file exists


let defaultAvatar = 'public/avatars/No_Profile.webp'

</script>

<template>
    {{ (users) }}
    <button v-on:click="checkFile(defaultAvatar)">
        check if file exists
    </button>

    <Navigation/>

    <div class="flex justify-center mt-4">

        <!-- Profile Card -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md text-center">
            <!-- Avatar -->
            <div class="flex justify-center mb-4 relative">
                <img v-if="users.avatar || filerExists " :src="users.avatar" alt="User Avatar"
                     class="w-28 h-28 rounded-full border-4 border-blue-500">

                <img v-else :src="'images/No_Profile.webp'" alt="User Avatar"
                     class="w-28 h-28 rounded-full border-4 border-blue-500">
            </div>


            <!-- User Info -->
            <h1 class="text-2xl font-semibold text-gray-800">{{ users.name }}</h1>
            <p class="text-gray-600 mb-4">{{ users.role }}</p>

        </div>

        <!-- Update Profile Form -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Profile</h2>
            <Form action="/profile-update" method="POST" enctype="multipart/form-data" class="space-y-4" resetOnSuccess>
                <input type="hidden" name="_method" value="PUT">

                <!-- Avatar Upload -->
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" :value="users.name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" :value="users.email"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>


                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg
                       hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                        Save Changes
                    </button>
                </div>
            </Form>
        </div>


    </div>

</template>
