<template>
    <div class="mt-6">
        <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <span class="font-light text-gray-600">{{configDateTime(post.created_at)}}</span>
            </div>
            <div class="mt-2">
                <inertia-link :href="route('PostDisplay', { id : post.id})" class="text-2xl text-gray-700 font-bold hover:underline">{{post.title}}</inertia-link>
                <p class="mt-2 h-24 text-gray-600">{{parseText(post.body,250)}}</p>
            </div>
            <div class="flex justify-between items-center mt-4">
                <inertia-link :href="route('PostDisplay', { id : post.id})" class="text-blue-500 hover:underline">Read more</inertia-link>
                <div v-if="post.user">
                    <inertia-link :href="route('AuthorProfile', { id : post.user.id})" class="flex items-center">
                        <img :src="post.user.profile_photo_path" v-if="post.user.profile_photo_path" alt="avatar" class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block">
                        <h1 class="text-gray-700 font-bold hover:underline">{{post.user.name}}</h1>
                    </inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        props: ['post'],

        methods:{
            //date configuration with moment.js
            configDateTime(date) {
                return moment(date).locale("fr").format("Do MMM YY");
            },

            //parse post body for preview
            parseText(text, limit){
                if (text.length > limit){
                    for (let i = limit; i > 0; i--){
                        if(text.charAt(i) === ' ' && (text.charAt(i-1) != ','||text.charAt(i-1) != '.'||text.charAt(i-1) != ';')) {
                            return text.substring(0, i) + '...';
                        }
                    }
                    return text.substring(0, limit) + '...';
                }
                else
                    return text;
            }
        },
    }
</script>
