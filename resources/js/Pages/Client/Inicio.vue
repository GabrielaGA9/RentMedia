<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-primary leading-tight">
                Panel de Cliente
            </h2>
        </template>

        <div
            class="min-h-screen bg-fixed bg-cover bg-center"
            style="background-image: url('/storage/img/fondo4.jpg')"
        >
            <div class="py-12 bg-white bg-opacity-90 backdrop-blur-sm">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Bienvenida -->
                    <div class="text-primary rounded-xl shadow-md p-8 mb-8">
                        <h1 class="text-3xl font-bold mb-2">
                            ¡Hola, {{ user.name }}! 👋
                        </h1>
                        <p class="text-lg">¿Qué te gustaría hacer hoy?</p>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="grid md:grid-cols-3 gap-6">
                        <Link
                            :href="route('medios.catalogo')"
                            class="bg-white hover:shadow-lg transition duration-300 rounded-xl border p-6 text-center"
                        >
                            <div class="text-4xl mb-2">🖥️</div>
                            <h3 class="font-semibold text-xl text-primary mb-1">
                                Ver Catálogo
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Explora medios disponibles y realiza nuevas
                                reservas.
                            </p>
                        </Link>

                        <Link
                            :href="route('reservas.historial')"
                            class="bg-white hover:shadow-lg transition duration-300 rounded-xl border p-6 text-center"
                        >
                            <div class="text-4xl mb-2">📅</div>
                            <h3 class="font-semibold text-xl text-primary mb-1">
                                Mis Reservas
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Consulta todas tus reservas anteriores y
                                futuras.
                            </p>
                        </Link>

                        <Link
                            :href="route('profile.edit')"
                            class="bg-white hover:shadow-lg transition duration-300 rounded-xl border p-6 text-center"
                        >
                            <div class="text-4xl mb-2">⚙️</div>
                            <h3 class="font-semibold text-xl text-primary mb-1">
                                Mi Perfil
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Actualiza tu información personal y
                                configuración.
                            </p>
                        </Link>
                    </div>
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
