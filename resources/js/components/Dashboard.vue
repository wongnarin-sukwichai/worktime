<template>
    <div class="flex flex-col p-8">
        <div class="flex justify-end pb-2 no-print">
            <form class="flex">
                <Datepicker
                    class="hover:cursor-pointer border rounded-lg p-2 text-right"
                    language="th"
                    v-model="picked"
                />
                <button
                    class="rounded-lg border ml-2 p-2 bg-green-200 hover:bg-green-300"
                    @click.prevent="search()"
                >
                    ค้นหา
                </button>
            </form>
        </div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full border text-center text-sm font-light"
                    >
                        <transition-group name="fade" mode="out-in">
                            <tbody
                                style="width: 100%; display: table"
                                v-if="showDayList"
                            >
                                <!-- Header -->
                                <thead class="border-b bg-sky-700 text-white">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            #
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            ชื่อ-นามสกุล
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            วันที่
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            #
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            เวลาเข้า
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            #
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            เวลาออก
                                        </th>
                                        <th
                                            scope="col"
                                            class="border-r px-6 py-2 font-normal"
                                        >
                                            หมายเหตุ
                                        </th>
                                    </tr>
                                </thead>

                                <!-- กลุ่มงาน -->
                                <thead
                                    v-for="(dep, index) in depList"
                                    :key="index"
                                >
                                    <tr>
                                        <th
                                            colspan="8"
                                            class="border-b p-2 font-normal text-left bg-sky-100"
                                        >
                                            {{ dep.dep_title }}
                                        </th>
                                    </tr>

                                    <!-- รายชื่อ -->
                                    <tr
                                        class="border-b"
                                        v-for="(report, index) in showDayList"
                                        :key="index"
                                    >
                                        <template v-if="report.dep === dep.id">
                                            <td
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                {{ index + 1 }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                {{ report.name }}
                                                {{ report.surname }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                {{ report.dat }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                <img
                                                    v-if="report.picin"
                                                    class="mx-auto rounded-full object-cover object-center h-10 w-10"
                                                    alt=""
                                                    :src="
                                                        path +
                                                        '/' +
                                                        report.y +
                                                        '/' +
                                                        report.m +
                                                        '/' +
                                                        report.d +
                                                        '/' +
                                                        report.picin
                                                    "
                                                />
                                            </td>

                                            <td
                                                v-if="report.timein"
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                <a
                                                    class="hover:text-blue-500 hover:cursor-pointer"
                                                    @click.prevent="
                                                        editIn(report.idin)
                                                    "
                                                >
                                                    {{ report.timein }}
                                                </a>
                                            </td>
                                            <td
                                                v-else
                                                class="border-r hover:cursor-pointer hover:bg-sky-100"
                                                @click="addIn(report.uid,report.dat)"
                                            ></td>

                                            <td
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                <img
                                                    v-if="report.picout"
                                                    class="mx-auto rounded-full object-cover object-center h-10 w-10"
                                                    alt=""
                                                    :src="
                                                        path +
                                                        '/' +
                                                        report.y +
                                                        '/' +
                                                        report.m +
                                                        '/' +
                                                        report.d +
                                                        '/' +
                                                        report.picout
                                                    "
                                                />
                                            </td>

                                            <td
                                                v-if="report.timeout"
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            >
                                                <a
                                                    class="hover:text-blue-500 hover:cursor-pointer"
                                                    @click.prevent="
                                                        editOut(report.idout)
                                                    "
                                                >
                                                    {{ report.timeout }}
                                                </a>
                                            </td>
                                            <td
                                                v-else
                                                class="border-r hover:cursor-pointer hover:bg-sky-100"
                                                @click="addOut(report.uid,report.dat)"
                                            ></td>
                                            <td
                                                class="whitespace-nowrap border-r px-6 py-2"
                                            ></td>
                                        </template>
                                    </tr>
                                </thead>
                            </tbody>
                        </transition-group>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "boxicons";
import Datepicker from "vue3-datepicker";
import moment from "moment";
import axios from "axios";

export default {
    mounted() {
        this.getDep();
    },
    data() {
        return {
            path: "/storage/img",
            picked: new Date(),
            show: true,
            report: {
                selected: "",
            },
            showDayList: "",
            depList: "",
        };
    },
    methods: {
        async search() {
            this.report.selected = moment(this.picked)
                .add(543, "years")
                .format("YYYY-MM-DD");
            // console.log(this.selected)
            try {
                await this.$store.dispatch("reportDay", this.report);
                this.showDayList = this.$store.getters.reportDay;
            } catch (err) {
                console.log(err);
            }
        },
        getDep() {
            axios
                .get("/api/dep")
                .then((response) => {
                    this.depList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        editIn(id) {
            this.$router.push("/editin/" + id);
        },
        editOut(id) {
            this.$router.push("/editout/" + id);
        },
        addIn(uid, dat) {
            this.$router.push("/addin/" + uid + "/" + dat);
        },
        addOut(uid, dat) {
            this.$router.push("/addout/" + uid + "/" + dat);
        },
    },
    components: {
        Datepicker,
    },
};
</script>

<style>
.boxplus:hover {
    color: red;
}
</style>
