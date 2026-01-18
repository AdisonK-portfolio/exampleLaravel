<template>
    <div class="sm:px-6 px-4">
        <div class="mx-auto max-w-4xl sm:my-6 my-4">
            <h1 class="text-4xl text-bold"> {{ title }}</h1>
        </div>
        
        <div class="">
            <div class="mx-auto block bg-white sm:p-6 xs:p-4 p-2  max-w-4xl">
                <div class="px-2 md:px-4 my-2 mb-4 flex justify-between space-x-2">
                    <div class="flex space-x-0">
                        <input type="text" name="search" placeholder="Search for Contact" class="m-0" v-model="search">
                        <button class="bg-primary p-2" @click="getContacts">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                    <a href="/contacts/create"><button type="button" class="submitBtn">New Contact</button></a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th :class="styling['firstName']">First Name</th>
                            <th :class="styling['lastName']">Last Name</th>
                            <th :class="styling['email']">Email</th>
                            <th :class="styling['primaryCompany']">Primary Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in contacts.data">
                            <td :class="styling['firstName']">{{ contact.firstName }}</td>
                            <td :class="styling['lastName']">{{ contact.lastName }}</td>
                            <td :class="styling['email']">{{ contact.email }}</td>
                            <td :class="styling['primaryCompany']">{{ contact.primaryCompany }}</td> 
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-between xs:pt-6 pt-4">
                    <div class="pt-2">
                        <span v-if="contacts.meta">Showing {{ contacts.meta.from }} to {{ contacts.meta.to }} of {{  contacts.meta.total }}</span>
                        <!--  -->
                    </div>
                    <TailwindPagination
                        :data="contacts"
                        :limit="1"
                        @pagination-change-page="getContacts"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import { TailwindPagination } from 'laravel-vue-pagination';

    export default {

        components: {
            TailwindPagination,
        },
        
        props: {
            styling:{
                required: true,
            },
            title:{
                required: true,
            }
        },

        data(){
            return {
                'contacts': {},
                'search': null,
            }
        },
        mounted(){
            this.getContacts();
        },

        methods: {
            
            getContacts(page = 2){
                let url = `/api/contacts?page=${page}`;
                if(this.search){
                    url = url + '&search=' + this.search;
                }
                axios.get(url)
                    .then(response => {
                        console.log("response data");
                        console.log(response.data);
                        this.contacts = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>