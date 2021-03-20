<template>
    <div class="cursor-default w-full border-gray-100 rounded-b hover:bg-teal-100">
        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
            <div class="w-6 flex flex-col items-center">
                <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full ">
                    <img class="rounded-full" alt="A" :src="user.profile_photo_path" v-if="user.profile_photo_path">
                </div>
            </div>
            <div class="w-full items-center justify-between flex">
                <div class="mx-2 -mt-1 w-1/2 overflow-hidden">
                    <inertia-link :href="route('AuthorProfile', { id : user.id})" class="flex items-center">{{user.name}}</inertia-link>
                    <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">{{user.email}}</div>
                </div>
                <div class="flex">
                    <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                        <div class="text-xs font-normal leading-none max-w-full flex-initial">{{user.role.name}}</div>
                    </div>
                </div>
                <div class="flex justify-between w-auto">
                    <button @click="setRole(1)" v-bind:class="{'bg-green-600 hover:bg-green-500 focus:border-green-700 focus:shadow-outline-green active:bg-green-600 cursor-not-allowed': user.role.id==1, 'focus:shadow-outline-red active:bg-red-600 cursor-pointer': user.role.id!=1}" class="px-2 py-1 my-2 mx-1 bg-red-600 border border-transparent rounded font-bold text-xs text-white tracking-widest focus:outline-none transition ease-in-out duration-150">Author</button>
                    <button @click="setRole(2)" v-bind:class="{'bg-green-600 hover:bg-green-500 focus:border-green-700 focus:shadow-outline-green active:bg-green-600 cursor-not-allowed': user.role.id==2, 'focus:shadow-outline-red active:bg-red-600 cursor-pointer': user.role.id!=2}" class="px-2 py-1 my-2 mx-1 bg-red-600 border border-transparent rounded font-bold text-xs text-white tracking-widest focus:outline-none transition ease-in-out duration-150">Moderator</button>
                    <button @click="setRole(3)" v-bind:class="{'bg-green-600 hover:bg-green-500 focus:border-green-700 focus:shadow-outline-green active:bg-green-600 cursor-not-allowed': user.role.id==3, 'focus:shadow-outline-red active:bg-red-600 cursor-pointer': user.role.id!=3}" class="px-2 py-1 my-2 mx-1 bg-red-600 border border-transparent rounded font-bold text-xs text-white tracking-widest focus:outline-none transition ease-in-out duration-150">Administrator</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3'

    export default {
        props: ['user'],
        setup () {
            const roleUpdate = useForm({
            '_method': 'PUT',
            role_id: null,
            })

            return { roleUpdate }
        },
        methods:{
            setRole(idRole){
            this.roleUpdate.role_id = idRole
            this.roleUpdate.put(route('UserRoleUpdate', {id : this.user.id}), {
                preserveScroll: true,
                onSuccess: () => this.roleUpdate.reset('role_id'),
            })
            },

        },
    }
</script>
