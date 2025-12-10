<script setup>
import Navigation from "@/components/Navigation.vue";
import {ref} from "vue";
import {Link, router} from "@inertiajs/vue3";

const searchUser = ref('')

function search() {
    router.get('/users', {q: searchUser.value}, {
        preserveState: true,
        replace: true
    })
}

defineProps({
    users: Array,
})

</script>

<template>

    <Navigation/>
    <!-- Table -->

    <form @submit.prevent="search" class="flex justify-center mb-6 gap-2">
        <input v-model="searchUser" type="text" placeholder="Search..." autofocus class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"/>
        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            Search
        </button>

        <Link type="submit" class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            Reset
        </Link>
    </form>


    <div class="bg-white shadow-md rounded-lg p-6 ">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Users</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <tr v-for="(user, i) in users" :key="i">

                    <td class="px-4 py-2 text-sm text-gray-700">{{ i + 1 }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ user.name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ user.email }}</td>
                    <!--  <td class="px-4 py-2 text-sm text-gray-700">{{ user.created_at }}</td>-->
                </tr>

                </tbody>
            </table>
        </div>
    </div>

</template>

<style scoped>

</style>
