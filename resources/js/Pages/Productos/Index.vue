<template>

    <Head title="Productos" />
    <AuthenticatedLayout>


        <div class="w-full px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md" :class="clasMsj">
                    <div class="flex items-center justify-center w-12 bg-green-500">
                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
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

                        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-md">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-500">Código</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Descripción</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Unidad</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Peso</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Cantidad</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Imagen</th>
                                    <th class="px-4 py-2 text-left text-gray-500">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in paginatedProducts" :key="product.id">
                                    <td class="px-4 py-2">{{ product.codigo }}</td>
                                    <td class="px-4 py-2">{{ product.descripcion }}</td>
                                    <td class="px-4 py-2">{{ product.Unid }}</td>
                                    <td class="px-4 py-2">{{ product.peso }}</td>
                                    <td class="px-4 py-2">{{ product.cantidad }}</td>
                                    <td class="px-4 py-2">
                                        <img v-if="product.img" :src="product.img" alt="Imagen del producto"
                                            class="w-24 h-24 object-cover" />
                                    </td>
                                    <td class="px-4 py-2">
                                        <button @click="openModalform(2, product)"
                                            class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">Editar</button>
                                        <button @click="delet(product.id)"
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
                        <label for="codigo" class="block mb-2 text-sm font-medium text-gray-700">Código</label>
                        <input v-model="form.codigo" id="codigo" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300"
                            required />
                    </div>
                    <div class="mb-4">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-700">Descripción</label>
                        <textarea v-model="form.descripcion" id="descripcion"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="Unid" class="block mb-2 text-sm font-medium text-gray-700">Unidad</label>
                        <input v-model="form.Unid" id="Unid" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                    </div>
                    <div class="mb-4">
                        <label for="peso" class="block mb-2 text-sm font-medium text-gray-700">Peso</label>
                        <input v-model="form.peso" id="peso" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                    </div>
                    <div class="mb-4">
                        <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-700">Cantidad</label>
                        <input v-model="form.cantidad" id="cantidad" type="number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                    </div>
                    <div class="mb-4">
                        <label for="img" class="block mb-2 text-sm font-medium text-gray-700">Imagen URL</label>
                        <input v-model="form.img" id="img" type="text"
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

const props = defineProps({ productos: Array });

const form = useForm({
    id: '',
    codigo: '',
    descripcion: '',
    Unid: '',
    peso: '',
    cantidad: '',
    img: ''
});

const showmodalview = ref(false);
const showmodalform = ref(false);
const showmodaldelet = ref(false);

const title = ref('');
const operation = ref(1);
const msj = ref('');
const clasMsj = ref('hidden');

const openModalform = (op, product = null) => {
    showmodalform.value = true;
    operation.value = op;
    if (op === 1) {
        title.value = "Registrar Producto";
        form.reset();
    } else {
        title.value = "Actualizar Producto";
        form.id = product.id;
        form.codigo = product.codigo;
        form.descripcion = product.descripcion;
        form.Unid = product.Unid;
        form.peso = product.peso;
        form.cantidad = product.cantidad;
        form.img = product.img;
    }
};

const delet = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        form.delete(route('productos.destroy', id), {
            onSuccess: () => {
                ok("Producto Eliminado");
            },
            onError: (errors) => {
                console.error('Error al eliminar el producto:', errors);
            }
        });
    }
};

const closeModalForm = () => {
    showmodalform.value = false;
    form.reset();
};

const save = () => {
    if (operation.value == 1) {
        form.post(route('productos.store'), {
            onSuccess: () => {
                ok("Producto Creado");
            },
            onError: (errors) => {
                console.error('Error al crear el producto:', errors);
            }
        });
    } else {
        form.put(route('productos.update', form.id), {
            onSuccess: () => {
                ok("Producto Actualizado");
            },
            onError: (errors) => {
                console.error('Error al actualizar el producto:', errors);
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

const filteredProducts = computed(() => {
    return props.productos.filter(product => {
        return (
            product.codigo.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            product.descripcion.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });
});

const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return filteredProducts.value.slice(start, end);
});

const totalPages = computed(() => {
    return Math.ceil(filteredProducts.value.length / itemsPerPage);
});

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const downloadExcel = () => {
    const ws = XLSX.utils.json_to_sheet(filteredProducts.value);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "productos");
    XLSX.writeFile(wb, "productos.xlsx");
};
</script>


<style>
/* Añadir transiciones CSS para modales */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
