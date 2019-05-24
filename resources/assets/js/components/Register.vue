<template>
    <div class="bg-white rounded-t-lg h-screen overflow-hidden border-t border-l border-r border-gray-400 p-4 px-3 py-10 bg-gray-200 flex justify-center content-center items-center">
        <form class="bg-white shadow-md rounded pb-8 mb-4 h-auto" @submit.prevent="register" method="post">
            <div class="flex items-center justify-between px-8 bg-blue-900 py-3">
                <h2 class="block text-black-700 text-4xl font-bold mb-2 text-white">Create an account</h2>
            </div>
            <div class="mb-4 px-8 pt-6 " v-bind:class="{ 'has-error': error && errors.name }">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Enter your full name" v-model="name" required>
                <p class="text-red-500 text-xs italic" v-if="error && errors.name">{{ errors.name }}</p>
            </div>
            <div class="mb-4 px-8" v-bind:class="{ 'has-error': error && errors.email }">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Enter your email" v-model="email" required>
                <p class="text-red-500 text-xs italic" v-if="error && errors.email">{{ errors.email }}</p>
            </div>
            <div class="mb-6 px-8" v-bind:class="{ 'has-error': error && errors.password }">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" v-model="password" required>
                <p class="text-red-500 text-xs italic" v-if="error && errors.password">{{ errors.password }}</p>
            </div>
            <div class="flex items-center justify-between px-8">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Register
                </button>
                <router-link :to="{ name: 'login' }"><a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Login</a></router-link>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
                return {
                    name: '',
                    email: '',
                    password: '',
                    error: false,
                    errors: {},
                    success: false
                };
            },
            methods: {
                register() {
                    var app = this;
                    var form = new FormData();
                    form.append('name', app.name);
                    form.append('email', app.email);
                    form.append('password', app.password);
                    this.$auth.register({
                        data: form,
                        success: function() {
                            app.success = true
                        },
                        autoLogin: true,
                        error: function(resp) {
                            app.error = true;
                            app.errors = resp.response.data;
                        },
                        rememberMe: true,
                        redirect: '/dashboard',
                        fetchUser: true
                    });
                }
            }
    }
</script>