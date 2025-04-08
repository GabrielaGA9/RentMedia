<template>
    <div class="p-6 max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">🖥️ Catálogo de Medios</h1>
            <Link
                :href="route('cliente.inicio')"
                class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition"
            >
                ⬅️ Volver al Panel
            </Link>
        </div>

        <!-- Barra de búsqueda -->
        <div class="mb-6 flex gap-4">
            <input
                v-model="search"
                type="text"
                placeholder="Buscar medios..."
                class="border p-2 rounded flex-grow"
            />
            <button
                @click="buscar"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                🔍 Buscar
            </button>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div
                v-for="medio in medios.data"
                :key="medio.id"
                class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300"
            >
                <img
                    :src="`/storage/${medio.imagen}`"
                    alt="imagen del medio"
                    class="w-full h-48 object-cover"
                    v-if="medio.imagen"
                />
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-1">
                        {{ medio.nombre }}
                    </h2>
                    <p class="text-gray-500 mb-1">📍 {{ medio.ubicacion }}</p>
                    <span
                        class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full capitalize"
                    >
                        {{ medio.tipo }}
                    </span>
                    <p class="text-green-600 font-bold mt-3">
                        💲{{ medio.precio_por_dia.toLocaleString() }} MXN / día
                    </p>
                    <Link
                        :href="route('medios.show', medio.id)"
                        class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors"
                    >
                        📌 Ver detalles
                    </Link>
                </div>
            </div>
        </div>

        <!-- Paginación mejorada -->
        <div
            v-if="medios.links?.length"
            class="mt-6 flex justify-center space-x-2"
        >
            <Component
                v-for="link in medios.links"
                :is="link.url ? Link : 'span'"
                :key="link.label"
                :href="link.url"
                v-html="link.label"
                class="px-3 py-1 border rounded transition"
                :class="{
                    'bg-blue-600 text-white': link.active,
                    'text-gray-400 cursor-not-allowed': !link.url,
                    'hover:bg-gray-100': link.url && !link.active,
                }"
            />
        </div>

        <!-- Botón flotante hacia arriba -->
        <button
            v-show="scrolled"
            @click="scrollTop"
            class="fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition"
        >
            ⬆️
        </button>
    </div>
</template>

<script setup>
import { usePage, Link, router } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";

const medios = usePage().props.medios;
const search = ref("");

function buscar() {
    router.get(route("medios.catalogo"), { search: search.value });
}

const scrolled = ref(false);
const handleScroll = () => {
    scrolled.value = window.scrollY > 200;
};

const scrollTop = () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
};

onMounted(() => window.addEventListener("scroll", handleScroll));
onUnmounted(() => window.removeEventListener("scroll", handleScroll));
</script>
