<template>

			<div v-if="loading" class="justify-self-center flex justify-center items-center py-20">
			        <div class="loader"> </div>
			</div>
				<div v-else class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image: url('https://cdn.pixabay.com/photo/2015/10/30/10/40/key-1013662__340.jpg')"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<div class="px-8 mb-4 text-center">
							<h3 class="pt-4 mb-2 text-2xl">Forgot Your Password?</h3>
							<p class="mb-4 text-sm text-gray-700">
								We get it, stuff happens. Just enter your email address below and we'll send you a
								link to reset your password!
							</p>
						</div>
						<form @submit.prevent="forgotpass" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									v-model="email"
									placeholder="Enter Email Address..."
								/>
							</div>
							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Reset Password
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

	data: () => ({

        email: '',
        loading: false,              	
}),



	methods: {
		forgotpass() {
			this.loading = true;
			axios.post("/api/password/create", {

					email: this.email, 
				}, 
				{
		        headers: {
		            'Content-Type': 'application/json',
		            'Store_Key': 'WackAMolE',
		        }
		    })
				.then (response => {
					if (response.data.message) {
						alert(response.data.message);
						this.loading = false;
						this.email = '';
					}
				})

		}
	}

}


</script>