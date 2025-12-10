<script setup lang="js">
// define pros
import Navigation from "@/components/Navigation.vue";

defineProps({
    items: Array,
    message: String
})


import {Link} from "@inertiajs/vue3";
import Welcome from "@/pages/welcome.vue";
</script>

<template>
    <!--    success message -->
    <div v-if="$page.props.flash.message" class="alert">
        {{ $page.props.flash.message }}
    </div>

    <Navigation/>


    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg p-6 ">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Sample Table</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Stock Qty</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Description</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <tr v-for="(item, i) in items" :key="i">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ i + 1 }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.description }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.price }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.stock_quantity }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.deleted_at }}</td>
                </tr>

                </tbody>
            </table>

            <p v-for="Item in items" class="text-teal-600"></p>
        </div>
    </div>
</template>

<style scoped>

</style>
