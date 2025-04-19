<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});
const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Registro" />

    <!-- Imagen de fondo en el área del formulario -->
    <div
        class="min-h-screen flex items-center justify-center bg-cover bg-center px-4"
        style="background-image: url('/storage/img/fondo3.jpg')"
    >
        <!-- Capa blanca translúcida -->
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
                    Crear una cuenta
                </h2>
                <p class="text-sm text-gray-600 mb-6">
                    ¿Ya tienes cuenta?
                    <Link href="/login" class="text-primary hover:underline">
                        Inicia sesión
                    </Link>
                </p>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                            >Nombre</label
                        >
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            autofocus
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"
                        />
                        <p
                            class="text-sm text-red-500 mt-1"
                            v-if="form.errors.name"
                        >
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700"
                            >Correo electrónico</label
                        >
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
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

                    <div>
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700"
                            >Confirmar contraseña</label
                        >
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"
                        />
                        <p
                            class="text-sm text-red-500 mt-1"
                            v-if="form.errors.password_confirmation"
                        >
                            {{ form.errors.password_confirmation }}
                        </p>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-secondary transition duration-300"
                        :disabled="form.processing"
                    >
                        Registrarse
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
