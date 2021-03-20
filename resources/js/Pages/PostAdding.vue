<template>
    <app-layout>
        <div class="bg-gray-100 overflow-x-hidden">
            <div class="px-6 py-8">
                <div class="flex justify-center container mx-auto">
                    <div class="w-full flex flex-col content-center lg:w-8/12">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Create your Posts</h1>
                        </div>

                        <div class="mt-6">
                            <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
                                <div class="mt-2">
                                    <!-- Title -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="title" value="Title" />
                                        <input v-model="newPost.title" id="title" type="text" ref="title" class="input block rounded-md shadow-sm mt-1 w-full border text-gray-700 py-2.5 px-4 pr-8 rounded leading-tight focus:outline-none" />
                                    </div>
                                    <!-- body -->
                                    <div class="col-span-6 sm:col-span-4 mb-10">
                                        <jet-label for="body" value="Content" />
                                        <textarea v-model="newPost.body" id="body" type="body" class="form-input h-40 block rounded-md shadow-sm mt-1 w-full border text-gray-700 py-2.5 px-4 pr-8 rounded leading-tight focus:outline-none" />
                                    </div>

                                    <button @click="addPost()" type="submit" :class="{ 'opacity-25': newPost.processing }"  :disabled="newPost.processing" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Add
                                    </button>

                                    <jet-action-message :on="newPost.recentlySuccessful" class="mr-3">
                                        Saved.
                                    </jet-action-message>

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
    import JetActionMessage from './../Jetstream/ActionMessage'
    import AppLayout from './../Layouts/AppLayout'
    import JetButton from './../Jetstream/Button'
    import JetInput from './../Jetstream/Input'
    import JetInputError from './../Jetstream/InputError'
    import JetLabel from './../Jetstream/Label'
    import { useForm } from '@inertiajs/inertia-vue3'


    export default {
        components: {
            JetActionMessage,
            AppLayout,
            JetButton,
            JetInput,
            JetInputError,
            JetLabel,
        },
        props: [],
        setup () {
            const newPost = useForm({
            '_method': 'POST',
            title: null,
            body: null,
            })

            return { newPost }
        },
        methods: {
            addPost() {
            this.newPost.post(route('PostAdding'), {
                preserveScroll: true,
                onSuccess: () => this.newPost.reset('title', 'body'),
            })
            },
        },
    }
</script>
