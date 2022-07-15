import { ref } from 'vue';
import axios from 'axios';
import { Ref } from 'vue';

export default function useRole() {
    const search = ref('');
    const roles: any = ref([]);
    const role_id: Ref<number|null> = ref(null);
    const errors: any = ref('');

    const getRoles = async () => {
        let response = await axios.get('/api/roles?search='+search.value);
        roles.value = response.data.data;
    }
    
    const destroyRole = async (id: number) => {
        await axios.delete('/api/roles/'+id)
            .catch((error_data) => {
                if ( error_data.response.status===403 ) {
                    window.confirm('Unauthorized Action!')
                }
            });
    }

    const showRole = async (id: number) => {
        let response = await axios.get('/api/roles/'+id);
        return response.data.data;
    }

    const saveRole = async (id: any, data:any) => {
        errors.value = '';
        try {
            id==0
                ? await axios.post('/api/roles', data)
                : await axios.put('/api/roles/'+id, data);
        } catch (error: any) {
            if ( error.response.status===422 ) {
                errors.value = error.response.data.errors;
            }
        }
    }

    return {
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
