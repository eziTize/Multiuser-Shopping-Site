//import Vue from 'vue';
//import Vuex from 'vuex';
import axios from 'axios';

//Vue.use(Vuex);

export default {
	state: {

		user: {},
		products : [],
        product: {},
		cart: [],
		cartCount: 0,

	},

	getters: {

				userlogged(state) {
					return state.user.is_logged;
				}
		
	},



	actions: {


		loginUser( {}, user ) {

				axios.post("/api/login", {

					email: user.email, 
					password: user.password
				}, 
				{
		        headers: {
		            'Content-Type': 'application/json',
		            'Store_Key': 'WackAMolE',
		        }
		    })
				.then (response => {
					if (response.data.data.error) {
						alert('Invalid Credentials');
					}

					else if (response.data.data.token) {
						//save token
						localStorage.setItem(
							"Store.jwt",
							response.data.data.token)

						window.location.replace("/")


					}

				})
		},


		forgotPass( {}, email ) {

				axios.post("/api/password/create", {

					email: email, 
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
					}

				})
		},



			logout( {}, user ) {


				axios.post("/api/logout",{

					name: user.name,
					is_logged: user.is_logged,
				},
				{
		        headers: {

		            'Content-Type': 'application/json',
		            'Store_Key': 'WackAMolE',
		            'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
		        }
		    })
				.then (response => {


					if (response.data.data.is_logged = false) {
						//save token
						localStorage.removeItem('Store.jwt')


						alert('Loggedout Successfully');

						window.location.replace("/")


					}

				})

				.catch((error) => {
						    // handle this error here
						    alert('Logout Failed');
						})

			},


		registerUser( {}, user ) {

				axios.post("/api/register",  {

					name: user.name,
					email: user.email,
					ph_no: user.ph_no,
					password: user.password,
					c_password: user.c_password,
				}, 
				{
		        headers: {
		            'Content-Type': 'application/json',
		            'Store_Key': 'WackAMolE',
		        }
		    })
				.then (response => {

					if (response.data.data.token !== null) {
						//save token
						localStorage.setItem(
							"Store.jwt",
							response.data.data.token)

						alert('Registration Completed');

						window.location.replace("/")


					}

				})
				.catch((error) => {
						    // handle this error here
						    alert('Registration Failed');
						})
		},


		updateUser( {}, user ) {




				axios.patch("/api/updateuser", {

					name: user.name,
					email: user.email,
					ph_no: user.ph_no,
					password: user.password,
					password_confirmation: user.password_confirmation,
				}, 
				{
		        headers: {

		            'Content-Type': 'application/json',
		            'Store_Key': 'WackAMolE',
		            'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
		        }
		    })

				.then (response => {

					if (response.data.data !== null) {
						

						alert('Details Updated');
					



					}

				})

				.catch((error) => {
						    // handle this error here
						    alert('Updation Failed');
						})
				
					},



					setDefaults({}, user) {


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





			viewCart({}, carts) {

                    if(localStorage.getItem('carts')) {
                        this.carts = JSON.parse(localStorage.getItem('carts'));
                        this.badge = this.carts.length;
                        this.totalprice = this.carts.reduce((total, item)=>{
                            return total + this.quantity * item.price;
                        }, 0);
                    }

                },

                addCart({}, carts) {

                    this.cartadd.id = product.id;
                    this.cartadd.name = product.name;
                    this.cartadd.price = product.price;
                    //this.cartadd.units = product.units;
                    this.carts.push(this.cartadd);
                    this.cartadd = {};
                    this.storeCart();




                },
                
                removeCart({}, product) {

                    this.cartadd.splice(product, 1);
                    this.storeCart();

                },

                storeCart({}, carts) {

                    let parsed = JSON.stringify(this.carts);
                    localStorage.setItem('carts', parsed);
                    this.viewCart();

                },



					
		

},


	mutations: {

		addToCart(state, product) {
			state.cart.push(item);
			state.cartCount++;
		}

		
	},


}


//name spaced way


/*const state = {
	user: {
		email: "abc@abc.com"
	}
};

const getters = {};
const actions = {};
const mutations = {};


export default {
namespaced: true,
state,
getters,
actions,
mutations,
}
*/