<template>
    
    <div class="mx-auto block bg-white sm:p-6 xs:p-4 p-2 w-full">
        <div class="px-2 md:px-4 my-2 sm:mb-4 mb-2  sm:flex sm:justify-between space-x-2 space-y-2 w-full">
            <div class="flex space-x-0">
                <input type="text" name="search" placeholder="Search for Contact" class="m-0" v-model="search" @keyup.enter="getContacts">
                <button class="bg-primary p-2 text-white" @click="getContacts">
                    <Search></Search> 
                </button>
            </div>
            <div class="flex">
                <a href="/contacts/export" class="p-2 sm:px-4" title="Export Contacts">
                    <Download /> 
                </a>
                <a href="/contacts/create"><button type="button" class="submitBtn">New Contact</button></a>
                
            </div>
        </div>
        <table class="table max-w-full overflow-auto">
            <thead>
                <tr>
                    <!-- Playing with the idea of making this dynamic- could limit things later though -->
                    <!-- <th v-for="[col, style] in Object.entries(this.styling)" :class="'justify-between ' + style" @click="sort(col)">{{ col }}</th> 
                        
                    <th :class="'justify-between ' + styling['firstName']" @click="sort('firstName')">-->
                    <th class="justify-between" @click="sort('firstName')">
                        <div class="flex space-x-1">
                            <div>First Name </div>
                            <Chevrons name="firstName" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons>
                        </div>
                    </th>
                    <th class="justify-between" @click="sort('lastName')">
                        <div class="flex space-x-1">
                            <div>Last Name </div>
                            <Chevrons name="lastName" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons>
                        </div>
                    </th>
                    <th class="justify-between hidden sm:table-cell" @click="sort('email')">
                        <div class="flex space-x-1">
                            <div>Email </div>
                            <Chevrons name="email" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons>
                        </div>
                    </th>
                    <th class="justify-between" @click="sort('primaryCompanies.name')">
                        <div class="flex space-x-1">
                            <div>Primary Company </div>
                            <Chevrons name="primaryCompanies.name" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons> 
                        </div>
                    </th>
                    <th class="justify-between hidden xl:table-cell" @click="sort('address1')">
                        <div class="flex space-x-1">
                            <div>Address 1</div>
                            <Chevrons name="address1" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons> 
                        </div>
                    </th>
                    <th class="justify-between hidden lg:table-cell" @click="sort('city')">
                        <div class="flex space-x-1">
                            <div>City</div>
                            <Chevrons name="city" :sort-col="sortCol":sort-dir="sortDir"> </Chevrons> 
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts.data">
                    <!-- if this were dynamic (td in for loop)- could use extraClasses() to style (:class="styling['firstName']") -->
                    <td >
                        <a :href="'/contacts/' + contact.id + '/edit'">{{ contact.firstName }}</a>
                    </td>
                    <td class="">
                        <a :href="'/contacts/' + contact.id + '/edit'">{{ contact.lastName }}</a>
                    </td>
                    <td class="hidden sm:table-cell">{{ contact.email }}</td>
                    <td class="">{{ contact.primaryCompanyName }}</td> 
                    <td class=" hidden xl:table-cell">{{ contact.address1 }}</td>
                    <td class=" hidden lg:table-cell">{{ contact.city }}</td>
                    <td><button type="submit" @click="destroy(contact.id)" @hover="" class="text-red-500"><Trash /></button></td>
                    <!-- @hover="" -->
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
   
</template>
<script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios';
    import { TailwindPagination } from 'laravel-vue-pagination';
    import Chevrons from './Chevrons.vue';
    import Trash from './Trash.vue';
    import Search from './Search.vue';
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
    const page = ref(1);
        
    function getContacts(newPage = page.value){
        //let page = this.contacts.meta.page;
        page.value = newPage;
        let url = '/api/contacts?page=' + page.value;
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

    function destroy(contact){
        axios.delete('/contacts/' + contact)
                .then(response => {
                    getContacts();
                })
                .catch(error => {
                    console.log(error);
                });
    }

    onMounted(() => {
        console.log('before start:');
        console.log(contacts.value);
        getContacts();
        
        // console.log('styling');
        // console.log(this.styling);
    })
</script>