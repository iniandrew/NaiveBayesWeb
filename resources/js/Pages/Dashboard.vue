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
                    <div class="mt-2 py-2">
                        <h1 class="font-bold text-lg mb-2">Asal Sekolah</h1>
                        <div class="statisticByCity">
                            <table class="table-auto w-full">
                                <thead>
                                <tr>
                                    <th class="px-4 py-2 w-2/3">Sekolah</th>
                                    <th class="px-4 py-2 ">Lulus</th>
                                    <th class="px-4 py-2 ">Tidak Lulus</th>
                                    <th class="px-4 py-2">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in statistics.filterBySchool" :key="index">
                                    <td class="border px-4 py-2">{{ index }}</td>
                                    <td class="border px-4 py-2">{{ item.graduated }}</td>
                                    <td class="border px-4 py-2">{{ item.not_graduated }}</td>
                                    <td class="border px-4 py-2">{{ item.total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="border-2 my-4 border-gray-300">
                    <div class="mt-2 py-2">
                        <h1 class="font-bold text-lg mb-2">Jurusan</h1>
                        <div class="statisticByCity">
                            <table class="table-auto w-full">
                                <thead>
                                <tr>
                                    <th class="px-4 py-2 w-2/3">Jurusan</th>
                                    <th class="px-4 py-2">Lulus</th>
                                    <th class="px-4 py-2">Tidak Lulus</th>
                                    <th class="px-4 py-2">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in statistics.filterByMajor" :key="index">
                                    <td class="border px-4 py-2">{{ index }}</td>
                                    <td class="border px-4 py-2">{{ item.graduated }}</td>
                                    <td class="border px-4 py-2">{{ item.not_graduated }}</td>
                                    <td class="border px-4 py-2">{{ item.total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="border-2 my-4 border-gray-300">
                    <div class="mt-2 py-2">
                        <h1 class="font-bold text-lg mb-2">Asal Kota</h1>
                        <div class="statisticByCity">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 w-2/3">Kota</th>
                                        <th class="px-4 py-2">Lulus</th>
                                        <th class="px-4 py-2">Tidak Lulus</th>
                                        <th class="px-4 py-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in statistics.filterByCity" :key="index">
                                        <td class="border px-4 py-2">{{ index }}</td>
                                        <td class="border px-4 py-2">{{ item.graduated }}</td>
                                        <td class="border px-4 py-2">{{ item.not_graduated }}</td>
                                        <td class="border px-4 py-2">{{ item.total }}</td>
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

const props = defineProps({
    statistics: {
        type: [Array, Object],
        required: true,
    },
});


</script>

