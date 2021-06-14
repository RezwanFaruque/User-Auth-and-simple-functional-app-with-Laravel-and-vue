import Registration from '../pages/Registration.vue';
import Login from '../pages/login.vue';
import Khoj from '../pages/Khoj.vue';


const  routes = [
  
    {
        path: "/user/registration",
        name: "userregistration",
        meta: {
            layout: "auth-layout",
            guest: true,
            
        },
        component: Registration,

    },

    {
        path: "/",
        name: "userlogin",
        meta: {
            layout: "auth-layout",
            guest : true,
            
        },
        component: Login,

    },

    {
        path: "/user/khoj-the-search",
        name: "khojthesearch",
        meta: {
            layout: "auth-layout",
            requiresAuth : true,
            
        },
        component: Khoj,

    },
  
];


export default routes;