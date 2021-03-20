<template>
    <app-layout>
        <div class="bg-gray-100 overflow-x-hidden">
            <div class="px-6 py-8">
                <div class="flex justify-center container mx-auto">
                    <div class="w-full flex flex-col content-center lg:w-8/12">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                        </div>

                        <div v-if="posts">
                            <post-preview v-for="post in PostsList" v-bind:key="post.id" :post="post"/>
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

    export default {
        components: {
            AppLayout,
            PostPreview
        },
        props: ['posts'],
        data () {
            return {
                page: 1,
                perPage: 5,
                pages: [],
                active: true
            }
        },
        methods:{
            setPages () {
                let numberOfPages = Math.ceil(this. posts.length / this.perPage)
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
            PostsList() {
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
