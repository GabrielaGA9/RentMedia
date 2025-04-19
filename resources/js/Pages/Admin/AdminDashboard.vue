<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-2xl text-primary leading-tight">
                    Panel de Administración
                </h2>
            </div>
        </template>

        <div class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-xl p-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        Bienvenido, {{ user.name }} 👋
                    </h1>
                    <p class="text-gray-600 mb-6">
                        Desde este panel puedes gestionar los medios, revisar
                        reservas y monitorear la actividad de los usuarios.
                    </p>

                    <!-- Acciones rápidas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div
                            class="bg-primary text-white rounded-lg p-6 shadow hover:bg-secondary transition"
                        >
                            <h3 class="text-lg font-semibold mb-2">
                                Gestionar Medios
                            </h3>
                            <p class="text-sm opacity-90 mb-4">
                                Crea, edita o elimina espectaculares
                                disponibles.
                            </p>
                            <a
                                href="/admin/media"
                                class="underline text-white text-sm hover:text-gray-200"
                                >Ir a medios →</a
                            >
                        </div>
                        <div
                            class="bg-primary text-white rounded-lg p-6 shadow hover:bg-secondary transition"
                        >
                            <h3 class="text-lg font-semibold mb-2">
                                Ver Reservas
                            </h3>
                            <p class="text-sm opacity-90 mb-4">
                                Consulta el historial y estado de todas las
                                reservas.
                            </p>
                            <a
                                href="/admin/reservas"
                                class="underline text-white text-sm hover:text-gray-200"
                                >Ir a reservas →</a
                            >
                        </div>
                        <div
                            class="bg-primary text-white rounded-lg p-6 shadow hover:bg-secondary transition"
                        >
                            <h3 class="text-lg font-semibold mb-2">
                                Configuración
                            </h3>
                            <p class="text-sm opacity-90 mb-4">
                                Ajustes generales del sistema y usuarios.
                            </p>
                            <a
                                href="/admin/configuracion"
                                class="underline text-white text-sm hover:text-gray-200"
                                >Ir a configuración →</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
console.log("Estoy en AdminDashboard");

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>
