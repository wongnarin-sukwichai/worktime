<template>
    <div class="p-16 bg-gradient-to-r from-blue-400 to-emerald-400">
        <div class="p-8 bg-white shadow-lg mt-24">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div
                    class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0"
                >
                    <div>
                        <div id="digit_clock_date" class="font-semibold"></div>
                        <p class="text-gray-300 text-4xl mb-8">ว/ด/ป</p>
                    </div>
                </div>

                <div class="relative">
                    <div
                        class="w-72 h-72 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-40 flex items-center justify-center text-indigo-500"
                    >
                        <video
                            ref="webcam"
                            autoplay="true"
                            class="rounded-full w-72 h-72 mx-auto"
                        ></video>
                    </div>
                </div>
                <div
                    class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center"
                >
                    <router-link
                        class="rounded-full bg-sky-300 px-8 py-8 text-gray-50 hover:bg-sky-400 text-4xl"
                        to="/"
                    >
                        เข้างาน
                    </router-link>
                    <router-link
                        class="rounded-full px-8 py-8 text-orange-300 outline outline-offset-0 outline-1 outline-orange-300 hover:bg-orange-300 hover:text-gray-50 text-4xl"
                        to="checkout"
                    >
                        ออกงาน
                    </router-link>
                </div>

                <div class="absolute mt-20">
                    <div class="flex py-2">
                        <div class="border-dotted border-2 rounded-lg p-2">
                            1
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            วงศ์นรินทร์ สุขวิชัย
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            08:30:00
                        </div>
                    </div>
                    <div class="flex py-2">
                        <div class="border-dotted border-2 rounded-lg p-2">
                            1
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            วงศ์นรินทร์ สุขวิชัย
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            08:30:00
                        </div>
                    </div>
                    <div class="flex py-2">
                        <div class="border-dotted border-2 rounded-lg p-2">
                            1
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            วงศ์นรินทร์ สุขวิชัย
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            08:30:00
                        </div>
                    </div>
                    <div class="flex py-2">
                        <div class="border-dotted border-2 rounded-lg p-2">
                            1
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            วงศ์นรินทร์ สุขวิชัย
                        </div>
                        <div class="border-dotted border-2 rounded-lg p-2 ml-2">
                            08:30:00
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20 text-center pb-4">
                <h1 class="text-4xl font-medium text-gray-700">
                    {{ this.profile }}
                </h1>
                <p class="font-light text-gray-600 mt-3"></p>
                <p class="mt-8 text-gray-500"></p>
                <p class="mt-2 text-gray-500 text-xl">
                    สำนักวิทยบริการ มหาวิทยาลัยมหาสารคาม
                </p>
            </div>

            <div class="flex flex-wrap justify-center mt-4">
                <div class="flex justify-center px-4">
                    <p class="px-4 pt-5 mr-2 text-2xl">Lates :</p>
                    <canvas
                        class="rounded-full border shadow-lg"
                        ref="showCapture"
                        :width="80"
                        :height="80"
                    ></canvas>
                    <p
                        class="px-3 pt-5 ml-2 border rounded-full shadow-lg text-2xl"
                    >
                        {{ this.profile }}
                    </p>
                    <p
                        class="px-3 pt-5 ml-2 border rounded-full shadow-lg text-2xl"
                    >
                        {{ this.timein }}
                    </p>
                </div>
            </div>

            <form class="mt-8" @submit.prevent="sendData()">
                <div class="relative mb-4 flex flex-wrap items-stretch">
                    <input
                        type="text"
                        class="relative h-28 text-6xl text-sky-700 m-0 -ml-0.5 block w-[1px] min-w-0 flex-auto rounded-lg border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] leading-[1.6] outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Example text with button addon"
                        aria-describedby="button-addon1"
                        style="text-align: center"
                        autofocus
                        v-model="record.uid"
                    />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { computed } from "vue";
import store from "../store";
import Swal from "sweetalert2";

export default {
    mounted() {
        this.startWebcam();
    },
    data() {
        return {
            image: "http://localhost/worktime/public/img/library.jpg",
            formData: "",
            imageCapture: "",
            record: {
                uid: "",
                capture: "",
            },
            profile: "",
            timein: "",
        };
    },
    methods: {
        async sendData() {
            let formData = new FormData();

            try {
                await this.imageCapture.takePhoto().then((blob) => {
                    formData.append("file", blob);
                });

                await this.$store.dispatch("storeUpload", formData);

                this.record.capture = this.$store.getters.getImageName;
            } catch (err) {
                console.log("Something went wrong vue : ", err);
            }

            try {
                await this.$store.dispatch("storeCheckin", this.record);

                //cap หน้าจอแล้วแสดงภาพ
                const context = this.$refs.showCapture.getContext("2d");
                context.drawImage(this.$refs.webcam, 0, 0, 80, 80);
            } catch (err) {
                Swal.fire({
                    icon: "error",
                    title: "ผิดพลาด",
                    text: "กรุณาตรวจสอบรหัส...",
                    timer: 1500,
                });
                // console.log("Something went wrong store : ", err);
            }

            this.profile = this.profileName();
            this.timein = this.timeIn();
            this.record.uid = "";
            this.record.capture = "";
        },

        startWebcam() {
            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices
                    .getUserMedia({
                        video: true,
                    })
                    .then((stream) => {
                        this.$refs.webcam.srcObject = stream; //เปิด webcam
                        this.imageCapture = new ImageCapture(
                            stream.getVideoTracks()[0]
                        );
                    })
                    .catch((err) => {
                        console.log("Something went wrong", err);
                    });
            }
        },

        profileName() {
            return this.$store.getters.getProfileName;
        },

        timeIn() {
            return this.$store.getters.getTimeIn + " น.";
        },
    },
};
</script>
