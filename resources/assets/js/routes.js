import Home from './pages/Home';
import Contact from './pages/contact';
import Store from './pages/store';
import Cart from './pages/cart';
import products from './admin/products';
import create from './admin/create';
import category from './pages/category';
import register from './pages/register';
import login from './pages/login';
import forgotpass from './pages/forgotpass';
import resetpass from './pages/resetpass';
import dashboard from './pages/dashboard';
import Checkout from './pages/checkout';
import Orders from './pages/Orders';
import Cod from './pages/cod';
import single_product from './pages/single_product';


function guardMyroute(to, from, next)
{
 var isAuthenticated= false;
//this is just an example. You will have to find a better or 
// centralised way to handle you localstorage data handling 
if(localStorage.getItem('Store.jwt'))
  isAuthenticated = true;
 else
  isAuthenticated= false;
 if(isAuthenticated) 
 {
  next(); // allow to enter route
 } 
 else
 {
  next('/login'); // go to '/login';
 }
}

function guardMyroute2(to, from, next)
{
 var isAuthenticated = false;
//this is just an example. You will have to find a better or 
// centralised way to handle you localstorage data handling 
if(localStorage.getItem('Store.jwt'))
  isAuthenticated = true;
 else
  isAuthenticated= false;
 if(isAuthenticated) 
 {
  next('/dashboard'); // go to '/'; 
 } 
 else
 {
  next(); // allow to enter route
 }
}


export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },

       /* {
            path: '/contact',
            component: Contact,
            name: 'contact'
        }, */

        {
            path: '/store',
            component: Store,
            name: 'store'
        },

        {
            path: '/cart',
            component: Cart,
            name: 'cart'
        },

        {
            path: '/checkout',
            component: Checkout,
            name: 'checkout',
            beforeEnter : guardMyroute,
        },
        
        {
            path: '/cod',
            component: Cod,
            name: 'cod',
            beforeEnter : guardMyroute,
        },


        {
            path: '/my-orders',
            component: Orders,
            name: 'orders',
            beforeEnter : guardMyroute,
        },


      //  {
        //    path: '/admin/products',
       //     component: products,
       //     name: 'products'
       // },

       // {
         //   path: '/admin/create-products',
        //    component: create,
        //    name: 'create'
       // },

        {
            path: '/product/:slug',
            component: single_product,
            name: 'single_product'
        },

        {
            path: '/category/:slug',
            component: category,
            name: 'Category'
        },

        {
            path: '/register',
            component: register,
            name: 'register',
            beforeEnter : guardMyroute2,
            
        },

        {
            path: '/login',
            component: login,
            name: 'login',
            beforeEnter : guardMyroute2,

        },

        {
            path: '/forgot-pass',
            component: forgotpass,
            name: 'forgotpass',
            beforeEnter : guardMyroute2,

        },

        {
            path: '/reset-pass/:token',
            component: resetpass,
            name: 'resetpass',

        },

        {
            path: '/dashboard',
            component: dashboard,
            name: 'dashboard',
            beforeEnter : guardMyroute,

        },

    
    ],


    

};







