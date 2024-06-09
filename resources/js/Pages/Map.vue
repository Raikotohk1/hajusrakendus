<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import RadarMap from '@/Components/RadarMap.vue';
</script>

<template>
    <Head title="Map" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Map</h2>
        </template>

        
        <div><RadarMap></RadarMap>
        </div>
    </AuthenticatedLayout>
</template>
