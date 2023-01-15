<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between justify-items-center">
                        <div>
                            <h2 class="text-center font-bold text-lg mb-2">Asal Sekolah</h2>
                            <div class="schoolChart">
                                <Bar :data="schoolChartData"></Bar>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 py-2">
                        <h1 class="font-bold text-lg mb-2">Asal Sekolah</h1>
                        <div class="statisticByCity">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Kota</th>
                                        <th class="px-4 py-2">Lulus</th>
                                        <th class="px-4 py-2">Tidak Lulus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(city, index) in statistics.filterByCity" :key="index">
                                        <td class="border px-4 py-2">{{ index }}</td>
                                        <td class="border px-4 py-2">{{ city.graduated }}</td>
                                        <td class="border px-4 py-2">{{ city.not_graduated }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js'
import { Bar } from 'vue-chartjs'
ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)

const props = defineProps({
    statistics: {
        type: [Array, Object],
        required: true,
    },
});

const schoolChartData = {
    labels: ['SMA', 'SMK', 'MA'],
    datasets: [
        {
            label: 'Asal Sekolah',
            data: [props.statistics.filterBySchool],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1,
        },
    ],
}


</script>

