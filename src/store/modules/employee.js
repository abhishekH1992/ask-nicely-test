import axios from 'axios';

export default {
    namespaced: true,
    state: {
        list: [],
    },

    getters: {},

    mutations: {
        set_list: (state, list) => {
            state.list = list;
        },
    },

    actions: {
        get_list: (context) => {
            return axios.get(process.env.VUE_APP_API_URL+'/api/list.php').then((response) => {
                response.data.result ? context.commit('set_list', response.data.result) : [];
            });
        },
        upload_file: (context, data) => {
            return axios.post(process.env.VUE_APP_API_URL+'/api/upload-file.php', data);
        },
    },
};
