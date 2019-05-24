<template>
    <div class="">
        <app-header></app-header>
        <div class="flex mb-4">
            <div class="w-1/4 p-12">
                <app-sidebar></app-sidebar>
            </div>
            <div class="w-3/4 p-12">
                <form class="w-full max-w-xl" @submit.prevent="editAddress" method="post">
                    <div class="font-bold text-xl mb-2 px-8 pt-6">Edit Address</div>
                    <div class="px-8 pt-6 mb-4" v-if="success">
                        <div class="bg-teal-100 border border-teal-400  px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">Address updated successfully.</span>
                        </div>
                    </div>
                    <div class="mb-4 px-8 pt-6 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_name">Company Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" type="text" placeholder="Enter Company Name" v-model="address.company_name" required>
                    </div>
                    <div class="mb-4 px-8 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_address">Company Address</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_address" type="text" placeholder="Enter Company Address" v-model="address.company_address" required>
                    </div>
                    <div class="mb-4 px-8 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_website">Company Website</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_website" type="text" placeholder="Enter Company Website" v-model="address.company_website" required>
                    </div>
                    <div class="mb-6 px-8 flex flex-wrap">
                        <div class="w-full md:w-1/3  mb-6 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="company_city">Company City</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_city" type="text" placeholder="Enter Company City" v-model="address.company_city" required>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="company_state">Company State</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_state" type="text" placeholder="Enter Company State" v-model="address.company_state" required>
                        </div>
                        <div class="w-full md:w-1/3 mb-6 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="company_postcode">Company Zip Code</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_postcode" type="text" placeholder="Enter Company Zip Code" v-model="address.company_postcode" required>
                        </div>
                    </div>
                    <div class="mb-6 px-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_country">Company Country</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_country" type="text" placeholder="Enter Company Country" v-model="address.company_country" required>
                    </div>

                    <div class="flex items-center justify-between px-8">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Edit Address
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
</template>

<script>
    //import your components here
    import Header from '../General/Header.vue'
    import SideBar from '../General/SideBar.vue'
    export default {
        mounted() {
                let app = this;
                let id = app.$route.params.id;
                app.addressID = id;
                this.axios.get('/addresses/' + id)
                    .then(function(resp) {
                        app.address = resp.data;
                    })
                    .catch(function() {
                        alert("Could not load your company")
                    });
            },
            components: {
                'app-header': Header,
                'app-sidebar': SideBar
            },
            data: function() {
                return {
                    addressID: null,
                    error: false,
                    errors: {},
                    success: false,
                    address: {
                        company_name: '',
                        company_address: '',
                        company_website: '',
                        company_city: '',
                        company_state: '',
                        company_postcode: '',
                        company_country: ''
                    }
                }
            },
            methods: {
                editAddress() {
                    var app = this;
                    this.axios.put('/editAddress/' + app.addressID, app.address)
                        .then(function(resp) {
                            app.success = true;
                        })
                        .catch(function(resp) {
                            console.log(resp);
                        });
                }
            }
    }
</script>