import Vue from "vue";
import VueRouter from "vue-router";
import Create from "./views/Create";
import List from "./views/List";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/', name: 'home', component: List
        },
        {
            path: '/create', name: 'list', component: Create,
        },
    ]
})
