<template>
				<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image: url('https://cdn.pixabay.com/photo/2015/09/15/17/20/vector-note-pad-941436__340.png')"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<div class="px-8 mb-4 text-center">
							<h3 class="pt-4 mb-2 text-2xl">Update Your Details</h3>
							<p class="mb-4 text-sm text-gray-700">
								Leave your Password empty if you do not want to change it.
							</p>
						</div>
						<form @submit.prevent="userupdate" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="name">
									Name
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="name"
									type="text"
									placeholder="Enter your updated name here."
									v-model="user.name"

								/>
							</div>
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									placeholder="Enter Email Address..."
									v-model="user.email"
								/>
							</div>
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="ph_no">
									Phone Number
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="ph_no"
									type="number"
									placeholder="Enter Phone Number..."
									v-model="user.ph_no"
								/>
							</div>
								<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
									Password
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="password"
									type="password"
									placeholder="Enter password to change it..."
									v-model="user.password"
								/>
							</div>
								<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
									Confirm Password
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="password_confirmation"
									type="password"
									placeholder="Confirm password"
									v-model="user.password_confirmation"
								/>
							</div>
							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Update Details
								</button>
							</div>
							<hr class="mb-6 border-t" />
							
						</form>
					</div> 
				</div>
</template>


<script>


    export default {

    	//props : ['nextUrl'],
        data() {
                return {
        		
                	user: {
                		name : '',
                		email : '',
                		ph_no: '',
                		password : '',
                		password_confirmation : '',
                	},
                
                isLoggedIn: localStorage.getItem('Store.jwt') != null,
            }
        },

created() {


			this.setDefaults();
        },
    
methods: {

		userupdate() {

		if ( this.user.name.length <= 0) {
			   					
			   return alert('Please fillup input your Name to update')
			   }

		else if ( this.user.email.length <= 0) {
			   					
			   return alert('Please fillup input your Email to update')
			   }

			else if (this.user.password !== this.user.password_confirmation) {
			                    this.user.password = ""
			                    this.user.password_confirmation = ""
			                    return alert('Passwords do not match')
			                }
			else {
			this.$store.dispatch('updateUser', this.user);
			this.setDefaults();
			window.location.replace("/dashboard")


		}
		},

		setDefaults() {


					if (this.isLoggedIn) {
                    //let user = JSON.parse(localStorage.getItem('Store.user'))
                    //this.name = user.name
                    //this.user_type = user.is_admin
                     

                      fetch('/api/details', {

                                
                                //body: JSON.stringify(this.user),
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })

                    

                        .then(res => res.json())

                        .then(res => {
                        this.user = res.data;

                         //To save in cookies
                         //document.cookie = "Store.jwt =" + this.result.token;


                        })


                }
                     

                     
			},

	
	}
             
                   		

}
</script>

<style scoped>

</style>