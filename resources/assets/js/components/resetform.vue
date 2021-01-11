<template>
			<section class="w-full xl:w-3/4 lg:w-11/12 mx-auto container" v-if="!invalid">
				<div v-if="loading" class="justify-self-center flex justify-center items-center py-20">
					 <div class="loader"> </div>
				</div>
				<div v-else class="flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image: url('https://cdn.pixabay.com/photo/2017/03/23/12/56/security-2168233_960_720.jpg')"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<div class="px-8 mb-4 text-center">
							<h3 class="pt-4 mb-2 text-2xl">Reset Your Password?</h3>
							<p class="mb-4 text-sm text-gray-700">
								Carefully choose a new password and confirm it to reset your password.
							</p>
						</div>
						<form  @submit.prevent="resetPass" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
							<div class="mb-4 lg:flex lg:justify-between">
								<div class="mb-4 lg:mr-2 lg:mb-0">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
										Password
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="password"
										type="password"
										v-model="password"
										placeholder="******************"
									/>
							<!--		<p class="text-xs italic text-red-500">Please choose a password.</p> -->
								</div>
								<div class="lg:ml-2">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
										Confirm Password
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="password_confirmation"
										type="password"
										v-model="password_confirmation"
										placeholder="******************"
									/>
								</div>
							</div>

							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-teal-500 rounded-full hover:bg-teal-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Confirm Password
								</button>
							</div>
						</form>
					</div>
				</div>
			</section>
				<div  v-else class="text-gray-900">
					<div class="pt-20 pb-10 flex justify-center">
					    <h1 class="text-4xl text-red-500">
					        Error!
					    </h1>
					</div>
					<p class="text-center pb-10 text-gray-600 px-2 text-xl">{{message}}</p>
			    </div>

</template>

<script>
export default {  

	data: () => ({

        password: '',
        password_confirmation: '',
        email: '',
        token: '',
        message: '',
        invalid: '', 
        loading: '',             	
}),

	mounted() {
		this.getToken();
	},

	methods: {
		getToken() {
			axios.get('/api/password/reset/' + this.$route.params.token, {
		        headers: {
		            'Store_Key': 'WackAMolE',
		        }
		    })
				.then (response => {
					if (response.data.message) {
						this.invalid = true;
						this.message = response.data.message;
						alert(this.message);
					}
					else {
						this.email = response.data.email;
  						this.token = response.data.token;
						this.invalid = false;
					}
				})

		},

		resetPass(){

		if (this.password.length <= 0 || this.password_confirmation.length <= 0) {
			   					
			   					this.password = "";
			                    this.password_confirmation = ""
			                    return alert('Please fillup all the Fields')
			   }

			else if (this.password !== this.password_confirmation) {
			                    this.password = "";
			                    this.password_confirmation = "";
			                    return alert('Passwords do not match')
			                }
			else {
			
					this.loading = true;
					axios.post("/api/password/reset",  {

					email: this.email,
					token: this.token,
					password: this.password,
					password_confirmation: this.password_confirmation,
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
						this.password = '';
						this.password_confirmation = '';
					}

					else if (response.data.name) {
						this.loading = false;
						alert('Reset Successful');
						this.password = '';
						this.password_confirmation = '';
						window.location.replace("/");

					}

				})
		}
	  }
	}

}

</script>