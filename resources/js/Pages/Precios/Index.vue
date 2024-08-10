<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="w-full px-4">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <div class="flex-auto p-4">
                    You are logged in!
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
const props= defineProps({ precios: Array,lugares:Array,productos:Array})
console.log(props.productos)

</script>
