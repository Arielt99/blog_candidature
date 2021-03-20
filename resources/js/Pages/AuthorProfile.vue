<template>
    <app-layout>
        <div class="top h-64 w-full bg-blue-600 overflow-hidden relative" >
            <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="" class="bg w-full h-full object-cover object-center absolute z-0">
            <div class="flex flex-col justify-center items-center relative h-full bg-black bg-opacity-50 text-white">
                <img :src="author.profile_photo_path" v-if="author.profile_photo_path" alt="avatar"  class="h-24 w-24 object-cover rounded-full">
                <h1 class="text-2xl font-semibold">{{author.name}}</h1>
                <p class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">{{author.role.name}}</p>
                <h4 class="text-sm font-semibold">Joined Since {{configDateTime(author.created_at)}}</h4>
            </div>
        </div>
        <div class="bg-gray-100 overflow-x-hidden">
            <div class="px-6 py-8">
                <div class="flex justify-center container mx-auto">
                    <div class="w-full flex flex-col content-center lg:w-8/12">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">{{author.name}}'s Posts</h1>
                        </div>

                        <div v-if="posts">
                            <post-preview v-for="post in PostList" v-bind:key="post.id" :post="post"/>
                        </div>

                        <div class="mt-8">

                            <div class="flex justify-center" v-if="pages.length > 1">
                                <div class="flex flex-start">
                                    <div v-if="page != 1">
                                    <button class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md" type="button" @click="page = 1" > &#60;&#60;</button>
                                    <button class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md" type="button" @click="page--" > &#60; </button>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div v-for="(pageNumber, index) in pages" @click="page = pageNumber" :key="index">
                                        <div v-bind:class="{ 'mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md cursor-not-allowed': pageNumber==page, 'mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md': pageNumber!=page }" v-if="page-2<=pageNumber && pageNumber<=page+2 || pageNumber<=5 && pageNumber>=page+2 || pageNumber>=pages.length-4 && pageNumber<= page+2">
                                            <button type="button">
                                            {{pageNumber}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-end">
                                    <div v-if="page < pages.length">
                                    <button class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md" type="button" @click="page++" > &#62; </button>
                                    <button class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md" type="button" @click="page = pages.length" > &#62;&#62; </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>
<script>
    import PostPreview from './../Components/PostPreview'
    import AppLayout from './../Layouts/AppLayout'
    import moment from 'moment'

    export default {
        components: {
            AppLayout,
            PostPreview
        },
        props: ['author', 'posts'],
        data () {
            return {
                page: 1,
                perPage: 5,
                pages: [],
                active: true
            }
        },
        methods:{
            //date configuration with moment.js
            configDateTime(date) {
                return moment(date).locale("fr").format("Do MMM YY");
            },

            setPages () {
                let numberOfPages = Math.ceil(this.posts.length / this.perPage)
                this.pages =[]
                for (let index = 1; index <= numberOfPages; index++) {
                    this.pages.push(index)
                }
            },
            paginate () {
                let page = this.page
                let perPage = this.perPage
                let from = (page * perPage) - perPage
                let to = (page * perPage)
                return  this.posts.slice(from, to)
            }
        },
        computed: {
            PostList() {
                return this.paginate(this.posts)
            },

        },
        created: function(){
                this.page = 1
                this.setPages()
                this.paginate()
        },
    }
</script>
