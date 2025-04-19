<template>
    <div
        class="min-h-screen flex items-center justify-center bg-white text-center px-4"
    >
        <div class="max-w-xl">
            <h1 class="text-4xl font-bold text-red-600 mb-4">
                ❌ Pago cancelado
            </h1>
            <p class="text-gray-700 text-lg mb-6">
                El proceso de pago fue cancelado o no se completó. Si deseas
                intentarlo nuevamente, puedes hacerlo desde tu historial de
                reservas.
            </p>
            <Link
                :href="route('reservas.historial')"
                class="inline-block bg-primary text-white px-6 py-2 rounded hover:bg-secondary transition"
            >
                Volver a Mis Reservas
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
