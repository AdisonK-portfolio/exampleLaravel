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
                            <!-- Playing with the idea of making this dynamic- could limit things later though -->
                            <!-- <th v-for="[col, style] in Object.entries(this.styling)" :class="'justify-between ' + style" @click="sort(col)">{{ col }}</th> -->
                            <th :class="'justify-between' + styling['firstName']" @click="sort('firstName')">
                                <div>First Name </div>
                                <ChevronUp class="ml-auto size-4" v-show="sortCol == 'firstName' && sortDir == 'asc'"/>
                                <ChevronDown class="ml-auto size-4" v-show="sortCol == 'firstName' && sortDir == 'desc'"/>
                            </th>
                            <th :class="'justify-between' + styling['lastName']" @click="sort('lastName')">
                                <div>Last Name </div>
                                <ChevronUp class="ml-auto size-4" v-show="sortCol == 'lastName' && sortDir == 'asc'"/>
                                <ChevronDown class="ml-auto size-4" v-show="sortCol == 'lastName' && sortDir == 'desc'"/>
                            </th>
                            <th :class="'justify-between' + styling['email']" @click="sort('email')">
                                <div>Email </div>
                                <ChevronUp class="ml-auto size-4" v-show="sortCol == 'email' && sortDir == 'asc'"/>
                                <ChevronDown class="ml-auto size-4" v-show="sortCol == 'email' && sortDir == 'desc'"/>
                            </th>
                            <th :class="'justify-between' + styling['primaryCompany']" @click="sort('primaryCompany')">
                                <div>Primary Company </div>
                                <ChevronUp class="ml-auto size-4" v-show="sortCol == 'primaryCompany' && sortDir == 'asc'"/>
                                <ChevronDown class="ml-auto size-4" v-show="sortCol == 'primaryCompany' && sortDir == 'desc'"/>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in contacts.data">
                            
                            <td :class="styling['firstName']">{{ contact.firstName }}</td>
                            <td :class="styling['lastName']">{{ contact.lastName }}</td>
                            <td :class="styling['email']">{{ contact.email }}</td>
                            <td :class="styling['primaryCompanyName']">{{ contact.primaryCompanyName }}</td> 
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-between xs:pt-6 pt-4">
                    <div class="pt-2">
                        <span v-if="contacts.meta">Showing {{ contacts.meta.from }} to {{ contacts.meta.to }} of {{  contacts.meta.total }}</span>
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
    import { ChevronDown, ChevronUp } from 'lucide-vue-next';

    export default {

        components: {
            TailwindPagination,
            ChevronDown,
            ChevronUp
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
                'sortCol': '',
                'sortDir': 'desc',
            }
        },
        mounted(){
            console.log('before start:');
            console.log(this.contacts);
            this.getContacts();
            
            //console.log(this.contacts[0].forEach())
            // <td v-for="col in headings" :class="styling[col]">{{ contact.${col} }}</td>
            // console.log('styling');
            // console.log(this.styling);
        },

        methods: {
            
            getContacts(page = 1){
                //let page = this.contacts.meta.page;
                let url = `/api/contacts?page=${page}`;
                if(this.search){
                    url = url + '&search=' + this.search;
                    console.log('searching for:' + this.search);
                }
                axios.get(url)
                    .then(response => {
                        console.log("response data");
                        console.log(response.data);
                        this.contacts = response.data;
                        // Object.entries(this.contacts.data[0]).forEach(([key, value]) => {
                        //     console.log(key + ' value: ' + value);
                        // });
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            sort(event){
                console.log('sorting by ' + event);
                let page = this.contacts.meta.page;
                let url = '/api/contacts?page=' + page + '&sort=' + event;
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