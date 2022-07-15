<template>
    <div class="mb-5">
        <div class="flex items-center">
            <form class="flex items-center w-full" @submit.prevent="searching">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input type="text" v-model="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search">
                </div>
                <button
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                </button>
            </form>
            <button @click="role_id = 0"
                class="p-2.5 px-4 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Create
            </button>
        </div>
    </div>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6" style="width: 30%;">
                        Full Name
                    </th>
                    <th scope="col" class="py-3 px-6" style="width: 30%;">
                        Role Name
                    </th>
                    <th scope="col" class="py-3 px-6" style="width: 40%;">
                        Role Description
                    </th>
                    <th scope="col" class="py-3 px-6 text-center" style="width: 210px; min-width: 210px;">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item) in roles" :key="item.id"
                    class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ item.user.full_name }}
                    </th>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ item.role_name }}
                    </th>
                    <td class="py-4 px-6">
                        {{ item.role_description }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        <button type="button" @click="role_id = item.id"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mx-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Edit
                        </button>
                        <button type="button" @click="deleteRole(item.id)"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 mx-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <RoleForm v-if="role_id != null" :role_id="role_id" @close="() => role_id = null" @saved="saved" />
</template>

<script setup lang="ts">
import useRole from "../../composables/roles";
import RoleForm from "./RoleForm.vue";
import { onMounted } from "vue";

const { role_id, search, roles, getRoles, destroyRole } = useRole();

onMounted(getRoles);

const searching = async () => {
    await getRoles();
}

const deleteRole = async (id: number) => {
    if (!window.confirm('Delete the record?')) {
        return;
    }

    await destroyRole(id);
    await getRoles();
}

const saved = async () => {
    await getRoles();
    role_id.value = null;
}
</script>