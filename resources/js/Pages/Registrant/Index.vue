<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Pendaftar
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="registarnt-table">
                        <div class="relative overflow-x-auto sm:rounded-lg">
                            <div class="flex items-center justify-between pb-4">
                                <div>
                                    <h1 class="p-6">Data Pendaftar</h1>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                                </div>
                            </div>
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kota
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sekolah
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jurusan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rata-rata SMT 4
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rata-rata SMT 5
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(registrant, index) in registrants.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ registrants.from + index }}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ registrant.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ registrant.city }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ registrant.school }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{  registrant.major }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{  registrant.mean_smt_4 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{  registrant.mean_smt_5 }}
                                        </td>
                                        <td class="px-6 py-4 w-1/6">
                                            <span class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                                                  :class="{'bg-blue-100 text-blue-800': registrant.status === 'graduated', 'bg-red-100 text-red-800 text-xs font-medium': registrant.status === 'not_graduated'}">
                                                {{ registrant.status === 'graduated' ? 'Lulus' : 'Tidak Lulus' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 w-1/12">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination :data="registrants" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Pagination from "../../Components/Pagination.vue";

const props = defineProps({
    registrants: {
        type: [Array, Object],
        required: true
    }
})

const getRegistrants = (page = 1) => {
    axios.get(`/registrant?page=${page}`)
        .then(response => {
            props.registrants = response.data
        })
        .catch(error => {
            console.log(error)
        })
}

</script>

<style scoped>

</style>
