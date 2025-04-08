<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de Cliente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6 mb-6"
                >
                    <h1 class="text-3xl font-bold mb-2">
                        ¡Hola, {{ user.name }}! 👋
                    </h1>
                    <p class="text-lg">¿Qué te gustaría hacer hoy?</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <Link
                        :href="route('medios.catalogo')"
                        class="bg-white hover:shadow-xl transition-shadow duration-300 rounded-lg shadow p-6 text-center"
                    >
                        <div class="text-3xl mb-2">🖥️</div>
                        <h3 class="font-semibold text-xl">Ver Catálogo</h3>
                        <p class="text-gray-500">
                            Explora medios disponibles y realiza nuevas
                            reservas.
                        </p>
                    </Link>

                    <Link
                        :href="route('reservas.historial')"
                        class="bg-white hover:shadow-xl transition-shadow duration-300 rounded-lg shadow p-6 text-center"
                    >
                        <div class="text-3xl mb-2">📅</div>
                        <h3 class="font-semibold text-xl">Mis Reservas</h3>
                        <p class="text-gray-500">
                            Consulta todas tus reservas anteriores y futuras.
                        </p>
                    </Link>

                    <Link
                        :href="route('profile.edit')"
                        class="bg-white hover:shadow-xl transition-shadow duration-300 rounded-lg shadow p-6 text-center"
                    >
                        <div class="text-3xl mb-2">⚙️</div>
                        <h3 class="font-semibold text-xl">Mi Perfil</h3>
                        <p class="text-gray-500">
                            Actualiza tu información personal y configuración.
                        </p>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, Link } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>
