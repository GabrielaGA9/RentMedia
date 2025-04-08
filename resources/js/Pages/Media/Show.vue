<template>
    <div class="p-6 max-w-xl mx-auto bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Reserva tu espacio</h1>

        <Datepicker
            v-model="range"
            range
            :min-date="new Date()"
            :disabled-dates="disabledDates"
            :enable-time-picker="false"
            class="w-full border p-2 rounded"
        />

        <div class="mt-4 space-y-2">
            <p v-if="range && range.length === 2" class="text-gray-700">
                Has seleccionado del
                <strong>{{ formatDate(range[0]) }}</strong> al
                <strong>{{ formatDate(range[1]) }}</strong>
            </p>

            <p v-if="total > 0" class="text-green-700 font-semibold">
                Total: ${{ total.toLocaleString() }} MXN
            </p>

            <button
                @click="confirmarReserva"
                :disabled="!range || range.length !== 2"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Confirmar reserva
            </button>

            <p v-if="mensaje" class="text-sm text-green-600 mt-2">
                {{ mensaje }}
            </p>
        </div>
    </div>
    <div v-if="estado === 'procesando'" class="text-center my-4">
        <div
            class="animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500 mx-auto mb-2"
        ></div>
        <p class="text-gray-600">Procesando pago...</p>
    </div>

    <div v-if="estado === 'exito'" class="text-center my-4">
        <svg
            class="h-12 w-12 text-green-500 mx-auto mb-2"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"
            />
        </svg>
        <p class="text-green-600 font-semibold">¡Reserva confirmada!</p>
    </div>
</template>

<script setup>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ref, watch, onMounted } from "vue";
import axios from "axios";
import { usePage } from "@inertiajs/vue3";

const media = usePage().props.media;
const range = ref([]);
const disabledDates = ref([]);
const total = ref(0);
const mensaje = ref("");
const estado = ref(null);

async function confirmarReserva() {
    estado.value = "procesando";
    mensaje.value = "";

    try {
        // Simulación de delay como si fuera un pago
        await new Promise((resolve) => setTimeout(resolve, 2000));

        await axios.post(`/reservas`, {
            media_id: media.id,
            fecha_inicio: range.value[0].toISOString().split("T")[0],
            fecha_fin: range.value[1].toISOString().split("T")[0],
        });

        estado.value = "exito";
        mensaje.value = "¡Reserva realizada con éxito!";
    } catch (err) {
        estado.value = null;
        console.error("Error al reservar:", err);
        mensaje.value = "Ocurrió un error al reservar.";
    }
}
// Calcular total al seleccionar rango
watch(range, () => {
    if (range.value?.length === 2) {
        const [start, end] = range.value;
        const days = Math.round((end - start) / (1000 * 60 * 60 * 24)) + 1;
        total.value = days * media.precio_por_dia;
    } else {
        total.value = 0;
    }
});

// Cargar fechas ocupadas
onMounted(async () => {
    try {
        const res = await axios.get(`/medios/${media.id}/fechas-ocupadas`);
        disabledDates.value = res.data.map((d) => new Date(d));
    } catch (err) {
        console.error("Error cargando fechas ocupadas:", err);
    }
});

// Formatear fecha para mostrar
function formatDate(date) {
    return date.toLocaleDateString("es-MX", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

// Confirmar reserva
</script>
