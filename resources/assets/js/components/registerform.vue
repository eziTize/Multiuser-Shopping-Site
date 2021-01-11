<template>

<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
						style="background-image: url('https://cdn.pixabay.com/photo/2013/03/11/19/41/diary-92652_960_720.jpg')"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
						<h3 class="pt-4 text-2xl text-center">Create an Account!</h3>
						<form @submit.prevent="register" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Name
								</label>
								<input
									class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="name"
									type="text"
									placeholder="Full Name"
									v-model="user.name"
								/>
							</div>

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email
								</label>
								<input
									class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									placeholder="Email"
									v-model="user.email"
								/>
							</div>
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="ph_no">
									Phone Number
								</label>
								<input
									class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="ph_no"
									type="ph_no"
									placeholder="Phone Number"
									v-model="user.ph_no"
								/>
							</div>
							<div class="mb-4 md:flex md:justify-between">
								<div class="mb-4 md:mr-2 md:mb-0">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
										Password
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="password"
										type="password"
										placeholder="******************"
										v-model="user.password"
									/>
							<!--		<p class="text-xs italic text-red-500">Please choose a password.</p> -->
								</div>
								<div class="md:ml-2">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
										Confirm Password
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="c_password"
										type="password"
										placeholder="******************"
										v-model="user.c_password"
									/>
								</div>
							</div>
							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Register Account
								</button>
							</div>
							<hr class="mb-6 border-t" />
							<div class="text-center">
								<router-link
									class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
									:to="{name: 'forgotpass'}"
								>
									Forgot Password?
								</router-link>
							</div>
							<div class="text-center">
								<router-link
									class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
									:to="{name: 'login'}"
								>
									Already have an account? Login!
								</router-link>
							</div>
						</form>
					</div>
				</div>
			</template>



<script>


    export default {

    	//props : ['nextUrl'],
        data(){
                return {
        		


                	user: {
                		name : '',
                		email : '',
                		ph_no : '',
                		password : '',
                		c_password : '',
                	},
                
                
            }
            	
            	//token:''
        },


    
methods: {
		register() {

		if (this.user.password.length <= 0 || this.user.name.length <= 0 || this.user.email.length <= 0 || this.user.ph_no.length <= 0) {
			   					
			   					this.user.password = ""
			                    this.user.c_password = ""
			                    return alert('Please fillup all the Fields')
			   }

			else if (this.user.password !== this.user.c_password) {
			                    this.user.password = ""
			                    this.user.c_password = ""
			                    return alert('Passwords do not match')
			                }
			else {
			this.$store.dispatch('registerUser', this.user);
		}
	  }
	}
             
                   		

}
</script>

<style scoped>

</style>