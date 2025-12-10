<script setup>
import {Link} from "@inertiajs/vue3";
import Navigation from "@/components/Navigation.vue";

defineProps({
    posts: Array,
});
</script>

<template>
    <Navigation/>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Posts</h1>

        <div v-for="post in posts" :key="post.id" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-2">{{ post.title }}</h2>
            <p class="text-gray-700 mb-4">{{ post.body }}</p>

            <div class="border-t pt-4">
                <h3 class="text-lg font-medium mb-3">Comments</h3>
                <div v-for="comment in post.comments" :key="comment.id" class="flex justify-between items-start bg-gray-50 rounded p-3 mb-2">
                    <span class="text-gray-600">{{ comment.comment }}</span>
                    <Link :href="`/comments/${comment.id}`" method="delete" as="button" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                        Delete
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
