	<template>

		<!-- Container -->
		
				<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image: url('https://images.unsplash.com/photo-1515965885361-f1e0095517ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3300&q=80')"
					></div>


					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<h3 class="pt-4 text-2xl text-center">Welcome Back!</h3>
						<form @submit.prevent="login" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									placeholder="Email"
									v-model="user.email"

								/>
							</div>
							<div class="mb-4">
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
							<!--	<p class="text-xs italic text-red-500">Please choose a password.</p> -->
							</div>
							<div class="mb-4">
								<input class="mr-2 leading-tight" type="checkbox" id="checkbox_id" />
								<label class="text-sm" for="checkbox_id">
									Remember Me
								</label>
							</div>
							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Sign In
								</button>
							</div>
							<hr class="mb-6 border-t" />
							<div class="text-center">
								<router-link
									class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
									:to="{name: 'register'}"
								>
									Create an Account!

								</router-link>

							</div>
							<div class="text-center">
								<router-link
									class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
									:to="{name: 'forgotpass'}"
								>
									Forgot Password?
								</router-link>
							</div>
						</form>
					</div>
				</div>

</template>

<script>

export default {  

	data: () => ({

		user: {
                		
                email : '',
                password : '',
                	
            }
		
}),



	methods: {
		login() {

			
			this.$store.dispatch('loginUser', this.user);
		}
	}

}


</script>