import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import routes from './routes';
import storeData from './store/store';
import Navbar from './components/Navbar';
//import Nav2 from './components/Nav2';
import '../css/spinner.css';


//window.axios = require('axios');

Vue.use(VueRouter);
Vue.use (Vuex);
require('./bootstrap');

Vue.prototype.$eventBus = new Vue();

//const app = new Vue --- same as let app
let app = new Vue ({
    el: '#app',

    router: new VueRouter(routes),
    store: new Vuex.Store(storeData),

    name: 'app',
    components: {
        Navbar,
        //Nav2,
    },
});


/*
router.beforeEach((to, from, next) => {
   
        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (localStorage.getItem('bigStore.jwt') == null) {
                next({
                    path: '/login',
                    params: { nextUrl: to.fullPath }
                })
            } else {
                let user = JSON.parse(localStorage.getItem('bigStore.user'))
                if (to.matched.some(record => record.meta.is_admin)) {
                    if (user.is_admin == 1) {
                        next()
                    }
                    else {
                        next({ name: 'userboard' })
                    }
                }
                else if (to.matched.some(record => record.meta.is_user)) {
                    if (user.is_admin == 0) {
                        next()
                    }
                    else {
                        next({ name: 'admin' })
                    }
                }
                next()
            }
        } else {
            next()
        }
    })

*/
