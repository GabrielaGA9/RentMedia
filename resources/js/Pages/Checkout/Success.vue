<template>
    <div
        class="min-h-screen flex items-center justify-center bg-white text-center px-4"
    >
        <div class="max-w-xl">
            <h1 class="text-4xl font-bold text-green-600 mb-4">
                ✅ ¡Pago exitoso!
            </h1>
            <p class="text-gray-700 text-lg mb-6">
                Gracias por tu reserva. Hemos recibido tu pago correctamente.
                Puedes ver el detalle en tu historial de reservas.
            </p>
            <Link
                :href="route('reservas.historial')"
                class="inline-block bg-primary text-white px-6 py-2 rounded hover:bg-secondary transition"
            >
                Ver mis reservas
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
