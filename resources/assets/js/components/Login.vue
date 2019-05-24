<template>
    <div class="bg-white rounded-t-lg h-screen overflow-hidden border-t border-l border-r border-gray-400 p-4 px-3 py-10 bg-gray-200 flex justify-center content-center items-center">
        <form class="bg-white shadow-md rounded pb-8 mb-4 h-auto" @submit.prevent="login" method="post">
            <div class="flex items-center justify-between px-8 bg-blue-900 py-3">
                <h2 class="block text-black-700 text-4xl font-bold mb-2 text-white">Welcome to Invoice App</h2>
            </div>
            <div class="px-8 pt-6" v-if="error">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ errors }} </span>
                </div>
            </div>
            <div class="mb-4 px-8 pt-6 ">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Enter your email" v-model="email" required>
            </div>
            <div class="mb-6 px-8">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" v-model="password" required>
            </div>
            <div class="flex items-center justify-between px-8">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
                <router-link :to="{ name: 'register' }"><a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Register</a></router-link>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
                return {
                    email: null,
                    password: null,
                    error: false,
                    errors: ''
                }
            },
            methods: {
                login() {
                    var app = this
                    var form = new FormData();
                    form.append('email', app.email);
                    form.append('password', app.password);
                    this.$auth.login({
                        data: form,
                        success: function() {},
                        error: function(resp) {
                            app.error = true;
                            app.errors = resp.response.data.msg;
                        },
                        rememberMe: true,
                        redirect: '/dashboard',
                        fetchUser: true,
                    });
                },
            }
    }
</script>