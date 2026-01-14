<template>
    <div>ddd
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts">
                    <td>{{contact.lastName}}, {{contact.firstName}}</td>
                    <td>{{contact.email}}</td>
                    <td>{{contact.company}}</td>
                    <td>
                        
                    </td>
                </tr>
                
            </tbody>
        </table>
        
    </div>
</template>
<script>
    export default {
        //import { onMounted, ref } from 'vue';

        props: {
            contacts: {
                required: true,
            }
        },

        data(){
            return [

            ]
        },

        mounted(){
            // axios.get('/api/contacts')
            //     .then(response => {
            //         contacts.value = response;
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     })
            console.log('there');
        }
    }
</script>