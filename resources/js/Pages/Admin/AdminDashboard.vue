<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de Administración
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <h1 class="text-2xl font-bold mb-4">
                        Bienvenido, {{ user.name }} 👋
                    </h1>
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
