<template>
    <app-layout>
        <div class="bg-gray-100 overflow-x-hidden">
            <div class="px-6 py-8">
                <div class="flex justify-center container mx-auto">
                    <div class="w-full flex flex-col content-center lg:w-8/12">
                        <article class="py-12 px-4">
                        <h1 class="text-4xl text-center mb-4 font-semibold font-heading font-semibold">{{post.title}}</h1>
                        <div v-if="post.user.id == $page.props.user.id || $page.props.user.role_id == 3 || $page.props.user.role_id == 2">
                            <inertia-link v-if="post.user.id == $page.props.user.id || $page.props.user.role_id == 3 || $page.props.user.role_id == 2" :href="route('PostEdition', { id : post.id})" class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">Update the post</inertia-link>
                            <button v-if="post.user.id == $page.props.user.id || $page.props.user.role_id == 3" @click="deletePost()" class=" px-2 py-1 my-2 mx-1 bg-red-600 border border-transparent rounded font-bold text-xs text-white tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">Delete</button>
                        </div>

                        <p class="text-center">
                            <span>{{configDateTime(post.created_at)}}, by</span>
                            <inertia-link :href="route('AuthorProfile', { id : post.user.id})" class="ml-1 text-indigo-600 hover:underline">{{post.user.name}}</inertia-link>
                        </p>

                        <div class="max-w-3xl mx-auto">
                            <p class="mb-4">
                                {{post.body}}
                            </p>
                        </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>
<script>
    import JetDangerButton from './../Jetstream/DangerButton'
    import AppLayout from './../Layouts/AppLayout'
    import { useForm } from '@inertiajs/inertia-vue3'
    import moment from 'moment'

    export default {
        components: {
            AppLayout,
            JetDangerButton
        },
        props: ['post'],
        setup () {
            const deletePost = useForm({
            '_method': 'DELETE',
            })

            return { deletePost }
        },
        methods: {
            //date configuration with moment.js
            configDateTime(date) {
                return moment(date).locale("fr").format("Do MMM YY");
            },
            deletePost(){
                if (confirm('Do you really want to delete this post ?')) {
                    this.deletePost.post(route('PostDestroying', {id : this.post.id}), {
                    preserveScroll: true
                })
                }
            },
        },
    }
</script>
