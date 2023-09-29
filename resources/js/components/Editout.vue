<template>
    <div class="flex justify-center p-8">
        <table class="table-auto border border-gray-300 text-sm">
            <thead class="border-b">
                <tr class="border-b">
                    <th colspan="2" class="p-4">
                        <box-icon
                            name="log-out-circle"
                            color="#fdba74"
                            size="md"
                        ></box-icon>
                        <p class="text-lg">แก้ไขเวลาออก</p>
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
                    <td class="p-4 text-left">
                        <img
                            class="mx-auto rounded-full object-cover object-center h-16 w-16"
                            alt=""
                            :src="
                                path + '/' + y + '/' + m + '/' + d + '/' + pic
                            "
                        />
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">ชื่อ-นามสกุล</td>
                    <td class="p-4 text-left">{{ this.name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">วันที่</td>
                    <td class="p-4 text-left">{{ this.dat }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 border-r text-left">เวลา</td>
                    <td class="flex p-4 text-left">
                        <input
                            type="text"
                            class="border p-2"
                            v-model="this.dataEdit.timeout"
                        />
                        <box-icon
                            name="revision"
                            size="sd"
                            color="#fff"
                            class="p-2 bg-green-300 hover:bg-green-400 hover:cursor-pointer"
                            @click="sendEdit()"
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
        this.getEdit();
    },
    data() {
        return {
            path: "/storage/img",
            pic: "",
            name: "",
            dat: "",
            y: "",
            m: "",
            d: "",
            dataEdit: {
                id: "",
                timeout: "",
            },
        };
    },
    methods: {
        async getEdit() {
            await axios
                .get("/api/editout/" + this.$route.params.id)
                .then((response) => {
                    this.pic = response.data.pic;
                    this.name = response.data.name;
                    this.dat = response.data.dat;
                    this.y = response.data.y;
                    this.m = response.data.m;
                    this.d = response.data.d;

                    this.dataEdit.id = response.data.id;
                    this.dataEdit.timeout = response.data.timeout;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        async sendEdit() {
            await this.$store.dispatch("updateOut", this.dataEdit);
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
