<template>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">
                📅 Mis Reservas
            </h1>
            <Link
                :href="route('cliente.inicio')"
                class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition"
            >
                ⬅️ Volver al Panel
            </Link>
        </div>

        <div
            v-if="reservas.length"
            class="grid grid-cols-1 md:grid-cols-2 gap-6"
        >
            <div
                v-for="reserva in reservas"
                :key="reserva.id"
                class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
            >
                <div class="p-5">
                    <h2 class="text-xl font-bold text-gray-700 mb-2">
                        {{ reserva.media.nombre }}
                    </h2>
                    <div class="flex items-center text-gray-600 mb-2">
                        <span class="mr-2">📍</span
                        >{{ reserva.media.ubicacion }}
                    </div>
                    <div class="flex items-center text-gray-600 mb-1">
                        <span class="mr-2">🗓️</span>
                        <span>{{ formatDate(reserva.fecha_inicio) }}</span>
                        <span class="mx-1">al</span>
                        <span>{{ formatDate(reserva.fecha_fin) }}</span>
                    </div>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span class="mr-2">💰</span>
                        <span
                            >Total: ${{
                                reserva.total.toLocaleString()
                            }}
                            MXN</span
                        >
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="text-center text-gray-600">
            <svg
                class="w-16 h-16 mx-auto text-gray-400 mb-4"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6v6l4 2"
                />
                <circle cx="12" cy="12" r="9" />
            </svg>
            <p class="text-lg">
                No tienes reservas aún. ¡Explora nuestro catálogo y reserva hoy!
            </p>
            <Link
                :href="route('medios.catalogo')"
                class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700"
            >
                Ir al catálogo
            </Link>
        </div>
    </div>
</template>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";

const reservas = usePage().props.reservas;

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("es-MX", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};
</script>
