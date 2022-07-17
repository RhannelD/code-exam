import { ref, Ref } from 'vue';
import axios from 'axios';

export default function useUser() {
    const can_create: Ref<boolean> = ref(false);
    const search: Ref<string> = ref('');
    const users: Ref<any> = ref([]);
    const roles: Ref<any> = ref([]);
    const user_id: Ref<number | null> = ref(null);
    const errors: Ref<any> = ref('');

    const getUsers = async () => {
        let response = await axios.get('/api/users?search=' + search.value);
        users.value = response.data.data;
        can_create.value = response.data.can_create;
    }

    const getSelectRoles = async () => {
        let response = await axios.get('/api/users/select/roles');
        roles.value = response.data.data;
    }

    const destroyUser = async (id: number) => {
        let response = await axios.delete('/api/users/' + id)
            .catch((error_data) => {
                return error_data.response;
            });
        return response.status === 200;
    }

    const showUser = async (id: number) => {
        let response = await axios.get('/api/users/' + id);
        return response.data.data;
    }

    const saveUser = async (id: any, data: any) => {
        errors.value = '';
        try {
            id == 0
                ? await axios.post('/api/users', data)
                : await axios.put('/api/users/' + id, data);
        } catch (error: any) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        }
    }

    return {
        can_create,
        search,
        errors,
        user_id,
        users,
        roles,
        getUsers,
        destroyUser,
        getSelectRoles,
        showUser,
        saveUser
    };
}
