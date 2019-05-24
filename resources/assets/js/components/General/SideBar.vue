<template>
    <div>
        <div class="max-w-sm rounded overflow-hidden shadow-lg content-center items-center text-center p-4">
            <svg class="stroke-current text-teal-500 inline-block h-20 w-20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Total Addresses</div>
                <p class="text-gray-700 text-base font-bold">
                    {{ totalAddress }}
                </p>
            </div>
        </div>
        <div class="max-w-sm rounded overflow-hidden shadow-lg content-center items-center text-center mt-12 p-4">
            <svg class="stroke-current text-teal-500 inline-block h-20 w-20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Total Invoices</div>
                <p class="text-gray-700 text-base font-bold">
                    {{ totalInvoices }}
                </p>
            </div>

        </div>
    </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                totalAddress: '',
                totalInvoices: ''
            }
        },
        mounted() {
            var app = this;
            this.axios.get('/addresses')
                .then(function(resp) {
                    app.totalAddress = resp.data.length;
                })
                .catch(function(resp) {
                    console.log(resp);
                    alert("Could not load addresses");
                });

            this.axios.get('/invoices')
                .then(function(resp) {
                    app.totalInvoices = resp.data.length;
                })
                .catch(function(resp) {
                    console.log(resp);
                    alert("Could not load invoices");
                });
        },
    }
</script>