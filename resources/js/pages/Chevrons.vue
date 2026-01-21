<template>
    <div class="flex pt-2">
        <ChevronUp class="ml-auto size-4" v-show="sortCol == name && sortDir == 'asc'"/>
        <ChevronDown class="ml-auto size-4" v-show="sortCol == name && sortDir == 'desc'"/>
        <ChevronsUpDown class="ml-auto size-4" v-show="sortCol != name"/>  
    </div>
</template>
<script setup>
    import { ChevronDown, ChevronUp, ChevronsUpDown } from 'lucide-vue-next';
    
    const props = defineProps ({
        name: {
            required: true
        },
        sortDir: {
            default: 'desc'
        },
        sortCol:{
            required: true,
        }
    });
</script>