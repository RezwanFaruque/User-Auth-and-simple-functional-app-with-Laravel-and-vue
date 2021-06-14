<template>
    <div>
        <Navbar />
        <slot />
    </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
export default {
    name: "Authlayout",
    components:{
        Navbar,
    }

}
</script>

<style>

</style>