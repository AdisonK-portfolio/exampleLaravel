<template>
    <div class="sm:px-6 px-4">
        <div class="mx-auto max-w-4xl sm:my-6 my-4">
            <h1 class="text-4xl text-bold"> {{ title }}</h1>
        </div>
        
        <div class="">
            <div class="mx-auto block bg-white sm:p-6 xs:p-4 p-2  max-w-4xl">
                <div class="px-2 md:px-4 my-2 sm:mb-4 mb-2  sm:flex sm:justify-between space-x-2 space-y-2">
                    <div class="flex space-x-0">
                        <input type="text" name="search" placeholder="Search for Contact" class="m-0" v-model="search" @keyup.enter="getContacts">
                        <button class="bg-primary p-2" @click="getContacts">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex">
                        <a href="/contacts/export" class="p-2 sm:px-4" title="Export Contacts"><button>
                            <Download /> 
                        </button></a>
                        <a href="/contact/create"><button type="button" class="submitBtn">New Contact</button></a>
                        
                    </div>
                </div>
                <table class="table w-full">
                    <thead>
                        <tr>
                            <!-- Playing with the idea of making this dynamic- could limit things later though -->
                            <!-- <th v-for="[col, style] in Object.entries(this.styling)" :class="'justify-between ' + style" @click="sort(col)">{{ col }}</th> -->
                            <th :class="'justify-between ' + styling['firstName']" @click="sort('firstName')">
                                <div class="flex space-x-1">
                                    <div>First Name </div>
                                    <Chevrons name="firstName" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons>
                                </div>
                            </th>
                            <th :class="'justify-between ' + styling['lastName']" @click="sort('lastName')">
                                <div class="flex space-x-1">
                                    <div>Last Name </div>
                                    <Chevrons name="lastName" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons>
                                </div>
                            </th>
                            <th :class="'justify-between ' + styling['email']" @click="sort('email')">
                                <div class="flex space-x-1">
                                    <div>Email </div>
                                    <Chevrons name="email" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons>
                                </div>
                            </th>
                            <th :class="'justify-between ' + styling['primaryCompany']" @click="sort('primaryCompanies.name')">
                                <div class="flex space-x-1">
                                    <div>Primary Company </div>
                                    <Chevrons name="primaryCompanies.name" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons> 
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in contacts.data">
                            
                            <td :class="styling['firstName']">
                                <a :href="'/contact/' + contact.id + '/edit'">{{ contact.firstName }}</a>
                            </td>
                            <td :class="styling['lastName']">
                                <a :href="'/contact/' + contact.id + '/edit'">{{ contact.lastName }}</a>
                            </td>
                            <td :class="styling['email']">{{ contact.email }}</td>
                            <td :class="styling['primaryCompanyName']">{{ contact.primaryCompanyName }}</td> 
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-between xs:py-4 py-2 px-2 md:px-4">
                    <div class="pt-2 hidden sm:block">
                        <span v-if="contacts.meta">Showing {{ contacts.meta.from }} to {{ contacts.meta.to }} of {{  contacts.meta.total }}</span>
                    </div>
                    <div>
                        <TailwindPagination
                            :data="contacts"
                            :limit="1"
                            @pagination-change-page="getContacts"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios';
    import { TailwindPagination } from 'laravel-vue-pagination';
    import Chevrons from './Chevrons.vue';
    import { Download } from 'lucide-vue-next';

    const props = defineProps({
        styling:{
            required: true,
        },
        title:{
            required: true,
        }
    })
        
    const contacts = ref({});
    const search = ref(null);
    const sortCol = ref('');
    const sortDir = ref('desc');
        
    function getContacts(page = 1){
        //let page = this.contacts.meta.page;
        let url = `/api/contacts?page=${page}`;
        if(search.value){
            url = url + '&search=' + search.value;
            console.log('searching for:' + search.value);
        }
        axios.get(url)
            .then(response => {
                console.log("response data");
                console.log(response.data);
                contacts.value = response.data;
            })
            .catch(error => {
                console.log(error);
            })
    }

    function sort(event){
        console.log('sorting by ' + event);
        let page = contacts.value.meta.page;
        sortCol.value = event;
        sortDir.value = (sortDir.value == 'desc' ? 'asc' : 'desc');
        let url = '/api/contacts?page=' + page + '&sort=' + sortCol.value + '&dir=' + sortDir.value;
        console.log('sort url: ' + url);
        
        if(search.value){
            url = url + '&search=' + search.value;
        }

        axios.get(url)
            .then(response => {
                console.log("response data");
                console.log(response.data);
                contacts.value = response.data;
            })
            .catch(error => {
                console.log(error);
            })
    }

    onMounted(() => {
        console.log('before start:');
        console.log(contacts.value);
        getContacts();
        
        // console.log('styling');
        // console.log(this.styling);
    })
</script>