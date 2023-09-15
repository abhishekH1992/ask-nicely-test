import axios from 'axios';

export default {
    namespaced: true,
    state: {
        list: [],
        salaryList: [],
    },

    getters: {},

    mutations: {
        set_list: (state, list) => {
            state.list = list;
        },
        set_salary_list: (state, salaryList) => {
            state.salaryList = salaryList;
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
        update_email: (context, data) => {
            return axios.post(process.env.VUE_APP_API_URL+'/api/update-email.php', data);
        },
        avg_salary: (context) => {
            return axios.get(process.env.VUE_APP_API_URL+'/api/average-salary.php').then((response) => {
                response.data.result ? context.commit('set_salary_list', response.data.result) : [];
            });
        },
    },
};
