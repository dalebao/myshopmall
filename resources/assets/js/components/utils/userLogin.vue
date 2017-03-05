<template>
    <form>
        <input type="email" v-model.trim="email"/>
        <input type="password" v-model="pwd" />
        <button @click="handleSub">sub</button>
    </form>
</template>
<script>
    export default {
        name:'login',
        data(){
            return {
                email:"",
                pwd:""
            }
        },
        methods:{
            handleSub(e){
                e.preventDefault();
                console.log(this.email);
                console.log(this.pwd);

            }
        }
    }
</script>