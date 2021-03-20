<template>
    <app-layout>
        <div class="bg-gray-100 overflow-x-hidden flex flex-col items-center">
    <div class="w-full md:w-3/4 flex flex-col items-center">
        <div class="w-full px-6 py-8">
            <div class="flex flex-col items-center relative">
                <div class="w-full">
                    <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                        <div class="flex flex-auto flex-wrap"></div>
                        <input placeholder="Search by name" v-model="Search" class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                        <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                            <button class="cursor-default w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                    <div class="flex flex-col w-full">
                        <div v-if="users">
                            <user-card v-for="user in UsersList" :key="user.id" :user="user"/>
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
    import AppLayout from './../../Layouts/AppLayout'
    import UserCard from './../../Components/UserCard'
export default {
        components: {
            AppLayout,
            UserCard
        },
        props: ['users'],
        data () {
            return {
                page: 1,
                perPage: 5,
                pages: [],
                active: true,
                Search: '',
            }
        },
        methods:{
            setPages () {
                let numberOfPages = Math.ceil(this.ResearchResult.length / this.perPage)
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
                return  this.ResearchResult.slice(from, to)
            }
        },
        computed: {
            ResearchResult(){
                return this.users.filter(user =>{
                return user.name.toLowerCase().includes(this.Search.toLowerCase())
                })
            },
            UsersList() {
                return this.paginate(this.ResearchResult)
            },
        },
        created: function(){
                this.page = 1
                this.setPages()
                this.paginate()
        }
    }
</script>
