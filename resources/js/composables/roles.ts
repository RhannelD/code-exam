import { ref, Ref } from 'vue';
import axios from 'axios';

export default function useRole() {
    const can_create: Ref<boolean> = ref(false);
    const search: Ref<string> = ref('');
    const roles: Ref<any> = ref([]);
    const role_id: Ref<number | null> = ref(null);
    const errors: Ref<any> = ref('');

    const getRoles = async () => {
        let response = await axios.get('/api/roles?search=' + search.value);
        roles.value = response.data.data;
        can_create.value = response.data.can_create;
    }

    const destroyRole = async (id: number) => {
        let response = await axios.delete('/api/roles/' + id)
            .catch((error_data) => {
                return error_data.response;
            });
        return response.status === 200;
    }

    const showRole = async (id: number) => {
        let response = await axios.get('/api/roles/' + id);
        return response.data.data;
    }

    const saveRole = async (id: any, data: any) => {
        errors.value = '';
        try {
            id == 0
                ? await axios.post('/api/roles', data)
                : await axios.put('/api/roles/' + id, data);
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
        role_id,
        roles,
        getRoles,
        destroyRole,
        showRole,
        saveRole
    };
}
