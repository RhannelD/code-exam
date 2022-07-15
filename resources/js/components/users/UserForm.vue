<template>
    <div @click.self="$emit('close')" id="defaultModal" tabindex="-1" aria-hidden="true"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex bg-gray-900 bg-opacity-50 dark:bg-opacity-80">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Campus Form
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg @click="$emit('close')" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="mb-6">
                        <label for="campus"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
                        <input type="text" id="full_name" v-model="form.full_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Full Name">
                        <small v-if="typeof errors.full_name=='object'" class="text-red-500">
                            {{ errors.full_name[0] }}
                        </small>
                    </div>
                    <div class="mb-6">
                        <label for="email_address" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Address</label>
                        <input type="text" id="email_address" v-model="form.email_address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Email Address">
                        <small v-if="typeof errors.email_address=='object'" class="text-red-500">
                            {{ errors.email_address[0] }}
                        </small>
                    </div>
                    <div class="mb-6">
                        <label for="nominated_password" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                        <input type="password" id="nominated_password" v-model="form.nominated_password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Password">
                        <small v-if="typeof errors.nominated_password=='object'" class="text-red-500">
                            {{ errors.nominated_password[0] }}
                        </small>
                    </div>
                    <div class="mb-6">
                        <label for="confirmed_password" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Password</label>
                        <input type="password" id="confirmed_password" v-model="form.confirmed_password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Confirm Password">
                        <small v-if="typeof errors.confirmed_password=='object'" class="text-red-500">
                            {{ errors.confirmed_password[0] }}
                        </small>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class=" text-right p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button @click="savingUser()" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                        Save
                    </button>
                    <button @click="$emit('close')" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import useUser from "../../composables/users";
import { onMounted, reactive } from "vue";

const props = defineProps(['user_id']);
const emit = defineEmits(['saved','close']);

const form = reactive({
    'user_id': '',
    'full_name': '',
    'email_address': '',
    'nominated_password': '',
    'confirmed_password': '',
})

const { errors, showUser, saveUser } = useUser();

const setUser = async () => {
    if (props.user_id == 0) {
        form.full_name = '';
        form.email_address = '';
        form.nominated_password = '';
        form.confirmed_password = '';
        return;
    }
    let data = await showUser(props.user_id)
    form.full_name = data.full_name;
    form.email_address = data.email_address;
    form.nominated_password = data.nominated_password;
    form.confirmed_password = data.confirmed_password;
}

onMounted(setUser);

const savingUser = async () => {
    form.user_id = props.user_id;
    await saveUser(props.user_id, {...form});

    if (typeof errors.value=='string') {
        window.alert('Record Updated Successfully');
        emit('saved');
    }
}
</script>
