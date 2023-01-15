<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Simulasi Naive Bayes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="mb-6">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
                            <select v-model="form.city" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Pilih Kota</option>
                                <option v-for="(data, index) in cities" :value="data.city">{{ data.city }}</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asal Sekolah</label>
                            <select v-model="form.school" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Pilih Asal Sekolah</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                                <option value="MA">MA</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                            <select v-model="form.major" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Teknologi Informasi">Teknologi Informasi</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Binis Digital">Binis Digital</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Data Science">Data Science</option>
                            </select>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="mb-6">
                                <label for="mean-smt-4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rata-rata Semester 4</label>
                                <input v-model="form.mean_smt_4" type="text" id="mean-smt-4" placeholder="ex. 80.6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <div class="mb-6">
                                <label for="mean-smt-5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rata-rata Semester 5</label>
                                <input v-model="form.mean_smt_5" type="text" id="mean-smt-5" placeholder="ex. 85.7" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div v-if="result" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Hasil Perhitungan Naive Bayes</p>
                    <hr class="my-4 border-2">
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">TOTAL DATA = {{ result.total_data }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">TOTAL LULUS = {{ result.total_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">TOTAL TIDAK LULUS = {{ result.total_not_graduated }}</p>
                    </div>
                    <hr class="my-4 border-2">
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P (LULUS) = {{ result.total_graduated }} / {{ result.total_data }} = {{ result.p_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P (TIDAK LULUS) = {{ result.total_not_graduated }} / {{ result.total_data }} = {{ result.p_not_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( {{ result.selected_city }} | LULUS ) = {{ result.total_selected_city_graduated }} / {{ result.total_graduated }} = {{ result.p_city_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( {{ result.selected_city }} | TIDAK LULUS ) = {{ result.total_selected_city_not_graduated }} / {{ result.total_not_graduated }} = {{ result.p_city_not_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( {{ result.selected_school }} | LULUS ) = {{ result.total_selected_school_graduated }} / {{ result.total_graduated }} = {{ result.p_school_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( {{ result.selected_school }} | TIDAK LULUS ) = {{ result.total_selected_school_not_graduated }} / {{ result.total_not_graduated }} = {{ result.p_school_not_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( {{ result.selected_major }} | LULUS ) = {{ result.total_selected_major_graduated }} / {{ result.total_graduated }} = {{ result.p_major_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( {{ result.selected_major }} | TIDAK LULUS ) = {{ result.total_selected_major_not_graduated }} / {{ result.total_not_graduated }} = {{ result.p_major_not_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( Rata-rata SMT 4 >= {{ result.mean_smt_4 }} | LULUS ) = {{ result.total_selected_mean_smt_4_graduated }} / {{ result.total_graduated }} = {{ result.p_mean_smt_4_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( Rata-rata SMT 4 >= {{ result.mean_smt_4 }} | TIDAK LULUS ) = {{ result.total_selected_mean_smt_4_not_graduated }} / {{ result.total_not_graduated }} = {{ result.p_mean_smt_4_not_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( Rata-rata SMT 5 >= {{ result.mean_smt_5 }} | LULUS ) = {{ result.total_selected_mean_smt_5_graduated }} / {{ result.total_graduated }} = {{ result.p_mean_smt_5_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P ( Rata-rata SMT 5 >= {{ result.mean_smt_5 }} | TIDAK LULUS ) = {{ result.total_selected_mean_smt_5_not_graduated }} / {{ result.total_not_graduated }} = {{ result.p_mean_smt_5_not_graduated }}</p>
                    </div>
                    <div class="my-2">
                        <hr class="my-4 border-2">
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Kesimpulan</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P (LULUS | {{ result.selected_city }}, {{ result.selected_school }}, {{ result.selected_major }}, Rata-rata SMT 4 >= {{ result.mean_smt_4 }}, Rata-rata SMT 5 >= {{ result.mean_smt_5 }} ) = {{ result.p_graduated }} x {{ result.p_city_graduated }} x {{ result.p_school_graduated }} x {{ result.p_major_graduated }} x {{ result.p_mean_smt_4_graduated }} x {{ result.p_mean_smt_5_graduated }} = {{ result.p_graduated_city_school_major }}</p>
                    </div>
                    <div class="my-2">
                        <p class="text-lg text-gray-900 dark:text-white">P (TIDAK LULUS | {{ result.selected_city }}, {{ result.selected_school }}, {{ result.selected_major }}, Rata-rata SMT 4 >= {{ result.mean_smt_4 }}, Rata-rata SMT 5 >= {{ result.mean_smt_5 }} ) = {{ result.p_not_graduated }} x {{ result.p_city_not_graduated }} x {{ result.p_school_not_graduated }} x {{ result.p_major_not_graduated }} x {{ result.p_mean_smt_4_not_graduated }} x {{ result.p_mean_smt_5_not_graduated }} = {{ result.p_not_graduated_city_school_major }}</p>
                    </div>
                    <div class="my-2">
                        <div v-if="result.p_graduated_city_school_major > result.p_not_graduated_city_school_major">
                            <p class="text-lg text-gray-900 dark:text-white">Kesimpulan P (LULUS) > P (TIDAK LULUS) Sehingga Calon Mahasiswa dengan kriteria tersebut dapat di prediksi <span class="font-bold text-green-600">LULUS</span></p>
                        </div>
                        <div v-else>
                            <p class="text-lg text-gray-900 dark:text-white">Kesimpulan P (LULUS) &lt P (TIDAK LULUS) Sehingga Calon Mahasiswa dengan kriteria tersebut dapat di prediksi <span class="font-bold text-red-600">TIDAK LULUS</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import {reactive} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    cities: {
        type: [Array, Object],
        required: true,
    },
    result: {
        type: [Array, Object],
        required: false,
    },
});

const form = useForm({
    city: "",
    school: "",
    major: "",
    mean_smt_4: "",
    mean_smt_5: "",
});

const submit = () => {
    form.post(route("registrants.simulate.bayes.action"));
};


</script>

<style scoped>

</style>
