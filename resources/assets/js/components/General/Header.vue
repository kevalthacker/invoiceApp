<template>
    <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <span class="font-semibold text-xl tracking-tight">Invoice App</span>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <router-link :to="{ name: 'dashboard' }"><a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Dashboard</a></router-link>
                <router-link :to="{ name: 'address' }"><a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Manage Addresses</a></router-link>
                <router-link :to="{ name: 'invoice' }"><a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Manage Invoices</a></router-link>
            </div>
            <div>
                <span class="inline-block text-white font-bold mx-3">Welcome, {{ $auth.user().name }} </span>
                <a href="#" @click.prevent="$auth.logout()" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Logout</a>
            </div>
        </div>
    </nav>
</template>