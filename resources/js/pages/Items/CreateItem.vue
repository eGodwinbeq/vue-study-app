<script setup>

import {Form} from "@inertiajs/vue3";
import Navigation from "@/components/Navigation.vue";

defineProps({
    errors: Object,
    message: String
})
</script>

<template>
    <Navigation/>


    <div v-if="$page.props.flash.message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ $page.props.flash.message }}
    </div>

    <div class="flex justify-center mt-4">
        <!-- Product Form -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Create Product</h2>
            <Form action="/item-store" method="POST" resetOnSuccess class="space-y-5">

                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" id="name" name="name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                    transition duration-200">
                    <!--  Validation Errors -->
                    <p class="text-red-500 text-xs italic mt-1">{{ errors.name }}</p>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="number" id="price" name="price" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                    transition duration-200">
                </div>


                <!-- Stock Quantity -->
                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                    <input type="number" id="stock_quantity" name="stock_quantity" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                    transition duration-200">
                </div>


                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                       transition duration-200"></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg
                     hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400
                     transition duration-200">
                        Create Product
                    </button>
                </div>
            </Form>
        </div>
    </div>

</template>
