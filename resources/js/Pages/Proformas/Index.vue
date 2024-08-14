<template>

    <Head title="Formulario de Cotización" />

    <AuthenticatedLayout>
        <div class="w-full px-4 py-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg shadow-lg">
                <div class="flex-auto p-6">
                    <div>
                        <!-- CSRF Token para seguridad (si estás usando Laravel u otro framework similar) -->
                        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="fechaInicial" class="block text-gray-700 text-sm font-semibold mb-2">Fecha
                                    Inicial:</label>
                                <input v-model="form_cot.fechaInicial" type="date" id="fechaInicial" name="fechaInicial"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="fechav" class="block text-gray-700 text-sm font-semibold mb-2">Fecha de
                                    Vencimiento:</label>
                                <input v-model="form_cot.fechav" type="date" id="fechav" name="fechav"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1  gap-6">

                            <div>
                                <label for="idcliente" class="block text-gray-700 text-sm font-semibold mb-2">ID
                                    Cliente:</label>
                                <input v-model.number="form_cot.idcliente" type="number" id="idcliente" name="idcliente"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>
                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="departamento"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Departamento:</label>
                                <input v-model="form_cot.departamento" type="text" id="departamento" name="departamento"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="provincia"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Provincia:</label>
                                <input v-model="form_cot.provincia" type="text" id="provincia" name="provincia"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="distrito"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Distrito:</label>
                                <input v-model="form_cot.distrito" type="text" id="distrito" name="distrito"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>

                        </div>
                        <div class="grid grid-cols-1  gap-6 mb-5">
                            <div>
                                <label for="direccion"
                                    class="block text-gray-700 text-sm font-semibold mb-2">Dirección:</label>
                                <input v-model="form_cot.direccion" type="text" id="direccion" name="direccion"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <!-- CSRF Token para seguridad (si estás usando Laravel u otro framework similar) -->
                            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

                            <!-- Campos Dinámicos -->
                            <div v-for="(item, index) in form.items" :key="index" class="border p-4 rounded-md mb-4">
                                <h3 class="text-lg font-semibold mb-2">Detalle {{ index + 1 }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label :for="'codigo_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Código:</label>
                                        <input v-model="item.codigo" :id="'codigo_' + index" type="text" name="codigo"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label :for="'descripcion_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Descripción:</label>
                                        <textarea v-model="item.descripcion" :id="'descripcion_' + index"
                                            name="descripcion"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            rows="4" required></textarea>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label :for="'cantidad_producto_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Cantidad
                                            Producto:</label>
                                        <input v-model.number="item.cantidad_producto"
                                            :id="'cantidad_producto_' + index" type="number" name="cantidad_producto"
                                            step="0.01"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label :for="'unidad_medida_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Unidad de
                                            Medida:</label>
                                        <input v-model="item.unidad_medida" :id="'unidad_medida_' + index" type="text"
                                            name="unidad_medida"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label :for="'equivale_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Equivale:</label>
                                        <input v-model="item.equivale" :id="'equivale_' + index" type="text"
                                            name="equivale"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label :for="'precio_unitario_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Precio
                                            Unitario:</label>
                                        <input v-model.number="item.precio_unitario" :id="'precio_unitario_' + index"
                                            type="number" name="precio_unitario" step="0.01"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label :for="'subtotal_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Subtotal:</label>
                                        <input v-model.number="item.subtotal" :id="'subtotal_' + index" type="number"
                                            name="subtotal" step="0.01"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label :for="'peso_' + index"
                                            class="block text-gray-700 text-sm font-semibold mb-2">Peso:</label>
                                        <input v-model.number="item.peso" :id="'peso_' + index" type="number"
                                            name="peso" step="0.01"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                </div>

                                <button @click="removeItem(index)" type="button"
                                    class="bg-red-600 text-white py-1 px-2 rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Eliminar Detalle
                                </button>
                            </div>

                            <button @click="addItem" type="button"
                            class="w-full bg-green-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Agregar Otro Detalle
                        </button>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Enviar
                            Cotización</button>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const form_cot = ref({
    idusuario: '',
    idcliente: '',
    fechaInicial: '',
    fechav: '',
    departamento: '',
    provincia: '',
    distrito: '',
    direccion: '',
    estado: '',
    pagos: 0,
    subtotal: 0,
    descuento: 0
});
const form = ref({
    items: [{
        codigo: '',
        descripcion: '',
        cantidad_producto: 0,
        unidad_medida: '',
        equivale: '',
        precio_unitario: 0,
        subtotal: 0,
        peso: 0
    }]
});

// Manejo del envío del formulario
const submitForm = async () => {
    try {
        // Aquí puedes manejar el envío del formulario, por ejemplo, utilizando axios o fetch
        // const response = await axios.post('/submit', form.value);
        // console.log(response.data);
        console.log('Formulario enviado:', form.value);
    } catch (error) {
        console.error('Error al enviar el formulario:', error);
    }
};
// Función para añadir un nuevo detalle
const addItem = () => {
    form.value.items.push({
        codigo: '',
        descripcion: '',
        cantidad_producto: 0,
        unidad_medida: '',
        equivale: '',
        precio_unitario: 0,
        subtotal: 0,
        peso: 0
    });
};

// Función para eliminar un detalle existente
const removeItem = (index) => {
    form.value.items.splice(index, 1);
};
</script>

<style scoped>
/* Estilos adicionales si es necesario */
</style>