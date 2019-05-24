<template>
    <div class="">
        <app-header></app-header>
        <div class="flex mb-4">
            <div class="w-1/4 p-12">
                <app-sidebar></app-sidebar>
            </div>
            <div class="w-3/4 p-12">
                <form class="w-full max-w-xl" @submit.prevent="editInvoice" method="post">
                    <div class="font-bold text-xl mb-2 px-8 pt-6">Edit Invoice</div>
                    <div class="px-8 pt-6 mb-4" v-if="success">
                        <div class="bg-teal-100 border border-teal-400  px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">Invoice updated successfully.</span>
                        </div>
                    </div>
                    <div class="px-8 flex flex-wrap">
                        <div class="w-full md:w-1/2  mb-6 md:mb-0" v-bind:class="{ 'has-error': error && errors.creater_detail }">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="creater_detail">Your Details</label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 h-32 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" id="creater_detail" type="text" placeholder="Enter Your Details" v-model="invoice.creater_detail" required></textarea>

                            <p class="text-red-500 text-xs italic" v-if="error && errors.creater_detail">{{ errors.creater_detail }}</p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <div v-bind:class="{ 'has-error': error && errors.invoice_no }">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="invoice_no">Invoice Number</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" id="invoice_no" type="text" placeholder="Enter Invoice Number" v-model="invoice.invoice_no" required>
                                <p class="text-red-500 text-xs italic" v-if="error && errors.invoice_no">{{ errors.invoice_no }}</p>
                            </div>
                            <div class="inline-block relative w-full" v-bind:class="{ 'has-error': error && errors.address_id }">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="invoice_no">Select Address</label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" id="address_id" type="text" v-model="invoice.address_id">
                                    <option v-for="address in addresses" :value="address.id">{{address.company_name}}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                                <p class="text-red-500 text-xs italic" v-if="error && errors.address_id">{{ errors.address_id }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 px-8 flex flex-wrap">
                        <div class="w-full md:w-1/2  mb-6 md:mb-0" v-bind:class="{ 'has-error': error && errors.invoice_date }">

                            <label class="block text-gray-700 text-sm font-bold mb-2" for="invoice_date">Invoice Date</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" id="invoice_date" type="text" placeholder="Enter Invoice Date" v-model="invoice.invoice_date" required>
                            <p class="text-red-500 text-xs italic" v-if="error && errors.invoice_date">{{ errors.invoice_date }}</p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" v-bind:class="{ 'has-error': error && errors.due_date }">

                            <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">Due Date</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" id="due_date" type="text" placeholder="Enter Due Date" v-model="invoice.due_date" required>
                            <p class="text-red-500 text-xs italic" v-if="error && errors.due_date">{{ errors.due_date }}</p>
                        </div>
                    </div>
                    <div class="mb-6 px-8 flex flex-wrap">
                        <p class="text-red-500 text-xs italic w-full mb-6" v-if="error && errors.products_empty">{{ errors.products_empty }}</p>
                        <h5 class="font-bold mb-6">Manage Invoice Items <a @click="addLine" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="javascrit:void()">Add Line</a></h5>

                        <div class="table w-full">
                            <div class="table-row">
                                <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Item Name</div>
                                <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Qty</div>
                                <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Price</div>
                                <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Total</div>
                                <div class="table-cell bg-teal-500 font-semibold text-white  px-4 py-2 text-sm">Action</div>
                            </div>
                            <div class="table-row" v-for="item, index in invoice.items">
                                <div class="table-cell font-semibold text-white  px-4 py-2 text-sm">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" type="text" placeholder="Enter item name" v-model="item.item_name" required>
                                </div>
                                <div class="table-cell font-semibold text-white  px-4 py-2 text-sm">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" type="text" placeholder="Enter item qty" v-model="item.qty" required>
                                </div>
                                <div class="table-cell font-semibold text-white  px-4 py-2 text-sm">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" type="text" placeholder="Enter item price" v-model="item.price" required>
                                </div>
                                <div class="table-cell font-semibold px-4 py-2 text-sm">
                                    <span class="table-text">{{item.qty * item.price}}</span>
                                </div>
                                <div class="table-cell font-semibold px-4 py-2 text-sm">
                                    <a @click="removeLine(index)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="javascrit:void()">&times;</a>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="px-8 flex flex-wrap">
                        <div class="w-full md:w-1/2  mb-6 md:mb-0"></div>
                        <div class="w-full md:w-1/2  mb-6 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-6">Subtotal: {{subTotal}}</label>
                        </div>
                    </div>
                    <div class="px-8 flex flex-wrap">
                        <div class="w-full md:w-1/2  mb-6 md:mb-0"></div>
                        <div class="w-full md:w-1/2  mb-6 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Discount:
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6" type="text" placeholder="Enter discount" v-model="invoice.discount" required>
                            </label>
                        </div>
                    </div>
                    <div class="px-8 flex flex-wrap">
                        <div class="w-full md:w-1/2  mb-6 md:mb-0"></div>
                        <div class="w-full md:w-1/2  mb-6 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Total: {{total}}</label>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Edit Invoice
                            </button>

                        </div>
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
        components: {
            'app-header': Header,
            'app-sidebar': SideBar
        },
        data: function() {
            return {
                invoiceID: '',
                addresses: [],
                error: false,
                errors: {},
                success: false,
                selected_address: null,
                invoice: {
                    creater_detail: '',
                    invoice_no: '',
                    address_id: '',
                    invoice_date: '',
                    due_date: '',
                    items: [],
                    discount: 0

                }
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
            let id = app.$route.params.id;
            app.invoiceID = id;
            this.axios.get('/invoices/' + id)
                .then(function(resp) {
                    app.invoice = resp.data;
                })
                .catch(function(resp) {
                    console.log(resp);
                    alert("Could not load addresses");
                });
        },
        methods: {
            addLine: function() {
                var app = this;
                this.invoice.items.push({
                    item_name: '',
                    price: 0,
                    qty: 1
                });
            },
            removeLine: function(index) {
                this.invoice.items.splice(index, 1);
            },
            editInvoice(e) {
                var app = this;
                this.axios.put('/editInvoice/' + app.invoiceID, app.invoice)
                    .then(function(resp) {
                        app.success = true;
                    })
                    .catch(function(resp) {
                        app.error = true;
                        app.errors = resp.response.data;
                    });
            }
        },
        computed: {
            subTotal: function() {
                return this.invoice.items.reduce(function(carry, item) {
                    return carry + (parseFloat(item.qty) * parseFloat(item.price));
                }, 0);
            },
            total: function() {
                return this.subTotal - parseFloat(this.invoice.discount);
            }
        }
    }
</script>