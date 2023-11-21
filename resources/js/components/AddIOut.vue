<template>
    <div class="flex justify-center p-8">
        <table class="table-auto border border-gray-300 text-sm">
            <thead class="border-b">
                <tr class="border-b">
                    <th colspan="2" class="p-4">
                        <box-icon
                            name="plus-circle"
                            color="#fb923c"
                            size="md"
                        ></box-icon>
                        <p class="text-lg">เพิ่มเวลาออก</p>
                    </th>
                </tr>
                <tr>
                    <th
                        class="font-normal border-r p-4 text-center bg-orange-400 text-white"
                    >
                        เรื่อง
                    </th>
                    <th
                        class="font-normal p-4 text-center bg-orange-400 text-white"
                    >
                        รายละเอียด
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">รูป</td>
                    <td class="p-4 text-left bg-gray-300">
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">ชื่อ-นามสกุล</td>
                    <td class="p-4 text-left">{{ this.dataOut.name }} {{ this.dataOut.surname }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">วันที่</td>
                    <td class="p-4 text-left">{{ this.dataOut.dat }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">เวลา</td>
                    <td class="flex p-4 text-left">
                        <input
                            type="text"
                            class="border p-2"
                            placeholder="** 16:30:00 **"
                            v-model="this.dataOut.timeout"
                        />
                        <box-icon
                            name="plus"
                            size="sd"
                            color="#fff"
                            class="p-2 bg-green-300 hover:bg-green-400 hover:cursor-pointer"
                            @click="sendAdd()"
                        ></box-icon>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import "boxicons";
import axios from "axios";
import Swal from "sweetalert2";

export default {
    mounted() {
        this.getName();
    },
    data() {
        return {
            dataOut: {
                uid: this.$route.params.uid,
                name: "",
                surname: "",
                dat: this.$route.params.dat,
                timeout: "",
                other: ""
            },
        };
    },
    methods: {
        async getName() {
            await axios
                .get("/api/showname/" + this.$route.params.uid)
                .then((response) => {
                    this.dataOut.name = response.data.name;
                    this.dataOut.surname = response.data.surname;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        async sendAdd() {
            await this.$store.dispatch("addOut", this.dataOut);
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "บันทึกข้อมูลเรียบร้อย",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    },
};
</script>
