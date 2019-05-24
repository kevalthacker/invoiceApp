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
                        <router-link :to="{path: 'add-invoice'}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create new invoice</router-link>
                    </div>
                    <div class="table w-full">
                        <div class="table-row">
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">ID</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Invoice Number</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Date</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Due Date</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Discount</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Total</div>
                            <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Action</div>
                        </div>
                        <div class="table-row" v-for="invoice, index in invoices">
                            <div class="table-cell px-4 py-2 text-sm">{{ index + 1 }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ invoice.invoice_no }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ invoice.invoice_date }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ invoice.due_date }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ invoice.discount }}</div>
                            <div class="table-cell px-4 py-2 text-sm">{{ invoice.grand_total }}</div>
                            <div class="table-cell font-semibold text-white px-4 py-2 text-sm">
                                <router-link :to="{path: 'edit-invoice/' + invoice.id }" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Edit</router-link>
                                <a href="#" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-full" @click="deleteInvoice(invoice.id, index)">
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
                invoices: []
            }
        },
        mounted() {
            var app = this;
            this.axios.get('/invoices')
                .then(function(resp) {
                    app.invoices = resp.data;
                })
                .catch(function(resp) {
                    alert("Could not load addresses");
                });
        },
        methods: {
            deleteInvoice(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    this.axios.delete('/deleteInvoice/' + id)
                        .then(function(resp) {
                            app.invoices.splice(index, 1);
                        })
                        .catch(function(resp) {
                            alert("Could not delete invoice.");
                        });
                }
            }
        }
    }
</script>