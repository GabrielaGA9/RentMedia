<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-bold text-gray-800">
                Medios Publicitarios
            </h2>
        </template>

        <div class="p-6">
            <div
                v-if="$page.props.flash && $page.props.flash.success"
                class="mb-4 p-3 bg-green-100 border text-green-800 rounded"
            >
                {{ $page.props.flash.success }}
            </div>
            <!-- Formulario de creación -->
            <form
                @submit.prevent="submit"
                class="mb-8 grid gap-4 md:grid-cols-2"
                enctype="multipart/form-data"
            >
                <input
                    v-model="form.nombre"
                    type="text"
                    placeholder="Nombre"
                    class="input"
                />
                <input
                    v-model="form.ubicacion"
                    type="text"
                    placeholder="Ubicación"
                    class="input"
                />
                <select v-model="form.tipo" class="input">
                    <option disabled value="">Tipo</option>
                    <option value="espectacular">Espectacular</option>
                    <option value="pantalla">Pantalla</option>
                    <option value="valla">Valla</option>
                    <option value="otro">Otro</option>
                </select>
                <input
                    v-model="form.precio_por_dia"
                    type="number"
                    placeholder="Precio por día"
                    class="input"
                />

                <!-- Campo de imagen -->
                <input
                    ref="imageInput"
                    type="file"
                    @change="handleFileChange"
                    class="input md:col-span-2"
                />

                <div class="md:col-span-2">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Agregar
                    </button>
                </div>
            </form>
            <!-- Filtros de búsqueda -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center gap-4">
                <input
                    v-model="filters.location"
                    type="text"
                    placeholder="Buscar por ubicación"
                    class="input md:w-1/3"
                />
                <select v-model="filters.type" class="input md:w-1/3">
                    <option value="">Todos los tipos</option>
                    <option value="espectacular">Espectacular</option>
                    <option value="pantalla">Pantalla</option>
                    <option value="valla">Valla</option>
                    <option value="otro">Otro</option>
                </select>
                <button
                    @click="applyFilters"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Buscar
                </button>
            </div>
            <!-- Tabla de medios -->
            <table class="min-w-full bg-white rounded shadow overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Imagen</th>
                        <th class="text-left p-3">Nombre</th>
                        <th class="text-left p-3">Ubicación</th>
                        <th class="text-left p-3">Tipo</th>
                        <th class="text-left p-3">Precio</th>
                        <th class="text-left p-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="medio in medios"
                        :key="medio.id"
                        class="border-t"
                    >
                        <td class="p-3">
                            <img
                                v-if="medio.imagen"
                                :src="`/storage/${medio.imagen}`"
                                alt="Imagen del medio"
                                class="w-24 h-auto rounded"
                            />
                        </td>
                        <td class="p-3">{{ medio.nombre }}</td>
                        <td class="p-3">{{ medio.ubicacion }}</td>
                        <td class="p-3 capitalize">{{ medio.tipo }}</td>
                        <td class="p-3">${{ medio.precio_por_dia }}</td>
                        <td class="p-3 flex gap-2">
                            <button
                                @click="edit(medio)"
                                class="text-sm text-blue-600 hover:underline"
                            >
                                Editar
                            </button>
                            <button
                                @click="destroy(medio.id)"
                                class="text-sm text-red-600 hover:underline"
                            >
                                Eliminar
                            </button>
                            <button
                                @click="verDetalle(medio.id)"
                                class="text-sm text-blue-600 hover:underline"
                            >
                                Ver detalles
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Paginación -->
            <div class="mt-6 flex justify-center items-center gap-4">
                <button
                    @click="goToPage(pagination.current_page - 1)"
                    :disabled="pagination.current_page === 1"
                    class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
                >
                    Anterior
                </button>
                <span
                    >Página {{ pagination.current_page }} de
                    {{ pagination.last_page }}</span
                >
                <button
                    @click="goToPage(pagination.current_page + 1)"
                    :disabled="pagination.current_page === pagination.last_page"
                    class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
                >
                    Siguiente
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { useForm, usePage, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

const verDetalle = (id) => {
    router.visit(`/medios/${id}`);
};

const imageInput = ref(null);
const props = usePage().props;
const medios = ref(props.medios.data);

const handleFileChange = (e) => {
    form.imagen = e.target.files[0];
    console.log("Archivo seleccionado:", form.imagen);
};
const form = useForm({
    nombre: "",
    ubicacion: "",
    tipo: "",
    precio_por_dia: "",
    imagen: null,
});

const submit = () => {
    form.post(route("admin.medios.store"), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            if (imageInput.value) imageInput.value.value = null;
            router.visit(route("admin.medios.index"), { only: ["medios"] });
        },
    });
};

const edit = (medio) => {
    form.nombre = medio.nombre;
    form.ubicacion = medio.ubicacion;
    form.tipo = medio.tipo;
    form.precio_por_dia = medio.precio_por_dia;
    form.put(route("admin.medios.update", medio.id));
};

const destroy = (id) => {
    if (confirm("¿Estás segura de eliminar este medio?")) {
        router.delete(route("admin.medios.destroy", id));
    }
};
const pagination = ref({
    current_page: props.medios.current_page,
    last_page: props.medios.last_page,
});

const filters = ref({
    location: props.filters?.location || "",
    type: props.filters?.type || "",
});

const applyFilters = () => {
    router.visit(route("admin.medios.index"), {
        method: "get",
        preserveState: true,
        preserveScroll: true,
        data: filters.value,
    });
};

const goToPage = (page) => {
    router.visit(route("admin.medios.index"), {
        method: "get",
        preserveState: true,
        preserveScroll: true,
        data: {
            ...filters.value,
            page,
        },
    });
};
</script>

<style scoped>
.input {
    @apply w-full px-4 py-2 border rounded;
}
</style>
