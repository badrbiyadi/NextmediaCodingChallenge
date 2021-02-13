import Vue from "vue";
import VueRouter from "vue-router";
import Create from "./views/Create";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/', name: 'home', component: Create
        }
    ]
})
