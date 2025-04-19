<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-primary leading-tight">
                Panel de Cliente
            </h2>
        </template>

        <div class="max-w-4xl mx-auto py-12 px-4">
            <h1 class="text-4xl font-bold text-primary mb-10 text-center">
                🗓️ Mis Reservas
            </h1>

            <div v-if="reservas.length" class="space-y-10">
                <div
                    v-for="reserva in reservas"
                    :key="reserva.id"
                    class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-md transition"
                >
                    <!-- Imagen del medio -->
                    <img
                        :src="`/storage/${reserva.media.imagen}`"
                        alt="Imagen del medio"
                        class="w-full md:w-1/3 object-cover"
                    />

                    <!-- Información -->
                    <div class="p-6 flex flex-col justify-between w-full">
                        <div>
                            <div
                                class="flex items-center text-sm text-gray-500 mb-2"
                            >
                                <span>{{
                                    formatDate(reserva.fecha_inicio)
                                }}</span>
                                <span class="mx-1">al</span>
                                <span>{{ formatDate(reserva.fecha_fin) }}</span>
                                <span
                                    class="ml-auto bg-gray-100 text-gray-800 px-2 py-0.5 rounded-full text-xs font-semibold"
                                >
                                    {{ reserva.media.tipo }}
                                </span>
                            </div>

                            <h2 class="text-xl font-bold text-primary mb-1">
                                {{ reserva.media.nombre }}
                            </h2>

                            <p class="text-gray-600 mb-3">
                                {{ reserva.media.ubicacion }}
                            </p>

                            <div class="text-green-600 font-semibold mb-4">
                                💰 Total: ${{ reserva.total.toLocaleString() }}
                                MXN
                            </div>
                        </div>

                        <!-- Pago -->
                        <div>
                            <div v-if="!reserva.pagada">
                                <button
                                    @click="pagarReserva(reserva)"
                                    class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition"
                                >
                                    Pagar
                                </button>
                            </div>
                            <div
                                v-else
                                class="inline-block bg-green-100 text-green-800 px-4 py-1 rounded font-semibold text-sm"
                            >
                                Pagado ✅
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="text-center text-gray-600 mt-16">
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
                    No tienes reservas aún. ¡Explora nuestro catálogo y reserva
                    hoy!
                </p>
                <Link
                    :href="route('medios.catalogo')"
                    class="inline-block mt-4 bg-primary text-white px-5 py-2 rounded hover:bg-secondary transition"
                >
                    Ir al catálogo
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, Link } from "@inertiajs/vue3";

const reservas = usePage().props.reservas;

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("es-MX", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};
const pagarReserva = async (reserva) => {
    try {
        const response = await fetch("/payment/checkout-session", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({
                total: reserva.total,
                reserva_id: reserva.id,
            }),
        });
        if (!response.ok) {
            const errorText = await response.text();
            console.error("Error de servidor:", errorText);
            alert("Error al iniciar el pago");
            return;
        }
        const data = await response.json();
        if (data.url) {
            window.location.href = data.url;
        } else {
            alert("No se pudo generar la sesión de pago.");
        }
    } catch (error) {
        console.error("Error al iniciar pago:", error);
        alert("Ocurrió un error al procesar el pago.");
    }
};
</script>
