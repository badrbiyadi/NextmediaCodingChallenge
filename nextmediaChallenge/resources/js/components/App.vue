<template>   
    <div>
        <Nav></Nav>

        <div class="container">
            <router-view></router-view>
        </div>

    </div>
</template>

<script>
    import Nav from "./Nav";

    export default {
        components: {
            Nav
        }
    }
</script>

<style scoped>

</style>