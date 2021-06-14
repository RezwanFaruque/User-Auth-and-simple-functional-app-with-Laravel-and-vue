import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: routes,
    scrollBehavior(to, from, savedPosition){
        if (savedPosition) {
        return savedPosition;
        }
    }
})

// cheking authenticate middleware for going to specific rotues
// router.beforeEach((to,from ,next)=>{
//     if(to.meta.requiresAuth){
//         if(localStorage.getItem("") == null){
//             next({
//                 name: "index",
//             });
            
//         }else{
//             next();
//         }
//     }else{
//         next();
//     }
// });

export default router;