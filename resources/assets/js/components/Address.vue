<template>
    <div class="">
        <app-header></app-header>
        <div class="flex mb-4">
            <div class="w-1/4 p-12">
                <app-sidebar></app-sidebar>
            </div>
            <div class="w-3/4 p-12">
                <div class="flex items-center justify-between flex-wrap ">
                    <div class="float-right pb-8">
                        <router-link :to="{path: 'add-address'}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create new address</router-link>
                    </div>
                    <div class="table w-full">
                        <div class="table-row">
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">ID</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Name</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Address</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">City</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">State</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Zip Code</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Country</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Action</div>
                        </div>
                        <div class="table-row" v-for="address, index in addresses">
                            <div class="table-cell px-4 py-2 text-sm">{{ index + 1 }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ address.company_name }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ address.company_address }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ address.company_city }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ address.company_state }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ address.company_postcode }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ address.company_country }}</div>
                            <div class="table-cell font-semibold text-white px-4 py-2 text-sm">
                                <router-link :to="{path: 'edit-address/' + address.id}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                    Edit
                                </router-link>
                                <a href="#" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-full" v-on:click="deleteAddress(address.id, index)">
                            Delete
                        </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    //import your components here
    import Header from './General/Header.vue'
    import SideBar from './General/SideBar.vue'
    export default {
        components: {
            'app-header': Header,
            'app-sidebar': SideBar
        },
        data: function() {
            return {
                addresses: []
            }
        },
        mounted() {
            var app = this;
            this.axios.get('/addresses')
                .then(function(resp) {
                    app.addresses = resp.data;
                })
                .catch(function(resp) {
                    console.log(resp);
                    alert("Could not load addresses");
                });
        },
        methods: {
            deleteAddress(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    this.axios.delete('/deleteAddress/' + id)
                        .then(function(resp) {
                            app.addresses.splice(index, 1);
                        })
                        .catch(function(resp) {
                            alert("Could not delete address.It's assoicated with one or more invoiceses.");
                        });
                }
            }
        }
    }
</script>