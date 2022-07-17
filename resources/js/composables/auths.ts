import { useRouter } from 'vue-router';
import { ref, Ref } from 'vue';
import axios from 'axios';

export default function useAuth() {
    const router = useRouter();
    const errors: Ref<any> = ref('');
    const user: Ref<any> = ref([]);

    const signin = async (data: any) => {
        errors.value = '';
    
        await axios.post('/api/signin', data)
            .then((response) => {
                router.push({ name: 'user.index' });
            })
            .catch((error_data) => {
                if ( error_data.response.status===422 ) {
                    errors.value = error_data.response.data.errors;
                }
            });
    }

    const signout = async () => {
        await axios.post('/api/signout')
            .then((response) => {
                router.push({ name: 'signin' });
            });
    }

    const getUser = async () => {
        await axios.get('/api/user')
            .then((response) => {
                user.value = response.data;
            })
            .catch((error_data) => {
                if ( error_data.response.status===401 ) {
                    router.push({ name: 'signin' });
                }
            });
    }

    return {
        errors,
        user,
        signin,
        signout,
        getUser
    };
}
