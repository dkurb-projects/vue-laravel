<template>
  <div class="max-w-4xl mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Posts</h1>

    <form class="mb-6 shadow-md rounded-md bg-gray-100 pt-5 pb-5" @submit.prevent="savePosts">
        <div class="mb-4 ml-10 mr-10 w-full">
            <label for="" class="min-w-5 mr-10">Title</label>
            <input type="text" class=" p-2 rounded-md focus:outline-none border border-gray-300 focus:ring focus:ring-indigo-400" v-model="form.title" />
        </div>
        <div class="mb-4 ml-10 mr-10 w-full">
            <label for="" class="min-w-5 mr-10">Content</label>
            <textarea class=" p-2 rounded-md focus:outline-none border border-gray-300 focus:ring focus:ring-indigo-400" v-model="form.content"></textarea>
        </div>

        <button type="submit" class="bg-indigo-500 py-2 px-2 rounded-md hover:bg-indigo-600 cursor-pointer text-white">{{ editId ? 'Edit' : 'Create' }}</button>
    </form>

    <div v-for="post in posts.data" :key="post.id" class="mb-4 p-4 shadow-md rounded-md">
        <h3 class="text-xl font-semibold">{{ post.title }}</h3>
        <p class="text-gray-700 mb-5">{{  post.content }}</p>

        <button type="button" class="bg-yellow-500 py-1 px-1 rounded-md hover:bg-yellow-600 cursor-pointer text-white text-sm" @click="editPost(post)">Edit</button>
        <button type="button" class="bg-red-500 py-1 px-1 rounded-md hover:bg-red-600 cursor-pointer text-white ml-2 text-sm" @click="deletePost(post)">Delete</button>
    </div>
    
    <div v-if="posts.links" class="flex justify-center items-center space-x-2">
        <button v-for="(link, index) in posts.links" :key="index"
        @click="fetchPosts(link.url)"
        :disabled="!link.url"
        class="px-4 py-2 rounded-md text-sm text-white"
        :class="{
            'bg-green-500 hover:bg-green-600 cursor-pointer' : link.active,
            'bg-gray-500 cursor-pointer' : !link.active && link.url,
            'bg-gray-300 cursor-not-allowed' : !link.url
        }
        "
        v-html="link.label">
        </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            posts: {},
            form: {
                title: '',
                content: ''
            },
            editId: null
        }
    },
    methods: {
        async fetchPosts(url= "api/v1/posts") {
            const {data} = await axios.get(url)
            this.posts = data
        },
        async savePosts() {
            if(this.editId != null) {
                await axios.put(`api/v1/posts/${this.editId}`, this.form)
                this.editId = null
            } else {
                await axios.post('api/v1/posts', this.form)
            }
            this.fetchPosts()
            
        },
        editPost(post) {
            this.editId = post.id
            this.form.title = post.title
            this.form.content = post.content
        },
        async deletePost(post) {
            if(confirm('Are you sure you want to delete this record?')) {
                await axios.delete(`api/v1/posts/${post.id}`)
                this.fetchPosts()
            }
        }
    },
    mounted() {
        this.fetchPosts()
    }
}
</script>

<style>

</style>