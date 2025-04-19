<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Bienvenido a RentMedia" />

    <!-- Hero -->
    <section
        class="bg-cover bg-center min-h-screen flex items-center justify-center px-4"
        style="background-image: url('/storage/img/portada1.jpg')"
    >
        <div
            class="bg-black bg-opacity-60 p-8 rounded-lg max-w-2xl text-center text-white"
        >
            <h1 class="text-4xl font-bold mb-4">Haz visible tu marca</h1>
            <p class="text-lg mb-6">
                Renta espectaculares publicitarios en las mejores ubicaciones
                del país. Fácil, rápido y 100% online.
            </p>
            <div class="flex justify-center gap-4">
                <Link
                    :href="route('login')"
                    class="bg-primary hover:bg-secondary text-white px-6 py-2 rounded-md text-lg transition"
                >
                    Iniciar sesión
                </Link>
                <Link
                    :href="route('register')"
                    class="bg-white text-primary hover:text-secondary px-6 py-2 rounded-md text-lg transition"
                >
                    Registrarse
                </Link>
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="py-16 px-4 bg-gray-100 text-center">
        <h2 class="text-3xl font-bold mb-10">
            ¿Por qué anunciar con nosotros?
        </h2>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-center mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-12 h-12 text-primary"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                        />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">
                    Ubicaciones Estratégicas
                </h3>
                <p>
                    Contamos con medios en zonas de alto tráfico vehicular y
                    peatonal.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-center mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-12 h-12 text-primary"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5"
                        />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Reserva en Línea</h3>
                <p>
                    Consulta disponibilidad y aparta en segundos desde tu panel.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-center mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-12 h-12 text-primary"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 8.25h19.5M3 9h18m-15 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75v10.5A2.25 2.25 0 0 0 4.5 19.5Z"
                        />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pagos en línea</h3>
                <p>Pagos fáciles y rápidos desde casa.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6">
        <p>
            &copy; {{ new Date().getFullYear() }} RentMedia. Todos los derechos
            reservados.
        </p>
    </footer>
</template>
