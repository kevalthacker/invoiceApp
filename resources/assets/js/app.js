import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import Address from './components/Address.vue';
import AddAddress from './components/Address/AddAddress.vue';
import EditAddress from './components/Address/EditAddress.vue';
import Invoice from './components/Invoice.vue';
import AddInvoice from './components/Invoice/AddInvoice.vue';
import EditInvoice from './components/Invoice/EditInvoice.vue';
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login,
			meta: {
				auth: false
			}
        },{
			path: '/login',
			name: 'login',
			component: Login,
			meta: {
				auth: false
			}
		},{
			path: '/register',
			name: 'register',
			component: Register,
			meta: {
				auth: false
			}
		},{
			path: '/dashboard',
			name: 'dashboard',
			component: Dashboard,
			meta: {
				auth: true
			}
		},{
			path: '/address',
			name: 'address',
			component: Address,
			meta: {
				auth: true
			}
		},{
			path: '/add-address',
			name: 'addaddress',
			component: AddAddress,
			meta: {
				auth: true
			}
		},{
			path: '/edit-address/:id',
			name: 'editaddress',
			component: EditAddress,
			meta: {
				auth: true
			}
		},{
			path: '/invoice',
			name: 'invoice',
			component: Invoice,
			meta: {
				auth: true
			}
		},{
			path: '/add-invoice',
			name: 'addinvoice',
			component: AddInvoice,
			meta: {
				auth: true
			}
		},{
			path: '/edit-invoice/:id',
			name: 'editinvoice',
			component: EditInvoice,
			meta: {
				auth: true
			}
		}
    ]
});

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
App.router = Vue.router


new Vue(App).$mount('#app');