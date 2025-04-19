<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <!-- Imagen de fondo en toda la pantalla -->
    <div
        class="min-h-screen flex items-center justify-center bg-cover bg-center px-4"
        style="background-image: url('/storage/img/fondo3.jpg')"
    >
        <!-- Contenedor del formulario con fondo blanco translúcido -->
        <div
            class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg w-full max-w-md"
        >
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <img
                        src="/logo.svg"
                        alt="RentMedia"
                        class="w-10 h-10 text-primary"
                    />
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    Iniciar Sesión
                </h2>
                <p class="text-sm text-gray-600 mb-6">
                    Aún no tienes cuenta?
                    <a href="#" class="text-primary hover:underline"
                        >Regístrate</a
                    >
                </p>

                <div
                    v-if="status"
                    class="mb-4 text-sm font-medium text-green-600"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700"
                            >Email</label
                        >
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            autofocus
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"
                        />
                        <p
                            class="text-sm text-red-500 mt-1"
                            v-if="form.errors.email"
                        >
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                            >Contraseña</label
                        >
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"
                        />
                        <p
                            class="text-sm text-red-500 mt-1"
                            v-if="form.errors.password"
                        >
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input
                                type="checkbox"
                                v-model="form.remember"
                                class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Récuerdame</span
                            >
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-primary hover:underline"
                        >
                            Olvidaste tu contraseña?
                        </Link>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-secondary transition duration-300"
                        :disabled="form.processing"
                    >
                        Iniciar Sesión
                    </button>

                    <div class="text-center text-sm text-gray-500">
                        O ingresa con
                    </div>

                    <div class="flex justify-center space-x-4">
                        <a
                            href="#"
                            class="flex items-center justify-center px-4 py-2 border rounded-md"
                        >
                            <img
                                src="https://www.svgrepo.com/show/475656/google-color.svg"
                                alt="Google"
                                class="w-5 h-5 mr-2"
                            />
                            Google
                        </a>
                        <a
                            href="#"
                            class="flex items-center justify-center px-4 py-2 border rounded-md"
                        >
                            <img
                                src="https://www.svgrepo.com/show/349375/github.svg"
                                alt="GitHub"
                                class="w-5 h-5 mr-2"
                            />
                            GitHub
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
