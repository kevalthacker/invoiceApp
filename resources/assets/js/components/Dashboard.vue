<template>
	<div class="">
	<app-header></app-header>
		<div class="flex mb-4">
      <div class="w-1/4 p-12">
	       <app-sidebar></app-sidebar>
	  </div>
      <div class="w-3/4 p-12">
	  <h1 class="block text-black-700 text-4xl font-bold mb-2">Welcome to Invoice Management System V1.0</h1>
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
	  'app-sidebar':SideBar
    }   
 }   
</script>