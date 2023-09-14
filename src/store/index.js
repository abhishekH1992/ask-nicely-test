import {createStore} from 'vuex'
import employee from './modules/employee';

const store = createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
});

store.registerModule('employee', employee);

export default store;