<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Primary Company</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts">
                    <td :class="styling['firstName']">{{contact.firstName}}</td>
                    <td :class="styling['lastName']">{{contact.lastName}}</td>
                    <td :class="styling['email']">{{contact.email}}</td>
                    <td>{{contact.primaryCompany}}</td> 
                </tr>
            </tbody>
        </table>
        <button @click="getContacts">xxx</button>
        <TailwindPagination
            :data="contacts"
            :limit="2"
            @pagination-change-page="getContacts"
        />
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
            initialContacts: {
                required: true,
            },
            styling:{
                required: true,
            }
        },

        data(){
            return {
                'contacts': this.initialContacts,
                'something': 'https//www.something.com',
            }
        },

        mounted(){
            // this.getContacts();
            // console.log(this.initialcontacts);
            console.log(this.contacts);
        },

        methods: {
            getContacts(){//page){
                //console.log('page' + page);
                axios.get('/api/contacts')//?page=' + page)
                    .then(response => {
                        console.log(response.data.data);
                        this.contacts = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
                console.log(this.contacts);
            }
        }
    }
</script>