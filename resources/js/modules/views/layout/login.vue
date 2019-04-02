<template>
    <div @click="t">login</div>
</template>

<script>
    export default {
        name: "login",
        methods: {
            t(){
                this.$store.dispatch('auth/afterLogin', 'xxx');
                this.$router.push({name: 'home'})
            }
        }
    }
</script>

<style scoped>

</style>