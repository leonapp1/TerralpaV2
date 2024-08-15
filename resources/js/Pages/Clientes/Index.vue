<template>
    <Head title="Clientes" />
    <AuthenticatedLayout>

        <div class="w-full px-4">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md" :class="clasMsj">
                    <div class="flex items-center justify-center w-12 bg-green-500">
                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666">
                            </path>
                        </svg>
                    </div>

                    <div class="px-4 py-2 -mx-3">
                        <div class="mx-3">
                            <span class="font-semibold text-blue-500">{{ msj }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-4">

                    <div class="min-w-full p-4 bg-white rounded-lg shadow-xs">
                        <button @click="openModalform(1)"
                            class="px-4 py-2 mb-4 text-white bg-indigo-600 rounded hover:bg-indigo-700">Agregar</button>
                        <input v-model="searchQuery" type="text" placeholder="Buscar..."
                            class="px-4 py-2 mb-4 border rounded" />
                        <button @click="downloadExcel" class="px-4 py-2 mb-4 text-white bg-green-500 rounded">Descargar
                            Excel</button>

                        <table class="min-w-full bg-white divide-y divide-gray-200 rounded-lg shadow-md">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-500">DNI</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Nombre</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Teléfono</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(cliente, index) in paginatedClientes" :key="cliente.id">
                                    <td class="px-4 py-2">{{ cliente.dni }}</td>
                                    <td class="px-4 py-2">{{ cliente.nombre }}</td>
                                    <td class="px-4 py-2">{{ cliente.telefono }}</td>
                                    <td class="px-4 py-2 flex gap-2">
                                        <button @click="openModalform(2, cliente)"
                                            class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">Editar</button>

                                        <button @click="delet(cliente.id)"
                                            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-between mt-4">
                            <button @click="prevPage"
                                class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Anterior</button>
                            <button @click="nextPage"
                                class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showmodalform" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-full max-w-3xl p-6 bg-white rounded-lg shadow-lg">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-semibold">{{ title }}</h2>
                    <button @click="closeModalForm" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
                <form @submit.prevent="save">
                    <div class="mb-4">
                        <label for="Dni" class="block mb-2 text-sm font-medium text-gray-700">DNI</label>
                        <input v-model="form.dni" id="Dni" type="number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                    </div>
                    <div class="mb-4">
                        <label for="Nombre" class="block mb-2 text-sm font-medium text-gray-700">Nombre</label>
                        <textarea v-model="form.nombre" id="Nombre"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-700">Teléfono</label>
                        <input v-model="form.telefono" id="telefono" type="number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import * as XLSX from 'xlsx';

const props = defineProps({ clientes: Array });

const form = useForm({
    id: '',
    dni: '',
    nombre: '',
    telefono: ''
});

const showmodalform = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const clasMsj = ref('hidden');

const openModalform = (op, cliente = null) => {
    showmodalform.value = true;
    operation.value = op;
    if (op === 1) {
        title.value = "Registrar Cliente";
        form.reset();
    } else {
        title.value = "Actualizar Cliente";
        form.id = cliente.id;
        form.dni = cliente.dni;
        form.nombre = cliente.nombre;
        form.telefono = cliente.telefono;
    }
};

const delet = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
        form.delete(route('clientes.destroy', id), {
            onSuccess: () => {
                ok("Cliente Eliminado");
            },
            onError: (errors) => {
                console.error('Error al eliminar el cliente:', errors);
            }
        });
    }
};

const closeModalForm = () => {
    showmodalform.value = false;
    form.reset();
};

const save = () => {
    if (operation.value === 1) {
        form.post(route('clientes.store'), {
            onSuccess: () => {
                ok("Cliente Creado");
            },
            onError: (errors) => {
                console.error('Error al crear el cliente:', errors);
            }
        });
    } else {
        form.put(route('clientes.update', form.id), {
            onSuccess: () => {
                ok("Cliente Actualizado");
            },
            onError: (errors) => {
                console.error('Error al actualizar el cliente:', errors);
            }
        });
    }
};

const ok = (message) => {
    closeModalForm();
    msj.value = message;
    clasMsj.value = '';
    setTimeout(() => {
        clasMsj.value = 'hidden';
    }, 8000);
};

const currentPage = ref(1);
const itemsPerPage = 10;
const searchQuery = ref('');

const filteredClientes = computed(() => {
    return props.clientes.filter(cliente => {
        return (
            cliente.dni.toString().includes(searchQuery.value) ||
            cliente.nombre.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });
});

const paginatedClientes = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    return filteredClientes.value.slice(startIndex, startIndex + itemsPerPage);
});

const prevPage = () => {
    if (currentPage.value > 1) currentPage.value--;
};

const nextPage = () => {
    if (currentPage.value * itemsPerPage < filteredClientes.value.length) currentPage.value++;
};

const downloadExcel = () => {
    const worksheet = XLSX.utils.json_to_sheet(props.clientes);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Clientes');
    XLSX.writeFile(workbook, 'clientes.xlsx');
};
</script>
