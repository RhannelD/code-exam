import { ref } from 'vue';
import axios from 'axios';
import { Ref } from 'vue';

export default function useUser() {
    const search = ref('');
    const users: any = ref([]);
    const roles: any = ref([]);
    const user_id: Ref<number|null> = ref(null);
    const errors: any = ref('');

    const getUsers = async () => {
        let response = await axios.get('/api/users?search='+search.value);
        users.value = response.data.data;
    }

    const getSelectRoles = async () => {
        let response = await axios.get('/api/users/select/roles');
        roles.value = response.data.data;
    }
    
    const destroyUser = async (id: number) => {
        await axios.delete('/api/users/'+id)
            .catch((error_data) => {
                if ( error_data.response.status===403 ) {
                    window.confirm('Unauthorized Action!')
                }
            });
    }

    const showUser = async (id: number) => {
        let response = await axios.get('/api/users/'+id);
        return response.data.data;
    }

    const saveUser = async (id: any, data:any) => {
        errors.value = '';
        try {
            id==0
                ? await axios.post('/api/users', data)
                : await axios.put('/api/users/'+id, data);
        } catch (error: any) {
            if ( error.response.status===422 ) {
                errors.value = error.response.data.errors;
            }
        }
    }

    return {
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
